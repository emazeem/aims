<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function create(Request $request){
        $this->authorize('add-suggestions');
        $this->validate($request,[
            'parameter'=>'required',
            'asset'=>'required',
            'optassets'=>'required',
        ]);
        $suggestions=new Suggestion();
        $suggestions->capabilities=$request->capability;
        $suggestions->asset=$request->asset;
        $optassets=implode(',',$request->optassets);
        $suggestions->optional_assets=$optassets;
        $suggestions->save();
        return response()->json(['success'=>'Suggestion added successfully']);
    }
    public function destroy(Request $request){
        $this->authorize('delete-suggestions');
        Suggestion::find($request->id)->delete();
        return response()->json(['success'=>'Suggestion deleted successfully']);

    }
    //
}
