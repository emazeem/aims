<?php

namespace App\Http\Controllers;

use App\Models\PoDetails;
use App\Models\Purchaseindentitem;
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
        $item=Purchaseindentitem::find($request->indentitem_id);
        $item->description=$request->description;
        $item->qty=$request->qty;
        $item->price=$request->price;
        $item->save();
        return redirect()->back()->with('success', 'Item added successfully');
    }
}
