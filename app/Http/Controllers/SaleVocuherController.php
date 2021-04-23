<?php

namespace App\Http\Controllers;


use App\Models\Job;
use App\Models\Jobitem;
use Yajra\DataTables\DataTables;

class SaleVocuherController extends Controller
{

    public function index(){
        return view('salesvoucher.index');
    }
    public function fetch(){
        $this->authorize('jobs-index');
        $data=Job::with('quotes')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('quote', function ($data) {
                return $data->quote_id;
            })
            ->addColumn('customer', function ($data) {
                return $data->quotes->customers->reg_name;
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
            })
            ->addColumn('status', function ($data) {
                if ($data->status==0){
                    $status= '<b class="badge badge-danger">Pending</b>';
                }
                if ($data->status==1){
                    $status= '<b class="badge badge-success">Complete</b>';
                }
                return $status;
            })
            ->addColumn('options', function ($data) {
                $ifassigned=Jobitem::where('job_id',$data->id)->where('type',1)->where('group_assets',!null)->get();
                $check=Jobitem::where('job_id',$data->id)->where('type',0)->count();
                $token=csrf_token();
                $action=null;

                $action.="<a title='Invoice' 
                onclick=\"window.open('".url('/jobs/print/invoice/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                href=".url('/jobs/print/invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-dollar'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','status'])
            ->make(true);
    }

    //
}
