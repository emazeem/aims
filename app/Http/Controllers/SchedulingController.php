<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Quotes;
use App\Models\Sitejob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SchedulingController extends Controller
{
    public function show($id){
        $jobs=Jobitem::with('items')->where('job_id',$id)->where('type',0)->get();
        return view('scheduling.lab_items',compact('jobs'));
    }

    //
}
