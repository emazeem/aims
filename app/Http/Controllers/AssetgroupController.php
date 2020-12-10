<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetgroup;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AssetgroupController extends Controller
{
    public function index(){
        $parameters=Parameter::all();
        $assets=Asset::all();
        return view('assets_groups.index',compact('parameters','assets'));
    }
    public function fetch(){
        $data=Assetgroup::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('assets', function ($data) {
                $assets=Asset::where('group_id',$data->id)->get();
                $label=null;
                foreach ($assets as $asset){
                    $label.='<span class="badge badge-danger">'.$asset->name.'</span><br>';
                }
                return $label;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                $action.="<a title='Edit' class='btn edit btn-sm btn-success'  href='".url('asset/groups/edit/'.$data->id)."'><i class='fa fa-edit'></i></a>";
                $action.="<a title='Show' class='btn show btn-sm btn-danger'  href='".url('asset/groups/show/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                return $action;
            })
            ->rawColumns(['options','assets'])
            ->make(true);
    }
    public function create(){
        $parameters=Parameter::all();
        $assets=Asset::all();
        return view('assets_groups.create',compact('parameters','assets'));
    }
    public function show($id){
        $show=Assetgroup::find($id);
        return view('assets_groups.show',compact('show'));
    }

    public function edit($id){
        $parameters=Parameter::all();
        $assets=Asset::all();
        $assetGroup=Assetgroup::find($id);
        $temps=Asset::where('group_id',$assetGroup->id)->get();
        $assigned_assets=[];
        foreach ($temps as $temp){
            $assigned_assets[]=$temp->id;
        }
        return view('assets_groups.edit',compact('parameters','assets','assetGroup','assigned_assets'));
    }

    public function store(Request $request){
        $this->validate(request(),[
            'name' => 'required',
            'parameter' => 'required',
            'assets' => 'required',
        ],[
            'name.required' => 'Group name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'assets.required' => 'Group Asset fields are required *',
        ]);
        $assetGroup=new Assetgroup();
        $assetGroup->parameter=$request->parameter;
        $assetGroup->name=$request->name;
        $assetGroup->save();
        foreach ($request->assets as $asset_id) {
            $asset=Asset::find($asset_id);
            $asset->group_id=$assetGroup->id;
            $asset->save();
        }
        return redirect()->back()->with('success', 'Asset group added successfully!');
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate(request(),[
            'name' => 'required',
            'parameter' => 'required',
            'assets' => 'required',
        ],[
            'name.required' => 'Group name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'assets.required' => 'Group Asset fields are required *',
        ]);
        $assetGroup=Assetgroup::find($request->id);
        $temp_assets=Asset::where('group_id',$request->id)->get();
        foreach ($temp_assets as $temp_asset) {
            $default=Asset::find($temp_asset->id);
            $default->group_id=0;
            $default->save();
        }
        $assetGroup->parameter=$request->parameter;
        $assetGroup->name=$request->name;
        $assetGroup->save();
        foreach ($request->assets as $asset_id) {
            $asset=Asset::find($asset_id);
            $asset->group_id=$assetGroup->id;
            $asset->save();
        }
        return redirect()->back()->with('success', 'Asset group updated successfully!');
    }


}
