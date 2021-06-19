<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Calculatorentries;
use App\Models\Capabilities;
use App\Models\Certificate;
use App\Models\Dataentry;
use App\Models\Incubatormapping;
use App\Models\Item;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Managereference;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Quotes;
use App\Models\Sitejob;
use App\Models\Unit;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Types\Compound;
use Yajra\DataTables\Facades\DataTables;

class MytaskController extends Controller
{
    public function index(){
        $this->authorize('mytask-index');
        return view('mytask.index');
    }

    public function fetch(Request $request){
        $this->authorize('mytask-index');

        $data=Jobitem::all()->where('assign_user',auth()->user()->id);
        return DataTables::of($data)
            ->addColumn('job', function ($data) {
                return $data->jobs->cid;
            })
            ->addColumn('model', function ($data) {
                return $data->model;
            })
            ->addColumn('uuc', function ($data) {
                return $data->item->capabilities->name;
            })
            ->addColumn('eqid', function ($data) {
                return $data->eq_id;
            })
            ->addColumn('date', function ($data) {
                return $data->start.' to '.$data->end;
            })
            ->addColumn('asset', function ($data) {

                $assets=Asset::whereIn('id',explode(',',$data->assign_assets))->get();
                $standard=null;
                foreach ($assets as $asset) {
                    $standard=$asset->code.'<i class="feather icon-chevron-right"></i>'.$asset->name.'<br>'.$standard;
                }
                return $standard;
            })

            ->addColumn('status', function ($data) {
                if ($data->status==2){
                    $status= "<b class=\"text-danger\">Pending</b>";
                }
                if ($data->status==3){
                    $status= "<b class=\"text-success\">Started</b>";
                }
                if ($data->status==4){
                    $status= "<b class=\"text-success\">Completed</b>";
                }
                if ($data->status==5){
                    $status= "<b class=\"text-success\">Completed</b>";
                }

                return $status;
            })

            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='View' class='btn btn-sm btn-success' href='" . url('/mytasks/view/'.$data->id) . "'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','parameter','asset','status'])
            ->make(true);

    }
    public function s_fetch(Request $request){
        $this->authorize('mytask-index');
        $filters=Jobitem::all()->where('type',1);
        $skip_ids=array();
        foreach ($filters as $filter) {
            if (in_array(auth()->user()->id,explode(',',$filter->group_users))){
                $skip_ids[]=$filter->id;
            }
        }
        $data=Jobitem::all()->whereIn('id',$skip_ids)->where('type',1);
        return DataTables::of($data)

            ->addColumn('job', function ($data) {
                return $data->jobs->cid;
            })
            ->addColumn('uuc', function ($data) {
                return $data->item->capabilities->name;
            })
            ->addColumn('eqid', function ($data) {
                return $data->eq_id;
            })
            ->addColumn('model', function ($data) {
                return $data->model;
            })

            ->addColumn('asset', function ($data) {

                $assets=Asset::whereIn('id',explode(',',$data->group_assets))->get();
                $standard=null;
                foreach ($assets as $asset) {
                    $standard=$asset->code.'<i class="feather icon-chevron-right"></i>'.$asset->name.'<br>'.$standard;
                }
                return $standard;
            })
            ->addColumn('date', function ($data) {
                return $data->start.' to '.$data->end;
            })
            ->addColumn('status', function ($data) {
                if ($data->status==1){
                    $status= "<b class=\"text-danger\">Pending</b>";
                }
                if ($data->status==2){
                    $status= "<b class=\"text-danger\">Pending</b>";
                }
                if ($data->status==3){
                    $status= "<b class=\"text-success\">Started</b>";
                }
                if ($data->status==4){
                    $status= "<b class=\"text-success\">Requirements</b>";
                }

                if ($data->status==5){
                    $status= "<b class=\"text-success\">Completed</b>";
                }
                if ($data->status==6){
                    $status= "<b class=\"text-success\">Completed</b>";
                }
                return $status;
            })

            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='View' class='btn btn-sm btn-success' href='" . url('/mytasks/view/'.$data->id) . "'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','parameter','status'])
            ->make(true);
    }
    public function show($id){
        $this->authorize('mytask-view');
        $show=Jobitem::with('general')->find($id);
        $location=$show->type;
        $parameters=[];
        if ($location==0){
            $assets=explode(',',$show->assign_assets);
        }
        if ($location==1){
            $assets=explode(',',$show->group_assets);
        }
        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $parameters=array_unique($parameters);
        $parameters=Parameter::whereIn('id',$parameters)->get();
        $assets=Asset::whereIn('id',$assets)->get();
        $dataentrie=Calculatorentries::where('job_type_id',$id)->with('child')->first();

        return view('mytask.show',compact('show','location','parameters','assets','dataentrie'));
    }
    public function start(Request $request){
        $this->authorize('start-mytask');
        $start=Jobitem::find($request->id);
        $start->status=3;
        $start->started_at=date('Y-m-d H:i:s');
        $start->save();
        return redirect()->back()->with('success','Task has been started');
    }
    public function end(Request $request){
        $start=Jobitem::find($request->id);
        $start->status=4;
        $start->ended_at=date('Y-m-d H:i:s');
        $start->save();
        return redirect()->back()->with('success','Task has been ended');
    }
    public function getLabCertificate(Request $request){

        if ($request->location==0){
            $labjob=Jobitem::find($request->id);
            $labjob->status=5;
            $certificate=new Certificate();
            $certificate->uuc_id=$request->id;
            $certificate->location="LAB";
            $certificate->job=$labjob->id;
            $certificate->save();
            $labjob->certificate=$certificate->id;
            $labjob->save();
        }
        elseif ($request->location==1){
            $sitejob=Sitejob::find($request->id);
            $sitejob->status=6;
            $certificate=new Certificate();
            $certificate->uuc_id=$request->id;
            $certificate->location="SITE";
            $certificate->job=$sitejob->id;
            $certificate->save();
            $sitejob->certificate=$certificate->id;
            $sitejob->save();
        }
        return redirect()->back()->with('success','Certificate no. issued successfully');
    }
    //
}
