<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function store(Request $request){
        //$this->authorize('designation-edit');
        $this->validate(request(), [
            'title' => 'required',
        ],[
            'title.required' => 'Department name field is required *',
        ]);
        $cc=new CostCenter();
        $cc->parent_id=$request->parent;
        $cc->title=$request->title;
        $cc->save();

        return response()->json(['success'=>'Added successfully']);
    }
    public function show($id){
        $cc=CostCenter::where('parent_id',$id)->get();
        return response()->json($cc);
    }
    public function destroy(Request $request){
        CostCenter::find($request->id)->delete();
        return response()->json(['success'=>'Cost Center Deleted Successfully']);
    }
    //
}
