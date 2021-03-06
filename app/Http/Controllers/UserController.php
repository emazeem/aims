<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Parameter;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(){
        $this->authorize('staff-index');
        //$columns = Schema::getColumnListing('users');
        $parameters=Parameter::all();
        return view('users.index',compact('parameters'));
    }
    public function attendances(){
        $this->authorize('staff-index');
        $year=date('Y',time());
        $month=date('m',time());
        $dates=array();
        for ($date=0;$date<=31;$date++){
            if (checkdate($month,$date,$year)==true){
                $dates[]=array($date,date_format(date_create($year.'-'.$month.'-'.$date),"D"));
            }
        }
        $all=Attendance::all();
        $monthCurrentIDs=[];
        foreach ($all as $attendance){
            if (date('m',time())==date('m',strtotime($attendance->check_in_date))){
                $monthCurrentIDs[]=$attendance->id;
            }
        }
        $attendances=Attendance::whereIn('id',$monthCurrentIDs)->get();
        $users = Attendance::select('user_id')->distinct()->get();
        //dd($users);
        return view('users.attendances',compact('dates','users','attendances','attendances'));
    }

    public function create(){
        //$this->authorize('staff-create');
        $roles=Role::all();
        $departments=Department::all();
        return view('users.create',compact('departments','roles'));
    }
    public function edit($id){
        $this->authorize('staff-edit');
        $roles=Role::all();
        $edit=User::find($id);
        $departments=Department::all();

        return view('users.edit',compact('edit','departments','roles'));
    }
    public function show($id){
        $this->authorize('staff-view');
        $show=User::find($id);
        return view('users.show',compact('show'));
    }

    public function fetch(Request $request){
        $data=User::with('departments')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->cid;
            })
            ->addColumn('name', function ($data) {
                return $data->fname." ".$data->lname;
            })
            ->addColumn('email', function ($data) {
                return $data->email;
            })
            ->addColumn('phone', function ($data) {
                return $data->phone;
            })
            ->addColumn('designation', function ($data) {
                return $data->designations->name;
            })
            ->addColumn('department', function ($data) {
                return $data->departments->name;
            })
            ->addColumn('options', function ($data) {

                $action=null;
                if (Auth::user()->can('staff-view')){
                    $action.="<a title='Detail' class='btn btn-sm btn-primary' href='" . url('/users/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                }
                if (Auth::user()->can('staff-edit')){
                    $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/users/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('add-staff-parameter-authorization')){
                    $action.= '<button data-id="'.$data->id.'" class="btn btn-sm btn-dark add_authorization_btn" data-id="'.$data->id.'"><i class="feather icon-plus-circle"></i> Authorization</button>';
                }
                return $action;
            })
            ->rawColumns(['options','auth_parameters'])
            ->make(true);

    }
    public function store(Request $request){

        $this->authorize('staff-create');
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'fathername' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cnic' => 'required',
            'address' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'dob' => 'required',
            'joining' => 'required',
            'roles' => 'required',
        ],[
            'fname.required' => 'First Name field is required *',
            'lname.required' => 'Last Name field is required *',
            'fathername.required' => 'Father Name field is required *',
            'email.required' => 'Email field is required *',
            'phone.required' => 'Phone field is required *',
            'cnic.required' => 'CNIC field is required *',
            'address.required' => 'Address field is required *',
            'designation.required' => 'Designation field is required *',
            'department.required' => 'Department field is required *',
            'joining.required' => 'Joining field is required *',
            'roles.required' => 'Roles field is required *',
        ]);

        $user=new User();
        $user->user_type=0;
        $user->user_type=$request->roles;
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->father_name=$request->fathername;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->dob=$request->dob;
        $user->joining=$request->joining;
        $user->cnic=$request->cnic;
        $user->password=Hash::make($request->get('password'));
        $user->address=$request->address;
        $user->designation=$request->designation;
        $user->department=$request->department;
        $user->cid='E-000';
        $user->save();
        $user->cid='E-'.str_pad($user->id, 3, '0', STR_PAD_LEFT);
        $user->save();

        $activity = Activity::all()->last();
        $activity->description;
        if (isset($request->cv)){
            $user=User::find($user->id);
            $attachment=time().'-'.$request->cv->getClientOriginalName();
            Storage::disk('local')->put('/public/cv/'.$user->id.'/'.$attachment, File::get($request->cv));
            $user->cv=$attachment;
            $user->save();
        }
        if (isset($request->signature)){
            $user=User::find($user->id);
            $attachment=time().'-'.$request->signature->getClientOriginalName();
            Storage::disk('local')->put('/public/signature/'.$user->id.'/'.$attachment, File::get($request->signature));
            $user->signature=$attachment;
            $user->save();
        }
        return response()->json(['success'=>'Personnel Updated Successfully','id'=>$user->id]);
    }
    public function update(Request $request){
        $this->authorize('staff-edit');
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'fathername' => 'required',
            'email' => 'required',
            'phone' => 'required',
            //'password' => 'required',
            'cnic' => 'required',
            'address' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'dob' => 'required',
            'joining' => 'required',
            'roles' => 'required',
            'cid' => 'required|unique:users,cid,'.$request->id,
        ],[
            'fname.required' => 'First Name field is required *',
            'lname.required' => 'Last Name field is required *',
            'fathername.required' => 'Father Name field is required *',
            'email.required' => 'Email field is required *',
            //'password.required' => 'Password field is required *',
            'phone.required' => 'Phone field is required *',
            'cnic.required' => 'CNIC field is required *',
            'address.required' => 'Address field is required *',
            'designation.required' => 'Designation field is required *',
            'department.required' => 'Department field is required *',
            'joining.required' => 'Joining field is required *',
            'roles.required' => 'Roles field is required *',
            'cid.required' => 'Employee ID field is required *',
        ]);

        $user=User::find($request->id);
        $user->user_type=0;
        $user->user_type=$request->roles;
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->father_name=$request->fathername;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->dob=$request->dob;
        $user->joining=$request->joining;
        $user->cnic=$request->cnic;
        if ($request->password){
            $user->password=Hash::make($request->get('password'));
        }
        $user->address=$request->address;
        $user->designation=$request->designation;
        $user->department=$request->department;
        $user->cid=$request->cid;
        $user->save();
        if (isset($request->cv)){
            $user=User::find($user->id);
            $attachment=time().'-'.$request->cv->getClientOriginalName();
            Storage::disk('local')->put('/public/cv/'.$user->id.'/'.$attachment, File::get($request->cv));
            $user->cv=$attachment;
            $user->save();
        }
        if (isset($request->signature)){
            $user=User::find($user->id);
            $attachment=time().'-'.$request->signature->getClientOriginalName();
            Storage::disk('local')->put('/public/signature/'.$user->id.'/'.$attachment, File::get($request->signature));
            $user->signature=$attachment;
            $user->save();
        }


         Activity::all()->last();
        //$lastLoggedActivity->description;

        return response()->json(['success'=>'Personnel Updated Successfully','id'=>$user->id]);
    }
    public function fetchDesignation($id){
        $designation=Designation::where('department_id',$id)->pluck('id', 'name');

        return response()->json($designation);
    }
    public function setprofile(Request $request){

        //dd($request->profile->extension());
        $this->validate(request(), [
            'profile'=>'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        $user=User::find(auth()->user()->id);
        $attachment=time().'.png';
        Storage::disk('local')->put('/public/profile/'.auth()->user()->id.'/'.$attachment, File::get($request->profile));
        $user->profile=$attachment;
        $user->save();
        $activity = Activity::all()->last();
        $activity->description;
        return response()->json(['success'=> 'Profile Updated Successfully']);
    }
    public function profile(){
        $attendances=Attendance::where('user_id',auth()->user()->id)->get();
        //dd($attendances);
        return view('profile',compact('attendances'));
    }
    public function changepw(){
        return view('changepassword');
    }
    public function changepassword(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'oldpassword'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required',
        ],[
            'oldpassword.required'=>'Please enter your current password',
            'password.required'=>'Enter new password with min of length 6',
        ]);
        $user = User::find(auth()->user()->id);
        //Check The Current Password Matched
        if (!Hash::check($request->get('oldpassword'), $user->password)) {
            return redirect()->back()->with('error', "Current Password not matched.");
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $activity = Activity::all()->last();
        $activity->description;
        return redirect()->back()->with('success', "Your password has been changed.");
    }
    public function list_of_employees(){
        $users=User::orderBy('cid','ASC')->get();
        return view('users.listofemployees',compact('users'));
    }
    //
}
