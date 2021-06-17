<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Nofacility;
use App\Models\Parameter;
use App\Models\QuoteItem;
use App\Models\Quotes;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class QuoteItemController extends Controller
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
        $data=QuoteItem::all()->where('quote_id',$request->id);
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
                if ($data->parameter==14){
                    $title=null;
                    foreach ($data->capabilities->multis as $multi) {
                        $title.=$multi->name.'-';
                    }
                    return '<span class="text-danger" title="'.$title.'">'.$data->capabilities->name.'</span>';
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
                        if ($data->parameter==14){
                            $action.="<a title='Edit' class='btn btn-sm btn-success edit_multi' href data-id='$data->id'><i class='fa fa-edit'></i></a>";
                        }else{
                            $action.="<a title='Edit' class='btn btn-sm btn-success edit' href data-id='$data->id'><i class='fa fa-edit'></i></a>";
                        }
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
        $edit=QuoteItem::find($id);
        $session=Quotes::find($session);
        $capabilities=Capabilities::all();
        $parameters=Parameter::all();
        return view('items.edit',compact('session','parameters','capabilities','edit'));
    }
    public function store(Request $request){

        $this->authorize('items-create');
        //non-listed
        if (isset($request->non_listed)){
            if ($request->non_listed==1){
                $this->validate(request(), [
                    'name' => 'required',
                    'parameter' => 'required',
                    'quantity' => 'required',
                ],[
                    'name.required' => 'Parameter field is required *',
                    'quantity.required' => 'Quantity field is required *',
                    'parameter.required' => 'Quantity field is required *',
                ]);
            }
            if ($request->non_listed==3){
                $this->validate(request(), [
                    'nocapability' => 'required',
                    'quantity' => 'required',
                ],[
                    'nocapability.required' => 'Capability field is required *',
                    'quantity.required' => 'Quantity field is required *',
                ]);
            }
            $item=new QuoteItem();
            $item->quote_id=$request->quote_id;


            $item->capability=0;
            $item->location="site";
            $item->accredited="no";
            if ($request->non_listed==3){
                $item->parameter=Nofacility::find($request->nocapability)->parameter;
                $item->status=3;
                $item->not_available=Nofacility::find($request->nocapability)->capability;
            }
            if ($request->non_listed==1){
                $item->parameter=$request->parameter;
                $item->status=1;
                $item->not_available=$request->name;            }
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
            'range.0' => 'required',
            'range.1' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'accredited' => 'required',

        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.0.required' => 'Min Range field is required *',
            'range.1.required' => 'Max Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        //change status 0 to 1 for empty to adding state of quote
        $item=new QuoteItem();
        $item->quote_id=$request->quote_id;
        $item->not_available=null;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->unit=$request->unit?$request->unit:null;
        $item->parameter=$request->parameter;
        $item->capability=$request->capability;
        $item->range=implode(',',$request->range);
        $item->status=0;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        $item->save();
        $items=QuoteItem::where('quote_id',$request->quote_id)->where('status',0)->get();
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
            'range.0' => 'required',
            'range.1' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'accredited' => 'required',
        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.0.required' => 'Min Range field is required *',
            'range.1.required' => 'Max Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        $item=QuoteItem::find($request->edit_id);
        $item->parameter=$request->parameter;
        $item->not_available=null;
        $item->capability=$request->capability;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        //dd($item);
        $item->save();
        $items=QuoteItem::where('quote_id',$request->quote_id)->where('status',0)->get();
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
    public function getCapabilities($id){
        $data['capabilities']=Capabilities::where('parameter', $id)
            ->where('group_id',null)
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
        $editNA=QuoteItem::find($request->id);
        $editNA['capability_name']=$editNA->not_available;
        return response()->json($editNA);
    }
    public function getPrice($id){
        $data=Capabilities::find($id);
        if ($data->accredited=='yes'){
            $data['unit_name']=$data->units->unit;
        }
        return response()->json($data);
    }
    public function destroy($id){
        $this->authorize('items-delete');
        QuoteItem::find($id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    public function nofacility(Request $request){
        $q=QuoteItem::find($request->id);
        $q->status=3;
        $q->save();
        $nofacility=new Nofacility();
        $nofacility->item_id=$request->id;
        $nofacility->capability=$q->not_available;
        $nofacility->parameter=$q->parameter;
        $nofacility->quantity=$q->quantity;
        $nofacility->customer=$q->quotes->customer_id;
        $nofacility->save();
        return response()->json(['success'=>'Sent with no facility']);
    }
    public function compare_ranges($min,$max,$id){
        $capability=Capabilities::find($id);
        if ($capability->accredited_min_range<=$min){
            return response()->json(['error'=>'Your Min Range is LOW']);
        }else if ($capability->accredited_max_range>=$max){
            return response()->json(['error'=>'Your Max Range is HIGH']);
        } else if ($capability->accredited_max_range>=$max &&$capability->accredited_min_range<=$min ){
            return response()->json(['success'=>'Accredited']);
        }
    }
    public function store_multi(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'capability' => 'required',
            'price' => 'required',
            'location' => 'required',
            'accredited' => 'required',
            'quantity' => 'required',

        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.0.required' => 'Min Range field is required *',
            'range.1.required' => 'Max Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        //change status 0 to 1 for empty to adding state of quote
        $item=new QuoteItem();
        $item->quote_id=$request->quote_id;
        $item->not_available=null;
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->unit=0;
        $item->parameter=14;
        $item->capability=$request->capability;
        $item->range=0;
        $item->status=0;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        $item->save();
        $items=QuoteItem::where('quote_id',$request->quote_id)->where('status',0)->get();
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
        }
        return response()->json(['success'=>'Multi Parameter item added successfully']);
    }
    public function update_multi(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'capability' => 'required',
            'price' => 'required',
            'location' => 'required',
            'accredited' => 'required',
            'quantity' => 'required',

        ],[
            'parameter.required' => 'Parameter field is required *',
            'capability.required' => 'Capability field is required *',
            'range.0.required' => 'Min Range field is required *',
            'range.1.required' => 'Max Range field is required *',
            'price.required' => 'Price field is required *',
            'quantity.required' => 'Quantity field is required *',
            'location.required' => 'Location field is required *',
            'accredited.required' => 'Accredited field is required *',
        ]);
        //change status 0 to 1 for empty to adding state of quote
        $item=QuoteItem::find($request->edit_multi_id);
        $item->location=$request->location;
        $item->accredited=$request->accredited;
        $item->parameter=14;
        $item->capability=$request->capability;
        $item->price=$request->price;
        $item->quantity=$request->quantity;
        $item->save();
        $items=QuoteItem::where('quote_id',$item->quote_id)->where('status',0)->get();
        $lab=0;$site=0;
        foreach($items as $value){
            if ($value->location=='site'){$site=1;}
            if ($value->location=='lab'){$lab=1;}
        }
        if ($lab==1 and $site==1){
            $q=Quotes::find($item->quote_id);
            $q->type='BOTH';
            $q->save();
        }if ($lab==1 and $site==0){
            $q=Quotes::find($item->quote_id);
            $q->type='LAB';
            $q->save();
        }if ($site==1 and $lab==0){
            $q=Quotes::find($item->quote_id);
            $q->type='SITE';
            $q->save();
        }
        return response()->json(['success'=>'Multi Parameter item updated successfully']);
    }

    public function get_multi_detail($id){
        $multiitems=Capabilities::find($id);
        $price=0;
        $accredited=[];
        foreach ($multiitems->multis as $item) {
            $price=$price+$item->price;
            if ($item->accredited=='no'){
                $accredited[]=$item->accredited;
            }
        }
        $data=[
            'price'=>$price,
            'location'=>$multiitems->location,
            'accredited'=>count($accredited)>1?'no':'yes',
        ];
        return response()->json($data);
    }
}
