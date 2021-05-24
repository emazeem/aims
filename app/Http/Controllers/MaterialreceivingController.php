<?php

namespace App\Http\Controllers;

use App\Models\Chartofaccount;
use App\Models\Grn;
use App\Models\GrnVoucher;
use App\Models\InventoryCategory;
use App\Models\Journal;
use App\Models\JournalDetails;
use App\Models\Materialreceiving;
use App\Models\Po;
use App\Models\Purchaseindentitem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialreceivingController extends Controller
{
    public function index(){
        return view('materialreceivings.index');
    }
    public function fetch()
    {
        $data = Po::with('createdBy')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return 'PO # '.$data->id;
            })
            ->addColumn('indent_id', function ($data) {
                return 'IND # '.$data->indent_id;
            })
            ->addColumn('date', function ($data) {
                return $data->created_at->format('d M y');
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdBy->fname.' '.$data->createdBy->lname;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/material_receiving/show/' . $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";
            })
            ->rawColumns(['options'])
            ->make(true);

    }

    public function show($id){
        $show=Po::find($id);
        $grns=Grn::where('po_id',$id)->get();
        $grnid=[];
        foreach ($grns as $grn) {
            $grnid[]=$grn->receiving_id;
        }
        return view('materialreceivings.show',compact('show','grnid'));
    }
    public function create($id){
        $item=Purchaseindentitem::find($id);
        $edit=Materialreceiving::where('purchase_indent_item_id',$id)->get();
        if (count($edit)>0){
            $edit=Materialreceiving::where('purchase_indent_item_id',$id)->first();
            return view('materialreceivings.edit',compact('edit'));
        }
        return view('materialreceivings.create',compact('item'));

    }
    public function edit($id){
        $edit=Materialreceiving::find($id);
        return view('materialreceivings.edit',compact('edit'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'received_from'=>'required',
            'unit'=>'required',
            'qty'=>'required',
            'physical_check'=>'required',
            'meet_specifications'=>'required',
        ]);
        $receiving=new Materialreceiving();
        $receiving->purchase_indent_item_id=$request->indent_item_id;
        $receiving->received_from=$request->received_from;
        $receiving->physical_check=$request->physical_check;
        $receiving->meet_specifications=$request->meet_specifications;
        if ($request->meet_specifications==1){
            $receiving->specifications=$request->specifications;
        }
        $receiving->unit=$request->unit;
        $receiving->qty=$request->qty;
        $receiving->save();
        return redirect()->back()->with('success','Material Receiving added successfully');
    }
    public function update(Request $request){
        $this->validate($request,[
            'received_from'=>'required',
            'unit'=>'required',
            'qty'=>'required',
            'physical_check'=>'required',
            'meet_specifications'=>'required',
        ]);
        $receiving=Materialreceiving::find($request->id);
        $receiving->purchase_indent_item_id=$request->indent_item_id;
        $receiving->received_from=$request->received_from;
        $receiving->physical_check=$request->physical_check;
        $receiving->meet_specifications=$request->meet_specifications;
        if ($request->meet_specifications==1){
            $receiving->specifications=$request->specifications;
        }
        $receiving->unit=$request->unit;
        $receiving->qty=$request->qty;
        $receiving->delete();
        $receiving->save();
        return redirect()->back()->with('success','Material Receiving updated successfully');
    }
    public function create_grn(Request $request){
        $this->validate($request,[
            'grn'=>'required'
        ]);
        do {
            $unique=strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
            $codes=Grn::all()->where('unique',$unique);
        }
        while ($codes->count());
        $total=0;
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
        $journal->type='GRN';
        $journal->created_by=auth()->user()->id;
        $journal->customize_id=0;
        $journal->save();
        $journal->customize_id=date('dmy').(str_pad(count($c_id)+1, 3, '0', STR_PAD_LEFT));
        $journal->save();
        foreach ($request->grn as $g){

            $grn=new Grn();
            $grn->po_id=$request->po;
            $grn->receiving_id=$g;
            $grn->unique=$unique;
            $grn->save();

            $g=Purchaseindentitem::find($g);
            $price=$g->price*$g->qty;
            $subcategory=InventoryCategory::find($g->subcategory_id);
            $inventoryacc=Chartofaccount::find($subcategory->acc_id);

            //Current Asset -> Inventory Dr.
            $inventory=new JournalDetails();
            $inventory->parent_id=$journal->id;
            $inventory->acc_code=$inventoryacc->acc_code;
            $inventory->narration='INVENTORY NARRATION FOR PO # 00'.$request->po;
            $inventory->dr=$price;
            $inventory->save();
            $total=$total+$price;

        }
        //Liability -> IR/GR Cr.
        $irgr=new JournalDetails();
        $irgr->parent_id=$journal->id;
        $irgr->acc_code=20103001;
        $irgr->narration='IR/GR NARRATION FOR PO # 00'.$request->po;
        $irgr->cr=$total;
        $irgr->save();


        $grnvoucher=new GrnVoucher();
        $grnvoucher->po_id=$request->po;
        $grnvoucher->unique=$unique;
        $grnvoucher->voucher_id=$journal->id;
        $grnvoucher->save();

        return redirect()->back()->with('success','GRN created successfully');
    }
    //
}
