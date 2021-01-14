<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function checkin(Request $request){
        $date=date('Y-m-d',time());
        $checkin=date('H:i:s',time());

        $day=date('D',time());
        $attendance=new Attendance();
        $attendance->user_id=auth()->user()->id;
        $attendance->check_in_date=$date;
        $attendance->check_in=$checkin;
        $attendance->check_out=$checkin;
        $attendance->worked_hours=0;
        $attendance->status=0;
        $attendance->day=$day;
        $attendance->remarks="Present manual marked by user";
        $attendance->save();
        return response()->json(['success'=>'You are checked in successfully.']);
    }
    public function checkout(Request $request){
        $date=date('Y-m-d',time());
        $checkout=date('H:i:s',time());
        $attendance=Attendance::where('user_id',auth()->user()->id)->where('check_in_date',$date)->first();
        //dd($attendance);
        if (empty($attendance) || $attendance==null || !isset($attendance)){

            $attendance=Attendance::where('user_id',auth()->user()->id)->where('status',0)->first();

            $checkin=strtotime($attendance->check_in_date." ".$attendance->checkin);

            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s',$checkin));
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $diff_in_hours = $to->diffInHours($from);

            $attendance->worked_hours=$diff_in_hours;
            $attendance->check_out=$checkout;
            $attendance->status=1;
            $attendance->check_out_date=$date;
            $attendance->save();

        }else{

            $days=strtotime($attendance->checkout)-strtotime($attendance->checkin);
            $attendance->worked_hours=date('H',$days);
            $attendance->check_out=$checkout;
            $attendance->status=1;
            $attendance->check_out_date=$date;
            $attendance->save();

        }
        return response()->json(['success'=>'You are checked out successfully.']);

    }
}
