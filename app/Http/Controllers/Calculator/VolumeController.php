<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\Jobitem;
use App\Models\Managereference;
use App\Models\Preference;
use App\Models\Procedure;
use App\Models\Volumeentries;
use App\Models\Zvalues;
use Illuminate\Http\Request;

class VolumeController extends Controller
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
        return view('calculator.volume.create',compact('id','labs','parent','assets'));
    }
    public function store(Request $request){
        //dd($request->all());
        $parent=Calculatorentries::find($request->parent_id);
        $reference_table=Managereference::where('asset',$request->assets)->get();
        if (count($reference_table)==0){
            dd('reference data is not available');
//            return redirect()->back()->with('failed','Reference data is not available');
        }
//        dd($request->all());
        $this->validate(request(), [
            'assets' => 'required',
            'units' => 'required',
            'x1' => 'required',
            'x2' => 'required',
            'x3' => 'required',
            'y1' => 'required',
            'y2' => 'required',
            'y3' => 'required',
            'fixed_value' => 'required',
        ]);

        $x1 = [];
        $x2 = [];
        $x3 = [];
        $y1 = [];
        $y2 = [];
        $y3 = [];
        $fixed_value=[];
        foreach ($request->x1 as $item) {
            $x1[] = $item;
        }
        foreach ($request->x2 as $item) {
            $x2[] = $item;
        }
        foreach ($request->x3 as $item) {
            $x3[] = $item;
        }
        foreach ($request->y1 as $item) {
            $y1[] = $item;
        }
        foreach ($request->y2 as $item) {
            $y2[] = $item;
        }
        foreach ($request->y3 as $item) {
            $y3[] = $item;
        }
        foreach ($request->fixed_value as $item) {
            $fixed_value[] = $item;
        }


        for ($i = 0; $i < count($x1); $i++) {
            $item = new Volumeentries();
            $item->x1 = $x1[$i];
            $item->x2 = $x2[$i];
            $item->x3 = $x3[$i];
            $item->y1 = $y1[$i];
            $item->y2 = $y2[$i];
            $item->y3 = $y3[$i];

            $item->uuc=$fixed_value[$i];
            $item->asset_id=$request->assets;
            $item->unit=$request->units;
            $item->parent_id = $request->parent_id;
            //$item->save();
        }
        $parent=Calculatorentries::find($request->parent_id);
        $parent->fixed_type='uuc';
        $parent->save();

        $job=Jobitem::find($parent->job_type_id);
        $entries=Calculatorentries::find($request->parent_id);
        $allentries=Volumeentries::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);

        $weight_values=explode(',',$entries->balance_values);
        $weight_avg=array_sum($weight_values)/count($weight_values);
        $ranges=explode(',',$entries->parent->range);
        $ranges=array_reverse($ranges);
        $weight_ref_table=Managereference::where('asset',$entries->balance_id)->get();
        foreach ($weight_ref_table as $item) {
            $weight_intervals[]=$item->uuc;
            //echo (int)$item->uuc.'<br>';
        }
        $count=count($weight_intervals);
        if (in_array($ranges[0],$weight_intervals)){
            //echo '<h3>No interpolation needed</h3>';
            $map=array_search($ranges[0],$weight_intervals);
            //echo 'MAP : '.$map;
        }
        //interpolation needed
        else{
            // echo 'interpolation needed';
            for($i=0;$i<$count;$i++){
                if ($i<$count-1){
                    if ($ranges[0]>$weight_intervals[$i]){
                        if( $ranges[0]<$weight_intervals[$i+1]){
                            $min=$weight_intervals[$i];
                            $max=$weight_intervals[$i+1];
                        }
                    }
                }else{
                    if ($ranges[0]>$weight_intervals[$i]){
                        $max=$weight_intervals[$i];
                        $min=$weight_intervals[$i-1];
                    }
                }
            }
        }
        if ($min==null){
            if (!isset($map)){
                $min=$weight_intervals[0];
                $max=$weight_intervals[1];
            }else{
                $min=$weight_intervals[$map];
                $max=$weight_intervals[$map+1];
            }
        }

        $uuc=$ranges[0];
        // echo 'Minimum Range ='.$min;
        //echo 'Maximum Range ='.$max;



        if (isset($map)){
            foreach ($weight_ref_table as $item) {
                if ($item->uuc==$weight_intervals[$map]){
                    $uncertainty_of_mass=$item->uncertainty;
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
                    $uncertainty_of_mass=$item->uncertainty;

                }
                if ($item->uuc==$max){
                    $uncertainty_of_mass=$item->uncertainty;
                    $max_error=$item->error;
                }
            }
            $error=((($ranges[0]-$min)*($max_error-$min_error))/($max-$min))+$min_error;
            //echo 'Error of Std : '.$error;
            $reference=$ranges[0]-$error;
            $final_error=$uuc-$reference;
        }

        if (!isset($weight_intervals)){
            return redirect()->back()->with('failed','Reference data is not available');

        }


        $corrected_weight=$weight_avg-$reference;


        $temp_values=explode(',',$entries->temp_values);
        $temp_avg=array_sum($temp_values)/count($temp_values);
        $corrected_temp=$temp_avg-20;

        $data=array();
        foreach ($allentries as $entry){
            //dd($entry);
            //all uncertainties declaration
            $SD=0;
            //calculations

            $x1=($entry->x1)?$entry->x1:null;
            $x2=($entry->x2)?$entry->x2:null;
            $x3=($entry->x3)?$entry->x3:null;

            $y1=($entry->y1)?$entry->y1:null;
            $y2=($entry->y2)?$entry->y2:null;
            $y3=($entry->y3)?$entry->y3:null;

            $nx1=$y1-$x1;
            $nx2=$y2-$x2;
            $nx3=$y3-$x3;

            $avg_nx=array_sum([$nx1,$nx2,$nx3])/count([$nx1,$nx2,$nx3]);

            $intervals=[];
            //echo '<br>START INTERVALS<br>';
            foreach ($reference_table as $item) {
                $intervals[]=$item->uuc;
                //echo (int)$item->uuc.'<br>';
            }

            if (!isset($intervals)){
                return redirect()->back()->with('failed','Reference data is not available');

            }
            $reference=$avg_nx;
            //dd($intervals,$reference);
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

            $uuc=$entry->uuc_indication;
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
                //$final_error=$reference-$uuc;
            }

            //start z-value
            $class=strtoupper($entries->class);
            $avg_ap=($entries->end_atmospheric_pressure+$entries->start_atmospheric_pressure)/2;
            $ap_sdk=(987+1013)/2;
            if ($avg_ap<=$ap_sdk){
                $ap=987;
            }else{
                $ap=1013;
            }
            $temp_avg=round($temp_avg,0);
            $temp_avg=(int)$temp_avg;
            $z=Zvalues::where('class',$class)->where('atm_pressure',$ap)->where('temperature',$temp_avg)->first();
            $z_index=$z->z_value;
            //end start z-value

            $v20=$reference*$z_index;
            if ($class=='A'){
                $a=0.00001;
            }
            if ($class=='B'){
                $a=0.000025;
            }
            $vt=$v20*(1+($a*($temp_avg-20)));

            $square_sum=0;
            $all_repeated_values=[$nx1,$nx2,$nx3];
            for($i=0;$i<count([$nx1,$nx2,$nx3]);$i++){
                $temp=$avg_nx-$all_repeated_values[$i];
                $square_sum=$square_sum+($temp*$temp);
            }
            $temp=$square_sum/(count([$nx1,$nx2,$nx3])-1);
            if (in_array('standard-deviation',$uncertainties)){
                $SD=sqrt($temp);
                //dd($SD);
            }
            if (in_array('uncertainty-type-a',$uncertainties)){
                $uncertainty_Type_A=$SD/sqrt(3);
                //dd($uncertainty_Type_A);
            }
            if(in_array('relative-combined-uncertainty-of-standard-ub1',$uncertainties)){
                $balancerange=array_reverse($intervals);
                $relative_combined_uncertainty_of_standard_ub1=$uncertainty_of_mass/2/$balancerange[0];
                //dd('relative-combined-uncertainty-of-standard-ub1');
            }
            $max_range_temp=0;
            if(in_array('relative-combined-uncertainty-thermometer-ub3',$uncertainties)){
                $temp_ref=Managereference::where('asset',$entries->temp_id)->get();
                foreach ($temp_ref as $item) {
                    $temp_intervals[]=$item->uuc;
                    //echo (int)$item->uuc.'<br>';
                }
                $count=count($temp_intervals);
                if (in_array($temp_avg,$temp_intervals)){
                    $map=array_search($temp_avg,$temp_intervals);
                }
                else{
                    for($i=0;$i<$count;$i++){
                        if ($i<$count-1){
                            if ($temp_avg>$temp_intervals[$i]){
                                if( $temp_avg<$temp_intervals[$i+1]){
                                    $min=$temp_intervals[$i];
                                    $max=$temp_intervals[$i+1];
                                }
                            }
                        }else{
                            if ($temp_avg>$temp_intervals[$i]){
                                $max=$temp_intervals[$i];
                                $min=$temp_intervals[$i-1];
                            }
                        }
                    }
                }
                if ($min==null){
                    if (!isset($map)){
                        $min=$temp_intervals[0];
                        $max=$temp_intervals[1];
                    }else{
                        $min=$temp_intervals[$map];
                        $max=$temp_intervals[$map+1];
                    }
                }

                if (isset($map)){
                    foreach ($temp_ref as $item) {
                        if ($item->uuc==$temp_intervals[$map]){
                            $uncertainty_of_temp=$item->uncertainty;

                        }
                    }
                }
                else{
                    $min_error=null;
                    $max_error=null;
                    foreach ($temp_ref as $item) {
                        if ($item->uuc==$min){
                            $uncertainty_of_temp=$item->uncertainty;
                        }
                        if ($item->uuc==$max){
                            $uncertainty_of_temp=$item->uncertainty;
                        }
                    }
                }

                $temp_range=array_reverse($temp_intervals);
                $temp_range=$temp_range[0];
                $max_range_temp=$temp_range;
                $relative_combined_uncertainty_thermometer_ub3=$uncertainty_of_temp/2/$temp_range;
            }
            if(in_array('relative-combined-uncertainty-of-balance-ub2',$uncertainties)){
                $balancerange=array_reverse($intervals);
                $relative_combined_uncertainty_of_balance_ub2=$uncertainty_of_reference/2/$balancerange[0];
            }

            if(in_array('relative-uncertainty-due-to-resolution-of-uuc-ub4',$uncertainties)){
                $rangeofuuc=explode(',',$entries->parent->range);
                $rangeofuuc=array_reverse($rangeofuuc);
                $rangeofuuc=$rangeofuuc[0];
                $relative_uncertainty_due_to_resolution_of_uuc_ub4=$entries->parent->resolution/2/$rangeofuuc;
            }
            if(in_array('relative-uncertainty-due-to-drift-of-the-std-balance-ub5',$uncertainties)){
                $relative_uncertainty_due_to_drift_of_the_std_balance_ub5=0;
            }
            if(in_array('relative-uncertainty-due-to-temp-drift-of-water-ub6',$uncertainties)){
                $relative_uncertainty_due_to_temp_drift_of_water_ub6=(0.00024725*$entry->uuc*($temp_avg-20))/sqrt(3)/$max_range_temp;
                //dd($relative_uncertainty_due_to_drift_of_the_std_balance_ub5);

            }
            if(in_array('relative-uncertainty-due-to-tolerance-of-uuc-ub7',$uncertainties)){
                $relative_uncertainty_due_to_tolerance_of_uuc_ub7=$entries->tolerance/2/sqrt(3)/$entry->uuc;

            }

            if(in_array('relative-uncertainty-due-density-ofaair-ub8',$uncertainties)){
                $avg_temp=($parent->start_temp+$parent->end_temp)/2;
                $avg_humidity=($parent->start_humidity+$parent->end_humidity)/2;
                $avg_ap=($parent->start_atmospheric_pressure+$parent->end_atmospheric_pressure)/2;

                $pa=((0.348444*$avg_ap)-($avg_humidity*((0.00252*$avg_temp)-0.020582)))/(273.15+$avg_temp);
                $relative_uncertainty_due_density_ofaair_ub8=0.0000005/sqrt(3)/$pa;
            }
            if(in_array('relative-uncertainty-due-to-water-density-tanaka-s-value-ub9',$uncertainties)){
                $relative_uncertainty_due_to_water_density_tanaka_s_value_ub9=0.000001;
            }
            if(in_array('relative-uncertainty-due-to-thermal-expansion-coefficient-of-uuc-ub11',$uncertainties)){
                $relative_uncertainty_due_to_thermal_expansion_coefficient_of_uuc_ub11=0.00000001;
            }






            //dd($combined_uncertainty_of_standard);
            //dd($drift_of_the_standard);
            $squresum=(pow($relative_combined_uncertainty_of_standard_ub1,2)+
                pow($relative_combined_uncertainty_of_balance_ub2,2)+
                pow($relative_combined_uncertainty_thermometer_ub3,2)+
                pow($relative_uncertainty_due_to_resolution_of_uuc_ub4,2)+
                pow($relative_uncertainty_due_to_drift_of_the_std_balance_ub5,2)+
                pow($relative_uncertainty_due_to_temp_drift_of_water_ub6,2)+
                pow($relative_uncertainty_due_to_tolerance_of_uuc_ub7,2)+
                pow($relative_uncertainty_due_density_ofaair_ub8,2)+
                pow($relative_uncertainty_due_to_water_density_tanaka_s_value_ub9,2)+
                pow($relative_uncertainty_due_to_thermal_expansion_coefficient_of_uuc_ub11,2)
            );
            $combined_uncertainty=sqrt(1.19203);
            $expanded_uncertainties=$combined_uncertainty*2;
            $data=[
                'id'=>$entry->id,
                'final-error'=>$final_error,
                'standard-deviation'=>$SD,
                'uncertainty-type-a'=>$uncertainty_Type_A,




                'combined-uncertainty'=>$combined_uncertainty,
                'expanded-uncertainty'=>$expanded_uncertainties,
            ];
        }

        return redirect()->back()->with('success','Entry added successfully');

    }
}
