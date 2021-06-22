<?php

namespace App\Http\Controllers;


use App\Models\Job;
use App\Models\Jobitem;
use App\Models\QuoteItem;
use App\Models\Quotes;
use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

class ManageJobsController extends Controller
{
    public function index(){
        $this->authorize('awaiting-job-index');
        return view('manage.index');
    }
    public function fetch(){
        $this->authorize('awaiting-job-index');
        $data=Quotes::with('customers')->where('status',3)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('location', function ($data) {
                return ucfirst($data->location);
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('turnaround', function ($data) {
                return $data->turnaround.' Days';
            })
            ->addColumn('total', function ($data) {
                $items=QuoteItem::where('quote_id',$data->id)->get();
                $total=0;
                foreach ($items as $item){
                    $total=$total+$item->quantity;
                }
                return $total;
            })
            ->addColumn('jobs', function ($data) {
                $total=Job::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                if (Auth::user()->can('awaiting-job-show')){
                    $action.="<a title='view' href=".url('/jobs/manage/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                }
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }

    public function show($id){
        $this->authorize('awaiting-job-index');
        $show=Quotes::find($id);
        $jobs=Job::where('quote_id',$id)->get();
        $createjob=true;
        foreach ($jobs as $job){
            if ($job->status==0){
                $createjob=false;
            }
        }
        return view('manage.show',compact('show','jobs','id','createjob'));
    }
    public function get_items(Request $request){
        $items=QuoteItem::with('capabilities')->where('quote_id',$request->id)->get();
        foreach ($items as $item) {
            $item->capability=$item->capabilities->name;
        }
        return response()->json($items);
    }
    public function create($id){
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

        $items=QuoteItem::with('capabilities')->where('quote_id',$id)->get();
        return view('manage.create',compact('items','id','assigned_items'));
    }
    public function store(Request $request){
        $this->validate(request(), [
            'items' => 'required',
        ]);
        $items=array();
        foreach ($request->items as $item){
            $items[]=$item;
        }
        $job = new Job();
        $job->cid='JN/';
        $job->quote_id = $request->id;
        $job->status = 0;
        $job->save();
        $job->cid='JN/'.str_pad($job->id, 6, '0', STR_PAD_LEFT);
        $job->save();
        $quotes = QuoteItem::where('quote_id', $request->id)->get();
         foreach ($quotes as $quote) {
             if (in_array($quote->id,$items)){
                 for ($x = 0; $x < $quote->quantity; $x++) {
                     $jobitem = new Jobitem();
                     if ($quote->location == "site") {
                        $jobitem->type=1;
                        $jobitem->status=1;
                     }
                     if ($quote->location == "lab") {
                         $jobitem->type=0;
                     }
                     $jobitem->job_id = $job->id;
                     $jobitem->item_id = $quote->id;
                     $jobitem->save();
                 }
             }
         }

        $users = User::where('user_type', 1)->get();
        $url = '/jobs/view/'.$job->id;
        $message = collect([
            'title' => 'A new job has been created',
            'by'=>auth()->user()->id,
            'body' => \auth()->user()->fname.' '.\auth()->user()->lname.' created a job (' .$job->cid.') from '.Quotes::find($request->id)->cid,
            'redirectURL' => $url
        ]);
        Notification::send($users, new CustomNotification($message));

        return redirect()->back()->with('success','Job created successfully');
    }

    //
    public function destroy(Request $request){
        $job=Job::find($request->id);
        $jobitems=Jobitem::where('job_id',$request->id)->get();
        foreach ($jobitems as $jobitem) {
            $jobitem->delete();
        }
        $job->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
}