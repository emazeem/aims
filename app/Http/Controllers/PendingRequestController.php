<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Quotes;
use App\Models\Session;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;

class PendingRequestController extends Controller
{
    public function index(){
        $this->authorize('pending-index');
        return view('pendings.index');
    }
    public function fetch(){
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
                return "&emsp;              
                  <a title='Add' class='btn btn-sm btn-primary' href='" . url('pendings/create/'.$data->id) . "'><i class='fa fa-plus'></i></a>
                  <a title='Review' class='btn btn-sm btn-info' href='" . url('pendings/print_review/'.$data->quote_id) . "'><i class='fa fa-print'></i></a>
                  
                <a class='btn btn-danger btn-sm nofacility' href='#' data-id='{$data->id}'><i class='fa fa-ban'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

            })
            ->rawColumns(['options'])
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
        return redirect('pendings')->with('success', 'Capability and Quote Sent Successfully');
    }
    //capapbility create page in pending menu with id of not listed item
    public function create($id){
        $edit=Item::find($id);
        $procedures=Procedure::all();
        $parameters=Parameter::all();
        return view('pendings.create',compact('parameters','id','edit','procedures'));
    }
    public function print_review($id){
        $print=Item::where('id',$id)->get();
        return view('pendings.reviewform',compact('print'));
    }
    //
}
