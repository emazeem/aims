<?php

namespace App\Http\Controllers;

use App\Models\BusinessLine;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BusinessLineController extends Controller
{
    public function index(){
        $this->authorize('business-lines');
        return view('business_line');
    }
    public function fetch(){
        $data=BusinessLine::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->title;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>
                  ";

            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
        ]);
        $parameter=new BusinessLine();
        $parameter->title=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        //$this->authorize('department-edit');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
        ]);
        $parameter=BusinessLine::find($request->id);
        $parameter->title=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $this->authorize('department-edit');
        $edit=BusinessLine::find($request->id);
        return response()->json($edit);
    }
    //
}
