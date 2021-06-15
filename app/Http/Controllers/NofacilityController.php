<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Nofacility;
use App\Models\Parameter;
use App\Models\Quotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NofacilityController extends Controller
{
    public function index()
    {
        $this->authorize('no-facility-index');
        $customers=Customer::orderBy('reg_name','ASC')->get();
        $parameters=Parameter::orderBy('name','ASC')->get();
        return view('nofacility',compact('customers','parameters'));
    }
    public function fetch()
    {
        $this->authorize('no-facility-index');
        $data = Nofacility::all();
        return DataTables::of($data)
            ->addColumn('item', function ($data) {
                return $data->capability;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('qty', function ($data) {
                return $data->quantity;
            })
            ->addColumn('action', function ($data) {
                $action=null;
                $token=csrf_token();
                if (Auth::user()->can('no-facility-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                return $action;
            })

            ->make(true);
    }
    public function store(Request $request){

        //dd($request->all());
        $this->validate(request(), [
            'parameter' => 'required',
            'capability' => 'required',
            'qty' => 'required',
            'customer' => 'required',
        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'qty.required' => 'Quantity field is required *',
            'customer.required' => 'Customer field is required *',
        ]);
        $item=new Nofacility();
        $item->capability=$request->capability;
        $item->parameter=$request->parameter;
        $item->quantity=$request->qty;
        $item->customer=$request->customer;
        $item->save();
        return response()->json(['success'=>'No facility item is added successfully!']);
    }
    public function destroy(Request $request){
        Nofacility::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully!']);
    }
    //
}
