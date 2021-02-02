<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Capabilities;
use App\Models\Certificate;
use App\Models\Dataentry;
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
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('uuc', function ($data) {
                return $data->item->capabilities->name;
            })
            ->addColumn('eqid', function ($data) {
                return $data->eq_id;
            })
            ->addColumn('start', function ($data) {
                return $data->start;
            })
            ->addColumn('end', function ($data) {
                return $data->end;
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
            ->rawColumns(['options','parameter','status'])
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

            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('uuc', function ($data) {
                return $data->item->capabilities->name;
            })
            ->addColumn('eqid', function ($data) {
                return $data->eq_id;
            })
            ->addColumn('start', function ($data) {
                return $data->start;
            })
            ->addColumn('end', function ($data) {
                return $data->end;
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
                $action.="<a title='View' class='btn btn-sm btn-success' href='" . url('/mytasks/s_view/'.$data->id) . "'><i class='fa fa-eye'></i></a>";
                return "&emsp;".$action;

            })
            ->rawColumns(['options','parameter','status'])
            ->make(true);

    }
    public function show($id){
        $this->authorize('mytask-view');
        $location=0;
        $show=Jobitem::find($id);
        $parameters=[];
        $assets=explode(',',$show->assign_assets);
        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $parameters=array_unique($parameters);
        $parameters=Parameter::whereIn('id',$parameters)->get();
        $assets=Asset::whereIn('id',$assets)->get();

        $dataentrie=Dataentry::where('parent_id',null)->where('job_type',0)->where('job_type_id',$id)->with('child')->get();
        //4dd($dataentries);
        return view('mytask.show',compact('show','location','parameters','assets','dataentrie'));
    }
    public function s_show($id){
        $this->authorize('mytask-view');
        $location=1;
        $show=Jobitem::find($id);
        $parameters=[];
        $assets=explode(',',$show->group_assets);
        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $parameters=array_unique($parameters);
        $parameters=Parameter::whereIn('id',$parameters)->get();
        $assets=Asset::whereIn('id',$assets)->get();

        $dataentrie=Dataentry::where('parent_id',null)->where('job_type',1)->where('job_type_id',$id)->with('child')->get();
        //4dd($dataentries);
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


    public function print_worksheet($location,$id){
            $job=Jobitem::find($id);
            $mainjob=Job::find($job->job_id);
            $quote=Quotes::find($mainjob->quote_id);
            if ($location==0){
                $assets=explode(',',$job->assign_assets);
            }
            else{
                $assets=explode(',',$job->group_assets);
            }
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        $allentries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->get();
        return view('mytask.worksheet',compact('entries','job','quote','mainjob','assets','allentries'));
    }
    public function print_dataentrysheet($location,$id){
        $job=Jobitem::find($id);
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        $ids=Dataentry::where('job_type',$location)->where('job_type_id',$id)->pluck('id')->toArray();
        $allentries=Dataentry::whereIn('parent_id',$ids)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $allentry){
            $n=0;
            $x1=($allentry->x1)?$allentry->x1:null;
            $x2=($allentry->x2)?$allentry->x2:null;
            $x3=($allentry->x3)?$allentry->x3:null;
            $x4=($allentry->x4)?$allentry->x4:null;
            $x5=($allentry->x5)?$allentry->x5:null;

            $x=[$x1,$x2,$x3,$x4,$x5];

            if (isset($x1)){$n++;}
            if (isset($x2)){$n++;}
            if (isset($x3)){$n++;}
            if (isset($x4)){$n++;}
            if (isset($x5)){$n++;}
            $average_repeated_value=($x1+$x2+$x3+$x4+$x5)/$n;
            if ($entries->fixed_type=="Ref"){
                $reference=$allentry->fixed_value;
                $uuc=$average_repeated_value;
            }
            if ($entries->fixed_type=="UUC"){
                $uuc=$allentry->fixed_value;
                $reference=$average_repeated_value;
            }
            //may be there will be need to use unit in manage reference query;
            $reference_table=Managereference::where('asset',$entries->asset_id)->get();
            if (count($reference_table)==0){
                return redirect()->back()->with('failed','Reference data is not available');
            }
            $intervals=[];
            foreach ($reference_table as $item) {
                $intervals[]=$item->uuc;
            }
            if (!isset($intervals)){
                return redirect()->back()->with('failed','Reference data is not available');

            }
            $min=null;$max=null;$count=count($intervals);
            //no interpolation needed
            if (in_array($reference,$intervals)){
                //echo '<h3>No interpolation needed</h3>';
                $map=array_search($reference,$intervals);
                //echo 'MAP : '.$map;
            }
            //interpolation needed
            else{
                // echo 'interpolation needed';
                for($i=0;$i<$count;$i++){
                    if ($i<$count-1){
                        if ($reference>$intervals[$i]){
                            if( $reference<$intervals[$i+1]){
                                $min=$intervals[$i];
                                $max=$intervals[$i+1];
                            }
                        }
                    }else{
                        if ($reference>$intervals[$i]){
                            $min=$intervals[$i];
                            $max=$intervals[$i-1];
                        }
                    }
                }
            }
            if ($min==null){
                if (!isset($map)){
                    $min=$intervals[0];
                    $max=$intervals[1];
                }else{
                    $min=$intervals[$map];
                    $max=$intervals[$map+1];
                }
            }
            if (isset($map)){
                foreach ($reference_table as $item) {
                    if ($item->uuc==$intervals[$map]){
                        $uncertainty_of_reference=$item->uncertainty;
                        $final_error=$item->error;
                        $errorofstd=$item->error;
                        $corrected=$reference-$item->error;
                        $final_error=$uuc-$final_error;
                    }
                }
            }
            else{
                $min_error=null;
                $max_error=null;
                foreach ($reference_table as $item) {
                    if ($item->uuc==$min){
                        $min_error=$item->error;
                        $uncertainty_of_reference=$item->uncertainty;

                    }
                    if ($item->uuc==$max){
                        $uncertainty_of_reference=$item->uncertainty;
                        $max_error=$item->error;
                    }
                }
                $error=((($reference-$min)*($max_error-$min_error))/($max-$min))+$min_error;
                //echo 'Error of Std : '.$error;
                $errorofstd=$error;
                $reference=$reference-$error;
                $corrected=$reference;
                $final_error=$uuc-$reference;
            }

            $mydata=json_decode($allentry->data,true);
            //dd($allentry);
            $data[$allentry->fixed_value]=[
                'x_entries'=>$x,
                'error'=>$final_error,
                'corrected'=>$corrected,
                'errorofstd'=>$errorofstd,
                'average'=>$average_repeated_value,
                'standard-deviation'=>$mydata['standard-deviation'],
                'combined-uncertainty'=>$mydata['combined-uncertainty'],
                'expanded-uncertainty'=>$mydata['expanded-uncertainty'],

            ];
        }

        $fixed_type=$entries->fixed_type;
        return view('mytask.dataentrysheet',compact('entries','job','uncertainties','allentries','data','fixed_type'));
    }

    public function print_uncertainty($location,$id){
        $job=Jobitem::find($id);
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        $ids=Dataentry::where('job_type',$location)->where('job_type_id',$id)->pluck('id')->toArray();
        $allentries=Dataentry::whereIn('parent_id',$ids)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $allentry){
            $data[$allentry->fixed_value]=json_decode($allentry->data,true);
        }
        return view('mytask.uncertainty',compact('entries','job','uncertainties','allentries','data'));
    }

    public function print_certificate($location,$id){
        if ($location==0){
            $job=Jobitem::find($id);
            $mainjob=Job::find($job->job_id);
            $quote=Quotes::find($mainjob->quote_id);
            $assets=explode(',',$job->assign_assets);
        }
        if ($location==1){
            $job=Jobitem::find($id);
            $mainjob=Job::find($job->job_id);
            $quote=Quotes::find($mainjob->quote_id);
            $assets=explode(',',$job->group_assets);
        }
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();

        $ids=Dataentry::where('job_type',$location)->where('job_type_id',$id)->pluck('id')->toArray();
        $allentries=Dataentry::whereIn('parent_id',$ids)->with('parent')->get();
        $data=array();
        foreach ($allentries as $allentry){
            $data[$allentry->fixed_value]=json_decode($allentry->data,true);
        }

        $temps=Dataentry::where('job_type',$location)->where('job_type_id',$id)->pluck('asset_id');
        $p=[];
        foreach ($temps as $temp) {
            $p[]=Asset::find($temp)->parameter;
        }
        $p=array_values($p);
        return view('mytask.certificate',compact('entries','job','quote','mainjob','assets','allentries','data','p'));
    }

    //
}
