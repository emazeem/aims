<?php

namespace App\Http\Controllers;

use App\Models\Clause;
use Illuminate\Http\Request;

class ClauseController extends Controller
{
    public function create($id){
        return view('clauses.create',compact('id'));
    }
    public function edit($id){
        $edit=Clause::find($id);
        return view('clauses.edit',compact('edit'));
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
        ]);
        $clause=new Clause();
        $clause->sop_id=$request->id;
        $clause->title=$request->title;
        $clause->description=$request->description;
        $clause->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
        ]);
        $clause=Clause::find($request->id);
        $clause->title=$request->title;
        $clause->description=$request->description;
        $clause->save();
        return redirect()->back()->with('success', 'Updated Successfully');
    }
    //
}
