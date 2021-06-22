<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\QuoteItem;
use App\Models\Parameter;
use App\Models\Quotes;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenerateRequestsController extends Controller
{
    public function index(){

        $this->authorize('quote-index');
        $customers=Customer::orderBY('reg_name')->get();
        $tms=User::whereIn('id',[1,8,19])->get();
        $capabilities=Capabilities::all();
        $parameters=Parameter::all();

        return view('generate_requests.index',compact('customers','tms','capabilities','parameters'));
    }
    public function fetch(){
        $this->authorize('quote-index');
        $data=Quotes::with('customers')->where('status',0)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return str_replace('QTN','RFQ',$data->cid);
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
                    $status= '<b class="badge badge-secondary  p-1 px-2 mt-2">Items being added</b>';
                }
                return $status;
            })
            ->addColumn('turnaround', function ($data) {
                return $data->turnaround;
            })
            ->addColumn('total', function ($data) {
                $total=QuoteItem::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='view' href=".url('/generate-requests/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function store(Request $request){
        $this->authorize('quote-create');
        $this->validate(request(), [
            'customer' => 'required',
            'principal' => 'required',
            'rfq_mode' => 'required',
            'rfq_mode_details' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',
            'principal.required' => 'Customer field is required *',
            'rfq_mode.required' => 'Customer field is required *',
            'rfq_mode_details.required' => 'Customer field is required *',

        ]);
        $checks=Quotes::where('customer_id',$request->customer)->get();
        foreach ($checks as $check) {
            if ($check->status===0){
                return response()->json(['errors'=>'Already in progress']);
            }
            else if ($check->status===1){
                return response()->json(['errors'=>'Already in progress']);
            }
        }

        $session=new Quotes();
        $session->cid='RFQ/'.str_pad($session->id, 6, '0', STR_PAD_LEFT);
        $session->customer_id=$request->customer;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
        $session->rfq_mode=$request->rfq_mode;
        $session->rfq_mode_details=$request->rfq_mode_details;
        $session->save();

        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('quote-edit');
        $this->validate(request(), [            'customer' => 'required',
            'principal' => 'required',
            'rfq_mode' => 'required',
            'rfq_mode_details' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',
            'principal.required' => 'Customer field is required *',
            'rfq_mode.required' => 'Customer field is required *',
            'rfq_mode_details.required' => 'Customer field is required *',
        ]);
        $session=Quotes::find($request->id);
        $session->customer_id=$request->customer;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
        $session->rfq_mode=$request->rfq_mode;
        $session->rfq_mode_details=$request->rfq_mode_details;
        $session->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $this->authorize('quote-edit');
        $edit=Quotes::find($request->id);
        return response()->json($edit);
    }
    public function show($id){
        $this->authorize('quote-view');
        $show=Quotes::find($id);
        $tms=User::where('department',3)->get();
        $items=QuoteItem::where('quote_id',$id)->get();
        $noaction=false;
        foreach ($items as $item){
            if ($item->status==1){
                $noaction=true;
            }
        }
        $capabilities=Capabilities::orderBy('name','ASC')->get();
        $parameters=Parameter::orderBy('name','ASC')->where('id','!=',14)->get();
        return view('generate_requests.show',compact('show','id','tms','items','noaction','capabilities','parameters'));
    }

    //
}
