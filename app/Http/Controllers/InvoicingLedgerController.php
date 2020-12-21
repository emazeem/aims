<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InvoicingLedger;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Preference;
use App\Models\ReceivingLedger;
use App\Models\Sitejob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\Facades\DataTables;


class InvoicingLedgerController extends Controller
{
    public function index(){
        $customers=Customer::all();
        $data=InvoicingLedger::all();
        $oldest=[];
        foreach ($data as $datum){
            $oldest[]=$datum->invoice;
        }
        $oldest=collect($oldest)->min();
        $oldest=date('m/d/Y',strtotime($oldest));
        $latest=date('m/d/Y');
        return view('invoicingledger.index',compact('customers','oldest','latest'));
    }
    public function clearfilter(Request $request){
        $request->session()->forget('filter_data');
        return back();
    }
    public function show($invoice){
        $show=InvoicingLedger::find($invoice);
        $receivings=ReceivingLedger::where('invoice_id',$invoice)->get();
        return view('invoicingledger.show',compact('show','receivings'));
    }

    public function search(Request $request){
        //dd($request->all());
        $request->session()->forget('filter_data');
        $this->validate($request,[
            'daterange'=>'required',
        ]);
        if ($request->show=="customer_radio"){
            $this->validate($request,[
                'customer'=>'required',
            ]);
        }
        if ($request->show=="tax_radio"){
            $this->validate($request,[
                'taxtype'=>'required',
                'taxby'=>'required',
            ]);
        }

        if (isset($request->daterange)){
            $filter_data['dates']=explode('-',$request->daterange);
        }
        if (isset($request->customer)){
            $filter_data['customer']=$request->customer;
        }
        if (isset($request->taxtype)){
            if ($request->taxtype=='income'){
                $filter_data['income']=$request->taxby;
            }
            if ($request->taxtype=='service'){
                if (isset($request->region)){
                    $filter_data['service']=$request->taxby;
                    $filter_data['region']=Preference::find($request->region)->value;
                }else{
                    $filter_data['service']=$request->taxby;
                }
            }

        }

        Session::put('filter_data', $filter_data);
        //dd($request->session()->get('filter_data'));
        return back();
    }
    public function fetch()
    {
        $check=Session::get('filter_data');
        if (empty($check)){
            $data = InvoicingLedger::with('customers')->get();
        }
        else{
            $start=date('Y-m-d',strtotime($check['dates'][0]));
            $end=date('Y-m-d',strtotime($check['dates'][1]));
            $customer=null;$income=null;$service=null;$region=null;
            if (isset($check['customer'])){
                $customer=$check['customer'];
            }
            if (isset($check['income'])){
                $income=$check['income'];
                if ($income=='Source'){
                    $income='At Source';
                }
                if ($income=='AIMS'){
                    $income='By AIMS';
                }
            }
            if (isset($check['service'])){
                $service=$check['service'];
                if ($service=='Source'){
                    $service='At Source';
                }
                if ($service=='AIMS'){
                    $service='By AIMS';
                }
            }
            if (isset($check['region'])){
                $region=$check['region'];
            }



            $data=InvoicingLedger::where(function ($query) use ($start, $end,$customer,$income,$service,$region) {
                $query->where('invoice', '>=', $start);
                $query->where('invoice', '<=', $end);
                if ($customer!=null){
                    $query->where('customer_id',$customer);
                }
                if ($income!=null){
                    $query->where('income_tax_deducted',$income);
                }
                if ($service!=null){
                    if ($region!=null){
                        $query->where('service_tax_deducted',$service);
                        $query->where('service_tax_type',$region);
                    }else{
                        $query->where('service_tax_deducted',$service);

                    }
                }

            })->get();
            }
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('job_id', function ($data) {
                return $data->job_id;
            })
            ->addColumn('service_charges', function ($data) {
                return $data->service_charges;
            })
            ->addColumn('services_tax_type', function ($data) {
                return Preference::find($data->service_tax_type)->name." (".$data->service_tax_percent."%)";
            })
            ->addColumn('services_tax_amount', function ($data) {
                return $data->service_tax_amount;
            })
            ->addColumn('income_tax_percent', function ($data) {
                return $data->income_tax_percent.'%';
            })
            ->addColumn('income_tax_amount', function ($data) {
                return $data->income_tax_amount;
            })
            ->addColumn('net_receivable', function ($data) {
                return $data->net_receivable;
            })
            ->addColumn('service_tax_deducted', function ($data) {
                return $data->service_tax_deducted;
            })
            ->addColumn('income_tax_deducted', function ($data) {
                return $data->income_tax_deducted;
            })

            ->addColumn('confirmed_by', function ($data) {
                return $data->confirmed_by_name."<br> ".$data->confirmed_by_phone;
            })
            ->addColumn('invoice', function ($data) {
                return date('d M, Y',strtotime($data->invoice));
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                    <a title='Show' href='".url('/invoicing-ledger/show/'.$data->id)."' class='btn btn-sm btn-success'><i class='fa fa-eye'></i></a>
                  ";
            })

            ->rawColumns(['options','confirmed_by'])
            ->make(true);

    }

