<?php

namespace App\Http\Controllers;

use App\Models\Clause;
use App\Models\Sops;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SopsController extends Controller
{

    public function index(){
        $this->authorize('sop-index');
        return view('sop.index');
    }
    public function fetch(){
        $data=Sops::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<a title='Edit' class='btn btn-sm btn-dark' href='".url('/sop/view/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        //$this->authorize('department-create');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Sop name field is required *',
        ]);
        $parameter=new Sops();
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        //$this->authorize('department-edit');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'SOP name field is required *',
        ]);
        $parameter=Sops::find($request->id);
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        //$this->authorize('department-edit');
        $edit=Sops::find($request->id);
        return response()->json($edit);
    }
    public function show($id){
        $show=Sops::find($id);
        $clauses=Clause::where('sop_id',$id)->get();
        return view('sop.show',compact('show','clauses'));
    }

    //
}
