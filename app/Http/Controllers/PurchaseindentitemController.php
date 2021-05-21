<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
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
            'category' => 'required',
            'item_type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'item_code' => 'required',
            'model' => 'required',
            'purpose' => 'required',
            'ref_doc' => 'required',
            'unit' => 'required',
            'consumption' => 'required',
            'qty' => 'required',
        ]);
        $item=new Purchaseindentitem();
        $item->category_id=InventoryCategory::find($request->category)->parent_id;
        $item->subcategory_id=$request->category;
        $item->indent_id=$request->id;
        $item->item_type=$request->item_type;
        $item->title=$request->title;
        $item->description=$request->description;
        $item->code=$request->item_code;
        $item->model=$request->model;
        $item->purpose=$request->purpose;
        $item->ref_doc=$request->ref_doc;
        $item->unit=$request->unit;
        $item->consumption_6months=$request->consumption;
        $item->qty=$request->qty;
        $item->save();
        return redirect()->back()->with('success','Purchase indent item added successfully');
    }
    public function update(Request $request){
        $this->validate(request(),[
            'category' => 'required',
            'item_type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'item_code' => 'required',
            'model' => 'required',
            'purpose' => 'required',
            'ref_doc' => 'required',
            'unit' => 'required',
            'consumption' => 'required',
            'qty' => 'required',
        ]);
        $item=Purchaseindentitem::find($request->id);
        $item->category_id=InventoryCategory::find($request->category)->parent_id;
        $item->subcategory_id=$request->category;
        $item->indent_id=$request->id;
        $item->item_type=$request->item_type;
        $item->title=$request->title;
        $item->description=$request->description;
        $item->code=$request->item_code;
        $item->model=$request->model;
        $item->purpose=$request->purpose;
        $item->ref_doc=$request->ref_doc;
        $item->unit=$request->unit;
        $item->consumption_6months=$request->consumption;
        $item->qty=$request->qty;
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
        $approve->status=1;
        $approve->save();
        return redirect()->back()->with('success','Rejected Successfully');
    }



}