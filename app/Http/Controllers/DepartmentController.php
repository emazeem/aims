<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(){
        $this->authorize('department-index');
        $users=User::all();
        return view('department',compact('users'));
    }
    public function fetch(){
        $this->authorize('department-index');
        $data=Department::with('heads')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('head', function ($data) {
                return $data->heads->fname.' '.$data->heads->lname;
            })
            ->addColumn('options', function ($data) {
                if (Auth::user()->can('department-edit')){
                    $action="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='feather icon-edit'></i></button>";
                }
                return $action;

            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        $this->authorize('department-create');
        $this->validate(request(), [
            'name' => 'required',
            'head' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
            'head.required' => 'Department head field is required *',
        ]);
        $parameter=new Department();
        $parameter->name=$request->name;
        $parameter->head=$request->head;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('department-edit');
        $this->validate(request(), [
            'name' => 'required',
            'head' => 'required',
        ],[
            'name.required' => 'Department name field is required *',
            'head.required' => 'Department head field is required *',
        ]);
        $parameter=Department::find($request->id);
        $parameter->name=$request->name;
        $parameter->head=$request->head;
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
