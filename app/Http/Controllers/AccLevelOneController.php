<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccLevelOneController extends Controller
{
    public function index(){
        return view('acc_level_one.index');
    }
    public function fetch(){
        $data=AccLevelOne::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('code', function ($data) {
                return $data->code1;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;<a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_one/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function create(){
        return view('acc_level_one.create');
    }
    public function edit($id){
        $level=1;
        $edit=AccLevelOne::find($id);
        return view('acc_level_four.edit',compact('edit','level'));
    }
    public function store(Request $request){
        $this->validate(request(), [
            'title' => 'required',
        ],[
            'title.required' => 'Title is required.',
        ]);
        $acc=new AccLevelOne();
        $acc->title=$request->title;
        $acc->save();
        $reserved=AccLevelOne::get()->count();
        $acc->code1=str_pad($reserved, 1, '0', STR_PAD_LEFT);
        $acc->save();
        return  redirect()->back()->with('success', 'Level 1 has added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'title' => 'required',
        ],[
            'title.required' => 'Title is required.',
        ]);
        $acc=AccLevelOne::find($request->id);
        $acc->title=$request->title;
        $acc->save();
        return  redirect()->back()->with('success', 'Level 1 has updated successfully.');
    }
    //
}