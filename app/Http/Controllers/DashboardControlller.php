<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Attendance;
use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Item;
use App\Models\Job;
use App\Models\Labjob;
use App\Models\LeaveApplication;
use App\Models\Notification;
use App\Models\Parameter;
use App\Models\Purchaseindent;
use App\Models\Purchaseindentitem;
use App\Models\Quotes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use LaravelFullCalendar\Facades\Calendar;

class DashboardControlller extends Controller
{
    public function index(){
        $columns = Schema::getColumnListing('journals');
        dd($columns);

        $departments=Department::all()->count();
        $designations=Designation::all()->count();
        $sessions=Quotes::all()->count();
        $assets=Asset::all()->count();
        $personnels=User::all()->count();
        $customers=Customer::all()->count();
        $capabilities=Capabilities::all()->count();
        $parameters=Parameter::all()->count();
        $quotes=Quotes::all()->count();
        $jobs=Job::all()->count();

        $events = [];
        $data = Asset::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->description.'('.date('d m,Y h:i A',strtotime($value->calibration)).'-'.date('d m,Y h:i A',strtotime($value->calibration)+(60*60*24*365)).')',
                    true,
                    new \DateTime($value->calibration),
                    new \DateTime($value->calibration),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#hoi43',
                        'url' => url('appointments/show/'.$value->id),
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);

        $indentforrevisions=Purchaseindent::with(["indent_items" => function($q){
            $q->where('status', 0);
        }])->where('checked_by',\auth()->user()->id)->get();
        $indentforapprovals=Purchaseindent::with(["indent_items" => function($q){
            $q->where('status', 2);
        }])->where('checked_by',\auth()->user()->id)->get();








        $check=0;
        $current_date=date('Y-m-d',time());
        $current_day_attendance=Attendance::where('user_id',auth()->user()->id)->where('check_in_date',$current_date)->first();
        //show check in
        if (!empty($current_day_attendance)){
            //show checkout and status gone 1
            $check=1;
            //dd('show check out');
            if ($current_day_attendance->status===1){
                $check=2;
            }
        }
        else{
            $check=0;
            //dd('show check in');
        }
        $checkout_missing_status=0;
        $checkout_missing=Attendance::where('user_id',auth()->user()->id)->where('status',0)->first();
        if (isset($checkout_missing)){
            $checkout_missing_status=1;
        }

        $head_applications=LeaveApplication::where('head_recommendation_status',null)->where('head_id',\auth()->user()->id)->get();
        //dd($head_applications);

        return view('dashboard',compact('head_applications','customers','calendar','indentforrevisions','indentforapprovals','capabilities','parameters','quotes','sessions','personnels','assets','jobs','departments','designations','check','checkout_missing_status'));
    }
    public function markRead($id)
    {
        $notification = Notification::find($id);
        if (empty($notification->read_at)) {
            $notification->read_at = date('Y-m-d H:i:s');
            $notification->save();
            return redirect($notification->data['data']['redirectURL']);
        }
        return redirect($notification->data['data']['redirectURL']);
    }
    public function notification(){
        return view('notifications');
    }
    //
}
