<?php

namespace App\Http\Controllers;

use App\Models\ReceivingLedger;
use Illuminate\Http\Request;

class ReceivingLedgerController extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request,[
            'type'=>'required',
            'name'=>'required',
            'number'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'remarks'=>'required',
        ]);
        $receivable=new ReceivingLedger();
        $receivable->invoice_id=$request->id;
        $receivable->payment_way=$request->type;
        $receivable->name=$request->name;
        $receivable->number=$request->number;
        $receivable->amount=$request->amount;
        $receivable->date=$request->date;
        $receivable->remarks=$request->remarks;
        $receivable->save();
        return redirect()->back()->with('success','Receiving added successfully');
    }
}
