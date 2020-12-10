<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Intermediatechecksofasset;
use Illuminate\Http\Request;

class IntermediatechecksofassetController extends Controller
{
    public function create($id){
        $available=Intermediatechecksofasset::where('equipment_under_test_id',$id)->first();
        if (isset($available)){
            $asset=Asset::find($id);
            $difference=strtotime($asset->due)-strtotime($asset->calibration);
            $threemonthscheck=60*60*24*91;
            $repetition=$difference/$threemonthscheck;
            $repetition=(int)$repetition;
            $checks=4;
        }
        else{
            $checks=10;
            $available=null;
            $repetition=1;
        }
        $assets=Asset::all();
        return view('intermediate_checks.create',compact('checks','assets','id','available','repetition'));
    }
    public function edit($id){
        $assets=Asset::all();
        $edit=Intermediatechecksofasset::find($id);
        $available=Intermediatechecksofasset::where('equipment_under_test_id',$edit->equipment_under_test_id)->get();
        return view('intermediate_checks.edit',compact('assets','edit','available'));
    }
    public function store(Request $request){
        $this->validate(request(),[
            'check_reference' => 'required',
            'measured_value' => 'required',
        ],[
            'check_reference.required' => 'Group name field is required *',
            'measured_value.required' => 'Parameter field is required *',
        ]);
        //dd($request->all());
        $intermediateChecks=new Intermediatechecksofasset();
        $intermediateChecks->equipment_under_test_id=$request->equipment_under_test;
        $intermediateChecks->check_reference_id=$request->check_reference;
        $intermediateChecks->reference_value=$request->reference_value;
        $intermediateChecks->measured_value=implode(',',$request->measured_value);
        $intermediateChecks->save();
        return redirect()->back()->with('success', 'Intermediate checks added successfully!');
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate(request(),[
            'measured_value' => 'required',
        ],[
            'measured_value.required' => 'Parameter field is required *',
        ]);
        $intermediateChecks=Intermediatechecksofasset::find($request->id);
        $intermediateChecks->equipment_under_test_id=$request->equipment_under_test;
        if ($request->check_reference){
            $intermediateChecks->check_reference_id=$request->check_reference;
        }
        if ($request->reference_value){
            $intermediateChecks->reference_value=$request->reference_value;
        }
        $intermediateChecks->measured_value=implode(',',$request->measured_value);
        $intermediateChecks->save();
        return redirect()->back()->with('success', 'Intermediate checks added successfully!');
    }

    //
}
