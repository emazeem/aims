<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\IncubatorCalculator;
use App\Models\Incubatormapping;
use App\Models\Jobitem;
use App\Models\Managereference;
use App\Models\Massreference;
use App\Models\Preference;
use App\Models\Procedure;
use Illuminate\Http\Request;

class IncubatorController extends Controller
{
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

        return view('calculator.incubator.create',compact('id','labs','parent','assets'));
    }
    public function store(Request $request){
        $parent=Calculatorentries::find($request->parent_id);
        $reference_table=Managereference::where('asset',$request->assets)->get();
        if (count($reference_table)==0){
            dd('reference data is not available');
//            return redirect()->back()->with('failed','Reference data is not available');
        }

//        dd($request->all());
        $this->validate(request(), [
            'set_value' => 'required',
            'uuc_indication' => 'required',
            'x1' => 'required',
            'x2' => 'required',
            'x3' => 'required',
        ]);
        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);
        if (in_array($request->assets,$hasChannels)){
            $this->validate(request(), [
                'channels' => 'required',
            ],[
                'channels.required'=>'Channels field is required *',
            ]);
        }

        $x1 = [];
        $x2 = [];
        $x3 = [];
        $uuc_indication = [];
        $set_value = [];
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
        foreach ($request->set_value as $item) {
            if (isset($request->mulitplying_factor) and $request->multiplying_factor!=0){
                $set_value[] = $item*$request->mulitplying_factor;
            }else{
                $set_value
                [] = $item;
            }
        }        foreach ($request->uuc_indication as $item) {
            if (isset($request->mulitplying_factor) and $request->multiplying_factor!=0){
                $uuc_indication[] = $item*$request->mulitplying_factor;
            }else{
                $uuc_indication[] = $item;
            }
        }

        for ($i = 0; $i < count($x1); $i++) {
            $item = new IncubatorCalculator();
            $item->uuc_indication = $uuc_indication[$i];
            $item->set_value = $set_value[$i];
            $item->x1 = $x1[$i];
            $item->x2 = $x2[$i];
            $item->x3 = $x3[$i];
            $item->asset_id=$request->assets;
            $item->unit=$request->units;
            $item->parent_id = $request->parent_id;
            $item->channel = $request->channels;
            //$item->save();
        }
        //dd('saved');
        $parent=Calculatorentries::find($request->parent_id);
        $parent->fixed_type=$request->fixed;
        $parent->save();
        $job=Jobitem::find($parent->job_type_id);
        $entries=Calculatorentries::find($request->parent_id);
        $allentries=IncubatorCalculator::where('parent_id',$entries->id)->get();
        $procedure = Procedure::find($job->item->capabilities->procedure);
        $uncertainties=explode(',',$procedure->uncertainties);
        dd($uncertainties);
        $data=array();
        foreach ($allentries as $entry){
            //all uncertainties declaration
            $SD=0;
            //calculations
            $n=0;
            $x1=($entry->x1)?$entry->x1:null;
            $x2=($entry->x2)?$entry->x2:null;
            $x3=($entry->x3)?$entry->x3:null;

            if (isset($x1)){$n++;}
            if (isset($x2)){$n++;}
            if (isset($x3)){$n++;}
            $average_repeated_value=($x1+$x2+$x3)/$n;
            $reference_table=Managereference::where('asset',$request->assets)->where('channel',$request->channels)->get();
            $intervals=[];
            //echo '<br>START INTERVALS<br>';
            foreach ($reference_table as $item) {
                $intervals[]=$item->uuc;
                //echo (int)$item->uuc.'<br>';
            }

            if (!isset($intervals)){
                return redirect()->back()->with('failed','Reference data is not available');

            }
           $reference=$average_repeated_value;
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
                $reference=$reference+$error;
                $final_error=$reference-$uuc;
            }
            $square_sum=0;
            $all_repeated_values=[$x1,$x2,$x3];
            for($i=0;$i<$n;$i++){
                $temp=$average_repeated_value-$all_repeated_values[$i];
                $square_sum=$square_sum+($temp*$temp);
            }
            //dd($all_repeated_values);
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
                    //dd($uncertainty_due_to_resolution_of_uuc);
                }
            }

            //dd($uncertainty_of_reference);
            $combined_uncertainty_of_standard=$uncertainty_of_reference/2;



            //dd($combined_uncertainty_of_standard);
            //dd($drift_of_the_standard);
            $squresum=(pow($uncertainty_Type_A,2)+pow($combined_uncertainty_of_standard,2)+
                pow($uncertainty_due_to_resolution_of_uuc,2)+pow($uncertainty_due_to_resolution_of_std,2));

            $combined_uncertainty=sqrt(1.19203);
            $expanded_uncertainties=$combined_uncertainty*2;
            $data=[
                'id'=>$entry->id,
                'final-error'=>$final_error,
                'standard-deviation'=>$SD,
                'uncertainty-type-a'=>$uncertainty_Type_A,
                'combined-uncertainty-of-standard'=>$combined_uncertainty_of_standard,
                'uncertainty-due-to-resolution-of-uuc'=>$uncertainty_due_to_resolution_of_uuc,
                'combined-uncertainty'=>$combined_uncertainty,
                'expanded-uncertainty'=>$expanded_uncertainties,
            ];

            $save_data=IncubatorCalculator::find($entry->id);
            $save_data->data=$data;
            $save_data->save();
        }

        return redirect()->back()->with('success','Entry added successfully');

    }
    //
}
