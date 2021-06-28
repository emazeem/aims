<?php

namespace App\Http\Controllers;

use App\Models\QuotesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QuotesAttachmentsController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'type_of_attachment'=>'required',
            'attachment'=>'required',
        ]);
        $attachment = new QuotesAttachments();
        $attachment->quote_id=$request->id;
        $attachment->title=$request->type_of_attachment;
        $attach = time() . $request->attachment->getClientOriginalName();
        Storage::disk('local')->put('/public/quote-attachments/' . $attach, File::get($request->attachment));
        $attachment->attachment = $attach;
        $attachment->save();
        return response()->json(['success'=>'Attachment attached to this quote']);
    }
    public function delete(Request $request){
        $attach=QuotesAttachments::find($request->id);
        Storage::delete('public/quote-attachments/'.$attach->attachment);
        return response()->json(['success'=>'Attachment removed successfully']);
    }
    //
}
