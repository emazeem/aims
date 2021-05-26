<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;

class PendingRequestController extends Controller
{
    public function index(){
        $this->authorize('pending-index');
        return view('pendings.index');
    }
    /*public function fetch(){
        $data=Item::with('quotes')->where('not_available','!=',null)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('quotes', function ($data) {
                return $data->quote_id;
            })
            ->addColumn('customer', function ($data) {
                $customer=Customer::find($data->quotes->customer_id);
                return $customer->reg_name;
            })
            ->addColumn('not_available', function ($data) {
                return $data->not_available;
            })
            ->addColumn('createdat', function ($data) {
                return $data->created_at;
            })
            ->addColumn('updatedat', function ($data) {
                return $data->updated_at;
            })

            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $option=null;
                if ($data->status==1) {
                    $option .= "<a title='Checks' class='btn btn-sm btn-success checks'  href='#' data-id='{$data->id}'><i class='fa fa-check'></i></a>";
                    $option .= "<a title='Add' class='btn btn-sm btn-primary' href='" . url('pendings/create/' . $data->id) . "'><i class='fa fa-plus'></i></a>";
                    $option.="<a class='btn btn-danger btn-sm nofacility' href='#' data-id='{$data->id}'><i class='fa fa-ban'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                else{
                    $option .= "<a title='Checks' class='btn btn-sm btn-success checks'  href='#' data-id='{$data->id}'><i class='fa fa-check'></i></a>";

                }
                return $option."&emsp;";

            })
            ->rawColumns(['options'])
            ->make(true);

    }
    */
    public function fetch(){
        $this->authorize('quote-index');

        $quotes=Quotes::with('items')->get();
        $pending=[];
        foreach ($quotes as $quote){
            foreach ($quote->items as $item){
                if ($item->status==1){
                    $pending[]=$quote->id;
                }
            }
        }
        $pending=array_unique($pending);
        $data=Quotes::with('customers')->whereIn('id',$pending)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return 'RFQ/'.date('y',strtotime($data->created_at)).'/'.$data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('status', function ($data) {
                //Items are adding
                if ($data->status==0){
                    $status= '<b class="badge badge-secondary">Items being added</b>';
                }
                if ($data->status==1){
                    $status= '<b class="badge badge-success">New Quote Generated</b>';
                }
                if ($data->status==2){
                    $status= '<b class="badge badge-success">Waiting for Customer Approval</b>';
                }
                if ($data->status==3){
                    $status= '<b class="badge badge-danger">Approved</b>';
                }
                return $status;
            })
            ->addColumn('total', function ($data) {
                $total=Item::where('quote_id',$data->id)->where('status',1)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                $action.="<a title='view' href=".url('/pendings/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }


    //adding capabilities & quote by technical manager for pending requests
    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'range' => 'required',
            'unit' => 'required',
            'accuracy' => 'required',
            'price' => 'required',
            'remarks' => 'required',
            'location' => 'required',
        ],[
            'name.required' => 'Name field is required *',
            'category.required' => 'Category field is required *',
            'range.required' => 'Range field is required *',
            'unit.required' => 'Unit field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'price.required' => 'Price field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',


        ]);
        $capabilities=new Capabilities();
        $capabilities->name=$request->name;
        $capabilities->parameter=$request->category;
        $capabilities->range=$request->range;
        $capabilities->unit=$request->unit;
        $capabilities->accuracy=$request->accuracy;
        $capabilities->price=$request->price;
        $capabilities->remarks=$request->remarks;
        $capabilities->location=$request->location;
        $capabilities->procedure=$request->procedure;
        $capabilities->accredited=($request->accredited)?$request->accredited:'';
        if ($capabilities->save()){
            $quotes=Item::find($request->na_id);
            $quotes->parameter=$request->category;
            $quotes->capability=$capabilities->id;
            $quotes->not_available=null;
            $quotes->status=2;
            $quotes->range=$request->range;
            $quotes->price=$request->price;
            $quotes->save();
        }
        return back()->with('success', 'Capability added successfully');
    }
    //capability create page in pending menu with id of not listed item
    public function create($id){
        $edit=Item::find($id);
        $procedures=Procedure::all();
        $parameters=Parameter::all();
        $units=Unit::all();
        return view('pendings.create',compact('parameters','id','edit','procedures','units'));
    }
    public function show($id){
        $quote=Quotes::find($id);
        return view('pendings.show',compact('quote'));
    }

    public function print_review($id){
        $print=Item::where('id',$id)->get();
        return view('pendings.reviewform',compact('print'));
    }
    public function checks(Request $request){
        //dd($request->all());
        $array=array();
        if (isset($request->ref_std)){
            $array[0]=1;
        }
        else{
            $array[0]=0;
        }
        if (isset($request->cal_procedure)){
            $array[1]=1;
        }
        else{
            $array[1]=0;
        }
        if (isset($request->cal_schedule)){
            $array[2]=1;
        }
        else{
            $array[2]=0;
        }
        $items=Item::find($request->id);
        $items->rf_checks=implode(',',$array);
        $items->rf_reason=$request->rf_reason;
        $items->save();
        return response()->json(['success'=>'Checks added successfully']);
    }

    //
}
