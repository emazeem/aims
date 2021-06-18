<?php

namespace App\Http\Controllers;

use App\Models\Capabilities;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GroupedCapabilitiesController extends Controller
{
    public function index(){
        $this->authorize('grouped-capabilities');
        return view('groupedcapabilities.index');
    }
    public function fetch(){
        $this->authorize('grouped-capabilities');
        $data=Capabilities::with('parameters')->where('is_group',1)->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('location', function ($data) {
                return $data->location;
            })
            ->addColumn('underlying', function ($data) {
                $capabilities=null;
                foreach (Capabilities::where('group_id',$data->id)->get() as $item){
                    $capabilities.="<span>".$item->name."</span><br>";
                }
                return $capabilities;
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $token=csrf_token();
                if (Auth::user()->can('edit-grouped-capabilities')){
                    $action.="<a title='Edit' href='".url('grouped-capabilities/edit/'.$data->id)."' class='btn edit btn-sm btn-success'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('delete-grouped-capabilities')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                return $action;
            })
            ->rawColumns(['options','underlying'])
            ->make(true);

    }
    public function create($selections=null){
        if (isset($selections)){
            $selections=explode(',',$selections);
        }else{
            $selections=[];
        }
        $this->authorize('add-grouped-capabilities');
        return view('groupedcapabilities.create',compact('selections'));
    }
    public function edit($id){
        $this->authorize('edit-grouped-capabilities');
        $edit=Capabilities::find($id);
        $underlying=[];
        foreach (Capabilities::where('group_id',$id)->get() as $item){
            $underlying[]=$item->id;
        }
        return view('groupedcapabilities.edit',compact('edit','underlying'));
    }

    public function store(Request $request){
        $this->authorize('add-grouped-capabilities');
        $this->validate(request(), [
            'name' => 'required',
            'parameter' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'underlying' => 'required',
        ],[
            'name.required' => 'Name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'underlying.required' => 'Underlying capabilities is required *',
        ]);
        $groupedcapabilities=new Capabilities();
        $groupedcapabilities->name=$request->name;
        $groupedcapabilities->parameter=$request->parameter;
        $groupedcapabilities->min_range=0;
        $groupedcapabilities->accredited_min_range=0;
        $groupedcapabilities->accredited_max_range=0;
        $groupedcapabilities->max_range=0;
        $groupedcapabilities->unit=0;
        $groupedcapabilities->calculator=0;
        $groupedcapabilities->accuracy=0;
        $groupedcapabilities->is_group=1;
        $groupedcapabilities->location=$request->location;
        $groupedcapabilities->accredited="--";
        $groupedcapabilities->price=0;
        $groupedcapabilities->remarks=$request->remarks;
        $groupedcapabilities->procedure=0;
        $groupedcapabilities->save();
        foreach ($request->underlying as $id){
            $cap=Capabilities::find($id);
            $cap->group_id=$groupedcapabilities->id;
            $cap->save();
        }
        return response()->json(['success'=> 'Grouped Capability added successfully']);
    }
    public function update(Request $request){
        $this->authorize('edit-grouped-capabilities');
        $this->validate(request(), [
            'name' => 'required',
            'parameter' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'underlying' => 'required',
        ],[
            'name.required' => 'Name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'underlying.required' => 'Underlying capabilities is required *',
        ]);

        $groupedcapabilities=Capabilities::find($request->id);
        $groupedcapabilities->name=$request->name;
        $groupedcapabilities->parameter=$request->parameter;
        $groupedcapabilities->min_range=0;
        $groupedcapabilities->accredited_min_range=0;
        $groupedcapabilities->accredited_max_range=0;
        $groupedcapabilities->max_range=0;
        $groupedcapabilities->unit=0;
        $groupedcapabilities->calculator=0;
        $groupedcapabilities->accuracy=0;
        $groupedcapabilities->is_group=1;
        $groupedcapabilities->location=$request->location;
        $groupedcapabilities->accredited="--";
        $groupedcapabilities->price=0;
        $groupedcapabilities->remarks=$request->remarks;
        $groupedcapabilities->procedure=0;
        $groupedcapabilities->save();

        foreach (Capabilities::where('group_id',$request->id)->get() as $def){
            $default=Capabilities::find($def->id);
            $default->group_id=0;
            $default->save();
        }
        foreach ($request->underlying as $id){
            $cap=Capabilities::find($id);
            $cap->group_id=$groupedcapabilities->id;
            $cap->save();
        }
        return response()->json(['success'=> 'Grouped Capability updated successfully']);
    }
    public function delete(Request $request){
        $this->authorize('delete-grouped-capabilities');
        $item=Capabilities::find($request->id);
        foreach (Capabilities::where('group_id',$request->id)->get() as $def){
            $default=Capabilities::find($def->id);
            $default->group_id=0;
            $default->save();
        }
        $item->delete();
        return response()->json(['success'=> 'Grouped Capability deleted successfully']);
    }
}
