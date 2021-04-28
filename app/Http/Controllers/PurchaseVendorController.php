<?php

namespace App\Http\Controllers;

use App\Models\Purchaseindent;
use App\Models\PurchaseVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PurchaseVendorController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'vendor'=>'required',
            'quotation'=>'required',
            'quotation_ref'=>'required',
        ]);
        $purch_vendor=new PurchaseVendor();
        $purch_vendor->purchase_indent_id=$request->id;
        $purch_vendor->quotation_ref=$request->quotation_ref;
        $purch_vendor->vendor=$request->vendor;
        $attachment = time() . $request->quotation->getClientOriginalName();
        Storage::disk('local')->put('/public/purchase-quotation/' . $attachment, File::get($request->quotation));
        $purch_vendor->quotation = $attachment;
        $purch_vendor->save();
        return redirect()->back()->with('success','Purchase vendor selected successfully');
    }
    public function send_to_tm(Request $request){

        $purchase=Purchaseindent::with('indent_vendors')->find($request->id);
        if (count($purchase->indent_vendors)==0){
            return response()->json(['success'=>'Please add vendors.']);
        }

        $purchase->status=1;
        $purchase->save();
        return response()->json(['success'=>'Purchase indent successfully sent to TM ']);
    }
    public function prioritized(Request $request){

        $purchase=Purchaseindent::with('indent_vendors')->find($request->id);
        foreach ($purchase->indent_vendors as $vendor){
            if ($vendor->priority==0){
                return response()->json(['success'=>'Please prioritize again.']);
            }
        }
        $purchase->status=2;
        $purchase->save();
        return response()->json(['success'=>'Technical wetting of quotation is completed']);
    }

    public function set_priority(Request $request){
        $this->validate($request,[
            'priority.*'=>'required',
        ]);
        foreach ($request->priority as $k=>$item){
            $pv=PurchaseVendor::find($request->id[$k]);
            $pv->priority=$item;
            $pv->save();
        }
        return redirect()->back()->with('success','All Priorities have been set');
    }
    public function selected_vendor(Request $request){
        $this->validate($request,[
            'selected-vendor'=>'required',
        ]);

        $indent=Purchaseindent::find($request->id);
        $indent->selected_vendor=$request->input('selected-vendor');
        $indent->status=3;
        $indent->save();
        return redirect()->back()->with('success','Vendor has been finalized for quote');
    }


    //
}
