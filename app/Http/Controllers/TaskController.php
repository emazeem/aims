<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Parameter;
use App\Models\QuoteItem;
use App\Models\Quotes;
use App\Models\Session;
use App\Models\Sitejob;
use App\Models\SitePlan;
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
        $job=Jobitem::with('item')->with('jobs')->find($id);
        $suggestions=Suggestion::where('capabilities',$job->item->capability)->get();
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
        $job=Jobitem::find($id);
        $job->assign_assets=explode(',',$job->assign_assets);
        return view('tasks.edit',compact('job','users','assets'));
    }

    public function store(Request $request){

        if ($request->start > $request->end){
            return  redirect()->back()->with('error','Start date can not be greater than End date');
        }
        $tasks=Jobitem::find($request->id);
        if ($tasks->type==0){
            $this->authorize('create-lab-task-assign');
            $this->validate($request,[
                'start'=>'required',
                'end'=>'required',
                'user'=>'required',
                'assets'=>'required',
            ]);
            //dd($request->all());
            $tasks->start=$request->start;
            $tasks->end=$request->end;
            $tasks->status=2;
            $tasks->assign_user=$request->user;
            $tasks->assign_assets=implode(',',$request->assets);
            $tasks->save();
        }
        if ($tasks->type==1){
            $this->authorize('create-site-task-assign');
            $this->validate($request,[
                'user'=>'required',
                'assets'=>'required',
            ]);
            $site=SitePlan::where('job_id',$tasks->job_id)->first();
            $tasks->start=$site->start;
            $tasks->end=$site->end;
            $tasks->status=2;
            $tasks->assign_user=$request->user;
            $tasks->assign_assets=implode(',',$request->assets);
            $tasks->save();
        }

return response()->json(['success'=>'Tasks assigned successfully']);
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
        $site=new SitePlan();
        $site->job_id=$request->id;
        $site->start=$request->start;
        $site->end=$request->end;
        $site->assigned_users=implode(',',$request->user);
        $site->assigned_assets=implode(',',$request->assets);
        $site->quote_items=implode(',',$request->items);
        $site->save();
        $site->cid='GP/'.str_pad($site->id, 6, '0', STR_PAD_LEFT);
        $site->save();

        /*$jobs=Jobitem::where('job_id',$request->id)->where('type',1)->get();
        foreach ($jobs as $item) {
            $job=Jobitem::find($item->id);
            $job->status=1;
            $job->start=$request->start;
            $job->end=$request->end;
            $assets=implode(',',$request->assets);
            $job->group_assets=$assets;
            $users=implode(',',$request->user);
            $job->group_users=$users;
            $job->save();
        }*/

        return response()->json(['success'=> 'Site job has planed successfully']);

    }
    public function site_assign($id,$items){
        $items=QuoteItem::whereIn('id',explode(',',$items))->get();
        return view('assign_item.sitejob',compact('id','items'));
    }
    //
}