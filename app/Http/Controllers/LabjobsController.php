<?php

namespace App\Http\Controllers;

use App\Models\Labjob;
use Illuminate\Http\Request;

class LabjobsController extends Controller
{
    public function index($id){
        $jobs=Labjob::with('items')->where('job_id',$id)->get();
        return view('scheduling.labjob',compact('jobs'));
    }
    //
}
