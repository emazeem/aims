<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Intermediatechecksofasset;
use Illuminate\Http\Request;

class IntermediatechecksofassetController extends Controller
{
    public function create($id){
        $checks=10;
        $assets=Asset::all();
        return view('intermediate_checks.create',compact('checks','assets','id'));
    }
    public function edit($id){
        $assets=Asset::all();
        $edit=Intermediatechecksofasset::find($id);
        return view('intermediate_checks.edit',compact('assets','edit'));
    }
    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(),[
            'check_reference' => 'required',
            'measured_value' => 'required',
        ],[
            'check_reference.required' => 'Group name field is required *',
            'measured_value.required' => 'Parameter field is required *',
        ]);
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
            'check_reference' => 'required',
            'measured_value' => 'required',
        ],[
            'check_reference.required' => 'Group name field is required *',
            'measured_value.required' => 'Parameter field is required *',
        ]);
        $intermediateChecks=Intermediatechecksofasset::find();
        $intermediateChecks->equipment_under_test_id=$request->equipment_under_test;
        $intermediateChecks->check_reference_id=$request->check_reference;
        $intermediateChecks->reference_value=$request->reference_value;
        $intermediateChecks->measured_value=implode(',',$request->measured_value);
        $intermediateChecks->save();
        return redirect()->back()->with('success', 'Intermediate checks added successfully!');
    }

    //
}
