<?php

namespace App\Http\Controllers;

use App\Models\Dataentry;
use App\Models\Jobitem;
use App\Models\Labjob;
use App\Models\Managereference;
use App\Models\Procedure;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class DataentryController extends Controller
{
    //
    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'assets' => 'required',
            'units' => 'required',
            'uuc_resolution' => 'required',
            'start_humidity' => 'required',
            'end_humidity' => 'required',
            'location' => 'required',
            'accuracy' => 'required',
            'range' => 'required',
            'start_temp' => 'required',
            'end_temp' => 'required',
            'before_offset' => 'required',
            'after_offset' => 'required',
            'fixed' => 'required',
            'fixed_value' => 'required',
            'x1' => 'required',
            'x2' => 'required',
        ]);
        //if ($request->jobtype==0) {
            /*$already_exsited = Dataentry::where('job_type', 0)->where('asset_id', $request->assets)->where('unit', $request->units)->first();
            if ($already_exsited) {
                $x1 = [];
                $x2 = [];
                $x3 = [];
                $x4 = [];
                $x5 = [];
                $fixed = [];
                foreach ($request->x1 as $item) {
                    $x1[] = $item;
                }
                foreach ($request->x2 as $item) {
                    $x2[] = $item;
                }
                foreach ($request->x3 as $item) {
                    $x3[] = $item;
                }
                foreach ($request->x4 as $item) {
                    $x4[] = $item;
                }
                foreach ($request->x5 as $item) {
                    $x5[] = $item;
                }
                foreach ($request->fixed_value as $item) {
                    $fixed[] = $item;
                }
                for ($i = 0; $i < count($x1); $i++) {
                    $item = new Dataentry();
                    $item->fixed_value = $fixed[$i];
                    $item->x1 = $x1[$i];
                    $item->x2 = $x2[$i];
                    $item->x3 = $x3[$i];
                    $item->x4 = $x4[$i];
                    $item->x5 = $x4[$i];
                    $item->x6 = null;
                    $item->parent_id = $already_exsited->id;
                    $item->save();
                }
                return redirect()->back()->with('success', 'Entry added successfully');
            }*/

            $labjob = Jobitem::find($request->jobtypeid);
            $labjob->accuracy = $request->accuracy;
            $labjob->range = $request->range;
            $labjob->resolution = $request->uuc_resolution;
            $labjob->save();
            $entry = new Dataentry();
            $entry->job_type = $request->jobtype;
            $entry->job_type_id = $request->jobtypeid;
            $entry->location = $request->location;
            $entry->start_temp = $request->start_temp;
            $entry->end_temp = $request->end_temp;
            $entry->start_humidity = $request->start_humidity;
            $entry->end_humidity = $request->end_humidity;
            $entry->unit = $request->units;
            $entry->fixed_type = $request->fixed;
            $entry->asset_id = $request->assets;
            $entry->before_offset = $request->before_offset;
            $entry->after_offset = $request->after_offset;
            $entry->calibrated_by = auth()->user()->id;
            if ($entry->save()) {
                $labjob->save();
            }
            $x1 = [];
            $x2 = [];
            $x3 = [];
            $x4 = [];
            $x5 = [];
            $fixed = [];
            foreach ($request->x1 as $item) {
                $x1[] = $item;
            }
            foreach ($request->x2 as $item) {
                $x2[] = $item;
            }
            foreach ($request->x3 as $item) {
                $x3[] = $item;
            }
            foreach ($request->x4 as $item) {
                $x4[] = $item;
            }
            foreach ($request->x5 as $item) {
                $x5[] = $item;
            }
            foreach ($request->fixed_value as $item) {
                $fixed[] = $item;
            }
            for ($i = 0; $i < count($x1); $i++) {
                $item = new Dataentry();
                $item->fixed_value = $fixed[$i];
                $item->x1 = $x1[$i];
                $item->x2 = $x2[$i];
                $item->x3 = $x3[$i];
                $item->x4 = $x4[$i];
                $item->x5 = $x4[$i];
                $item->x6 = null;
                $item->parent_id = $entry->id;
                $item->save();
            }
        //}












        $job=Jobitem::find($request->jobtypeid);
           // dd($job);
        $entries=Dataentry::where('job_type',$job->type)->where('job_type_id',$request->jobtypeid)->with('child')->first();
        $allentries=Dataentry::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
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
            $uncertainty_of_standard_obtained_from_cert_of_ph_buffer=0;
            $uncertainty_due_to_function_generator=0;
            $uncertainty_due_to_temprature_stability_of_chamber=0;
            $uncertainty_due_to_drift_in_temprature=0;
            $uncertainty_due_to_resolution_of_std=0;
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
            //dd($average_repeated_value);
            //echo "Average Value of Repeated : ".$average_repeated_value;

            if ($entries->fixed_type=="Ref"){
                $reference=$entry->fixed_value;
                $uuc=$average_repeated_value;
            }
            if ($entries->fixed_type=="UUC"){
                $uuc=$entry->fixed_value;
                $reference=$average_repeated_value;
            }
            //echo 'Reference : '.$reference;
            //echo 'UUC : '.$uuc;

            //may be there will be need to use unit in manage reference query;
            $reference_table=Managereference::where('asset',$entries->asset_id)->get();
            if (count($reference_table)==0){
                return redirect()->back()->with('failed','Reference data is not available');
            }
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

            // echo 'Minimum Range ='.$min;
            //echo 'Maximum Range ='.$max;


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
                //dd($SD);
            }

            if (in_array('uncertainty-type-a',$uncertainties)){
                $uncertainty_Type_A=$SD/sqrt($n);
                //dd($uncertainty_Type_A);
            }
            if (in_array('uncertainty-due-to-resolution-of-std',$uncertainties)){
                $uncertainty_due_to_resolution_of_std=0;
                //dd($uncertainty_due_to_resolution_of_std);
            }

            if (in_array('uncertainty-due-to-resolution-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_resolution_of_uuc=(Jobitem::find($entries->job_type_id)->resolution/2)/sqrt(3);
                }
            }
            //dd($entries->before_offset);
            if (in_array('uncertainty-due-to-offset-of-uuc',$uncertainties)){
                $uncertainty_due_to_offset_of_uuc=$entries->before_offset/sqrt(3);
            }
            if (in_array('uncertainty-due-to-function-generator',$uncertainties)){
                $uncertainty_due_to_function_generator=0;
            }

            //dd($uncertainty_due_to_offset_of_uuc);
            if (in_array('uncertainty-due-to-accuracy-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_accuracy_of_uuc=(Jobitem::find($entries->job_type_id)->accuracy)/sqrt(3);
                }
            }
            //dd($uncertainty_due_to_accuracy_of_uuc);
            if (in_array('drift-of-the-standard',$uncertainties)){
                $drift_of_the_standard=$uncertainty_of_reference/sqrt(3);
            }
            if (in_array('uncertainty-due-to-temperature-stability-of-chamber',$uncertainties)){
                $uncertainty_due_to_temprature_stability_of_chamber=(Jobitem::find($entries->job_type_id)->resolution/2)/sqrt(3);
            }

            if (in_array('uncertainty-due-to-drift-in-temperature',$uncertainties)){
                //dd($entries->start_temp-$entries->end_temp);
                $uncertainty_due_to_drift_in_temprature=((($entries->start_temp+$entries->end_temp)/2)-23)*(0.0004/1000)/sqrt(3);
                //dd($uncertainty_due_to_drift_in_temprature);
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
            //dd($uncertainty_of_reference);
            if (in_array('combined-uncertainty-of-standard',$uncertainties)) {
                $combined_uncertainty_of_standard=$uncertainty_of_reference/2;
            }
            if (in_array('uncertainty-of-standard-obtained-from-cert-of-ph-buffer',$uncertainties)) {
                $uncertainty_of_standard_obtained_from_cert_of_ph_buffer=$uncertainty_of_reference/2;
            }

            //dd($combined_uncertainty_of_standard);
            //dd($drift_of_the_standard);
            $squresum=(pow($uncertainty_Type_A,2)+pow($combined_uncertainty_of_standard,2)+
                pow($uncertainty_due_to_resolution_of_uuc,2)+pow($uncertainty_due_to_accuracy_of_uuc,2)+pow($uncertainty_due_to_temprature_stability_of_chamber,2)+
                pow($drift_of_the_standard,2)+pow($uncertainty_due_to_offset_of_uuc,2)+pow($uncertainty_of_hysterisis,2)+pow($uncertainty_due_to_function_generator,2)+
                pow($uncertainty_due_to_drift_in_temprature,2)+pow($uncertainty_due_to_resolution_of_std,2));
            $combined_uncertainty=sqrt($squresum);
            $expanded_uncertainties=$combined_uncertainty*2;
            $data[$entry->fixed_value]=[
                'id'=>$entry->id,
                'standard-deviation'=>$SD,
                'uncertainty-type-a'=>$uncertainty_Type_A,
                'combined-uncertainty-of-standard'=>$combined_uncertainty_of_standard,
                'uncertainty-due-to-resolution-of-uuc'=>$uncertainty_due_to_resolution_of_uuc,
                'uncertainty-due-to-accuracy-of-uuc'=>$uncertainty_due_to_accuracy_of_uuc,
                'drift-of-the-standard'=>$drift_of_the_standard,
                'uncertainty-due-to-offset-of-uuc'=>$uncertainty_due_to_offset_of_uuc,
                'uncertainty-due-to-hysteresis-uuc'=>$uncertainty_of_hysterisis,
                'uncertainty-due-to-drift-in-temperature'=>$uncertainty_due_to_drift_in_temprature,
                'uncertainty-due-to-resolution-of-std'=>$uncertainty_due_to_resolution_of_std,
                'uncertainty-due-to-temperature-stability-of-chamber'=>$uncertainty_due_to_temprature_stability_of_chamber,
                'uncertainty-due-to-function-generator'=>$uncertainty_due_to_function_generator,
                'uncertainty-of-standard-obtained-from-cert-of-ph-buffer'=>$uncertainty_of_standard_obtained_from_cert_of_ph_buffer,
                'combined-uncertainty'=>$combined_uncertainty,
                'expanded-uncertainty'=>$expanded_uncertainties,
            ];
            $save_data=Dataentry::find($entry->id);
            $save_data->data=$data[$entry->fixed_value];
            $save_data->save();
        }

        return redirect()->back()->with('success','Entry added successfully');
        /*}*/
    }
}
