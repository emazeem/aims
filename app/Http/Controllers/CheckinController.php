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

    public function store(Request $request){

        $this->validate($request,[
            'eq_id'=>'required',
            'model'=>'required',
            'accessories'=>'required',
            'visualinspection'=>'required',
        ]);
        $details=Labjob::find($request->id);
        $details->eq_id=$request->eq_id;
        $details->model=$request->model;
        $details->accessories=$request->accessories;
        $details->status=1;
        $details->visual_inspection=$request->visualinspection;
        $details->save();
/*        $change_awaiting_status=Labjob::with('items')->where('job_id',$details->job_id)->get();
        $totallabjobs=0;
        foreach ($change_awaiting_status as $awaiting_status){
            if ($awaiting_status->items->location=="lab"){
                $totallabjobs++;
            }
        }
        $jobfromshavingonestatus=0;
        foreach ($change_awaiting_status as $awaiting_status){
            if ($awaiting_status->status==1){
                $jobfromshavingonestatus++;
            }
        }
        if ($jobfromshavingonestatus==$totallabjobs){
            $session=Quotes::find($details->job_id);
            $session->status=4;
            $session->save();
        }*/
        return response()->json(['success'=>'Added completed']);

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
