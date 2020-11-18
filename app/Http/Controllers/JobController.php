<?php

namespace App\Http\Controllers;

use App\Models\InvoicingLedger;
use App\Models\Item;
use App\Models\Job;
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
                }if ($check==0)
                    return "LAB";
                elseif ($check==1)
                    return "SITE";
                else
                    return "SPLIT";
            })
            ->addColumn('status', function ($data) {
                if ($data->status===0){
                    $status= '<b class="text-danger">Pending</b>';
                }
                if ($data->status===1){
                    $status= '<b class="text-success">Complete</b>';
                }
                return $status;
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

                    $action.="<a title='view' href=".url('/jobs/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";


                $action.="<a title='Job Form' href=".url('/jobs/print/jobform/'.$data->id)." class='btn btn-sm btn-danger'><b>J</b></a>";
                $action.="<a title='Invoice' href=".url('/jobs/print/invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-dollar-sign'></i></a>";
                $action.="<a title='Invoice' href=".url('/jobs/print/DN/'.$data->id)." class='btn btn-sm btn-info'>DN</a>";
                if ($check!=0){

                    $action.="<a title='Gatepass' class='btn btn-sm text-light bg-warning' href=".url('jobs/print/GP/'.$data->id).">GP</a>";
                }

                $invoice=InvoicingLedger::where('job_id',$data->id)->get();
                $invoice_exist=count($invoice);
                if ($invoice_exist==0){
                    $action.="<a title='Add Invoice Ledger Details' href=".url('/invoicing-ledger/create/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-check'></i></a>";
                }
                else{
                    $invoice=InvoicingLedger::where('job_id',$data->id)->first();
                    $action.="<a title='Edit Invoice Ledger Details' href=".url('/invoicing-ledger/edit/'.$invoice->id)." class='btn btn-sm btn-danger'><i class='fa fa-check'></i></a>";
                }
                return "&emsp;".$action;

            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function view($id){

        $job=Job::with('quotes')->find($id);
        $labjobs=Labjob::where('job_id',$id)->get();
        $sitejobs=Sitejob::where('job_id',$id)->get();

        return view('jobs.show',compact('job','labjobs','sitejobs'));
    }
    public function print_job_form($id){
        $job=Job::with('quotes')->find($id);
        $labjobs=Labjob::where('job_id',$id)->get();
        $sitejobs=Sitejob::where('job_id',$id)->get();
        return view('jobs.jobform',compact('job','labjobs','sitejobs'));
    }
    public function print_DN($id){
        $job=Job::with('quotes')->find($id);
        $labjobs=Labjob::where('job_id',$id)->get();
        $sitejobs=Sitejob::where('job_id',$id)->get();
        return view('jobs.deliverynote',compact('job','labjobs','sitejobs'));
    }

    public function print_invoice($id){
        $job=Job::find($id);
        $items=Labjob::where('job_id',$job->id)->pluck('item_id');
        $unique_lab_items=array();
        foreach ($items as $item){
            $unique_lab_items[]=$item;
        }
        $lab_items=array_unique($unique_lab_items);
        $lab_items=array_values($lab_items);
        $labitems=Item::whereIn('id',$lab_items)->get();

        $items=Sitejob::where('job_id',$job->id)->pluck('item_id');
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
        $sitejobs=Sitejob::where('job_id',$id)->first();
        $assets=explode(',',$sitejobs->group_assets);
        return view('jobs.gatepass',compact('items','assets','sitejobs','job'));
    }

    //
}
