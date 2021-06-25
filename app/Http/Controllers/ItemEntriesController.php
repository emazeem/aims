<?php

namespace App\Http\Controllers;

use App\Models\Jobitem;
use App\Models\QuoteItem;
use Illuminate\Http\Request;

class ItemEntriesController extends Controller
{

    public function edit($id){
        $edit=Jobitem::find($id);
        if ($edit->type==0){
            $this->authorize('lab-item-receiving-update');
        }
        if ($edit->type==1){
            $this->authorize('site-item-receiving-update');
        }

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
        $item=QuoteItem::find($request->id);
        $jobitem = new Jobitem();
        if ($item->location == "site") {
            $this->authorize('site-item-receiving-store');
            $jobitem->type=1;
            $jobitem->status=1;
        }
        if ($item->location == "lab") {
            $this->authorize('lab-item-receiving-store');
            $jobitem->type=0;
        }
        $jobitem->job_id = $request->job;
        $jobitem->item_id = $request->id;
        $jobitem->save();

        $details=Jobitem::find($jobitem->id);
        $details->eq_id=$request->eq_id;
        $details->serial=$request->serial;
        $details->make=$request->make;
        $details->model=$request->model;
        $details->accessories=$request->accessories;
        $details->store_incharge_id=auth()->user()->id;
        $details->status=1;
        $details->visual_inspection=$request->visualinspection;
        $details->save();
        return response()->json(['success'=>'Added/Updated successfully']);

    }
    public function update(Request $request){

        $this->validate($request,[
            'eq_id'=>'required_without:serial',
            'serial'=>'required_without:eq_id',
            'make'=>'required',
            'model'=>'required',
            'accessories'=>'required',
            'visualinspection'=>'required',
        ]);

        $details=Jobitem::find($request->id);
        if ($details->type==0){
            $this->authorize('lab-item-receiving-store');
        }
        if ($details->type==1){
            $this->authorize('site-item-receiving-update');
        }

        $details->eq_id=$request->eq_id;
        $details->serial=$request->serial;
        $details->make=$request->make;
        $details->model=$request->model;
        $details->accessories=$request->accessories;
        $details->status=1;
        $details->visual_inspection=$request->visualinspection;
        $details->save();
        return response()->json(['success'=>'Updated successfully']);

    }
}
