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
            'assets'=>'required',
        ]);
        $suggestions=new Suggestion();
        $suggestions->capabilities=$request->capability;
        $assets=implode(',',$request->assets);
        $suggestions->assets=$assets;
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
