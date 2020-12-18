<?php

namespace App\Http\Controllers;

use App\Models\Purchaseindentitem;
use Illuminate\Http\Request;

class PurchaseindentitemController extends Controller
{
    public function create($id){
        return view('purchaseindentitems.create',compact('id'));
    }
    public function edit($id){
        $edit=Purchaseindentitem::find($id);
        return view('purchaseindentitems.edit',compact('edit'));
    }
    public function store(Request $request){
        $this->validate(request(),[
            'title' => 'required',
            'purpose' => 'required',
            'item_code' => 'required',
            'description' => 'required',
            'ref_code' => 'required',
            'unit' => 'required',
            'consumption' => 'required',
            'stock' => 'required',
            'qty' => 'required',
        ]);
        $item=new Purchaseindentitem();
        $item->indent_id=$request->id;
        $item->item_code=$request->item_code;
        $item->item_description=$request->description;
        $item->ref_code=$request->ref_code;
        $item->unit=$request->unit;
        $item->last_six_months_consumption=$request->consumption;
        $item->current_stock=$request->stock;
        $item->qty=$request->qty;
        $item->purpose=$request->purpose;
        $item->title=$request->title;
        $item->save();
        return redirect()->back()->with('success','Purchase indent item added successfully');
    }
    public function update(Request $request){
        $this->validate(request(),[
            'title' => 'required',
            'purpose' => 'required',
            'item_code' => 'required',
            'description' => 'required',
            'ref_code' => 'required',
            'unit' => 'required',
            'consumption' => 'required',
            'stock' => 'required',
            'qty' => 'required',
        ]);
        $item=Purchaseindentitem::find($request->id);
        $item->item_code=$request->item_code;
        $item->item_description=$request->description;
        $item->ref_code=$request->ref_code;
        $item->unit=$request->unit;
        $item->last_six_months_consumption=$request->consumption;
        $item->current_stock=$request->stock;
        $item->qty=$request->qty;
        $item->purpose=$request->purpose;
        $item->title=$request->title;
        $item->save();
        return redirect()->back()->with('success','Purchase indent item updated successfully');
    }
    public function revision_accept($id){
        $approve=Purchaseindentitem::find($id);
        $approve->status=2;
        $approve->save();
        return redirect()->back()->with('success','Approved Successfully');
    }
    public function revision_reject($id){
        $approve=Purchaseindentitem::find($id);
        $approve->status=1;
        $approve->save();
        return redirect()->back()->with('success','Rejected Successfully');
    }
    public function approval_accept($id){
        $approve=Purchaseindentitem::find($id);
        $approve->status=3;
        $approve->save();
        return redirect()->back()->with('success','Approved Successfully');
    }
    public function approval_reject($id){
        $approve=Purchaseindentitem::find($id);
        $approve->status=4;
        $approve->save();
        return redirect()->back()->with('success','Rejected Successfully');
    }



}