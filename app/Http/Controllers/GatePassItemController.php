<?php

namespace App\Http\Controllers;

use App\Models\GatePassItems;
use Illuminate\Http\Request;

class GatePassItemController extends Controller
{
    public function out(Request $request){
        $this->authorize('gate-pass-items-checkin-checkout');
        $this->validate($request,[
           'out_fcv'=>'required',
           'out_status'=>'required'
        ]);
        $entry=GatePassItems::find($request->gp_id);
        $entry->out_fcv=$request->out_fcv;
        $entry->out_status=$request->out_status;
        $entry->out_fcb=auth()->user()->id;
        $entry->save();
        return response()->json(['success'=>'Item Check-OUT Details Added Successfully!']);
    }
    public function in(Request $request){
        $this->authorize('gate-pass-items-checkin-checkout');
        $this->validate($request,[
           'in_fcv'=>'required',
           'in_status'=>'required'
        ]);
        $entry=GatePassItems::find($request->gp_id);
        $entry->in_fcv=$request->in_fcv;
        $entry->in_status=$request->in_status;
        $entry->in_fcb=auth()->user()->id;
        $entry->save();
        return response()->json(['success'=>'Item Check-IN Details Added Successfully!']);
    }

    //
}
