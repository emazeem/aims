<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Column;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ColumnController extends Controller
{
    public function index(){
        $assets=Asset::all();
        return view('column',compact('assets'));
    }
    public function fetch(){
        $data=Column::with('departments')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('column', function ($data) {
                return $data->column;
            })
            ->addColumn('assets', function ($data) {
                return $data->assets;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>
                  ";

            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
           'column'=>'required',
        ]);
        $column=new Column();
        $column->assets=implode(',',$request->assets);
        $column->column=$request->column;
        $column->save();
        return response()->json(['success'=>'Column added successfully']);
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate($request,[
           'column'=>'required',
        ]);
        $column=Column::find($request->id);
        $column->column=$request->column;
        $column->save();
        return response()->json(['success'=>'Column updated successfully']);
    }

    public function edit(Request $request){
        $column=Column::find($request->id);
        return response()->json($column);

    }
    //
}
