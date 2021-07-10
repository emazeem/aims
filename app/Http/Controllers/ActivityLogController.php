<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function index(){
        return view('activitylog.index');
    }
    public function fetch(Request $request)
    {
        $page=$request->page*10;
        $obslete=[];
        $activities=Activity::latest()->get();
        foreach ($activities as $k=>$activity){
            $obslete[]=$activity->id;
            if ($k==($page-1)){
                break;
            }
        }
        $activities=Activity::latest()->whereNotIn('id',$obslete)->limit(10)->get();

        foreach ($activities as $activity) {
            $activity['subject_type']=str_replace('App\Models','',$activity['subject_type']);
            $activity['created']=$activity['created_at']->diffForHumans();
            $activity['causer_id']=$activity->causers->fname.' '.$activity->causers->lname;
            foreach ($activity['properties'] as $k=>$property){
                if ($k=='attributes'){
                    $activity['new']=$property;
                }
                if ($k=='old'){

                    $activity['old']=$property;
                }
            }
            if ($activity->causers->profile){
                $activity['profile_path']=Storage::disk('local')->url('profile/'.$activity->causers->id.'/'.$activity->causers->profile);
            }else{
                $activity['profile_path']=url('img/profile.png');
            }
        }
        return response()->json($activities);
    }
}
