<?php

namespace App\Http\Controllers;

use App\Models\Empcontract;
use App\Models\LeaveApplication;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class LeaveApplicationController extends Controller
{
    public function index(){
        $this->authorize('leave-application-index');
        return view('leave_application.index');
    }
    public function create(){
        $this->authorize('add-update-my-application');
        $employees=User::all();
        $natures=Preference::where('slug','nature-of-leave-applications')->first();
        $natures=Preference::with('child')->find($natures->id);
        return view('leave_application.create',compact('employees','natures'));
    }
    public function edit($id){
        $this->authorize('add-update-my-application');
        $edit=LeaveApplication::find($id);
        $employees=User::all();
        $natures=Preference::where('slug','nature-of-leave-applications')->first();
        $natures=Preference::with('child')->find($natures->id);
        return view('leave_application.edit',compact('employees','natures','edit'));

    }public function prints($id){
        $show=LeaveApplication::find($id);
        return view('leave_application.print',compact('show'));
    }
    public function show($id){
        $this->authorize('view-my-applications');
        $show=LeaveApplication::find($id);
        return view('leave_application.show',compact('show'));
    }
    public function store(Request $request){
        $this->authorize('add-update-my-application');
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
        $leave->user_id=$request->employee;
        $leave->from=$request->from;
        $leave->to=$request->to;
        $leave->nature_of_leave=$request->nature_of_leave;
        $leave->type_of_leave=$request->type_of_leave;
        $leave->type_time=$request->type_time?$request->type_time:null;
        $leave->reason=$request->reason;
        $leave->address_contact=$request->address_contact;
        $leave->head_id=$request->head_id;
        $leave->ceo_id=$request->ceo_id;
        $leave->save();;
        return response()->json(['success'=>'Leave Application applied successfully. You will be notified soon after action performed','id'=>$leave->id]);
    }
    public function update(Request $request){
        $this->authorize('add-update-my-application');
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
        $leave->user_id=$request->employee;
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
        return response()->json(['success'=>'Leave Application updated successfully.','id'=>$leave->id]);
    }

    public function fetch(Request $request){
        $this->authorize('leave-application-index');
        if ($request->filter=='my'){
            $data=LeaveApplication::where('user_id',auth()->user()->id)->get();
        }
        if ($request->filter=='all'){
            $data=LeaveApplication::all();
        }

        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->users->fname.' '.$data->users->lname;
            })
            ->addColumn('nature', function ($data) {
                $leave=Preference::where('slug',$data->nature_of_leave)->first();
                return $leave->name;
            })
            ->addColumn('type', function ($data) {
                return $data->type_of_leave==1?'Full Day':'Half Time';
            })
            ->addColumn('from-to', function ($data) {
                return $data->from->format('d-m-Y').' '.$data->to->format('d-m-Y');
            })
            ->addColumn('options', function ($data) {
                $action=null;
                if (Auth::user()->can('add-update-my-application')){
                    $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/leave-applications/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('view-my-applications')){
                    $action.="<a title='Show' class='btn btn-sm btn-warning' href='" . url('/leave-applications/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                }
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function head_approve($id){
        //0-Pending 1- 1st Apporval Reject 2- 1st Approval Approved 3- 2nd Approval Rejected 4- 2nd approval Approved
        $leave=LeaveApplication::find($id);
        $leave->status=2;
        $leave->head_recommendation_date=date('Y-m-d');
        $leave->save();
        return redirect()->back()->with('success','Leave Application Approved By Head of Department');
    }
    public function head_reject($id){
        //0-Pending 1- 1st Apporval Reject 2- 1st Approval Approved 3- 2nd Approval Rejected 4- 2nd approval Approved
        $leave=LeaveApplication::find($id);
        $leave->status=1;
        $leave->head_recommendation_date=date('Y-m-d');
        $leave->save();
        return redirect()->back()->with('success','Leave Application Rejected By Head of Department');
    }

    //
}
