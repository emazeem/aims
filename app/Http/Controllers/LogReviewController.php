<?php

namespace App\Http\Controllers;

use App\Models\LogReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class LogReviewController extends Controller
{

    public function index(){
        $this->authorize('designation-index');
        return view('logreview');
    }
    public function fetch(){
        $data=LogReview::with('departments')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->addColumn('priority', function ($data) {
                return $data->priority;
            })
            ->addColumn('status', function ($data) {
                return $data->status;
            })
            ->addColumn('created_by', function ($data) {
                return $data->created_by;
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
}
