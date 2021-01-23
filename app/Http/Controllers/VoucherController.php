<?php

namespace App\Http\Controllers;

use App\Models\AccLevelFour;
use App\Models\Voucher;
use App\Models\Voucherdetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    public function index(){
        return view('voucher.index');
    }
    public function show($id){
        $show=Voucher::find($id);
        return view('voucher.show',compact('show'));
    }
    public function edit($id){
        $accounts=AccLevelFour::all();
        $edit=Voucher::find($id);
        return view('voucher.edit',compact('edit','accounts'));
    }
    public function prints($id){
        $show=Voucher::find($id);
        return view('voucher.print',compact('show'));
    }



    public function fetch(){
        $data=Voucher::with('createdby')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customize_id', function ($data) {
                return $data->customize_id;
            })
            ->addColumn('type', function ($data) {
                return ucwords(str_replace('-',' ',$data->v_type)).' Voucher';
            })

            ->addColumn('date', function ($data) {
                return $data->v_date->format('d-M-Y');
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
        $accounts=AccLevelFour::all();
        return view('voucher.create',compact('accounts'));
    }
    public function store(Request $request){

        $this->validate(request(), [
            'v_type' => 'required',
            'v_date' => 'required',
            'account' => 'required',
            'narration' => 'required',
            'type' => 'required',
            'price' => 'required',
        ],[
            'v_type.required' => 'Voucher Type is required.',
            'v_date.required' => 'Voucher Date is required.',
        ]);


        $voucher=new Voucher();
        $voucher->v_date=$request->v_date;
        $voucher->v_type=$request->v_type;
        $voucher->created_by=auth()->user()->id;
        $voucher->updated_by=auth()->user()->id;
        $voucher->save();
        $voucher->customize_id=$voucher->id.date('dmy');
        $voucher->save();
        foreach ($request->account as $k=>$item){
            $details=new Voucherdetails();
            $details->v_id=$voucher->id;
            $details->acc_code=$request->account[$k];
            $details->narration=$request->narration[$k];
            if ($request->type[$k]=='credit'){
                $details->cr=$request->price[$k];
            }
            if ($request->type[$k]=='debit'){
                $details->dr=$request->price[$k];
            }
            $details->save();
        }
        return redirect()->back()->with(['success'=>'Voucher added Successfully']);
    }
    public function update(Request $request){

        $this->validate(request(), [
            'v_type' => 'required',
            'v_date' => 'required',
            'account' => 'required',
            'narration' => 'required',
            'type' => 'required',
            'price' => 'required',
        ],[
            'v_type.required' => 'Voucher Type is required.',
            'v_date.required' => 'Voucher Date is required.',
        ]);
        $voucher=Voucher::find($request->id);
        $voucher->v_date=$request->v_date;
        $voucher->v_type=$request->v_type;
        $voucher->updated_by=auth()->user()->id;
        $voucher->save();
        $voucher->customize_id=$voucher->id.date('dmy');
        $voucher->save();
        $deletes=Voucherdetails::where('v_id',$request->id)->get();
        foreach ($deletes as $delete){
            Voucherdetails::find($delete->id)->delete();
        }
        foreach ($request->account as $k=>$item){
            $details=new Voucherdetails();
            $details->v_id=$voucher->id;
            $details->acc_code=$request->account[$k];
            $details->narration=$request->narration[$k];
            if ($request->type[$k]=='credit'){
                $details->cr=$request->price[$k];
            }
            if ($request->type[$k]=='debit'){
                $details->dr=$request->price[$k];
            }
            $details->save();
        }
        return redirect()->back()->with(['success'=>'Voucher updated Successfully']);
    }

    //
}