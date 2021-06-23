<?php

namespace App\Http\Controllers;

use App\Models\DeliveryNotes;
use App\Models\Job;
use App\Models\Jobitem;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
           'delivery_items'=>'required'
        ]);
        $dn=new DeliveryNotes();
        $dn->job_id=$request->job_id;
        $dn->item=$request->delivery_item_id;
        $dn->save();
        $dn->cid='DN/'.str_pad($dn->id, 6, '0', STR_PAD_LEFT);
        $dn->save();
        return response()->json(['success'=>$dn->cid.' is create successfully']);
    }
    public function print_DN($id){
        $this->authorize('print-delivery-note');
        $dn=DeliveryNotes::find($id);
        $job=Job::with('quotes')->find($dn->job_id);
        $items=Jobitem::whereIn('id',explode(',',$dn->item))->get();
        return view('delivery_note.print',compact('job','items','dn'));
    }
}
