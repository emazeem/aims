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
    public function index_lab(){
        $this->authorize('lab-task-index');
        return view('my_task.index_lab');
    }
    public function index_site(){
        $this->authorize('site-task-index');
        return view('my_task.index_site');
    }


    public function fetch_lab(Request $request){
        $this->authorize('lab-task-index');
        if ($request->search=='pending'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',0)->where('status',2);
        }
        if ($request->search=='started'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',0)->where('status',3);
        }
        if ($request->search=='completed'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',0)->where('status',4);
        }
        if ($request->search=='all'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',0);
        }


        return DataTables::of($data)
            ->addColumn('job', function ($data) {
                return $data->jobs->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->jobs->quotes->customers->reg_name;
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
                $action.="<a title='View' class='btn btn-sm btn-success' href='" . url('/lab_task/view/'.$data->id) . "'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','parameter','asset','status'])
            ->make(true);

    }

    public function fetch_site(Request $request){
        $this->authorize('site-task-index');
        if ($request->search=='pending'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',1)->where('status',2);
        }
        if ($request->search=='started'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',1)->where('status',3);
        }
        if ($request->search=='completed'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',1)->where('status',4);
        }
        if ($request->search=='all'){
            $data=Jobitem::all()->where('assign_user',auth()->user()->id)->where('type',1);
        }

        return DataTables::of($data)
            ->addColumn('job', function ($data) {
                return $data->jobs->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->jobs->quotes->customers->reg_name;
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
                $action.="<a title='View' class='btn btn-sm btn-success' href='" . url('/site_task/view/'.$data->id) . "'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','parameter','asset','status'])
            ->make(true);

    }


    public function show($id){
        $this->authorize('mytask-view');
        $show=Jobitem::with('general')->find($id);
        $location=$show->type;
        $parameters=[];
        $assets=explode(',',$show->assign_assets);
        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $parameters=array_unique($parameters);
        $parameters=Parameter::whereIn('id',$parameters)->get();
        $assets=Asset::whereIn('id',$assets)->get();
        $dataentrie=Calculatorentries::where('job_type_id',$id)->with('child')->first();

        return view('my_task.show',compact('show','location','parameters','assets','dataentrie'));
    }
    public function start(Request $request){
        $this->authorize('start-mytask');
        $start=Jobitem::find($request->id);
        $start->status=3;
        $start->started_at=date('Y-m-d H:i:s');
        $start->save();
        return response()->json(['success'=>'Task has been started']);
    }
    public function end(Request $request){
        $start=Jobitem::find($request->id);
        $start->status=4;
        $start->ended_at=date('Y-m-d H:i:s');
        $start->cc=$request->cc;
        $prefix=null;
        if ($request->cc==0){
            $prefix='RR/';
        }
        if ($request->cc==1){
            $prefix='CC/';
        }
        $start->cid=$prefix.str_pad($start->id, 7, '0', STR_PAD_LEFT);
        $start->save();
        return response()->json(['success'=>'Task has been ended. Certificate # '.$start->cid.' # has been assigned to this item']);
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
    public function rar_store(Request $request){
        $this->validate($request,[
            'range'=>'required',
            'accuracy'=>'required',
            'resolution'=>'required',
        ]);
        $item=Jobitem::find($request->id);
        $item->range=$request->range;
        $item->resolution=$request->resolution;
        $item->accuracy=$request->accuracy;
        $item->save();
        return response()->json(['success'=>'Range/Resolution/Accuracy added successfully!']);
    }
    //
}
