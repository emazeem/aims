<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Jobitem;
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
    public function for_lab_job($task){
        $data['assets']=Asset::all();
        $item=Jobitem::find($task);
        $suggestions=Suggestion::where('capabilities',$item->item->capability)->get();
        $sug_id=[];
        foreach ($suggestions as $suggestion) {
            $temp=explode(',',$suggestion->assets);
            $sug_id[]=$temp[0];
        }
        $data['suggestions']=$sug_id;
        //dd($data);
        return response()->json($data);
    }
    //
}