    public function store(Request $request){
        //dd($request->all());
        /*$count=InvoicingLedger::where('job_id',$request->id)->get();
        if (count($count)>0){
            return redirect()->back()->with('error','Invoice details already exists, you cant add.');
        }
        $this->validate($request,[
           'tax_deducted_by'=>'required',
           'confirmed_by_name'=>'required',
           'confirmed_by_phone'=>'required',
        ]);
        $service_charges=$request->service_charges;

        $service_tax_amount=$request->service_tax_percent/100*$service_charges;
        $income_tax_amount=$request->income_tax_percent/100*($service_charges+$service_tax_amount);
        $net_receivable=0;
        $total=$service_charges+$service_tax_amount;
        //both by aims
        if ($request->tax_deducted_by==0){
            $net_receivable=$total;
        }
        //both at source
        if ($request->tax_deducted_by==1){
            $net_receivable=$total-$service_tax_amount-$income_tax_amount;
        }
        //income at source and service tax by aims
        if ($request->tax_deducted_by==2){
            $net_receivable=$total-$income_tax_amount;
        }
        //dd($net_receivable);
        //dd($request->all());
        $ledger=new InvoicingLedger();
        $ledger->job_id=$request->id;
        $ledger->customer_id=$request->customer;
        $ledger->service_charges=$service_charges;
        $ledger->service_tax_type=$request->service_tax_type;
        $ledger->service_tax_percent=$request->service_tax_percent;
        $ledger->service_tax_amount=$service_tax_amount;
        $ledger->income_tax_percent=$request->income_tax_percent;
        $ledger->income_tax_amount=$income_tax_amount;
        if ($request->tax_deducted_by==0){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="By AIMS";
        }
        if ($request->tax_deducted_by==1){
            $ledger->service_tax_deducted="At Source";
            $ledger->income_tax_deducted="At Source";
        }
        if ($request->tax_deducted_by==2){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="At Source";
        }
        $acc_phone=null;
        if (isset($request->acc_phone_1)){
            $acc_phone=$request->acc_phone_1;
        }
        if (isset($request->acc_phone_2)){
            $acc_phone.='-'.$request->acc_phone_2;
        }
        $ledger->net_receivable=$net_receivable;
        $ledger->invoice=date('Y-m-d');
        $ledger->confirmed_by_name=$request->confirmed_by_name;
        $ledger->confirmed_by_phone=$request->confirmed_by_phone;
        $account=Customer::find($request->customer);
        $account->acc_name=$request->acc_name;
        $account->acc_email=$request->acc_email;
        $account->acc_phone=$acc_phone;
        if ($ledger->save()){
            $account->save();
        }
        return redirect()->back()->with('success','Invoice Details Added Successfully');*/

        $count=InvoicingLedger::where('job_id',$request->id)->get();
        if (count($count)>0){
            return redirect()->back()->with('error','Invoice details already exists, you cant add.');
        }
        $this->validate($request,[
           'customers'=>'required',
           'service_charges'=>'required',
           'service_tax_type'=>'required',
           'tax_deducted_by'=>'required',
           'created_on'=>'required',
        ]);

        $service_charges=$request->service_charges;
        $service_tax_amount=Preference::find($request->service_tax_type)->value/100*$service_charges;
        $st=Preference::where('slug','income-tax')->first();
        $income_tax_amount=$st->value/100*($service_charges+$service_tax_amount);
        $net_receivable=0;
        $total=$service_charges+$service_tax_amount;
        //both by aims
        if ($request->tax_deducted_by==0){
            $net_receivable=$total;
        }
        //both at source
        if ($request->tax_deducted_by==1){
            $net_receivable=$total-$service_tax_amount-$income_tax_amount;
        }
        //income at source and service tax by aims
        if ($request->tax_deducted_by==2){
            $net_receivable=$total-$income_tax_amount;
        }
        $ledger=new InvoicingLedger();
        $ledger->job_id=$request->job;
        $ledger->customer_id=$request->customers;
        $ledger->service_charges=$service_charges;
        $ledger->service_tax_type=$request->service_tax_type;
        $ledger->service_tax_percent=Preference::find($request->service_tax_type)->value;
        $ledger->service_tax_amount=$service_tax_amount;
        $ledger->income_tax_percent=$st->value;
        $ledger->income_tax_amount=$income_tax_amount;
        if ($request->tax_deducted_by==0){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="By AIMS";
        }
        if ($request->tax_deducted_by==1){
            $ledger->service_tax_deducted="At Source";
            $ledger->income_tax_deducted="At Source";
        }
        if ($request->tax_deducted_by==2){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="At Source";
        }
        $ledger->net_receivable=$net_receivable;
        $ledger->invoice=date('Y-m-d');
        $ledger->confirmed_by_name='Confirmed By';
        $ledger->confirmed_by_phone='03001231231';
        $ledger->created_at=$request->created_on;
        $ledger->save();
        return redirect()->back()->with('success','Invoice Details Added Successfully');



    }
    public function update($invoice,Request $request){
        $this->validate($request,[
           'tax_deducted_by'=>'required',
           'confirmed_by_name'=>'required',
           'confirmed_by_phone'=>'required',
        ]);
        $service_charges=$request->service_charges;

        $service_tax_amount=$request->service_tax_percent/100*$service_charges;
        $income_tax_amount=$request->income_tax_percent/100*($service_charges+$service_tax_amount);
        $net_receivable=0;
        $total=$service_charges+$service_tax_amount;
        //both by aims
        if ($request->tax_deducted_by==0){
            $net_receivable=$total;
        }
        //both at source
        if ($request->tax_deducted_by==1){
            $net_receivable=$total-$service_tax_amount-$income_tax_amount;
        }
        //income at source and service tax by aims
        if ($request->tax_deducted_by==2){
            $net_receivable=$total-$income_tax_amount;
        }
        //dd($net_receivable);
        //dd($request->all());
        $ledger=InvoicingLedger::find($invoice);
        $ledger->job_id=$request->id;
        $ledger->customer_id=$request->customer;

        $ledger->service_charges=$service_charges;

        $ledger->service_tax_type=$request->service_tax_type;
        $ledger->service_tax_percent=$request->service_tax_percent;
        $ledger->service_tax_amount=$service_tax_amount;

        $ledger->income_tax_percent=$request->income_tax_percent;
        $ledger->income_tax_amount=$income_tax_amount;

        if ($request->tax_deducted_by==0){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="By AIMS";
        }
        if ($request->tax_deducted_by==1){
            $ledger->service_tax_deducted="At Source";
            $ledger->income_tax_deducted="At Source";
        }
        if ($request->tax_deducted_by==2){
            $ledger->service_tax_deducted="By AIMS";
            $ledger->income_tax_deducted="At Source";
        }
        $acc_phone=null;
        if (isset($request->acc_phone_1)){
            $acc_phone=$request->acc_phone_1;
        }
        if (isset($request->acc_phone_2)){
            $acc_phone.='-'.$request->acc_phone_2;
        }
        $ledger->net_receivable=$net_receivable;
        $ledger->invoice=date('Y-m-d');
        $ledger->confirmed_by_name=$request->confirmed_by_name;
        $ledger->confirmed_by_phone=$request->confirmed_by_phone;
        $account=Customer::find($request->customer);
        $account->acc_name=$request->acc_name;
        $account->acc_email=$request->acc_email;
        $account->acc_phone=$acc_phone;
        if ($ledger->save()){
            $account->save();
        }
        return redirect()->back()->with('success','Invoice Details Added Successfully');
    }
    public function create($id){
        $job=Job::find($id);
        $customer=Customer::where('id',$job->quotes->customer_id)->first();
        $tax=Preference::find($customer->region)->value;
        $service_charges=0;
        $jobs=Jobitem::where('job_id',$id)->with('items')->get();
        foreach ($jobs as $j){
            $service_charges=$service_charges+$j->item->price;
        }

        //for Only previous record;
        $customers=Customer::all();
        $service_taxes=Preference::where('category',1)->get();
        return view('invoicingledger.create',compact('job','id','service_charges','tax','customer','customers','service_taxes'));
    }
    public function edit($invoice){
        $invoice_ledger=InvoicingLedger::find($invoice);
        $id=$invoice_ledger->job_id;
        $job=Job::find($id);
        //dd($invoice);
        $customer=Customer::find($job->quotes->customer_id);
        $service_charges=0;
        $itemjobs=Jobitem::where('job_id',$id)->with('items')->get();
        foreach ($itemjobs as $itemjob){
            $service_charges=$service_charges+$itemjob->item->price;
        }
        $tax=Preference::find($customer->region)->value;
        return view('invoicingledger.edit',compact('job','id','service_charges','tax','customer','invoice_ledger'));
    }
}