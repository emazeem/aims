<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Capabilitiesgroup;
use App\Models\Item;
use App\Models\Nofacility;
use App\Models\Parameter;
use App\Models\Quotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function index(){
        return view('items.index');
    }
    public function create($id){
        $this->authorize('items-create');
        $session=Quotes::find($id);
        $capabilities=Capabilities::all();
        $parameters=Parameter::all();
        return view('items.create',compact('session','parameters','capabilities'));
    }

    public function fetch(Request $request){
        $data=Item::all()->where('quote_id',$request->id);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('parameter', function ($data) {
                if (isset($data->not_available)){
                    return '<b class="text-danger">Not Available</b>';
                }
                return $data->parameters->name;
            })
            ->addColumn('capability', function ($data) {
                if (isset($data->not_available)){
                    return $data->not_available;
                }
                return $data->capabilities->name;
            })
            ->addColumn('range', function ($data) {
                return $data->range;
            })
            ->addColumn('uprice', function ($data) {

                return $data->price;
            })
            ->addColumn('quantity', function ($data) {
                return $data->quantity;
            })
            ->addColumn('sprice', function ($data) {
                return ($data->price*$data->quantity);
            })
            ->addColumn('status', function ($data) {
                $status=null;
                if ($data->status==0){
                    $status= "<b class=\"text-success\">Listed</b>";
                }
                if ($data->status==1){
                    $status= "<b class=\"text-danger\">Not Listed</b>";
                }
                if ($data->status==2){
                    $status= "<b class=\"text-info\">New Entry</b>";
                }
                if ($data->status==3){
                    $status= "<b class=\"text-danger\">No Facility</b>";
                }
                return $status;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                if ($data->not_available==null){
                    $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/items/edit/'. $data->quote_id.'/'.$data->id) . "'><i class='fa fa-edit'></i></a>";
                } else{
                    $action.="<a title='Edit' class='btn btn-sm btn-success edit' href='#' data-id='$data->id'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('items-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                }
                if ($data->quotes->status>2){
                    $action="Calibrating";
                }
                return "&emsp;".$action;
            })
            ->rawColumns(['options','parameter','status'])
            ->make(true);
    }
    public function edit($session,$id){
        $this->authorize('items-create');
        $edit=Item::find($id);
        $session=Quotes::find($session);
        $capabilities=Capabilities::all();
        $parameters=Parameter::all();
        return view('items.edit',compact('session','parameters','capabilities','edit'));
    }
    public function store(Request $request){
        $this->authorize('items-create');
        if (isset($request->idofquote_forgroup)){
            $this->validate(request(), [
                'groups' => 'required',
            ],[
                'groups.required' => 'Groups field is required *',
            ]);
            $group=Capabilitiesgroup::find($request->groups);
            foreach (explode(',',$group->capabilities) as $capability){
                $cap=Capabilities::find($capability);
                $item=new Item();
                $item->quote_id=$request->idofquote_forgroup;
                $item->not_available=null;
                $item->location=$cap->location;
                $item->accredited=$cap->accredited;
                $item->parameter=$cap->parameter;
                $item->capability=$cap->id;
                $item->range=$cap->range;
                $item->status=0;
                $item->price=$cap->price;
                $item->quantity=1;
                $item->group_id=$request->groups;
                $item->save();
            }
            return redirect()->back()->with('success','Group Capabilities Items added successfully');

        }
        if (isset($request->name)){
            $this->validate(request(), [
                'name' => 'required',
                'quantity' => 'required',
            ],[
                'name.required' => 'Parameter field is required *',
                'quantity.required' => 'Quantity field is required *',
            ]);

            $item=new Item();
            $item->quote_id=$request->session_id;
            $item->not_available=$request->name;
            $item->parameter=0;
            $item->capability=0;
            $item->location="site";
            $item->accredited="no";
            $item->status=1;
            $item->range=0;
            $item->price=0;
            $item->quantity=$request->quantity;
            $item->save();
            return response()->json(['success'=>'Added successfully']);

        }
        $this->validate(request(), [
            'parameter' => 'required',
            'capability' => 'required',
            'range' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'accredited' => 'required',
        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.required' => 'Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        //change status 0 to 1 for empty to adding state of session
        $item=new Item();
        $item->quote_id=$request->session_id;
        $item->not_available=null;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->parameter=$request->parameter;
        $item->capability=$request->capability;
        $item->range=$request->range;
        $item->status=0;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        $item->save();
        Session::Flash('success', 'Item added successfully');
        return redirect()->back();
        //return redirect()->back()->with('success', 'Item added successfully');
    }
    public function update($id,Request $request){


        $this->validate(request(), [
            'parameter' => 'required',
            'capability' => 'required',
            'range' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'accredited' => 'required',
        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.required' => 'Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        $item=Item::find($id);
        $item->parameter=$request->parameter;
        $item->not_available=null;
        $item->capability=$request->capability;
        $item->range=$request->range;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        //dd($item);
        $item->save();
        return redirect()->back()->with('success', 'Item updated successfully');
    }
    public function updateNA(Request $request){

        $this->validate(request(), [
            'name' => 'required',
            'quantity' => 'required',
        ],[
            'name.required' => 'Parameter field is required *',
            'quantity.required' => 'Quantity field is required *',
        ]);
        $item=Item::find($request->id);
        $item->not_available=$request->name;
        $item->quantity=$request->quantity;
        $item->save();
        return response()->json(['success'=>'Updated successfully']);


    }
    public function getCapabilities($id){
        $capabilities=Capabilities::where('parameter', $id)
            ->orderBy('name','ASC')
            ->pluck('id', 'name')
            ->all();
        return response()->json($capabilities);
    }
    public function editNA(Request $request){
        $editNA=Item::find($request->id);
        return response()->json($editNA);
    }
    public function getPrice($id){
        $price=Capabilities::find($id);
        return response()->json($price);
    }
    public function destroy($id){
        $this->authorize('items-delete');
        Item::find($id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    public function nofacility($id){
        $q=Item::find($id);
        $q->status=3;
        $q->save();
        $nofacility=new Nofacility();
        $nofacility->item_id=$id;
        $nofacility->capability=$q->not_available;
        $nofacility->save();
        return response()->json(['success'=>'Sent successfully']);
    }
    //
}
