<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Journal;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Jobitem;
use Yajra\DataTables\DataTables;

class SalesInvoiceController extends Controller
{


    public function index(){
        $this->authorize('sales-invoice');
        return view('salesinvoice.index');
    }
    public function create(){
        $this->authorize('add-sales-invoice');
        return view('salesinvoice.create');
    }
    public function fetch(){
        $this->authorize('sales-invoice');
        $data=Journal::with('createdby')->where('type','sales invoice')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('customize_id', function ($data) {
                return $data->customize_id;
            })
            ->addColumn('type', function ($data) {
                return ucwords(str_replace('-',' ',$data->type));
            })
            ->addColumn('date', function ($data) {
                return $data->date->format('d-M-Y');
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdby->fname.' '.$data->createdby->lname;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/journal-vouchers/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-primary' href='" . url('/vouchers/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  ";
            })->rawColumns(['options'])->make(true);

    }
    public function create_fetch(){
        $this->authorize('add-sales-invoice');
        $data=Job::with('quotes')->with('invoices')->where('status','>',0)->get();
        return DataTables::of($data)
            ->addColumn('job', function ($data) {
                return $data->cid;
            })
            ->addColumn('inv', function ($data) {
                return $data->invoices->title;
            })
            ->addColumn('date', function ($data) {
                if ($data->invoices->created_at){
                    return $data->invoices->created_at->format('d-m-Y');
                }
                return '00-00-0000';
            })
            ->addColumn('customer', function ($data) {
                return '<span class="view-customer text-primary" data-id="'.$data->quotes->customers->id.'">'.$data->quotes->customers->reg_name.'</span>';
            })
            ->addColumn('status', function ($data) {
                if ($data->status==1){
                    $status= '<b class="badge badge-danger">Pending</b>';
                }
                if ($data->status==2){
                    $status= '<b class="badge badge-success">Closed</b>';
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
                href=".url('/jobs/print/invoice/'.$data->id)." class='btn mr-2 btn-sm btn-success'><i class='fa fa-paperclip'></i> Invoice</a>";
                    $action.="<a title='Show ST Invoice'
                onclick=\"window.open('".url('/jobs/print/sales_invoice/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                href=".url('/jobs/print/sales_invoice/'.$data->id)." class='btn btn-sm btn-success'><i class='fa fa-paperclip'></i> ST Invoice</a>";

                }
                return $action;
            })
            ->rawColumns(['options','status','customer'])
            ->make(true);
    }
    //
}
