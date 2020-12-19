<?php

namespace App\Http\Controllers;

use App\Models\Materialreceiving;
use App\Models\Purchaseindentitem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialreceivingController extends Controller
{
    public function index(){
        return view('materialreceivings.index');
    }
    public function fetch(){
        $data=Purchaseindentitem::all()->where('status',3);
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('indent_id', function ($data) {
                return $data->indent_id;
            })

            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('purpose', function ($data) {
                return $data->purpose;
            })
            ->addColumn('item_code', function ($data) {
                return $data->item_code;
            })
            ->addColumn('item_description', function ($data) {
                return $data->item_description;
            })
            ->addColumn('ref_code', function ($data) {
                return $data->ref_code;
            })
            ->addColumn('stock', function ($data) {
                return $data->current_stock;
            })
            ->addColumn('qty', function ($data) {
                return $data->qty;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;<a title='View' class='btn btn-sm btn-warning' href='" . url('/material_receiving/show/'. $data->id) . "'><i class='fa fa-eye'></i></a>";
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function show($id){
        $show=Purchaseindentitem::with('receivings')->find($id);
        return view('materialreceivings.show',compact('show'));
    }
    public function create($id){
        return view('materialreceivings.create',compact('id'));
    }
    public function edit($id){
        $edit=Materialreceiving::find($id);
        return view('materialreceivings.edit',compact('edit'));
    }


    public function store(Request $request){

        $this->validate($request,[
            'purchase_type'=>'required',
            'received_from'=>'required',
            'unit'=>'required',
            'qty'=>'required',
            'physical_check'=>'required',
            'meet_specifications'=>'required',
        ]);

        $receiving=new Materialreceiving();
        $receiving->purchase_indent_item_id=$request->purchase_indent_id;
        $receiving->received_from=$request->received_from;
        $receiving->physical_check=$request->physical_check;
        $receiving->purchase_type=$request->purchase_type;
        $receiving->meet_specifications=$request->meet_specifications;
        $receiving->specifications=$request->specifications;
        $receiving->unit=$request->unit;
        $receiving->qty=$request->qty;
        $receiving->save();
        return redirect()->back()->with('success','Material Receiving added successfully');
    }
    public function update(Request $request){
        $this->validate($request,[
            'purchase_type'=>'required',
            'received_from'=>'required',
            'unit'=>'required',
            'qty'=>'required',
            'physical_check'=>'required',
            'meet_specifications'=>'required',
        ]);
        $receiving=Materialreceiving::find($request->id);
        $receiving->received_from=$request->received_from;
        $receiving->physical_check=$request->physical_check;
        $receiving->purchase_type=$request->purchase_type;
        $receiving->meet_specifications=$request->meet_specifications;
        $receiving->specifications=$request->specifications;
        $receiving->unit=$request->unit;
        $receiving->qty=$request->qty;
        $receiving->save();
        return redirect()->back()->with('success','Material Receiving updated successfully');
    }

    //
}
