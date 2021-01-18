<?php

namespace App\Http\Controllers;

use App\Models\Empcontract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmpjoiningController extends Controller
{
    public function index(){
        return view('emp_joining.index');
    }
    public function create(){
        $employees=Empcontract::all();
        return view('emp_joining.create',compact('employees'));
    }

    public function edit($id){
        $edit=Empcontract::find($id);
        $employees=Empcontract::all();
        return view('emp_joining.edit',compact('employees','edit'));
    }
    public function show($id){
        $show=Empcontract::find($id);
        return view('emp_joining.show',compact('show'));
    }
    public function prints($id){
        $show=Empcontract::find($id);
        return view('emp_joining.print',compact('show'));
    }

    public function fetch(){
        $data=Empcontract::all()->where('status',1);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->appraisal->fname.' '.$data->appraisal->lname;
            })
            ->addColumn('designation', function ($data) {
                return $data->designation->name;
            })
            ->addColumn('signature', function ($data) {
                return "<img src=".Storage::disk('local')->url('public/emp_joining_signature/'.$data->signature)." width='100'>";
            })
            ->addColumn('options', function ($data) {
                $action=null;
                return "&emsp;                                
                <a title='Edit' class='btn btn-sm btn-success' href='" . url('/emp_joining/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                <a title='Show' class='btn btn-sm btn-warning' href='" . url('/emp_joining/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                ";
            })
            ->rawColumns(['options','signature'])
            ->make(true);
    }

    public function store(Request $request){
        $this->validate(request(), [
            'employee' => 'required',
            'joining' => 'required',
            'signature' => 'required',
        ]);
        $empjoining=Empcontract::find($request->employee);
        $empjoining->joining=$request->joining;
        $attachment=time().'-'.$request->signature->getClientOriginalName();
        Storage::disk('local')->put('/public/emp_joining_signature/'.$attachment, File::get($request->signature));
        $empjoining->signature=$attachment;
        $empjoining->hr_user_id=auth()->user()->id;
        $empjoining->status=1;
        $empjoining->save();
        return redirect()->back()->with('success','Employee Joining Details added successfully');
    }

    //
}
