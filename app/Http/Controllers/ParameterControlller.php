<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Param;
use Yajra\DataTables\DataTables;

class ParameterControlller extends Controller
{
    public function index(){
        $this->authorize('parameter-index');
        $parents=Parameter::all()->where('parent',null);
        return view('parameter',compact('parents'));
    }
    public function fetch(){
        $this->authorize('parameter-index');
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
                $token=csrf_token();
                $action=null;
                if (Auth::user()->can('parameter-edit')){
                    $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                }
                $action.="<button type='button' title='View Assets' class='btn view-assets btn-sm btn-dark' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Assets</button>";
                $action.="<button type='button' title='View Capabilities' class='btn view-capabilities btn-sm btn-primary' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-eye'></i> Capabilities</button>";
                if (Auth::user()->can('parameter-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                return "&emsp;".$action;
            })
            ->rawColumns(['options','parent'])
            ->make(true);
    }
    public function store(Request $request){
        $this->authorize('parameter-create');
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
        $this->authorize('parameter-edit');
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
        $this->authorize('parameter-edit');
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
    public function destroy(Request $request){
        $this->authorize('parameter-delete');
        Parameter::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    //
}
