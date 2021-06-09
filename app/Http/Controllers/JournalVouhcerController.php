<?php

namespace App\Http\Controllers;

use App\Models\AccLevelThree;
use App\Models\BusinessLine;
use App\Models\Chartofaccount;
use App\Models\Journal;
use App\Models\Journalassets;
use App\Models\JournalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class JournalVouhcerController extends Controller
{
    //
    public function index(){
        $this->authorize('journal-vouchers');
        return view('journalvoucher.index');
    }
    public function edit($id){
        $this->authorize('edit-journal-vouchers');
        $accounts=AccLevelThree::orderBy('title','ASC')->get();
        foreach ($accounts as $customer){
            $customer->title=str_replace("'","",$customer->title);
        }
        $blines=BusinessLine::all();
        $edit=Journal::find($id);
        return view('journalvoucher.edit',compact('edit','accounts','blines'));
    }
    public function prints($id){
        $this->authorize('print-journal-vouchers');
        $show=Journal::find($id);
        return view('paymentvoucher.print',compact('show'));
    }
    public function fetch(){
        $this->authorize('journal-vouchers');
        $data=Journal::with('createdby')->where('type','journal voucher')->get();
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
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/journal-vouchers/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-primary' href='" . url('/vouchers/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  ";
            })->rawColumns(['options'])->make(true);

    }
    public function create(){
        $this->authorize('add-journal-vouchers');
        $accounts=AccLevelThree::orderBy('title','ASC')->get();
        foreach ($accounts as $customer){
            $customer->title=str_replace("'","",$customer->title);
        }
        $blines=BusinessLine::all();

        return view('journalvoucher.create',compact('accounts','blines'));
    }
    public function store(Request $request){
        $this->authorize('add-journal-vouchers');
        $c_id=[];
        foreach (Journal::all() as $voucher) {
            $date=substr($voucher->customize_id, 5, 4);
            $type=substr($voucher->customize_id, 0, 2);
            if (date('my')==$date){
                if ($type=='JV'){
                    $c_id[]=$voucher->id;
                }
            }
        }
        //dd($c_id);
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
        $journal->reference=$request->reference?$request->reference:null;
        $journal->date=$request->v_date;
        $journal->type=$request->v_type.' voucher';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id='JV'.'.'.date('dmy').'.'.(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
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
        return response()->json(['success'=>'JV added']);
    }

    public function update(Request $request){
        $this->authorize('edit-journal-vouchers');

        $this->validate(request(), [
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
        $journal->reference=$request->reference?$request->reference:null;
        $journal->created_by=auth()->user()->id;
        $journal->save();

        foreach ($request->account as $k=>$item){

            $details=JournalDetails::find($request->detail_id[$k]);
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
        return response()->json(['success'=>'JV Updated']);
    }
}
