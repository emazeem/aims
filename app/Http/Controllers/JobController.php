<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Item;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    public function index(){
        $users=User::all();
        $assets=Asset::all();
        return view('jobs.index',compact('users','assets'));
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
                $action.="<a title='view' href=".url('/jobs/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                $action.="<a title='Job Form' onclick=\"window.open('".url('/jobs/print/jobform/'.$data->id)."','newwindow','width=1100,height=1000');return false;\" href=".url('/jobs/print/jobform/'.$data->id)." class='btn btn-sm btn-danger'><small>JN</small></a>";
                $action.="<a title='Invoice' onclick=\"window.open('".url('/jobs/print/invoice/'.$data->id)."','newwindow','width=1100,height=1000');return false;\" href=".url('/jobs/print/invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-dollar'></i></a>";
                $action.="<a onclick=\"window.open('".url('/jobs/print/DN/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"                title='Invoice' href=".url('/jobs/print/DN/'.$data->id)." class='btn btn-sm btn-info'><small>DN</small></a>";
                if ($check>0){
                    if ($ifassigned){
                        $action.="<a title='Gatepass'
                    onclick=\"window.open('".url('/jobs/print/GP/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                     class='btn btn-sm text-light bg-warning' href=".url('jobs/print/GP/'.$data->id)."><small>GP</small></a>";
                    }
                    $action.="<a title='Item Entries' href=".url('/item/entries/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-plus'></i></a>";
                }
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

                if ($type==1){
                    $action.="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''>SITE</button>";
                }
                if ($type==0){
                    $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'>LAB</i></a>";
                }
                if ($type==2){
                    $action.="<button type='button' title='assign site job' class='btn btn-sm btn-danger assign-site' data-id=".$data->id."  href=''>SITE</button>";

                    $action.="<a title='view' href=".url('/scheduling/labs/'.$data->id)." class='btn btn-sm btn-success'>LAB</a>";
                }

                return "&emsp;".$action;

            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function view($id){

        $job=Job::with('quotes')->find($id);
        $labjobs=Jobitem::where('job_id',$id)->where('type',0)->get();
        $sitejobs=Jobitem::where('job_id',$id)->where('type',1)->get();
        return view('jobs.show',compact('job','labjobs','sitejobs'));
    }
    public function print_job_form($id){
        $job=Job::with('quotes')->find($id);
        $labjobs=Jobitem::where('job_id',$id)->where('type',0)->get();
        $sitejobs=Jobitem::where('job_id',$id)->where('type',1)->get();
        return view('jobs.jobform',compact('job','labjobs','sitejobs'));
    }
    public function print_DN($id){
        $job=Job::with('quotes')->find($id);
        $labjobs=Jobitem::where('job_id',$id)->get();
        return view('jobs.deliverynote',compact('job','labjobs'));
    }

    public function print_invoice($id){
        $job=Job::find($id);
        $jobitems=Jobitem::where('job_id',$job->id)->pluck('item_id');
        $unique_lab_items=array();
        foreach ($jobitems as $item){
            $unique_lab_items[]=$item;
        }
        $items=array_unique($unique_lab_items);
        $items=array_values($items);
        $labitems=Item::whereIn('id',$items)->get();
        return view('jobs.invoice',compact('job','labitems'));
    }
    public function print_gp($id){
        $items=Item::with('customers')->find($id);
        $job=Job::find($id);
        $sitejobs=Jobitem::where('job_id',$id)->first();
        $assets=explode(',',$sitejobs->group_assets);
        return view('jobs.gatepass',compact('items','assets','sitejobs','job'));
    }
    public function print_jt($loc,$index,$id){
        $tag=Jobitem::find($id);
        $total=0;
        $total=count(Jobitem::where('job_id',$tag->job_id)->get()->toArray());
        $data = [
            'tag' =>$tag,
            'index' =>$index,
            'loc' =>$loc,
            'total' =>$total,
        ];
        return view('jobs.jobtag',compact('tag','index','total','loc'));
    }
    //
}
