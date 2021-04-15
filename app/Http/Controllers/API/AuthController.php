<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use phpseclib3\Crypt\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

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

        $accessToken=$user->createToken('authToken')->accessToken;
        return response(['user'=>$user,'token'=>$accessToken]);
    }

    public function login(Request $request){
        $loginData=$request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (!auth()->attempt($loginData)){
            return response(['message'=>'Invalid Credentials']);
        }
        $accessToken=auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=>auth()->user(),'token'=>$accessToken]);
    }
    //
}
