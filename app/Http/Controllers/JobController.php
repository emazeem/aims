<?php

namespace App\Http\Controllers;

use App\Models\InvoicingLedger;
use App\Models\Item;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Sitejob;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    public function index(){
        return view('jobs.index');
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
                $check=Jobitem::where('job_id',$data->id)->where('type',0)->count();
                $token=csrf_token();
                $action=null;

                $action.="<a title='view' href=".url('/jobs/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                $action.="<a title='Job Form' href=".url('/jobs/print/jobform/'.$data->id)." class='btn btn-sm btn-danger'><small>JN</small></a>";
                $action.="<a title='Invoice' href=".url('/jobs/print/invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-dollar'></i></a>";
                $action.="<a title='Invoice' href=".url('/jobs/print/DN/'.$data->id)." class='btn btn-sm btn-info'><small>DN</small></a>";
                if ($check>0){
                    $action.="<a title='Item Entries' href=".url('/item/entries/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-plus'></i></a>";
                    $action.="<a title='Gatepass' class='btn btn-sm text-light bg-warning' href=".url('jobs/print/GP/'.$data->id)."><small>GP</small></a>";
                }
                $invoice=InvoicingLedger::where('job_id',$data->id)->get();
                $invoice_exist=count($invoice);
                //if ($invoice_exist==0){
                    $action.="<a title='Add Invoice Ledger Details' href=".url('/invoicing-ledger/create/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-check'></i></a>";
                /*}
                else{
                    $invoice=InvoicingLedger::where('job_id',$data->id)->first();
                    $action.="<a title='Edit Invoice Ledger Details' href=".url('/invoicing-ledger/edit/'.$invoice->id)." class='btn btn-sm btn-danger'><i class='fa fa-check'></i></a>";
                }*/
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
        $sitejobs=Jobitem::where('job_id',$id)->get();
        return view('jobs.deliverynote',compact('job','labjobs','sitejobs'));
    }

    public function print_invoice($id){
        $job=Job::find($id);
        $items=Jobitem::where('job_id',$job->id)->pluck('item_id');
        $unique_lab_items=array();
        foreach ($items as $item){
            $unique_lab_items[]=$item;
        }
        $lab_items=array_unique($unique_lab_items);
        $lab_items=array_values($lab_items);
        $labitems=Item::whereIn('id',$lab_items)->get();

        $items=Jobitem::where('job_id',$job->id)->pluck('item_id');
        $unique_site_items=array();
        foreach ($items as $item){
            $unique_site_items[]=$item;
        }
        $site_items=array_unique($unique_site_items);
        $site_items=array_values($site_items);
        $siteitems=Item::whereIn('id',$site_items)->get();
        ///dd($siteitems);
        return view('jobs.invoice',compact('job','labitems','siteitems'));
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
        return view('jobs.jobtag',compact('tag','index','total','loc'));
    }
    //
}
