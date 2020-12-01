<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(){
        $this->authorize('staff-index');
        return view('users.index');
    }
    public function create(){
        $this->authorize('staff-create');
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
                return $data->id;
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
                $designation=Designation::find($data->designation);
                return $designation->name;
            })
            ->addColumn('department', function ($data) {
                return $data->departments->name;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                    <a title='Detail' class='btn btn-sm btn-primary' href='" . url('/users/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/users/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options'])
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

        $user->save();
        if (isset($request->cv)){
            $attachment=time().$request->cv->getClientOriginalName();
            Storage::disk('local')->put('/public/cv/'.$user->id.'/'.$attachment, File::get($request->cv));
            $user->cv=$attachment;
        }
        return redirect()->back()->with('success', 'Personnel Added Successfully');
    }
    public function update($id,Request $request){
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
        ]);

        $user=User::find($id);
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
        $user->save();
        return redirect()->back()->with('success', 'Personnel Updated Successfully');
    }
    public function fetchDesignation($id){
        $designation=Designation::where('department_id',$id)->pluck('id', 'name');

        return response()->json($designation);
    }
    public function setprofile(Request $request){
        $this->validate(request(), [
            'profile'=>'required',
        ]);
        $user=User::find(auth()->user()->id);
        $attachment=time().$request->profile->getClientOriginalName();
        Storage::disk('local')->put('/public/profile/'.auth()->user()->id.'/'.$attachment, File::get($request->profile));
        $user->profile=$attachment;
        $user->save();
        return redirect()->back()->with('success', 'Profile Updated Successfully');

    }
    public function profile(){
        return view('profile');
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
        return redirect()->back()->with('success', "Your password has been changed.");
    }


    //
}
