<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $user=new User();
        $user->user_type=0;
        $user->user_type=0;
        $user->father_name='null';
        $user->phone='null';
        $user->dob=date('Y-m-d');
        $user->joining=date('Y-m-d');
        $user->cnic=00000;
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->email=$request->email;
        $user->password=Hash::make($request->get('password'));
        $user->address='address';
        $user->designation=0;
        $user->department=0;
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
