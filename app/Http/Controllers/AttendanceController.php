<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function checkin(){
        $date=date('Y-m-d');
        $checkin=date('H:i:s');
        $day=date('D');
        $attendance=new Attendance();
        $attendance->user_id=auth()->user()->id;
        $attendance->check_in_date=$date;
        $attendance->check_out_date=$date;
        $attendance->check_in=$checkin;
        $attendance->check_out='11:59:59';
        //$attendance->worked_hours=0;
        $attendance->status=0;
        $attendance->day=$day;
        $attendance->remarks="Present manual marked by user";
        $attendance->save();
        return response()->json(['success'=>'You are checked in successfully.']);
    }
    public function checkout(){
        $checkout=date('H:i:s');
        $attendance=Attendance::where('user_id',auth()->user()->id)->where('check_in_date',date('Y-m-d'))->first();
        $attendance->check_out=$checkout;
        $attendance->status=1;
        $attendance->save();
        return response()->json(['success'=>'You are checked out successfully.']);

    }
}
