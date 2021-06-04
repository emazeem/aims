<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Item;
use App\Models\Nofacility;
use App\Models\Parameter;
use App\Models\Quotes;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                return $data->parameters->name;
            })
            ->addColumn('capability', function ($data) {
                if (isset($data->not_available)){
                    return '<span class="text-danger">'.$data->not_available.'</span>';
                }
                return $data->capabilities->name;
            })
            ->addColumn('range', function ($data) {
                if (isset($data->not_available)){
                    return '';
                }
                return $data->range;
            })
            ->addColumn('location', function ($data) {
                if (isset($data->not_available)){
                    return '';
                }
                return $data->location;
            })

            ->addColumn('uprice', function ($data) {
                if (isset($data->not_available)){
                    return '';
                }
                return $data->price;
            })
            ->addColumn('quantity', function ($data) {
                if (isset($data->not_available)){
                    return '';
                }
                return $data->quantity;
            })
            ->addColumn('sprice', function ($data) {
                if (isset($data->not_available)){
                    return '';
                }
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
                    $status= "<b class=\"text-dark\">No Facility</b>";
                }
                return $status;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                if ($data->quotes->status==0){
                    if ($data->not_available==null){
                        $action.="<a title='Edit' class='btn btn-sm btn-success edit' href data-id='$data->id'><i class='fa fa-edit'></i></a>";
                    } else{
                        $action.="<a title='Edit' class='btn btn-sm btn-success edit-na' href='#' data-id='$data->id'><i class='fa fa-edit'></i></a>";
                    }
                    if (Auth::user()->can('items-delete')){
                        $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                        return "&emsp;".$action;

                    }
                }else{
                    return "<span class='badge'>Not Allowed</span>";
                }
            })
            ->rawColumns(['options','parameter','status','capability'])
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
        //non-listed
        if (isset($request->non_listed)){
            $this->validate(request(), [
                'name' => 'required',
                'parameter' => 'required',
                'quantity' => 'required',
            ],[
                'name.required' => 'Parameter field is required *',
                'quantity.required' => 'Quantity field is required *',
                'parameter.required' => 'Quantity field is required *',
            ]);

            $item=new Item();
            $item->quote_id=$request->quote_id;
            $item->not_available=$request->name;
            $item->parameter=$request->parameter;
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
        //listed items
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
        //change status 0 to 1 for empty to adding state of quote
        $item=new Item();
        $item->quote_id=$request->quote_id;
        $item->not_available=null;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->unit=$request->unit?$request->unit:null;
        $item->parameter=$request->parameter;
        $item->capability=$request->capability;
        $item->range=$request->range;
        $item->status=0;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        $item->save();
        $items=Item::where('quote_id',$request->quote_id)->where('status',0)->get();
        $lab=0;$site=0;
        foreach($items as $value){
            if ($value->location=='site'){$site=1;}
            if ($value->location=='lab'){$lab=1;}
        }
        if ($lab==1 and $site==1){
            $q=Quotes::find($request->quote_id);
            $q->type='BOTH';
            $q->save();
        }if ($lab==1 and $site==0){
            $q=Quotes::find($request->quote_id);
            $q->type='LAB';
            $q->save();
        }if ($site==1 and $lab==0){
            $q=Quotes::find($request->quote_id);
            $q->type='SITE';
            $q->save();
        }else{}
        return response()->json(['success'=> 'Item added successfully']);
    }
    public function update(Request $request){


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
        $item=Item::find($request->edit_id);
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
        $items=Item::where('quote_id',$request->quote_id)->where('status',0)->get();
        $lab=0;$site=0;
        foreach($items as $value){
            if ($value->location=='site'){$site=1;}
            if ($value->location=='lab'){$lab=1;}
        }
        if ($lab==1 and $site==1){
            $q=Quotes::find($request->quote_id);
            $q->type='BOTH';
            $q->save();
        }if ($lab==1 and $site==0){
            $q=Quotes::find($request->quote_id);
            $q->type='LAB';
            $q->save();
        }if ($site==1 and $lab==0){
            $q=Quotes::find($request->quote_id);
            $q->type='SITE';
            $q->save();
        }else{}
        return response()->json(['success'=>'Item Updated successfully']);

    }
    public function updateNA(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'quantity' => 'required',
            'parameter' => 'required',
        ],[
            'name.required' => 'Parameter field is required *',
            'quantity.required' => 'Quantity field is required *',
            'parameter.required' => 'Quantity field is required *',
        ]);
        $item=Item::find($request->id);
        $item->not_available=$request->name;
        $item->quantity=$request->quantity;
        $item->parameter=$request->parameter;
        $item->save();
        return response()->json(['success'=>'Updated successfully']);
    }
    public function getCapabilities($id){
        $data['capabilities']=Capabilities::where('parameter', $id)
            ->orderBy('name','ASC')
            ->pluck('id', 'name')
            ->all();
        $data['unit']=Unit::where('parameter', $id)
            ->orderBy('unit','ASC')
            ->pluck('id', 'unit')
            ->all();
        return response()->json($data);
    }
    public function editNA(Request $request){
        $editNA=Item::find($request->id);
        $editNA['capability_name']=$editNA->not_available;
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
        return response()->json(['success'=>'Sent with no facility']);
    }
}
