<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Job;
use App\Models\Labjob;
use App\Models\Quotes;
use App\Models\Role;
use App\Models\Sitejob;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManageJobsController extends Controller
{
    public function index(){
        return view('manage.index');
    }
    public function fetch(){
        $this->authorize('quote-index');
        $data=Quotes::with('customers')->where('status',4)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('location', function ($data) {
                return ucfirst($data->location);
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('turnaround', function ($data) {
                $turnaround=date('d M, Y',strtotime($data->turnaround));
                return $turnaround;
            })
            ->addColumn('total', function ($data) {
                $total=Item::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('jobs', function ($data) {
                $total=Job::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                $action.="<a title='view' href=".url('/jobs/manage/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }

    public function show($id){
        $show=Quotes::find($id);
        $jobs=Job::where('quote_id',$id)->get();
        //dd($jobs);
        return view('manage.show',compact('show','jobs'));
    }
    public function get_items(Request $request){
        $items=Item::with('capabilities')->where('quote_id',$request->id)->get();
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
            $labs=Labjob::where('job_id',$job_id)->get();
            foreach ($labs as $lab){
                $assigned_items[]=$lab->item_id;
            }
            $sites=Sitejob::where('job_id',$job_id)->get();
            foreach ($sites as $site){
                $assigned_items[]=$site->item_id;
            }
        }
        $assigned_items=array_unique($assigned_items);
        $assigned_items=array_values($assigned_items);
        $items=Item::with('capabilities')->where('quote_id',$id)->get();
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
        $job->quote_id = $request->id;
        $job->status = 0;
        $job->save();
         $quotes = Item::where('quote_id', $request->id)->get();
         foreach ($quotes as $quote) {
             if (in_array($quote->id,$items)){
                 for ($x = 0; $x < $quote->quantity; $x++) {
                     if ($quote->location == "site") {
                         $jobform = new Sitejob();
                     }
                     if ($quote->location == "lab") {
                         $jobform = new Labjob();
                     }
                     $jobform->job_id = $job->id;
                     $jobform->item_id = $quote->id;
                     $jobform->save();
                 }
             }
         }
        return redirect()->back()->with('success','Job created successfully');
    }

    //
    public function destroy(Request $request){
        $job=Job::find($request->id);
        $labjobs=Labjob::where('job_id',$request->id)->get();
        foreach ($labjobs as $labjob) {
            $labjob->delete();
        }
        $sitejobs=Sitejob::where('job_id',$request->id)->get();
        foreach ($sitejobs as $sitejob) {
            $sitejob->delete();
        }
        $job->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
}
