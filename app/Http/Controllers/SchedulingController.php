<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Sitejob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SchedulingController extends Controller
{
    public function index(){
        //$users=User::all()->where('department',3);
        $users=User::all();
        $assets=Asset::all();
        return view('scheduling.index',compact('users','assets'));
    }
    public function fetch(){
        $data=Job::with('quotes')->get();

        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->quotes->customers->reg_name;
            })
            ->addColumn('status', function ($data) {
                //
                if ($data->status==0){
                    $status= '<b class="text-success">Pending</b>';
                }
                if ($data->status==1){
                    $status= '<b class="text-success">Completed</b>';
                }
                return $status;
            })
            ->addColumn('turnaround', function ($data) {
                $turnaround=date('d M, Y',strtotime($data->quotes->turnaround));
                return $turnaround;
            })
            ->addColumn('type', function ($data) {
                $check=null;
                $items=Jobitem::where('job_id',$data->id)->get();
                $check=[];
                foreach ($items as $item){
                    $check[]=$item->type;
                }
                $type=null;
                $check=array_unique($check);
                if ($check==[0]){$type='LAB';}
                else if ($check==[1]){$type='SITE';}
                else {$type='SPLIT';}
                return $type;
            })->addColumn('options', function ($data) {
                $check=null;
                $items=Jobitem::where('job_id',$data->id)->get();
                $check=[];
                foreach ($items as $item){
                    $check[]=$item->type;
                }
                $type=null;
                $check=array_unique($check);
                if ($check==[0]){$type=0;}
                else if ($check==[1]){$type=1;}
                else{$type=2;}
                $action=null;
                //if(Auth::user()->can('scheduling-show')){
                    if ($type==1){
                        $action="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''>SITE</button>";
                    }
                    if ($type==0){
                        $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'>LAB</i></a>";
                    }
                    if ($type==2){
                        $action="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''>SITE</button>";

                        $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'>LAB</a>";
                    }
                //}
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status','type'])
            ->make(true);
    }

    //
}
