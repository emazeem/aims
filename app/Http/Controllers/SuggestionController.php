<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function create(Request $request){
        $this->validate($request,[
            'parameter'=>'required',
            'optassets'=>'required',
        ]);
        $suggestions=new Suggestion();
        $suggestions->capabilities=$request->capability;
        $suggestions->parameter=$request->parameter;
        $optassets=implode(',',$request->optassets);
        $suggestions->optional_assets=$optassets;
        $suggestions->save();
        return redirect()->back()->with('success','Suggestion added successfully');
    }
    public function destroy(Request $request){
        Suggestion::find($request->id)->delete();
        return response()->json(['success'=>'Suggestion deleted successfully']);

    }
    //
}
