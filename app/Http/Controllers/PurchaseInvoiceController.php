<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use App\Models\GrnVoucher;
use App\Models\Journal;
use App\Models\JournalDetails;
use App\Models\Po;
use App\Models\Purchaseindent;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PurchaseInvoiceController extends Controller
{

    public function index(){
        return view('purchaseinvoice.index');
    }
    public function fetch(){
        $data=Journal::with('createdby')->where('type','purchase invoice')->get();
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
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/sales-voucher/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-primary' href='" . url('/sales-voucher/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  ";
            })->rawColumns(['options'])->make(true);

    }public function create_fetch(){
    $this->authorize('jobs-index');
    $data=GrnVoucher::all();
    return DataTables::of($data)
        ->addColumn('id', function ($data) {
            return $data->id;
        })
        ->addColumn('po', function ($data) {
            return $data->po_id;
        })
        ->addColumn('voucher_id', function ($data) {
            return $data->voucher_id;
        })
        ->addColumn('options', function ($data) {

            $action=null;
            $token=csrf_token();
            $action.="<a class='btn btn-danger btn-sm invoice-store' title='Create Invoice' href='#' data-id='{$data->id}'><i class='fa fa-plus'></i> Invoice</a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"POST\">
                
                     </form>";
            if (!$data->invoice_id){
                return $action;
            }else{
                return "<a href='".url('vouchers/show/'.$data->invoice_id)."' class='btn btn-sm btn-warning'><i class='fa fa-eye'></i> Purchase Invoice</a>";
            }
        })
        ->rawColumns(['options','status'])
        ->make(true);

    }
    public function create(){
        return view('purchaseinvoice.create');
    }
    public function store(Request $request){
        //dd($request->all());
        $price=0;
        $grnvoucher=GrnVoucher::find($request->id);
        $po=Po::find($grnvoucher->po_id);
        $indent=Purchaseindent::find($po->indent_id);
        $vendor=Vendors::find($indent->selected_vendor);
        $prev_voucher=Journal::find($grnvoucher->voucher_id);
        foreach ($prev_voucher->details as $detail){
            if ($detail->acc_code==20103001){
                $price=$detail->cr;
            }
        }

        $this->validate(request(), [
            'id'=>'required'
        ]);

        $c_id=[];
        foreach (Journal::all() as $voucher) {
            $date=substr($voucher->customize_id, 2, 4);
            if (date('my')==$date){
                $c_id[]=$voucher->id;
            }
        }

        $journal=new Journal();
        $journal->business_line=1;
        $journal->date=date('Y-m-d');
        $journal->type='purchase invoice';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id=date('dmy').(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
        $journal->save();

        //Liability -> IR/GR Dr.
        $irgr=new JournalDetails();
        $irgr->parent_id=$journal->id;
        $irgr->acc_code=20103001;
        $irgr->narration='IR/GR NARRATION FOR PO # 00'.$request->po;
        $irgr->dr=$price;
        $irgr->save();

        //Liability -> Supplier and Vendor Cr.
        $supplier=new JournalDetails();
        $supplier->parent_id=$journal->id;
        $supplier->acc_code=$vendor->acc_code;
        $supplier->narration='VENDOR AND SUPPLIER NARRATION FOR PO # 00'.$request->po;
        $supplier->cr=$price;
        $supplier->save();

        $grnvoucher->invoice_id=$journal->id;
        $grnvoucher->save();

        return response()->json(['success'=>'Invoice created successfully']);
    }
    //
}
