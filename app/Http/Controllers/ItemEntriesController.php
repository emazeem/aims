<?php

namespace App\Http\Controllers;

use App\Models\Jobitem;
use Illuminate\Http\Request;

class ItemEntriesController extends Controller
{
    public function index($id){

        $jobs=Jobitem::with('item')->where('job_id',$id)->where('type',0)->get();
        return view('itementries.show',compact('jobs'));
    }
    public function edit($id){
        $edit=Jobitem::find($id);
        return response()->json($edit);
    }
    public function store(Request $request){

        $this->validate($request,[
            'eq_id'=>'required_without:serial',
            'serial'=>'required_without:eq_id',
            'make'=>'required',
            'model'=>'required',
            'accessories'=>'required',
            'visualinspection'=>'required',
        ]);
        $details=Jobitem::find($request->id);
        $details->eq_id=$request->eq_id;
        $details->serial=$request->serial;
        $details->make=$request->make;
        $details->model=$request->model;
        $details->accessories=$request->accessories;
        $details->status=1;
        $details->visual_inspection=$request->visualinspection;
        $details->save();
        return response()->json(['success'=>'Added/Updated successfully']);

    }
    public function storesite(Request $request){
        $this->validate($request,[
            'eq_id'=>'required',
            'model'=>'required',
            'visualinspection'=>'required',
        ]);
        $details=Jobitem::find($request->id);
        $details->eq_id=$request->eq_id;
        $details->serial=$request->serial;
        $details->make=$request->make;
        $details->model=$request->model;
        $details->status=2;
        $details->accessories=$request->accessories;
        $details->visual_inspection=$request->visualinspection;

        $details->save();
        return response()->json(['success'=>'Added successfully']);
    }
    //
}