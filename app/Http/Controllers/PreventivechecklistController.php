<?php

namespace App\Http\Controllers;

use App\Models\Preventivechecklist;
use Illuminate\Http\Request;

class PreventivechecklistController extends Controller
{
    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'tasktodo' => 'required',
        ],[
            'tasktodo.required' => 'Task to do field is required *',
        ]);
        $checklist=new Preventivechecklist();
        $checklist->group_id=$request->group_id;
        $checklist->tasktodo=$request->tasktodo;
        $checklist->save();
        return response()->json(['success'=>'Added successfully']);
    }
      public function update(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'tasktodo' => 'required',
        ],[
            'tasktodo.required' => 'Task to do field is required *',
        ]);
        $checklist=Preventivechecklist::find($request->id);
        $checklist->tasktodo=$request->tasktodo;
        $checklist->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $edit=Preventivechecklist::find($request->id);
        return response()->json($edit);
    }
}
