<?php

namespace App\Http\Controllers;

use App\Models\Labjob;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Sitejob;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index($id){

        $jobs=Labjob::with('items')->where('job_id',$id)->get();
        //dd($jobs);
        return view('awaiting.quotes',compact('jobs'));
    }
    public function edit($id){
        $edit=Labjob::find($id);
        return response()->json($edit);
    }
    public function create($type,$id){
        if ($type=='lab'){
            $show=Labjob::find($id);
        }else{
            $show=Sitejob::find($id);
        }

        return view('awaiting.create',compact('show'));
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
        $details=Labjob::find($request->id);
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
        $details=Sitejob::find($request->id);
        $details->eq_id=$request->eq_id;
        $details->model=$request->model;
        $details->status=5;
        $details->visual_inspection=$request->visualinspection;
        $details->save();
        return response()->json(['success'=>'Added successfully']);

    }

    //
}
