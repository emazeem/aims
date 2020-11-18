<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Labjob;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Sitejob;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AwaitingController extends Controller
{
    public function index(){
        $this->authorize('awaiting-index');
        return view('awaiting.index');
    }
    public function fetch(){
        $data=Job::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->quotes->customers->reg_name;
            })
            ->addColumn('turnaround', function ($data) {

                $turnaround=date('d M Y',strtotime($data->quotes->turnaround));
                return $turnaround;

            })
            ->addColumn('options', function ($data) {
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
                $token=csrf_token();
                $action=null;
                if ($check!=1){
                    $action.="<a title='view' href=".url('/awaitings/checkin/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i> VIEW LAB ITEMS</a>";
                }else{
                    $action.="<a title='view' disabled class='btn btn-sm btn-default'><i class='fa fa-ban'></i> VIEW SITE ITEMS</a>";
                }

                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }



    //
}
