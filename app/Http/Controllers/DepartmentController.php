<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(){
        $this->authorize('department-index');
        return view('department');
    }
    public function fetch(){
        $data=Department::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
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
        $this->authorize('department-create');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
        ]);
        $parameter=new Department();
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('department-edit');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
        ]);
        $parameter=Department::find($request->id);
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $this->authorize('department-edit');
        $edit=Department::find($request->id);
        return response()->json($edit);
    }
    //
}
