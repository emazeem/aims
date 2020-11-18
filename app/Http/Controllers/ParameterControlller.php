<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ParameterControlller extends Controller
{
    public function index(){
        return view('parameter');
    }
    public function fetch(){
        $data=Parameter::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('createdat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->created_at));
            })
            ->addColumn('updatedat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->updated_at));
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                $action.="<button type='button' title='View Assets' class='btn view-assets btn-sm btn-dark' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Assets</button>";
                $action.="<button type='button' title='View Capabilities' class='btn view-capabilities btn-sm btn-primary' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Capabilities</button>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options'])
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
        return response()->json($units);
    }

    public function view_capabilities(Request $request){
        $assets=Capabilities::where('parameter',$request->id)->get();
        return response()->json($assets);
    }


    //
}
