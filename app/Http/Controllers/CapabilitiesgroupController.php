<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Capabilitiesgroup;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CapabilitiesgroupController extends Controller
{
    public function index(){
        $parameters=Parameter::all();
        $assets=Asset::all();
        return view('capabilities_groups.index',compact('parameters','assets'));
    }
    public function fetch(){
        $data=Capabilitiesgroup::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('capabilities', function ($data) {
                $capabilites=explode(',',$data->capabilities);
                $all=null;
                foreach ($capabilites as $capabilite) {
                    $all.='<span class="badge badge-primary mr-1">'.Capabilities::find($capabilite)->name.'</span>';
                }
                return $all;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                $action.="<a title='Edit' class='btn edit btn-sm btn-success'  href='".url('capabilities/group/edit/'.$data->id)."'><i class='fa fa-edit'></i></a>";
                $action.="<a title='Show' class='btn show btn-sm btn-danger'  href='".url('capabilities/group/show/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                return $action;
            })
            ->rawColumns(['options','capabilities'])
            ->make(true);
    }
    public function create(){
        $capabilities=Capabilities::all();
        return view('capabilities_groups.create',compact('capabilities'));
    }
    public function edit($id){
        $capabilities=Capabilities::all();
        $edit=Capabilitiesgroup::find($id);
        $edit->capabilities=explode(',',$edit->capabilities);
        return view('capabilities_groups.edit',compact('edit','capabilities'));
    }

    public function show($id){
        $show=Capabilitiesgroup::find($id);
        $show->capabilities=explode(',',$show->capabilities);
        $capabilities=[];
        foreach ($show->capabilities as $capability){
            $capabilities[]=Capabilities::find($capability)->name;
        }
        return view('capabilities_groups.show',compact('show','capabilities'));
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(),[
            'name' => 'required',
            'capabilities' => 'required',
        ],[
            'name.required' => 'Group name field is required *',
            'capabilities.required' => 'Group Asset fields are required *',
        ]);
        $capabiltiesGroup=new Capabilitiesgroup();
        $capabiltiesGroup->name=$request->name;
        $capabiltiesGroup->capabilities=implode(',',$request->capabilities);
        $capabiltiesGroup->save();
        return redirect()->back()->with('success', 'Capabilities group added successfully!');
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate(request(),[
            'name' => 'required',
            'capabilities' => 'required',
        ],[
            'name.required' => 'Group name field is required *',
            'capabilities.required' => 'Group Asset fields are required *',
        ]);
        $capabiltiesGroup=Capabilitiesgroup::find($request->id);
        $capabiltiesGroup->name=$request->name;
        $capabiltiesGroup->capabilities=implode(',',$request->capabilities);
        $capabiltiesGroup->save();
        return redirect()->back()->with('success', 'Capabilities group updated successfully!');
    }

    //
}
