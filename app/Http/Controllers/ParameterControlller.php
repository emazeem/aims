<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ParameterControlller extends Controller
{
    public function index(){
        $parents=Parameter::all()->where('parent',null);
        return view('parameter',compact('parents'));
    }
    public function fetch(){
        $data=Parameter::with('parents')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('parent', function ($data) {
                if ($data->parent!==null){
                    return "<span class='badge badge-danger'>".$data->parents->name."</span>";
                }
                else{
                    return "<i>NULL</i>";
                }
            })

            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>";
                $action.="<button type='button' title='View Assets' class='btn view-assets btn-sm btn-dark' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Assets</button>";
                $action.="<button type='button' title='View Capabilities' class='btn view-capabilities btn-sm btn-primary' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Capabilities</button>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options','parent'])
            ->make(true);
    }
    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Parameter name field is required *',
        ]);
        $parameter=new Parameter();
        $parameter->name=$request->name;
        if ($request->parent){
            $parameter->parent=$request->parent;
        }
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Parameter name field is required *',
        ]);
        $parameter=Parameter::find($request->id);
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $edit=Parameter::find($request->id);
        return response()->json($edit);
    }
    public function view_assets(Request $request){
        $assets=Asset::where('parameter',$request->id)->get();
        return response()->json($assets);
    }
    public function view_units(Request $request){
        $assets=Asset::find($request->id);
        $units=Unit::where('parameter',$assets->parameter)->get();
        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);
        $units['show_channels']=false;
        if (in_array($request->id,$hasChannels)){
            $units['show_channels']=true;
        }
        return response()->json($units);
    }

    public function view_capabilities(Request $request){
        $assets=Capabilities::where('parameter',$request->id)->get();
        return response()->json($assets);
    }


    //
}
