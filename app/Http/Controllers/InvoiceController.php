<?php

namespace App\Http\Controllers;

use App\Models\Chartofaccount;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Journal;
use App\Models\JournalDetails;
use App\Models\QuoteItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function store(Request $request){
        $this->authorize('add-sales-invoice');
        $this->validate(request(), [
            'id'=>'required'
        ]);
        $job=Job::find($request->id);
        $job->status=2;
        $invoice=new Invoice();
        $invoice->job_id=$request->id;
        $invoice->title='INV/'.str_pad($request->id,6,0,STR_PAD_LEFT);
        $invoice->save();
        //$customr_acc=Chartofaccount::where('acc_code',$invoice->job->quotes->customers->acc_code)->first();

        $c_id=[];
        foreach (Journal::all() as $voucher) {
            $date=substr($voucher->customize_id, 5, 4);
            $type=substr($voucher->customize_id, 0, 2);
            if (date('my')==$date){
                if ($type=='SI'){
                    $c_id[]=$voucher->id;
                }
            }
        }
        $service_charges=0;
        $jobitems=Jobitem::where('job_id',$invoice->job_id)->pluck('item_id');
        $unique_lab_items=array();
        foreach ($jobitems as $item){
            $unique_lab_items[]=$item;
        }
        $items=array_unique($unique_lab_items);
        $items=array_values($items);
        $items=QuoteItem::whereIn('id',$items)->get();

        foreach($items as $item){
            $service_charges=$service_charges+($item->price*$item->quantity);
        }
        $regional_tax=$invoice->job->quotes->customers->regions->value;
        $regional_tax_charges=$regional_tax/100*$service_charges;

        $journal=new Journal();
        $journal->business_line=1;
        $journal->date=date('Y-m-d');
        $journal->type='sales invoice';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $invoice->voucher_id=$journal->id;
        $invoice->save();
        $journal->customize_id='SI'.'.'.date('dmy').'.'.(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
        $journal->save();

        //Accounts Receivable of customer Dr.
        $acc_receivable=new JournalDetails();
        $acc_receivable->parent_id=$journal->id;
        $acc_receivable->acc_code=$invoice->job->quotes->customers->acc_code;
        $acc_receivable->narration='ACCOUNTS RECEIVABLE OF '.strtoupper($invoice->job->quotes->customers->reg_name).' AGAINST '.$invoice->title;
        $acc_receivable->dr=$service_charges+$regional_tax_charges;
        $acc_receivable->save();
        //Revenue -> Sales -> Calibration services Cr.
        $sales=new JournalDetails();
        $sales->parent_id=$journal->id;
        $sales->acc_code=40101001;
        $sales->narration='SERVICE CHARGES OF '.$invoice->title;
        $sales->cr=$service_charges;
        $sales->save();
        //Liabilities -> Current Liabilities -> PRA Cr.
        $service_tax=new JournalDetails();
        $service_tax->parent_id=$journal->id;
        $service_tax->acc_code=20101001;
        $service_tax->narration=$invoice->job->quotes->customers->regions->name.' OF '.$invoice->title;
        $service_tax->cr=$regional_tax_charges;
        $service_tax->save();
        $job->save();
        return response()->json(['success'=>'Invoice created successfully']);
    }
}
