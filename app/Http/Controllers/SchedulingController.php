<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Job;
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
        $users=User::all()->where('department',3);
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
                if ($data->status===0){
                    $status= '<b class="text-success">Pending</b>';
                }
                if ($data->status===1){
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
                $l=Labjob::where('job_id',$data->id)->count();
                if ($l>0){
                    //lab
                    $check=0;
                }

                $s=Sitejob::where('job_id',$data->id)->count();
                if ($s>0){
                    if (!isset($check)){
                        $check=1;
                    }else{
                        $check=2;
                    }
                }


                if ($check==0){
                    return "LAB";
                }
                if ($check==1){
                    return "SITE";

                }
                if ($check==2){
                    return "SPLIT";
                }

                //return $data->sessions->type;
            })->addColumn('options', function ($data) {
                $check=null;
                $l=Labjob::where('job_id',$data->id)->count();
                if ($l>0){
                    //lab
                    $check=0;
                }

                $s=Sitejob::where('job_id',$data->id)->count();
                if ($s>0){
                    if (!isset($check)){
                        $check=1;
                    }else{
                        $check=2;
                    }
                }
                $action=null;
                //if(Auth::user()->can('scheduling-show')){
                    if ($check==1){
                        $action="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''><i class='fa fa-plus'></i></button>";
                    }
                    if ($check==0){
                        $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-eye'></i></a>";
                    }
                    if ($check==2){
                        $action="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''><i class='fa fa-plus'></i></button>";

                        $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-eye'></i></a>";
                    }
                //}
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status','type'])
            ->make(true);
    }

    //
}
