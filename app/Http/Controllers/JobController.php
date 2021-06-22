<?php

namespace App\Http\Controllers;

use  App\Models\Asset;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\QuoteItem;
use App\Models\User;
use Illuminate\Http\Request;
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
                return $data->cid;
            })
            ->addColumn('quote', function ($data) {
                return $data->quotes->cid;
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
                    $status= '<b class="badge badge-danger px-2 py-1 mt-2">Pending</b>';
                }
                if ($data->status==1){
                    $status= '<b class="badge badge-success px-2 py-1 mt-2">Complete</b>';
                }
                return $status;
            })
            ->addColumn('options', function ($data) {
                $action="<a title='view' href=".url('/jobs/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                return $action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function view($id){

        $job=Job::with('quotes')->find($id);
        $labjobs=Jobitem::where('job_id',$id)->where('type',0)->get();
        $sitejobs=Jobitem::where('job_id',$id)->where('type',1)->get();


        $items=QuoteItem::with('capabilities')->where('quote_id',$job->quote_id)->get();


        $jobs=Job::where('quote_id',$id)->get();
        $job_ids=[];
        $assigned_items=[];
        foreach ($jobs as $job){
            $job_ids[]=$job->id;
        }
        foreach ($job_ids as $job_id) {
            //for lab
            $labs=Jobitem::where('job_id',$job_id)->where('type',0)->get();
            foreach ($labs as $lab){
                $assigned_items[]=$lab->item_id;
            }
            $sites=Jobitem::where('job_id',$job_id)->where('type',1)->get();
            foreach ($sites as $site){
                $assigned_items[]=$site->item_id;
            }
        }
        $assigned_items=array_unique($assigned_items);
        $assigned_items=array_values($assigned_items);

        return view('jobs.show',compact('job','labjobs','sitejobs','items','assigned_items'));
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
        $labitems=QuoteItem::whereIn('id',$items)->get();
        return view('jobs.invoice',compact('job','labitems'));
    }
    public function print_gp($id){
        $items=QuoteItem::with('customers')->find($id);
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
    public function store(Request $request){
        $job = new Job();
        $job->cid='JN/';
        $job->quote_id = $request->id;
        $job->status = 0;
        $job->save();
        $job->cid='JN/'.str_pad($job->id, 6, '0', STR_PAD_LEFT);
        $job->save();
        return response()->json(['success'=>'Job # '.$job->cid.' created successfully!']);
    }
    //
}
