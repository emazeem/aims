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
    public function show(){





        $activities = Activity::orderBy('id','DESC')->get();

        return view('activitylog.show',compact('activities'));
    }


    /*public function show()
    {
        return view('activitylog.show');
    }*/
    public function show_fetch(Request $request)
    {
        $activities=Activity::where('id', '>=', ($request->page-1)*10)->limit(10)->get();
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
            $activity['profile_path']=Storage::disk('local')->url('profile/'.$activity->causers->id.'/'.$activity->causers->profile);
        }
        return response()->json($activities);
    }

    public function fetch(){
        $data=Activity::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->addColumn('subject_id', function ($data) {
                return $data->subject_id;
            })
            ->addColumn('subject_type', function ($data) {
                return $data->subject_type;
            })
            ->addColumn('causer_id', function ($data) {
                return User::find($data->causer_id)->fname.' '.User::find($data->causer_id)->lname;
            })
            ->addColumn('properties', function ($data) {
                return $data->properties;
            })
            ->addColumn('created_at', function ($data) {
                return $data->created_at;
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    //
}
