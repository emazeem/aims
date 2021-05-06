<?php

namespace App\Http\Controllers;

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
        return view('materialreceivings.show',compact('show'));
    }
    public function create($id){
        $item=Purchaseindentitem::find($id);
        return view('materialreceivings.create',compact('item'));
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
        $receiving->purchase_indent_item_id=$request->indent_item_id;
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
