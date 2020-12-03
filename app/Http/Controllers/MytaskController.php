<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Capabilities;
use App\Models\Certificate;
use App\Models\Dataentry;
use App\Models\Item;
use App\Models\Job;
use App\Models\Labjob;
use App\Models\Managereference;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Quotes;
use App\Models\Sitejob;
use App\Models\Unit;
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

        $data=Labjob::all()->where('assign_user',auth()->user()->id);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('uuc', function ($data) {
                return $data->items->capabilities->name;
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

        $filters=Sitejob::all();
        $skip_ids=array();
        foreach ($filters as $filter) {
            if (in_array(auth()->user()->id,explode(',',$filter->group_users))){
                $skip_ids[]=$filter->id;
            }
        }
        $data=Sitejob::all()->whereIn('id',$skip_ids);

        return DataTables::of($data)

            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('uuc', function ($data) {
                return $data->items->capabilities->name;
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
        $show=Labjob::find($id);
        $parameters=[];
        $assets=explode(',',$show->assign_assets);
        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $parameters=array_unique($parameters);
        $parameters=Parameter::whereIn('id',$parameters)->get();
        $assets=Asset::whereIn('id',$assets)->get();

        $dataentries=Dataentry::where('parent_id',null)->where('job_type',0)->where('job_type_id',$id)->with('child')->first();
        //dd($dataentries);
        return view('mytask.show',compact('show','location','parameters','assets','dataentries'));
    }
    public function s_show($id){
        $this->authorize('mytask-view');
        $location=1;
        $show=Sitejob::find($id);
        return view('mytask.show',compact('show','location'));
    }

    public function start(Request $request){
        $this->authorize('start-mytask');
        if ($request->location==0){
            $start=Labjob::find($request->id);
        }
        elseif ($request->location==1){
            $start=Sitejob::find($request->id);
        }
        $start->status=3;
        $start->started_at=date('Y-m-d H:i:s');
        $start->save();
        return redirect()->back()->with('success','Task has been started');
    }
    public function end(Request $request){
        if ($request->location==0){
            $start=Labjob::find($request->id);
        }
        elseif ($request->location==1){
            $start=Sitejob::find($request->id);
        }
        $start->status=4;
        $start->ended_at=date('Y-m-d H:i:s');
        $start->save();
        return redirect()->back()->with('success','Task has been ended');
    }
    public function getLabCertificate(Request $request){

        if ($request->location==0){
            $labjob=Labjob::find($request->id);
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
    public function calculate(Request $request){
        //dd($request->all());
        $proSlugs=Procedure::find($request->procedure)->uncertainties;
        $proSlugs=explode(',',$proSlugs);
        //dd($proSlugs);
        $reference=null;$uuc=null;$n=0;$uncertainty_of_reference=null;
        $fixed_value=$request->fixed_value;
        //count isset variable for average
        $x1=($request->x1)?$request->x1:null;
        $x2=($request->x2)?$request->x2:null;
        $x3=($request->x3)?$request->x3:null;
        $x4=($request->x4)?$request->x4:null;
        $x5=($request->x5)?$request->x5:null;
        
        if (isset($x1)){$n++;}
        if (isset($x2)){$n++;}
        if (isset($x3)){$n++;}
        if (isset($x4)){$n++;}
        if (isset($x5)){$n++;}

        
        $average_repeated_value=($x1+$x2+$x3+$x4+$x5)/$n;

        echo "Average Value of Repeated : ".$average_repeated_value;

        if ($request->fixed=="Ref"){
            $reference=$fixed_value;
            $uuc=$average_repeated_value;
        }
        if ($request->fixed=="UUC"){
            $uuc=$fixed_value;
            $reference=$average_repeated_value;
        }
        echo 'Reference : '.$reference;
        
        echo 'UUC : '.$uuc;

        
        //may be there will be need to use unit in manage reference query;
        $reference_table=Managereference::where('asset',$request->assets)->get();
        $intervals=[];
        echo '<br>INTERVALS<br>';
        foreach ($reference_table as $item) {
            $intervals[]=$item->uuc;
            echo (int)$item->uuc.'<br>';
        }
        echo 'END INTERVALS';
        $min=null;$max=null;$count=count($intervals);
        //no interpolation needed
        if (in_array($reference,$intervals)){
            echo '<h3>No interpolation needed</h3>';
            $map=array_search($reference,$intervals);
            echo 'MAP : '.$map;
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

        echo 'Minimum Range ='.$min;
        echo 'Maximum Range ='.$max;
        
        if (isset($map)){
            foreach ($reference_table as $item) {
                if ($item->uuc==$intervals[$map]){
                    $uncertainty_of_reference=$item->uncertainty;
                    $final_error=$item->error;
                    echo 'Error of Std: '.$final_error;
                    echo 'Corrected value of Std:';
                    echo $final_error=$reference-$final_error;
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
            echo 'Error of Std : '.$error;
            $reference=$reference-$error;
            $final_error=$uuc-$reference;
        }
        echo 'Error: '.$final_error;
        $square_sum=0;
        $all_repeated_values=[$x1,$x2,$x3,$x4,$x5];
        for($i=0;$i<$n;$i++){
            $temp=$average_repeated_value-$all_repeated_values[$i];
            $square_sum=$square_sum+($temp*$temp);
        }
        //dd($n);
        $temp=$square_sum/($n-1);
        $SD=sqrt($temp);
        
        $uncertainty_Type_A=$SD/sqrt($n);
        
        $uncertainty_due_to_resolution_of_uuc=($request->uuc_resolution/2)/sqrt(3);
        $odd=0;$even=0;
        $odd_n=0;$even_n=0;
        for($i=1;$i<=$n;$i++){
            if ($i%2!=0){
                $odd=$odd+$all_repeated_values[$i-1];
                $odd_n++;
            }else{
                $even=$even+$all_repeated_values[$i-1];
                $even_n++;
            }
        }
        $odd_avg=$odd/$odd_n;
        $even_avg=$even/$even_n;
        $del_x=$odd_avg-$even_avg;
        $uncertainty_of_hysterisis=($del_x/2)/sqrt(3);
        
        
        

        $drift_of_the_standard=$uncertainty_of_reference/sqrt(3);
        $combined_uncertainty_of_standard=$uncertainty_of_reference/2;
        $uncertainty_due_to_offset_of_uuc=$request->offset/sqrt(3);
        //$homogeniety=Assetspecification::where('asset_id',$request->assets)->where('column',1)->first()->value;
        //$uncertainty_due_to_homogeniety=$homogeniety/sqrt(3);
        
        //$instability =Assetspecification::where('asset_id',$request->assets)->where('column',2)->first()->value;
        //$uncertainty_due_to_instability =$instability/sqrt(3);
        

        //$loadingofsource =Assetspecification::where('asset_id',$request->assets)->where('column',3)->first()->value;
        //$uncertainty_due_to_loadingofsource =$loadingofsource/sqrt(3);
        
        //$parallex =Assetspecification::where('asset_id',$request->assets)->where('column',4)->first()->value;
        //$uncertainty_due_to_parallex  = $parallex/sqrt(3);


        if (in_array('standard-deviation',$proSlugs)){

            echo "Standard Deviation : ".$SD;
        }else{
            $SD=0;
            echo "Standard Deviation : ".$SD;
        }
        echo '<br>';
        echo 'Corrected value of Std : '.$reference;
        echo '<br>';
        echo 'Uncertainty Due to Type A : '.$uncertainty_Type_A;
        echo '<br>';
        echo 'Uncertainty Due to Resolution of UUC : '.$uncertainty_due_to_resolution_of_uuc;
        echo '<br>';
        //echo 'Uncertainty due to loading of source  : '.$uncertainty_due_to_loadingofsource;
        echo '<br>';
        //echo 'Uncertainty due to instability  : '.$uncertainty_due_to_instability;
        echo '<br>';
        //echo 'Uncertainty due to homogeniety : '.$uncertainty_due_to_homogeniety;
        echo '<br>';
        //echo 'Uncertainty due to parallex  : '.$uncertainty_due_to_parallex;
        echo '<br>';
        echo 'Uncertainty of Reference : '.$uncertainty_of_reference;
        echo '<br>';
        echo 'Uncertainty_of hysterisis : '.$uncertainty_of_hysterisis;
        echo '<br>';
        echo 'Unceratinty due to offset of UUC : '.$uncertainty_due_to_offset_of_uuc;
        echo '<br>';
        echo 'Combined uncertainty of standard : '.$combined_uncertainty_of_standard;
        echo '<br>';
        echo 'Drift of the Standard : '.$drift_of_the_standard;
    }
    public function print_worksheet($location,$id){
        if ($location==0){
            $job=Labjob::find($id);
            $mainjob=Job::find($job->job_id);
            $quote=Quotes::find($mainjob->quote_id);
        }
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        return view('mytask.worksheet',compact('entries','job','quote','mainjob'));
    }
    public function print_uncertainty($location,$id){
        if ($location==0){
            $job=Labjob::find($id);

        }
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        $allentries=Dataentry::where('parent_id',$entries->id)->get();

        $procedure = Procedure::find($job->items->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);

        $data=array();
        foreach ($allentries as $entry){
            //all uncertainties declaration
            $SD=0;
            $uncertainty_Type_A=0;
            $combined_uncertainty_of_standard=0;
            $uncertainty_due_to_accuracy_of_uuc=0;
            $uncertainty_due_to_resolution_of_uuc=0;
            $drift_of_the_standard=0;
            $uncertainty_due_to_offset_of_uuc=0;
            $uncertainty_of_hysterisis=0;
            $combined_uncertainty=0;
            $expanded_uncertainties=0;


            //calculations
            $n=0;
            $x1=($entry->x1)?$entry->x1:null;
            $x2=($entry->x2)?$entry->x2:null;
            $x3=($entry->x3)?$entry->x3:null;
            $x4=($entry->x4)?$entry->x4:null;
            $x5=($entry->x5)?$entry->x5:null;

            if (isset($x1)){$n++;}
            if (isset($x2)){$n++;}
            if (isset($x3)){$n++;}
            if (isset($x4)){$n++;}
            if (isset($x5)){$n++;}

            $average_repeated_value=($x1+$x2+$x3+$x4+$x5)/$n;

            echo "Average Value of Repeated : ".$average_repeated_value;

            if ($entries->fixed_type=="Ref"){
                $reference=$entry->fixed_value;
                $uuc=$average_repeated_value;
            }
            if ($entries->fixed_type=="UUC"){
                $uuc=$entry->fixed_value;
                $reference=$average_repeated_value;
            }
            echo 'Reference : '.$reference;
            echo 'UUC : '.$uuc;

            //may be there will be need to use unit in manage reference query;
            $reference_table=Managereference::where('asset',$entries->asset_id)->get();
            $intervals=[];
            echo '<br>START INTERVALS<br>';
            foreach ($reference_table as $item) {
                $intervals[]=$item->uuc;
                echo (int)$item->uuc.'<br>';
            }
            echo 'END INTERVALS';
            $min=null;$max=null;$count=count($intervals);

            //no interpolation needed
            if (in_array($reference,$intervals)){
                echo '<h3>No interpolation needed</h3>';
                $map=array_search($reference,$intervals);
                echo 'MAP : '.$map;
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

            echo 'Minimum Range ='.$min;
            echo 'Maximum Range ='.$max;


            if (isset($map)){
                foreach ($reference_table as $item) {
                    if ($item->uuc==$intervals[$map]){
                        $uncertainty_of_reference=$item->uncertainty;
                        $final_error=$item->error;
                        echo 'Error of Std: '.$final_error;
                        echo 'Corrected value of Std:';
                        echo $final_error=$reference-$final_error;
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
                echo 'Error of Std : '.$error;
                $reference=$reference-$error;
                $final_error=$uuc-$reference;
            }
            echo 'Error: '.$final_error;
            $square_sum=0;
            $all_repeated_values=[$x1,$x2,$x3,$x4,$x5];
            for($i=0;$i<$n;$i++){
                $temp=$average_repeated_value-$all_repeated_values[$i];
                $square_sum=$square_sum+($temp*$temp);
            }
            //dd($n);
            $temp=$square_sum/($n-1);
            //dd($uncertainties);


            if (in_array('standard-deviation',$uncertainties)){
                $SD=sqrt($temp);
            }

            if (in_array('uncertainty-type-a',$uncertainties)){
                $uncertainty_Type_A=$SD/sqrt($n);
            }

            if (in_array('uncertainty-due-to-resolution-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_resolution_of_uuc=(Labjob::find($entries->job_type_id)->resolution/2)/sqrt(3);
                }
            }
            if (in_array('combined-uncertainty-of-standard',$uncertainties)){
                $combined_uncertainty_of_standard=$uncertainty_of_reference/2;
            }
            //dd($entries->before_offset);
            if (in_array('uncertainty-due-to-offset-of-uuc',$uncertainties)){
                $uncertainty_due_to_offset_of_uuc=$entries->before_offset/sqrt(3);
            }
            //dd($uncertainty_due_to_offset_of_uuc);
            if (in_array('uncertainty-due-to-accuracy-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_accuracy_of_uuc=(Labjob::find($entries->job_type_id)->accuracy)/sqrt(3);
                }
            }
            //dd($uncertainty_due_to_accuracy_of_uuc);
            if (in_array('drift-of-the-standard',$uncertainties)){
                $drift_of_the_standard=$uncertainty_of_reference/sqrt(3);
            }
            //dd($drift_of_the_standard);
            if (in_array('uncertainty-due-to-hysteresis-uuc',$uncertainties)){

                $odd=0;$even=0;
                $odd_n=0;$even_n=0;
                for($i=1;$i<=$n;$i++){
                    if ($i%2!=0){
                        $odd=$odd+$all_repeated_values[$i-1];
                        $odd_n++;
                    }else{
                        $even=$even+$all_repeated_values[$i-1];
                        $even_n++;
                    }
                }
                $odd_avg=$odd/$odd_n;
                $even_avg=$even/$even_n;
                $del_x=$odd_avg-$even_avg;
                $uncertainty_of_hysterisis=($del_x/2)/sqrt(3);

            }
            //dd($drift_of_the_standard);
            $squresum=(pow($uncertainty_Type_A,2)+pow($combined_uncertainty_of_standard,2)+pow($uncertainty_due_to_resolution_of_uuc,2)+pow($uncertainty_due_to_accuracy_of_uuc,2)+pow($drift_of_the_standard,2)+pow($uncertainty_due_to_offset_of_uuc,2)+pow($uncertainty_of_hysterisis,2));
            $combined_uncertainty=sqrt($squresum);
            $expanded_uncertainties=$combined_uncertainty*2;
            $data[]=[
                'standard-deviation'=>$SD,
                'uncertainty-type-a'=>$uncertainty_Type_A,
                'combined-uncertainty-of-standard'=>$combined_uncertainty_of_standard,
                'uncertainty-due-to-resolution-of-uuc'=>$uncertainty_due_to_resolution_of_uuc,
                'uncertainty-due-to-accuracy-of-uuc'=>$uncertainty_due_to_accuracy_of_uuc,
                'drift-of-the-standard'=>$drift_of_the_standard,
                'uncertainty-due-to-offset-of-uuc'=>$uncertainty_due_to_offset_of_uuc,
                'uncertainty-due-to-hysteresis-uuc'=>$uncertainty_of_hysterisis,
                'combined-uncertainty'=>$combined_uncertainty,
                'expanded-uncertainty'=>$expanded_uncertainties,
            ];
        }
        dd($data);
        return view('mytask.uncertainty',compact('entries','job','uncertainties'));
    }

    public function print_certificate($location,$id){
        if ($location==0){
            $job=Labjob::find($id);
            $mainjob=Job::find($job->job_id);
            $quote=Quotes::find($mainjob->quote_id);
        }
        $entries=Dataentry::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();

        return view('mytask.certificate',compact('entries','job','quote','mainjob'));
    }

    //
}
