<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Labjob;
use App\Models\Parameter;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Sitejob;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock;

class TaskController extends Controller
{
    public function create($id){
        //$users=User::all()->where('department',3);
        $users=User::all();
        $parameters=Parameter::all();
        $assets=Asset::all();
        $job=Labjob::with('items')->with('jobs')->find($id);
        $suggestions=Suggestion::where('capabilities',$job->items->capability)->get();
        $sug=array();
        foreach ($suggestions as $suggestion){
            $options=explode(',',$suggestion->optional_assets);
            foreach ($options as $option){
                if (Asset::find($option)->status==0){
                    $sug[]=$option;
                    break;
                }
            }
        }
        return view('tasks.create',compact('job','users','assets','sug','parameters'));
    }
    public function edit($id){
        //$users=User::all()->where('department',3);
        $users=User::all();
        $assets=Asset::all();
        $job=Labjob::find($id);
        $job->assign_assets=explode(',',$job->assign_assets);
        return view('tasks.edit',compact('job','users','assets'));
    }

    public function store(Request $request){

        if ($request->start > $request->end){
            return  redirect()->back()->with('error','Start date can not be greater than End date');
        }
        $this->validate($request,[
            'start'=>'required',
            'end'=>'required',
            'user'=>'required',
            'assets'=>'required',
        ]);
        //dd($request->all());
        $tasks=Labjob::find($request->id);
        $tasks->start=$request->start;
        $tasks->end=$request->end;
        $tasks->status=2;
        $tasks->assign_user=$request->user;
        $tasks->assign_assets=implode(',',$request->assets);
        $tasks->save();
        return redirect()->back()->with('success','Tasks assigned successfully');
    }

    public function respectiveassets($id){
        $assets=Asset::where('parameter',$id)->get();
        return response()->json($assets);
    }
    public function siteassignjobs(Request $request){
        $this->validate($request,[
            'start'=>'required',
            'end'=>'required',
            'user'=>'required',
            'assets'=>'required',
        ]);

        $jobs=Sitejob::where('job_id',$request->id)->get();
        foreach ($jobs as $job) {
            $job->status=2;
            $job->start=$request->start;
            $job->end=$request->end;
            $assets=implode(',',$request->assets);
            $job->group_assets=$assets;
            $users=implode(',',$request->user);
            $job->group_users=$users;
            $job->save();
        }
        return redirect()->back()->with('success','Site job has assigned successfully');

    }
    //
}
