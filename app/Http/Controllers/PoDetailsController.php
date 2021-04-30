<?php

namespace App\Http\Controllers;

use App\Models\PoDetails;
use Illuminate\Http\Request;

class PoDetailsController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate(request(), [
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);
        $exist=PoDetails::where('po_id',$request->id)->where('indent_item_id',$request->indentitem_id)->first();
        if ($exist){
            $items=PoDetails::find($exist->id);
        }else{
            $items=new PoDetails();
        }
        $items->po_id=$request->id;
        $items->indent_item_id=$request->indentitem_id;
        $items->description=$request->description;
        $items->qty=$request->qty;
        $items->price=$request->price;
        $items->save();
        return redirect()->back()->with('success', 'Item added successfully');
    }
}
