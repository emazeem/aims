<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ParameterAuthorizationController extends Controller
{
    public function store(Request $request){
        $this->authorize('add-staff-parameter-authorization');
        $this->validate($request,[
           'authorization_parameter'=>'required'
        ]);
        $user=User::find($request->user_id);
        $user->parameters()->attach($request->authorization_parameter);
        return response()->json(['success'=>'Authorization of '.$user->fname.' '.$user->lname,' is added successfully']);
    }
    public function delete(Request $request){
        $this->authorize('delete-staff-parameter-authorization');
        User::find($request->user_id)->parameters()->detach($request->id);
        return response()->json(['success'=>'Authorization parameter removed successfully']);
    }
    //
}
