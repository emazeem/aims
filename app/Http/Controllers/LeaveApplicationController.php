<?php

namespace App\Http\Controllers;

use App\Models\Empcontract;
use App\Models\LeaveApplication;
use App\Models\Preference;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeaveApplicationController extends Controller
{
    public function index(){
        return view('leave_application.index');
    }

    public function create(){
        $employees=Empcontract::all()->where('status',2);
        $natures=Preference::where('category',14)->get();
        return view('leave_application.create',compact('employees','natures'));
    }
    public function edit($id){
        $edit=LeaveApplication::find($id);
        $employees=Empcontract::all()->where('status',2);
        $natures=Preference::where('category',14)->get();
        return view('leave_application.edit',compact('employees','natures','edit'));

    }public function prints($id){
        $show=LeaveApplication::find($id);
        return view('leave_application.print',compact('show'));
    }
    public function show($id){
        $show=LeaveApplication::find($id);
        return view('leave_application.show',compact('show'));
    }


    public function store(Request $request){
        $this->validate(request(), [
            'employee' => 'required',
            'from' => 'required',
            'to' => 'required',
            'nature_of_leave' => 'required',
            'type_of_leave' => 'required',
            'reason' => 'required',
            'address_contact' => 'required',
        ]);
        if ($request->type_of_leave==1){
            $this->validate(request(), [
                'type_time' => 'required',
            ]);
        }

        $leave=new LeaveApplication();
        $leave->appraisal_id=$request->employee;
        $leave->from=$request->from;
        $leave->to=$request->to;
        $leave->nature_of_leave=$request->nature_of_leave;
        $leave->type_of_leave=$request->type_of_leave;
        $leave->type_time=$request->type_time?$request->type_time:null;
        $leave->reason=$request->reason;
        $leave->address_contact=$request->address_contact;
        $leave->head_id=1;
        $leave->ceo_id=1;
        $leave->save();
        return redirect()->back()->with('success','Leave Application applied successfully. You will be notified soon after action performed');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'employee' => 'required',
            'from' => 'required',
            'to' => 'required',
            'nature_of_leave' => 'required',
            'type_of_leave' => 'required',
            'reason' => 'required',
            'address_contact' => 'required',
        ]);
        if ($request->type_of_leave==1){
            $this->validate(request(), [
                'type_time' => 'required',
            ]);
        }

        $leave=LeaveApplication::find($request->id);
        $leave->appraisal_id=$request->employee;
        $leave->from=$request->from;
        $leave->to=$request->to;
        $leave->nature_of_leave=$request->nature_of_leave;
        $leave->type_of_leave=$request->type_of_leave;
        $leave->type_time=$request->type_time?$request->type_time:null;
        $leave->reason=$request->reason;
        $leave->address_contact=$request->address_contact;
        $leave->head_id=1;
        $leave->ceo_id=1;
        $leave->save();
        return redirect()->back()->with('success','Leave Application updated successfully.');
    }

    public function fetch(){
        $data=LeaveApplication::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->appraisal->fname.' '.$data->appraisal->lname;
            })
            ->addColumn('nature', function ($data) {
                $leave=Preference::where('slug',$data->nature_of_leave)->first();
                return $leave->name;
            })
            ->addColumn('type', function ($data) {
                return $data->type_of_leave==1?'Full Day':'Half Time';
            })
            ->addColumn('from', function ($data) {
                return $data->from->format('d/m/Y');
            })
            ->addColumn('to', function ($data) {
                return $data->to->format('d/m/Y');
            })
            ->addColumn('options', function ($data) {
                $action=null;
                return "&emsp;                                
                <a title='Edit' class='btn btn-sm btn-success' href='" . url('/leave-application/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                <a title='Show' class='btn btn-sm btn-warning' href='" . url('/leave-application/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function head_approve($id){
        $leave=LeaveApplication::find($id);
        $leave->head_recommendation_status=1;
        $leave->head_recommendation_date=date('Y-m-d');
        $leave->save();
        return redirect()->back()->with('success','Leave Application Approved By Head of Department');
    }
    //
}
