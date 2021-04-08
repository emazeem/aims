<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\Jobitem;
use App\Models\Managereference;
use App\Models\Preference;
use App\Models\Procedure;
use App\Models\Unit;
use App\Models\Vernierentries;
use Illuminate\Http\Request;

class VernierentriesController extends Controller
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
        return view('calculator.vernier.create',compact('id','labs','parent','assets','units'));
    }
    public function store(Request $request){
        //dd($request->all());
        $parent=Calculatorentries::find($request->parent_id);
        $reference_table=Managereference::where('asset',$request->assets)->get();
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
            $item = new Vernierentries();
            $item->parent_id = $request->parent_id;
            $item->x1 = $x1[$i];
            $item->x2 = $x2[$i];
            $item->x3 = $x3[$i];
            $item->ref = $ref[$i];
            $item->asset_id=$request->assets;
            $item->unit=$request->units;
        //    $item->save();
        }
        //dd('saced');
        $parent=Calculatorentries::find($request->parent_id);
        $parent->fixed_type=$request->fixed;
        $parent->save();
        $job=Jobitem::find($parent->job_type_id);
        $entries=Calculatorentries::find($request->parent_id);
        $allentries=Vernierentries::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        $data=array();
        foreach ($allentries as $entry){

            $square_sum=0;
            $all_repeated_values=[$entry->x1,$entry->x2,$entry->x3];
            $average_repeated_value=array_sum($all_repeated_values)/count($all_repeated_values);
            for($i=0;$i<count($all_repeated_values);$i++){
                $temp=$average_repeated_value-$all_repeated_values[$i];
                $square_sum=$square_sum+($temp*$temp);
            }
            //dd($n);
            $temp=$square_sum/(count($all_repeated_values)-1);
            if (in_array('standard-deviation',$uncertainties)){
                $SD=sqrt($temp);
                //dd($SD);
            }
            if (in_array('uncertainty-type-a',$uncertainties)){
                $uncertainty_Type_A=$SD/sqrt(count($all_repeated_values));
            }
            if (in_array('combined-uncertainty-of-standard',$uncertainties)) {
                $combined_uncertainty_of_standard=$uncertainty_of_reference/2;
            }
            if (in_array('uncertainty-due-to-resolution-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_resolution_of_uuc=(Jobitem::find($entries->job_type_id)->resolution/2)/sqrt(3);
                }
            }
            if (in_array('uncertainty-due-to-accuracy-of-uuc',$uncertainties)){
                if ($entries->job_type==0){
                    $uncertainty_due_to_accuracy_of_uuc=(Jobitem::find($entries->job_type_id)->accuracy)/sqrt(3);
                }
            }
            $reproducibility=explode(',',$entries->reproducibility);
            $noise=explode(',',$entries->noise);
            $baseline=explode(',',$entries->baseline);
            $stability=explode(',',$entries->stability);
            if ($entry->unit==58){
                $uncertainty_due_to_reproducibility=$reproducibility[0]/sqrt(10);
                $uncertainty_due_to_noise=$noise[0]/sqrt(3);
                $uncertainty_due_to_baseline=$baseline[0]/sqrt(3);
                $uncertainty_due_to_stability=$stability[0]/2/sqrt(3);
            }
            if ($entry->unit==57){
                $uncertainty_due_to_reproducibility=$reproducibility[1]/sqrt(10);
                $uncertainty_due_to_noise=$noise[1]/sqrt(3);
                $uncertainty_due_to_baseline=$baseline[1]/sqrt(3);
                $uncertainty_due_to_stability=$stability[1]/2/sqrt(3);
            }
            if ($entry->unit==56){
                $uncertainty_due_to_reproducibility=$reproducibility[2]/sqrt(10);
                $uncertainty_due_to_noise=$noise[2]/sqrt(3);
                $uncertainty_due_to_baseline=$baseline[2]/sqrt(3);
                $uncertainty_due_to_stability=$stability[2]/2/sqrt(3);
            }
        }

        return redirect()->back()->with('success','Entry added successfully');
        /*}*/
    }
}
