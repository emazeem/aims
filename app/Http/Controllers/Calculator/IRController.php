<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\Generaldataentries;
use App\Models\Jobitem;
use App\Models\Managereference;
use App\Models\Preference;
use App\Models\Procedure;
use Illuminate\Http\Request;

class IRController extends Controller
{
    //
    public function create($id){
        $p=Preference::where('slug','aims-labs')->first();
        $labs=Preference::where('category',$p->id)->get();
        $parent=Calculatorentries::with('parent')->find($id);
        if ($parent->parent->type==0){
            $assets=explode(',',$parent->parent->assign_assets);
        }
        if ($parent->parent->type==1){
            $assets=explode(',',$parent->parent->group_assets);
        }

        foreach ($assets as $asset){
            $parameters[]=Asset::find($asset)->parameter;
        }
        $assets=Asset::whereIn('id',$assets)->get();
        return view('calculator.ir.create',compact('id','labs','parent','assets'));
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
        $entries=Calculatorentries::where('job_type_id',$id)->with('child')->first();
        //$allentries=Generaldataentries::where('parent_id',$entries->id)->get();
        return view('calculator.general.worksheet',compact('entries','job','quote','mainjob','assets'));
    }
    public function print_dataentrysheet($location,$id){
        $job=Jobitem::find($id);
        $entries=Calculatorentries::where('job_type_id',$id)->with('child')->first();
        //$ids=Dataentry::where('job_type',$location)->where('job_type_id',$id)->pluck('id')->toArray();
        //$allentries=Dataentry::whereIn('parent_id',$ids)->get();
        $allentries=Generaldataentries::where('parent_id',$entries->id)->get();
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
            $reference_table=Managereference::where('asset',$allentry->asset_id)->get();
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
                            $max=$intervals[$i];
                            $min=$intervals[$i-1];
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
        return view('calculator.general.dataentrysheet',compact('entries','job','uncertainties','allentries','data','fixed_type'));
    }

    public function print_uncertainty($location,$id){
        $job=Jobitem::find($id);
        $entries=Calculatorentries::where('job_type_id',$id)->with('child')->first();
        //dd($entries);
        $allentries=Generaldataentries::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $allentry){
            $data[$allentry->fixed_value]=json_decode($allentry->data,true);
        }
        return view('calculator.general.uncertainty',compact('entries','job','uncertainties','allentries','data'));
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
        $entries=Calculatorentries::where('job_type_id',$id)->with('child')->first();

        $allentries=Generaldataentries::where('parent_id',$entries->id)->get();

