<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Attendance;
use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\LeaveApplication;
use App\Models\Notification;
use App\Models\Parameter;
use App\Models\Purchaseindent;
use App\Models\Quotes;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelFullCalendar\Facades\Calendar;
use Stevebauman\Location\Facades\Location;
class DashboardControlller extends Controller
{
    public function index(){
        $this->authorize('dashboard-index');
        //$columns = Schema::getColumnListing('journals');
        //dd($columns);

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
        //dd($current_day_attendance);
        //show check in
        if (isset($current_day_attendance)){
            //show checkout and status gone 1
            $check=1;
            //dd('show check out');
            if ($current_day_attendance->status==1){
                $check=2;
            }
        }
        $checkout_missing_status=0;
        $checkout_missing=Attendance::where('user_id',auth()->user()->id)->where('status',0)->first();
        if (isset($checkout_missing)){
            $checkout_missing_status=1;
        }

        $head_applications=LeaveApplication::where('status',0)->where('head_id',\auth()->user()->id)->get();
        $ceo_applications=LeaveApplication::where('status',2)->where('head_id',\auth()->user()->id)->get();
        //dd($head_applications);

        $gparameters=Parameter::all();

        $pendings_q=Quotes::all()->where('status',0)->count();
        $notsents_q=Quotes::all()->where('status',1)->count();
        $waitings_q=Quotes::all()->where('status',2)->count();
        $approved_q=Quotes::all()->where('status',3)->count();




        $pending_j=Job::all()->where('status',0)->count();
        $completed_j=Job::all()->where('status',1)->count();
        $invoiced_j=Job::all()->where('status',2)->count();

        $pending_mt=Jobitem::all()->where('status',2)->where('assign_user',auth()->user()->id)->count();
        $started_mt=Jobitem::all()->where('status',3)->where('assign_user',auth()->user()->id)->count();
        $completed_mt=Jobitem::all()->where('status',4)->where('assign_user',auth()->user()->id)->count();



        return view('dashboard.index',
            compact('head_applications','ceo_applications','customers','calendar','indentforrevisions',
                            'indentforapprovals','capabilities','parameters','quotes','sessions',
                            'personnels','assets','jobs','departments','designations','check','checkout_missing_status',
                            'gparameters','pendings_q','notsents_q','waitings_q','approved_q',
                'pending_j','completed_j','invoiced_j',
                'pending_mt','completed_mt','started_mt'));
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
    public function get_location(Request $r){
        $ip=\request()->ip();
        if ($ip=='127.0.0.1'){
            $ip='119.155.0.229';
        }
        $data = Location::get($ip);
        $key='4d934a76dfd686a9d005d8668f3c6de7';
        $api= file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=Lahore&appid='.$key,false);
        $api=json_decode($api,true);
        $temp_centi=round($api['main']['temp']-273.15);
        $temp_faren=$temp_centi;
        $api=[
            'weather-description'=>$api['weather'][0]['description'],
            'temp-in-centi'=>$temp_centi,
            'icon'=>'http://openweathermap.org/img/w/'.$api['weather'][0]['icon'].'.png',
            'city'=>$api['name'],
            'country'=>$api['sys']['country'],
            'day'=>date('l'),
        ];
        return response()->json($api);
        //4d934a76dfd686a9d005d8668f3c6de7
    }
    public function get_attendance(Request $request){
        $attendances=Attendance::where('check_in_date',$request->date)->get();
        $data=[];
        foreach ($attendances as $k=>$attendance) {
            $data[$k]['user']=$attendance->user->fname.' '.$attendance->user->lname;
            $data[$k]['check_in']=$attendance->check_in->format('h:i A');
            $data[$k]['check_out']=$attendance->status==0?'':$attendance->check_out->format('h:i A');
        }

        return response()->json($data);
    }
    //
}
