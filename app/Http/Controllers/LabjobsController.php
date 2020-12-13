<?php

namespace App\Http\Controllers;

use App\Models\Jobitem;
use App\Models\Labjob;
use Illuminate\Http\Request;

class LabjobsController extends Controller
{
    public function index($id){
        $jobs=Jobitem::with('items')->where('job_id',$id)->where('type',0)->get();
        return view('scheduling.labjob',compact('jobs'));
    }
    //
}
