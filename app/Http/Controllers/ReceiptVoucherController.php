<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceVsReceipts;
use App\Models\Quotes;
use Illuminate\Http\Request;
use  App\Models\BusinessLine;
use App\Models\Chartofaccount;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Journal;
use App\Models\Journalassets;
use App\Models\JournalDetails;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ReceiptVoucherController extends Controller
{
    //
    public function index(){
        $this->authorize('receipt-voucher');
        return view('receiptvoucher.index');
    }
    public function show($id){
        //dd(1);
        $this->authorize('view-receipt-voucher');
        $show=Journal::find($id);
        return view('receiptvoucher.show',compact('show'));
    }
    public function edit($id){
        $this->authorize('edit-receipt-voucher');
        $accounts=Chartofaccount::all();
        $edit=Journal::find($id);
        return view('receiptvoucher.edit',compact('edit','accounts'));
    }
    public function prints($id){
        $this->authorize('print-receipt-voucher');
        $show=Journal::find($id);
        return view('receiptvoucher.print',compact('show'));
    }
    public function fetch(){
        $this->authorize('receipt-voucher');
        $data=Journal::with('createdby')->where('type','receipt voucher')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
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
                $action=null;
                $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/sales-voucher/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                $action.="<a title='Show' class='btn btn-sm btn-primary' href='" . url('receipt-voucher/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                return $action;
            })->rawColumns(['options'])->make(true);

    }
    public function create(){
        $this->authorize('add-receipt-voucher');
        $blines=BusinessLine::all();

        $customers=Chartofaccount::where('code3',3)->orderBy('title','asc')->get();
        $servicetaxes=Chartofaccount::where('code3',13)->get();
        $incometaxes=Chartofaccount::where('code3',4)->get();
        $liability_incometaxes=Chartofaccount::where('code3',5)->get();
        foreach ($customers as $item){
            $item->title=str_replace("'","",$item->title);
        }
        return view('receiptvoucher.create',compact('blines','customers','servicetaxes','incometaxes','liability_incometaxes'));
    }
    public function store(Request $request){
        $this->authorize('add-receipt-voucher');
        $c=Customer::where('acc_code',$request->customer_acc)->first();
        $c_id=[];
        foreach (Journal::all() as $voucher) {
            $date=substr($voucher->customize_id, 3, 4);
            $type=substr($voucher->customize_id, 0, 2);
            if (date('my')==$date){
                if ($type=='RV'){
                    $c_id[]=$voucher->id;
                }
            }
        }
        $this->validate(request(), [
            'business_line' => 'required',
            'v_date' => 'required',
        ]);
        if ($c->tax_case=='1') {
            $this->validate(request(), [
                'payment_type' => 'required',
                'payment_acc' => 'required',
                'payment_charges' => 'required',
                'payment_narration' => 'required',
                'customer_acc' => 'required',
                'customer_inv' => 'required',
                'customer_charge' => 'required',
                'customer_narration' => 'required',
                'adv_income_tax_acc' => 'required',
                'adv_income_tax_charges' => 'required',
                'adv_income_tax_narration' => 'required',
                'payable_income_tax_acc' => 'required',
                'payable_income_tax_charges' => 'required',
                'payable_income_tax_narration' => 'required',
            ]);
            if ($request->payment_charges!=$request->customer_charge){
                return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
            }
            if ($request->adv_income_tax_charges!=$request->payable_income_tax_charges){
                return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
            }
        }
        if ($c->tax_case=='2') {
            $this->validate(request(), [
                'payment_type' => 'required',
                'payment_acc' => 'required',
                'payment_charges' => 'required',
                'payment_narration' => 'required',
                'customer_acc' => 'required',
                'customer_inv' => 'required',
                'customer_charge' => 'required',
                'customer_narration' => 'required',
                'adv_income_tax_acc' => 'required',
                'adv_income_tax_charges' => 'required',
                'adv_income_tax_narration' => 'required',
                'service_tax_acc' => 'required',
                'service_tax_charges' => 'required',
                'service_tax_narration' => 'required',
            ]);
            //dd($request->payment_charges,$request->service_tax_charges,$request->adv_income_tax_charges,$request->customer_charge);
            if ($request->payment_charges!=$request->customer_charge){
                return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
            }
        }
        if ($c->tax_case=='3') {
            $this->validate(request(), [
                'payment_type' => 'required',
                'payment_acc' => 'required',
                'payment_charges' => 'required',
                'payment_narration' => 'required',
                'customer_acc' => 'required',
                'customer_inv' => 'required',
                'customer_charge' => 'required',
                'customer_narration' => 'required',
                'adv_income_tax_acc' => 'required',
                'adv_income_tax_charges' => 'required',
                'adv_income_tax_narration' => 'required',
            ]);
            if (($request->payment_charges+$request->adv_income_tax_charges)!=$request->customer_charge){
                return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
            }
        }

        $journal=new Journal();
        $journal->business_line=$request->business_line;
        $journal->date=$request->v_date;
        $journal->type='receipt voucher';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id='RV'.'.'.date('my').'.'.(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
        $journal->save();
        $inv=Invoice::find($request->customer_inv);
        $vs=new InvoiceVsReceipts();
        $vs->invoice_id=$inv->voucher_id;
        $vs->receipt_id=$journal->id;
        $vs->save();
        if ($c->tax_case=='1'){
            //bank or cash
            $receipt=new JournalDetails();
            $receipt->parent_id=$journal->id;
            //$receipt->cost_center=$request->costcenter[$k];
            $receipt->acc_code=$request->payment_acc;
            $receipt->narration=$request->payment_narration;
            $receipt->dr=$request->payment_charges;
            $receipt->save();
            //customer
            $customer=new JournalDetails();
            $customer->parent_id=$journal->id;
            $customer->acc_code=$request->customer_acc;
            $customer->narration=$request->customer_narration;
            //$customer->inv=$request->inv;
            $customer->cr=$request->customer_charge;
            $customer->save();
            //advance income tax - current assets
            $advance_it=new JournalDetails();
            $advance_it->parent_id=$journal->id;
            $advance_it->acc_code=$request->adv_income_tax_acc;
            $advance_it->narration=$request->adv_income_tax_narration;
            $advance_it->dr=$request->adv_income_tax_charges;
            $advance_it->save();
            // income tax - liability
            $liability_it=new JournalDetails();
            $liability_it->parent_id=$journal->id;
            $liability_it->acc_code=$request->payable_income_tax_acc;
            $liability_it->narration=$request->payable_income_tax_narration;
            $liability_it->cr=$request->payable_income_tax_charges;
            $liability_it->save();
        }
        if ($c->tax_case=='2'){


            //bank/cash
            $receipt=new JournalDetails();
            $receipt->parent_id=$journal->id;
            //$receipt->cost_center=$request->costcenter[$k];
            $receipt->acc_code=$request->payment_acc;
            $receipt->narration=$request->payment_narration;
            $receipt->dr=$request->payment_charges;
            $receipt->save();
            //customer
            $customer=new JournalDetails();
            $customer->parent_id=$journal->id;
            $customer->acc_code=$request->customer_acc;
            $customer->narration=$request->customer_narration;
            $customer->cr=$request->customer_charge;
            $customer->save();
            //advance income tax - current assets
            $advance_it=new JournalDetails();
            $advance_it->parent_id=$journal->id;
            $advance_it->acc_code=$request->adv_income_tax_acc;
            $advance_it->narration=$request->adv_income_tax_narration;
            $advance_it->dr=$request->adv_income_tax_charges;
            $advance_it->save();
            //Liabilities -> Current Liabilities -> PRA Cr.

            $service_tax=new JournalDetails();
            $service_tax->parent_id=$journal->id;
            $service_tax->acc_code=$request->service_tax_acc;
            $service_tax->narration=$request->service_tax_narration;
            $service_tax->dr=$request->service_tax_charges;
            $service_tax->save();
        }
        if ($c->tax_case=='3'){

//bank/cash
            $receipt=new JournalDetails();
            $receipt->parent_id=$journal->id;
            //$receipt->cost_center=$request->costcenter[$k];
            $receipt->acc_code=$request->payment_acc;
            $receipt->narration=$request->payment_narration;
            $receipt->dr=$request->payment_charges;
            $receipt->save();
            //customer
            $customer=new JournalDetails();
            $customer->parent_id=$journal->id;
            $customer->acc_code=$request->customer_acc;
            $customer->narration=$request->customer_narration;
            //$customer->inv=$request->inv;
            $customer->cr=$request->customer_charge;
            $customer->save();
            //advance income tax - current assets
            $advance_it=new JournalDetails();
            $advance_it->parent_id=$journal->id;
            $advance_it->acc_code=$request->adv_income_tax_acc;
            $advance_it->narration=$request->adv_income_tax_narration;
            $advance_it->dr=$request->adv_income_tax_charges;
            $advance_it->save();
        }
        if ($request->attachments){
            foreach ($request->attachments as $files) {
                $attachment=$journal->id.$files->getClientOriginalName();
                Storage::disk('local')->put('/public/vouchers/'.$journal->id.'/'.$attachment, File::get($files));
                $assets=new Journalassets();
                $assets->voucher_id=$journal->id;
                $assets->attachment=$attachment;
                $assets->save();
            }
        }
        return response()->json(['success'=>'Voucher added Successfully']);
    }


    public function get_inv($id){

        $jobids=[];
        $customer=Customer::where('acc_code',$id)->first();
        $quotes=Quotes::where('customer_id',$customer->id)->get();
        foreach ($quotes as $quote){
            $jobs=Job::where('quote_id',$quote->id)->get();
            foreach ($jobs as $job){
                $jobids[]=$job->id;
            }
        }
        $data['invoices']=Invoice::whereIn('job_id',$jobids)->get();
        $data['case']=$customer->tax_case;
        return response()->json($data);
    }
    public function get_inv_details($inv){

        $invoice =Invoice::find($inv);
        $journal=Journal::find($invoice->voucher_id);
        $details=$journal->details;
        foreach ($details as $detail){
            if ($detail->cr==null){
                $detail->cr='';
            }
            if ($detail->dr==null){
                $detail->dr='';
            }
        }
        return response()->json($details);
    }
    public function get_payment_acc($type){
        if ($type=='cash'){
            $accounts=Chartofaccount::where('code3',2)->get();
        }
        if ($type=='bank'){
            $accounts=Chartofaccount::where('code3',1)->get();
        }
        return response()->json($accounts);
    }
}