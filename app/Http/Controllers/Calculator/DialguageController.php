<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\DialgaugeEntries;
use App\Models\Jobitem;
use App\Models\Preference;
use App\Models\Procedure;
use App\Models\Unit;
use Illuminate\Http\Request;

class DialguageController extends Controller
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

        $as=Asset::find($parent->parent->assign_assets);
        $units=Unit::where('parameter',$as->parameter)->get();
        return view('calculator.dialgauge.create',compact('id','labs','parent','assets','units'));
    }
    public function store(Request $request){

        $parent=Calculatorentries::find($request->parent_id);
        //$reference_table=Managereference::where('asset',$request->assets)->get();
        //dd($reference_table);
        /*        if (count($reference_table)==0){
                    dd('reference data is not available');
                }*/
        $this->validate(request(), [
            'assets' => 'required',
            'units' => 'required',
            'x1' => 'required',
            'x2' => 'required',
            'x3' => 'required',
            'fixed_value' => 'required',
        ]);
        $x1 = [];
        $x2 = [];
        $x3 = [];
        $ref = [];
        foreach ($request->x1 as $item) {
            $x1[] = $item;
        }
        foreach ($request->x2 as $item) {
            $x2[] = $item;
        }
        foreach ($request->x3 as $item) {
            $x3[] = $item;
        }
        foreach ($request->fixed_value as $item) {
            $ref[] = $item;
        }
        for ($i = 0; $i < count($x1); $i++) {
            $item = new DialgaugeEntries();
            $item->parent_id = $request->parent_id;
            $item->x1 = $x1[$i];
            $item->x2 = $x2[$i];
            $item->x3 = $x3[$i];
            $item->ref = $ref[$i];
            $item->asset_id=$request->assets;
            $item->unit=$request->units;
            //$item->save();
        }
        $parent=Calculatorentries::find($request->parent_id);
        $parent->fixed_type=$request->fixed;
        $parent->save();
        $job=Jobitem::find($parent->job_type_id);
        $entries=Calculatorentries::find($request->parent_id);
        $allentries=DialgaugeEntries::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $entry){
            $formula=[];
            $formula['Ii']=array_sum([$entry->x1,$entry->x2,$entry->x3])/count([$entry->x1,$entry->x2,$entry->x3]);
            $formula['αm']=0.0000115;
            $uuc_temp=explode(',',$entries->uuc_temp);
            $uuc_temp=array_sum($uuc_temp)/count($uuc_temp);
            $formula['θm']=$uuc_temp-20;
            $formula['Ie']=$entry->ref;
            $formula['αe']=0.0000115;
            $ref_temp=explode(',',$entries->ref_temp);
            $ref_temp=array_sum($ref_temp)/count($ref_temp);
            $formula['θe']=$ref_temp-20;
            $formula['dF']=0;
            $formula['dθ']=$formula['θm']-$formula['θe'];
            $formula['dα']=$formula['αm']-$formula['αe'];
            $comp1=($formula['Ii']*(1+($formula['αm']*$formula['θe'])+($formula['αm']*$formula['dθ'])));
            $comp2=($formula['Ie']*(1+($formula['αm']*$formula['θe'])-($formula['dα']*$formula['θe'])));
            $UUC_readings_after_compensations=$comp1*$comp2;

            if (in_array('uncertainty-of-repeatability-ua',$uncertainties)){
                $square_sum=0;
                $all_repeated_values=[$entry->x1,$entry->x2,$entry->x3];
                $average_repeated_value=array_sum($all_repeated_values)/count($all_repeated_values);
                for($i=0;$i<count($all_repeated_values);$i++){
                    $temp=$average_repeated_value-$all_repeated_values[$i];
                    $square_sum=$square_sum+($temp*$temp);
                }
                $temp=$square_sum/(count($all_repeated_values)-1);
                $SD=sqrt($temp);
                $uncertainty_of_repeatability_ua=$SD*1000/sqrt(3);
                //dd($uncertainty_of_repeatability_ua);
            }
            if (in_array('uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical',$uncertainties)){
                $uncertainty_of_reading_of_the_result_max_permissible_error_of_uuc= 5/sqrt(3);
                //dd($uncertainty_of_reading_of_the_result_max_permissible_error_of_uuc);
            }
            if (in_array('uncertainty-of-thermal-expansion-coefficient-u-a-m',$uncertainties)){
                $uncertainty_of_thermal_expansion_coefficient_uam=100*(0.0000115)/sqrt(3);
            }
            if (in_array('uncertainty-of-guage-block-temp-difference-u-the',$uncertainties)){
                $uncertainty_of_guage_block_temp_difference_u_the=($formula['θe']/2)*$formula['αm']*(($formula['Ii']*100)-($formula['Ie']*1000));
            }
            if (in_array('uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th',$uncertainties)){
                $uncertainty_of_temp_diff_bw_ref_and_uuc_udth=($formula['dθ']/2)*($formula['Ii']*1000)*$formula['αm'];
            }
            if (in_array('uncertainty-of-calibration-of-standard-u-le',$uncertainties)){
                $uncertainty_of_calibration_of_standard_ule=['interpolation_required'];
            }
            if (in_array('uncertainty-of-thermal-expansion-co-efficient-difference-u-da',$uncertainties)){
                $uncertainty_of_thermal_expansion_co_efficient_difference_uda=(0.0000021/1.732)*($formula['Ii']*100*$formula['θe']);
            }
            if (in_array('uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df',$uncertainties)){
                $uncertaintyof_assumed_difference_bw_deformations_caused_by_measurement_force_udf=3/sqrt(3);
            }
            if (in_array('uncertainty-due-to-resolution-of-uuc',$uncertainties)){
                $uncertainty_due_to_resolution_of_uuc=5/sqrt(3);
            }
            $data=[
                "uncertainty-due-to-resolution-of-uuc"=>$uncertainty_due_to_resolution_of_uuc,
                "uncertainty-of-repeatability-ua"=>$uncertainty_of_repeatability_ua,
                "uncertainty-of-reading-of-the-result-max-permissible-error-of-uuc-u-li-1mm-for-digital-or-2-mm-for-classical"=>$uncertainty_of_reading_of_the_result_max_permissible_error_of_uuc,
                "uncertainty-of-thermal-expansion-coefficient-u-a-m"=>$uncertainty_of_thermal_expansion_coefficient_uam,
                "uncertainty-of-guage-block-temp-difference-u-the"=>$uncertainty_of_guage_block_temp_difference_u_the,
                "uncertainty-of-temp-diff-b-w-ref-and-uuc-u-d-th"=>$uncertainty_of_temp_diff_bw_ref_and_uuc_udth,
                "uncertainty-of-calibration-of-standard-u-le"=>$uncertainty_of_calibration_of_standard_ule,
                "uncertainty-of-thermal-expansion-co-efficient-difference-u-da"=>$uncertainty_of_thermal_expansion_co_efficient_difference_uda,
                "uncertaintyof-assumed-difference-b-w-deformations-caused-by-measurement-force-u-df"=>$uncertaintyof_assumed_difference_bw_deformations_caused_by_measurement_force_udf,
            ];

            dd($uncertainties);
            dd($formula);

        }

        return redirect()->back()->with('success','Entry added successfully');
        /*}*/
    }
}
