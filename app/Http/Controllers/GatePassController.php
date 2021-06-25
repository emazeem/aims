<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\GatePass;
use App\Models\GatePassItems;
use App\Models\SitePlan;
use App\Models\User;
use Illuminate\Http\Request;

class GatePassController extends Controller
{
    //
    public function get_items(Request $request){
        $plan=SitePlan::find($request->id);
        $aids=explode(',',$plan->assigned_assets);
        $uids=explode(',',$plan->assigned_users);
        $data['assets']=Asset::whereIn('id',$aids)->get();
        $data['users']=User::whereIn('id',$uids)->get();
        return response()->json($data);
    }
    public function store(Request $request){
        $this->authorize('create-gate-pass');
        $this->validate($request,[
            'handed_over_to'=>'required',
            'gp_items'=>'required',
            'date_out'=>'required',
            'time_out'=>'required',
        ]);
        //dd($request->all());
        $gp=new GatePass();
        $gp->plan_id=$request->plan_id;
        $gp->out_received_by=$request->handed_over_to;
        $gp->out_handed_over_by=auth()->user()->id;
        //d-m-Y H:i:s
        $gp->out=$request->date_out.' '.$request->time_out;
        $gp->save();
        $gp->cid='GP/'.str_pad($gp->id, 7, '0', STR_PAD_LEFT);
        $gp->save();

        foreach ($request->gp_items as $item){
            $gpitems=new GatePassItems();
            $gpitems->gp_id=$gp->id;
            $gpitems->item_id=$item;
            $gpitems->save();
        }
        return response()->json(['success'=>'Gate Pass ( '.$gp->cid.') created successfully!']);
    }
}
