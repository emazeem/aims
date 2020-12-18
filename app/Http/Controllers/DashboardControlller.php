<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Expense;
use App\Models\Expensecategory;
use App\Models\Item;
use App\Models\Job;
use App\Models\Jobform;
use App\Models\Labjob;
use App\Models\Notification;
use App\Models\Parameter;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use LaravelFullCalendar\Facades\Calendar;

class DashboardControlller extends Controller
{
    public function index(){



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
        $expense_categories=Expensecategory::all()->count();
        $expenses=Expense::all()->count();
















        $events = [];
        $data = Parameter::all();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->description.'('.date('d m,Y h:i A',strtotime($value->created_at)).'-'.date('d m,Y h:i A',strtotime($value->updated_at)).')',
                    true,
                    new \DateTime($value->start),
                    new \DateTime($value->end),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#000',
                        'url' => url('appointments/show/'.$value->id),
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);







        return view('dashboard',compact('customers','calendar','expense_categories','expenses','capabilities','parameters','quotes','sessions','personnels','assets','jobs','departments','designations'));
    }
    public function markRead($id)
    {
        $notification = Notification::where('id', $id)->first();
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
