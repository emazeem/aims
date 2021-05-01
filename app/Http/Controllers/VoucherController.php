<?php

namespace App\Http\Controllers;

use App\Models\BusinessLine;
use App\Models\Chartofaccount;
use App\Models\Journal;
use App\Models\Journalassets;
use App\Models\JournalDetails;
use App\Models\Po;
use App\Models\PoVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    public function index(){
        return view('voucher.index');
    }
    public function show($id){
        $show=Journal::find($id);
        $povoucher=PoVoucher::where('journal_id',$show->id)->first();
        if (isset($povoucher)){
            $po=Po::find($povoucher->po_id);
        }
        else{
            $po=null;
        }
        return view('voucher.show',compact('show','po'));
    }
    public function edit($id){
        $accounts=Chartofaccount::all();
        $edit=Journal::find($id);
        return view('voucher.edit',compact('edit','accounts'));
    }
    public function prints($id){
        $show=Journal::find($id);
        return view('voucher.print',compact('show'));
    }
    public function fetch(){
        $data=Journal::with('createdby')->get();
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
                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/vouchers/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-primary' href='" . url('/vouchers/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  ";
            })->rawColumns(['options'])->make(true);

    }
    public function create(){
        $accounts=Chartofaccount::orderBy('title','ASC')->get();
        foreach ($accounts as $customer){
            $customer->title=str_replace("'","",$customer->title);
        }
        $blines=BusinessLine::all();
        return view('voucher.create',compact('accounts','blines'));
    }
    public function store(Request $request){
        $c_id=[];
        foreach (Journal::all() as $voucher) {
            $date=substr($voucher->customize_id, 2, 4);
            if (date('my')==$date){
                $c_id[]=$voucher->id;
            }
        }
        //dd($request->all());
        $this->validate(request(), [
            'v_type' => 'required',
            'v_date' => 'required',
            'account.*' => 'required',
            'narration.*' => 'required',
            'price.*' => 'required',
        ]);
        $dr=0;$cr=0;
        foreach ($request->account as $k=>$item){
            $cr=$cr+$request->cr[$k];
            $dr=$dr+$request->dr[$k];
        }
        if ($dr!=$cr){
            return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
        }
        $journal=new Journal();
        $journal->business_line=$request->business_line;
        $journal->date=$request->v_date;
        $journal->type=$request->v_type.' voucher';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id=date('dmy').(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
        $journal->save();
        foreach ($request->account as $k=>$item){
            $details=new JournalDetails();
            $details->parent_id=$journal->id;
            $details->cost_center=$request->costcenter[$k];
            $details->acc_code=$request->account[$k];
            $details->narration=$request->narration[$k];
            $details->cr=$request->cr[$k];
            $details->dr=$request->dr[$k];
            $details->save();
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
        if ($request->po){
            $po=new PoVoucher();
            $po->journal_id=$journal->id;
            $po->po_id=$request->po;
            $po->save();
        }
        return response()->json(['success'=>'Voucher added Successfully']);
    }
    public function update(Request $request){
        $this->validate(request(), [
            'v_type' => 'required',
            'v_date' => 'required',
            'account.*' => 'required',
            'narration.*' => 'required',
            'price.*' => 'required',
        ]);
        $dr=0;$cr=0;
        foreach ($request->account as $k=>$item){
            $cr=$cr+$request->cr[$k];
            $dr=$dr+$request->dr[$k];
        }
        if ($dr!=$cr){
            return response()->json(['error'=>'Please verify that credit and debit amounts are equal'],422);
        }
        $journal=Journal::find($request->id);
        $journal->business_line=1;
        $journal->date=$request->v_date;
        $journal->type=$request->v_type.' voucher';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();

        foreach ($request->account as $k=>$item){
            $details=JournalDetails::find($request->details_id[$k]);
            $details->parent_id=$journal->id;
            $details->acc_code=$request->account[$k];
            $details->cost_center=$request->costcenter[$k];
            $details->narration=$request->narration[$k];
            $details->cr=$request->cr[$k];
            $details->dr=$request->dr[$k];
            $details->save();
        }
        return response()->json(['success'=>'Voucher updated Successfully']);
    }
    //
}
