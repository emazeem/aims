<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequisitionController extends Controller
{
    public function index(){
        return view('requisition.index');
    }
    public function prints($id){
        $show=Requisition::find($id);
        return view('requisition.print',compact('show'));
    }

    public function fetch(){
        $data=Requisition::all();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('reason', function ($data) {
                return $data->reason;
            })
            ->addColumn('designation', function ($data) {
                return $data->designation->name;
            })
            ->addColumn('qualification', function ($data) {
                return $data->qualification;
            })
            ->addColumn('time_frame', function ($data) {
                return $data->time_frame;
            })
            ->addColumn('hrd_review', function ($data) {
                return $data->hrd_review;
            })
            ->addColumn('remarks', function ($data) {
                return $data->remarks;
            })
            ->addColumn('options', function ($data) {
                return
                    "&emsp;<a title='Edit' class='btn btn-sm btn-success' href='" . url('/requisition/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                    <a title='Show' class='btn btn-sm btn-warning' href='" . url('/requisition/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
            })
            ->rawColumns(['options'])
            ->make(true);

    }


    public function create(){
        $designations=Designation::all();
        return view('requisition.create',compact('designations'));
    }
    public function edit($id){
        $edit=Requisition::find($id);
        $designations=Designation::all();
        return view('requisition.edit',compact('designations','edit'));
    }
    public function show($id){
        $show=Requisition::find($id);
        return view('requisition.show',compact('show'));
    }



    public function store(Request $request){
        $this->validate(request(), [
            'req_designations' => 'required',
            'reason' => 'required',
            'qualification' => 'required',
            'hrd_review' => 'required',
            'time_frame' => 'required',
            'remarks' => 'required',
        ]);
        $requistion=new Requisition();
        $requistion->requisition_designation=$request->req_designations;
        $requistion->reason=$request->reason;
        $requistion->qualification=$request->qualification;
        $requistion->special_skills=($request->special_skills)?$request->special_skills:null;
        $requistion->hrd_review=$request->hrd_review;
        $requistion->remarks=$request->remarks;
        $requistion->time_frame=$request->time_frame;
        $requistion->initiated_by=auth()->user()->id;
        $requistion->save();
        return  redirect()->back()->with('success', 'Requisition has added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'req_designations' => 'required',
            'reason' => 'required',
            'qualification' => 'required',
            'hrd_review' => 'required',
            'time_frame' => 'required',
            'remarks' => 'required',
        ]);
        $requistion=Requisition::find($request->id);
        $requistion->requisition_designation=$request->req_designations;
        $requistion->reason=$request->reason;
        $requistion->qualification=$request->qualification;
        $requistion->special_skills=($request->special_skills)?$request->special_skills:null;
        $requistion->hrd_review=$request->hrd_review;
        $requistion->remarks=$request->remarks;
        $requistion->time_frame=$request->time_frame;
        $requistion->initiated_by=auth()->user()->id;
        $requistion->save();
        return  redirect()->back()->with('success', 'Requisition has updated successfully.');
    }

    //
}
