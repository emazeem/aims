<?php

namespace App\Http\Controllers;

use  App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class DesignationController extends Controller
{
    public function index(){
        $this->authorize('designation-index');
        $departments=Department::all();
        return view('designation',compact('departments'));
    }
    public function fetch(){
        $this->authorize('designation-index');
        $data=Designation::with('departments')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('department_id', function ($data) {
                return $data->departments->name;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })

            ->addColumn('createdat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->created_at));
            })
            ->addColumn('updatedat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->updated_at));
            })
            ->addColumn('options', function ($data) {
                if (Auth::user()->can('designation-edit')){
                    $action="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='feather icon-edit'></i></button>";
                }
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        $this->authorize('designation-create');
        $this->validate(request(), [
            'name' => 'required',
            'department' => 'required',
        ],[
            'name.required' => 'Designation name field is required *',
            'department.required' => 'Department field is required *',
        ]);
        $parameter=new Designation();
        $parameter->department_id=$request->department;
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('designation-edit');
        $this->validate(request(), [
            'name' => 'required',
            'department' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
            'department.required' => 'Department field is required *',
        ]);
        $parameter=Designation::find($request->id);
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $this->authorize('designation-edit');
        $edit=Designation::find($request->id);
        return response()->json($edit);
    }
    //
    //
}
