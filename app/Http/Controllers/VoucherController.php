<?php

namespace App\Http\Controllers;

use App\Models\Chartofaccount;
use App\Models\Journal;
use App\Models\JournalDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    public function index(){
        return view('voucher.index');
    }
    public function show($id){
        $show=Journal::find($id);
        return view('voucher.show',compact('show'));
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
        $accounts=Chartofaccount::all();
        return view('voucher.create',compact('accounts'));
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
        $journal->business_line=1;
        $journal->date=$request->v_date;
        $journal->type=$request->v_type.' voucher';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id=date('dmy').(str_pad(count($c_id)+1, 2, '0', STR_PAD_LEFT));
        $journal->save();

        foreach ($request->account as $k=>$item){

            $details=new JournalDetails();
            $details->parent_id=$journal->id;
            $details->acc_code=$request->account[$k];
            $details->narration=$request->narration[$k];
            $details->cr=$request->cr[$k];
            $details->dr=$request->dr[$k];
            $details->save();
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
            $details->narration=$request->narration[$k];
            $details->cr=$request->cr[$k];
            $details->dr=$request->dr[$k];
            $details->save();
        }
        return response()->json(['success'=>'Voucher updated Successfully']);
    }
    //
}
