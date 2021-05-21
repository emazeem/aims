<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Jobitem;
use Yajra\DataTables\DataTables;

class SalesInvoiceController extends Controller
{   public function index(){
        return view('salesinvoice.index');
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
                $invoice_exist=Invoice::where('job_id',$data->id)->count();
                $action=null;
                $token=csrf_token();
                if ($invoice_exist==0){
                    $action.="<a class='btn btn-danger btn-sm invoice-store' title='Create Invoice' href='#' data-id='{$data->id}'><i class='fa fa-plus'></i> Invoice</a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"POST\">
                      </form>";


                }else{
                    $action.="<a title='Show Invoice' 
                onclick=\"window.open('".url('/jobs/print/invoice/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                href=".url('/jobs/print/invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-paperclip'></i> Invoice</a>";
                }

                return $action;

            })
            ->rawColumns(['options','status'])
            ->make(true);
    }


    //
}
