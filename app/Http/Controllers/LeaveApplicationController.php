<?php

namespace App\Http\Controllers;

use App\Models\Empcontract;
use App\Models\LeaveApplication;
use App\Models\Preference;
use Illuminate\Http\Request;

class LeaveApplicationController extends Controller
{
    public function index(){
        return view('leave_application.index');
    }
    public function create(){
        $employees=Empcontract::all()->where('status',2);
        $natures=Preference::where('category',14)->get();
        return view('leave_application.create',compact('employees','natures'));
    }
    public function store(Request $request){
        $this->validate(request(), [
            'employee' => 'required',
            'from' => 'required',
            'to' => 'required',
            'nature_of_leave' => 'required',
            'type_of_leave' => 'required',
            'reason' => 'required',
            'address_contact' => 'required',
        ]);
        if ($request->type_of_leave==1){
            $this->validate(request(), [
                'type_time' => 'required',
            ]);
        }

        $leave=new LeaveApplication();
        $leave->appraisal_id=$request->employee;
        $leave->from=$request->from;
        $leave->to=$request->to;
        $leave->nature_of_leave=$request->nature_of_leave;
        $leave->type_of_leave=$request->type_of_leave;
        $leave->type_time=$request->type_time?$request->type_time:null;
        $leave->reason=$request->reason;
        $leave->address_contact=$request->address_contact;
        $leave->head_id=1;
        $leave->ceo_id=1;
        $leave->save();
        return redirect()->back()->with('success','Leave Application applied successfully. You will be notified soon after action performed');
    }

    //
}