        $data=array();
        foreach ($allentries as $allentry){
            $data[$allentry->fixed_value]=json_decode($allentry->data,true);
        }
        $temps=Generaldataentries::where('parent_id',$entries->id)->pluck('asset_id');
        $p=[];
        foreach ($temps as $temp) {
            $p[]=Asset::find($temp)->parameter;
        }
        $p=array_values($p);
        $p=array_unique($p);
        return view('calculator.general.certificate',compact('entries','job','quote','mainjob','assets','allentries','data','p'));
    }
    public function store(Request $request){
        $parent=Calculatorentries::find($request->parent_id);
        $reference_table=Managereference::where('asset',$request->assets)->get();
        if (count($reference_table)==0){
            dd('reference data is not available');
//            return redirect()->back()->with('failed','Reference data is not available');
        }

        $this->validate(request(), [
            'fixed_value' => 'required',
            'x1' => 'required',
            'x2' => 'required',
            'x3' => 'required',
        ]);
        $x1 = [];
        $x2 = [];
        $x3 = [];
        $fixed = [];
        foreach ($request->x1 as $item) {
            if (isset($request->mulitplying_factor) and $request->mulitplying_factor!=0){
                $x1[] = $item*$request->mulitplying_factor;
            }else{
                $x1[] = $item;
            }
        }
        foreach ($request->x2 as $item) {
            if (isset($request->mulitplying_factor)  and $request->multiplying_factor!=0){
                $x2[] = $item*$request->mulitplying_factor;
            }else{
                $x2[] = $item;
            }
        }
        foreach ($request->x3 as $item) {
            if (isset($request->mulitplying_factor)  and $request->multiplying_factor!=0){
                $x3[] = $item*$request->mulitplying_factor;
            }else{
                $x3[] = $item;
            }

        }
        foreach ($request->fixed_value as $item) {
            if (isset($request->mulitplying_factor) and $request->multiplying_factor!=0){
                $fixed[] = $item*$request->mulitplying_factor;
            }else{
                $fixed[] = $item;
            }
        }

        for ($i = 0; $i < count($x1); $i++) {
            $item = new Generaldataentries();
            $item->fixed_value = $fixed[$i];
            $item->x1 = $x1[$i];
            $item->x2 = $x2[$i];
            $item->x3 = $x3[$i];
            $item->asset_id=$request->assets;
            $item->unit=$request->units;
            $item->parent_id = $request->parent_id;
            //$item->save();
        }

        $parent->fixed_type='ref';
        $parent->save();

        $job=Jobitem::find($parent->job_type_id);
        $entries=Calculatorentries::find($request->parent_id);
        $allentries=Generaldataentries::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $entry){
            //all uncertainties declaration
            $SD=0;
            $uncertainty_Type_A=0;
            $combined_uncertainty_of_standard=0;
            $drift_of_the_standard=0;
            $combined_uncertainty=0;
            $expanded_uncertainties=0;
            //calculations
            $n=0;
            $x1=($entry->x1)?$entry->x1:null;
            $x2=($entry->x2)?$entry->x2:null;
            $x3=($entry->x3)?$entry->x3:null;


            if (isset($x1)){$n++;}
            if (isset($x2)){$n++;}
            if (isset($x3)){$n++;}

            $average_repeated_value=($x1+$x2+$x3)/$n;
            $reference=$entry->fixed_value;
            $uuc=$average_repeated_value;

            $reference_table=Managereference::where('asset',$request->assets)->get();
            $intervals=[];
            //echo '<br>START INTERVALS<br>';
            foreach ($reference_table as $item) {
                $intervals[]=$item->uuc;
                //echo (int)$item->uuc.'<br>';
            }
            if (!isset($intervals)){
                return redirect()->back()->with('failed','Reference data is not available');

            }
            //echo 'END INTERVALS';
            $min=null;$max=null;$count=count($intervals);
            //no interpolation needed
            if (in_array($reference,$intervals)){
                $map=array_search($reference,$intervals);
            }
            //interpolation needed
            else{
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
                $reference=$reference-$error;
                $final_error=$uuc-$reference;
            }
            $square_sum=0;
            $all_repeated_values=[$x1,$x2,$x3];
            for($i=0;$i<$n;$i++){
                $temp=$average_repeated_value-$all_repeated_values[$i];
                $square_sum=$square_sum+($temp*$temp);
            }
            //dd($n);
            $temp=$square_sum/($n-1);
            //dd($uncertainties);
            if (in_array('standard-deviation',$uncertainties)){
                $SD=sqrt($temp);
                //dd($SD);
            }

            if (in_array('uncertainty-type-a',$uncertainties)){
                $uncertainty_Type_A=$SD/sqrt($n);
                //dd($uncertainty_Type_A);
            }
            if (in_array('uncertainty-due-to-resolution-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_resolution_of_uuc=(Jobitem::find($entries->job_type_id)->resolution/2)/sqrt(3);
                }
//                dd($uncertainty_due_to_resolution_of_uuc);
            }
            //dd($uncertainty_due_to_accuracy_of_uuc);
            if (in_array('drift-of-the-standard',$uncertainties)){
                $drift_of_the_standard=$uncertainty_of_reference/sqrt(3);
            }
            //dd($uncertainty_of_reference);
            if (in_array('combined-uncertainty-of-standard',$uncertainties)) {
                $combined_uncertainty_of_standard=$uncertainty_of_reference/2;
            }
            $uncertainty_of_reflected_ambient_radiation=0;
            if (in_array('uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5',$uncertainties)) {
                $uncertainty_of_reflected_ambient_radiation=0.2/sqrt(3);
            }
            $uncertainty_of_source_heat_exchange=0;
            if (in_array('uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6',$uncertainties)) {
                $uncertainty_of_source_heat_exchange=0.054/sqrt(3);
            }
            $uncertainty_due_to_source_uniformity_from_manual_of_source_u8=0;
            if (in_array('uncertainty-due-to-source-uniformity-from-manual-of-source-u8',$uncertainties)) {
                $uncertainty_due_to_source_uniformity_from_manual_of_source_u8=0.1/2/sqrt(3);
            }
            $uncertainty_of_source_emissivity=0;
            if (in_array('uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4',$uncertainties)) {
                $uncertainty_of_source_emissivity=0.01/sqrt(3);
            }
            $uncertainty_due_to_source_stability_from_manual_of_source=0;
            if (in_array('uncertainty-due-to-source-stability-from-manual-of-source-u7',$uncertainties)) {
                if ($reference<=100){
                    $uncertainty_due_to_source_stability_from_manual_of_source=0.1/2/sqrt(3);
                }elseif ($reference<=350){
                    $uncertainty_due_to_source_stability_from_manual_of_source=0.2/2/sqrt(3);
                }else{
                    $uncertainty_due_to_source_stability_from_manual_of_source=0.4/2/sqrt(3);
                }
            }

            $squresum=(pow($uncertainty_Type_A,2)+pow($combined_uncertainty_of_standard,2)+
                pow($uncertainty_due_to_resolution_of_uuc,2)+
                pow($drift_of_the_standard,2));
            $combined_uncertainty=sqrt($squresum);
            $expanded_uncertainties=$combined_uncertainty*2;
            $data[$entry->fixed_value]=[
                'id'=>$entry->id,
                'final-error'=>$final_error,
                'standard-deviation'=>$SD,
                'uncertainty-type-a'=>$uncertainty_Type_A,
                'combined-uncertainty-of-standard'=>$combined_uncertainty_of_standard,
                'uncertainty-due-to-resolution-of-uuc'=>$uncertainty_due_to_resolution_of_uuc,
                'drift-of-the-standard'=>$drift_of_the_standard,
                "uncertainty-of-source-emissivity-from-x2-4-5-of-astm-e2847-u4"=>$uncertainty_of_source_emissivity,
                "uncertainty-of-reflected-ambient-radiation-from-x2-13-of-astm-e2847-u5"=>$uncertainty_of_reflected_ambient_radiation,
                "uncertainty-of-source-heat-exchange-x1-1-table-in-astm-e2847-u6"=>$uncertainty_of_source_heat_exchange,
                "uncertainty-due-to-source-stability-from-manual-of-source-u7"=>$uncertainty_due_to_source_stability_from_manual_of_source,
                "uncertainty-due-to-source-uniformity-from-manual-of-source-u8"=>$uncertainty_due_to_source_uniformity_from_manual_of_source_u8,
                'combined-uncertainty'=>$combined_uncertainty,
                'expanded-uncertainty'=>$expanded_uncertainties,
            ];
            $save_data=Generaldataentries::find($entry->id);
            $save_data->data=$data[$entry->fixed_value];
            $save_data->save();
        }

        return redirect()->back()->with('success','Entry added successfully');
        /*}*/
    }
}
