<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Incubatormapping;
use App\Models\Managereference;
use Illuminate\Http\Request;

class IncubatormappingController extends Controller
{
    public function store(Request $request){
        if (isset($request->other)){
            if ($request->other=='other'){
                $this->validate($request,[
                    'normal'=>'required',
                    'black'=>'required',
                    'start'=>'required',
                    'end'=>'required',
                ]);
                $ex=Incubatormapping::where('parent_id',$request->parent_id)->where('time_interval',0)->first();
                if ($ex){
                    $mapping=Incubatormapping::find($ex->id);
                    $message='Data Updated Successfully';

                }else{
                    $mapping=new Incubatormapping();
                    $message='Data Added Successfully';
                }
                $mapping->parent_id=$request->parent_id;
                $mapping->channel_1=0;
                $mapping->channel_2=0;
                $mapping->channel_3=0;
                $mapping->channel_4=0;
                $mapping->channel_5=0;
                $mapping->channel_6=0;
                $mapping->channel_7=0;
                $mapping->channel_8=0;
                $mapping->channel_9=0;
                $mapping->channel_10=0;
                $mapping->uuc_reading=0;
                $mapping->time_interval=0;
                $data=[
                    'start_time'=>$request->start,
                    'end_time'=>$request->end,
                    'normal'=>$request->normal,
                    'black'=>$request->black,
                ];
                $data=json_encode($data);
                $mapping->data=$data;
                $mapping->save();
                return redirect()->back()->with('success',$message);
            }
        }
        $this->validate($request,[
            'uuc_readings'=>'required',
            'channel_1'=>'required',
            'channel_2'=>'required',
            'channel_3'=>'required',
            'channel_4'=>'required',
            'channel_5'=>'required',
            'channel_6'=>'required',
            'channel_7'=>'required',
            'channel_8'=>'required',
            'channel_9'=>'required',
            'channel_10'=>'required',
        ]);

        $exist=Incubatormapping::where('parent_id',$request->parent_id)->where('time_interval',$request->time_interval)->first();
        if ($exist){
            $mapping=Incubatormapping::find($exist->id);
        }else{
            $mapping=new Incubatormapping();
        }
        $mapping->parent_id=$request->parent_id;
        $mapping->channel_1=$request->channel_1;
        $mapping->channel_2=$request->channel_2;
        $mapping->channel_3=$request->channel_3;
        $mapping->channel_4=$request->channel_4;
        $mapping->channel_5=$request->channel_5;
        $mapping->channel_6=$request->channel_6;
        $mapping->channel_7=$request->channel_7;
        $mapping->channel_8=$request->channel_8;
        $mapping->channel_9=$request->channel_9;
        $mapping->channel_10=$request->channel_10;
        $mapping->uuc_reading=$request->uuc_readings;
        $mapping->time_interval=$request->time_interval;
        $message=($exist)?'Thermal Mapping Data Updated Successfully':'Thermal Mapping Data Saved Successfully';
        //$mapping->save();
        $entries=Incubatormapping::with('parent')->where('parent_id',$request->parent_id)->where('time_interval','!=',0)->get();
        if (count($entries)==30){
            $channelavg1=0;
            $channelavg2=0;
            $channelavg3=0;
            $channelavg4=0;
            $channelavg5=0;
            $channelavg6=0;
            $channelavg7=0;
            $channelavg8=0;
            $channelavg9=0;
            $channelavg10=0;
            $sd=[];
            $sum=0;
            foreach ($entries as $entry){
                $channelavg1=$channelavg1+$entry->channel_1;
                $channelavg2=$channelavg2+$entry->channel_2;
                $channelavg3=$channelavg3+$entry->channel_3;
                $channelavg4=$channelavg4+$entry->channel_4;
                $channelavg5=$channelavg5+$entry->channel_5;
                $channelavg6=$channelavg6+$entry->channel_6;
                $channelavg7=$channelavg7+$entry->channel_7;
                $channelavg8=$channelavg8+$entry->channel_8;
                $channelavg9=$channelavg9+$entry->channel_9;
                $channelavg10=$channelavg10+$entry->channel_10;
            }


            $channelavg1=$channelavg1/count($entries);
            $channelavg2=$channelavg2/count($entries);
            $channelavg3=$channelavg3/count($entries);
            $channelavg4=$channelavg4/count($entries);
            $channelavg5=$channelavg5/count($entries);
            $channelavg6=$channelavg6/count($entries);
            $channelavg7=$channelavg7/count($entries);
            $channelavg8=$channelavg8/count($entries);
            $channelavg9=$channelavg9/count($entries);
            $channelavg10=$channelavg10/count($entries);

            $channels=[
              '1'=>$channelavg1,
              '2'=>$channelavg2,
              '3'=>$channelavg3,
              '4'=>$channelavg4,
              '5'=>$channelavg5,
              '6'=>$channelavg6,
              '7'=>$channelavg7,
              '8'=>$channelavg8,
              '9'=>$channelavg9,
              '10'=>$channelavg10
            ];
            $sd=[];
            foreach ($channels as $k=>$channel){
                $sum=0;
                foreach ($entries as $entry){
                    $t='channel_'.$k;
                    $sum=$sum+(($channel-$entry[$t])*($channel-$entry[$t]));

                }
                $sd[$k]=sqrt($sum/(count($entries)-1));
            }
            $overall_mean=array_sum($channels)/count($channels);
            $overall_std=0;
            $ajflkr=0;
            $sdbar=array_sum($sd)/(count($sd));
            foreach ($sd as $item){
                $ajflkr=$ajflkr+(($sdbar-$item)*($sdbar-$item));
            }
            $overall_std=$ajflkr/(count($sd)-1);
            $corrected_values=[
              '1'=>null,
              '2'=>null,
              '3'=>null,
              '4'=>null,
              '5'=>null,
              '6'=>null,
              '7'=>null,
              '8'=>null,
              '9'=>null,
              '10'=>null
            ];
            $other=Incubatormapping::with('parent')->where('parent_id',$request->parent_id)->where('time_interval','=',0)->first();
            $other=json_decode($other->data,true);

            $normal_column='channel_'.$other['normal'];
            $black_column='channel_'.$other['black'];
            $normal=Incubatormapping::with('parent')->where('parent_id',$request->parent_id)->where('time_interval','!=',0)->pluck($normal_column);
            $black=Incubatormapping::with('parent')->where('parent_id',$request->parent_id)->where('time_interval','!=',0)->pluck($black_column);
            $normal_min=$normal->min();
            $normal_max=$normal->max();
            $normal_avg=array_sum($normal->toArray())/count($normal);

            $black_min=$black->min();
            $black_max=$black->max();
            $black_avg=array_sum($black->toArray())/count($black);
            //dd($black_avg);
            foreach ($entries as $k=>$entry){
                if ($k==0){
                    foreach ($channels as $m=>$channel){
                        $reference_table=Managereference::where('asset',$entry->parent->incubatorentry->asset_id)->where('channel',$m)->get();
                        if (count($reference_table)==0){
                            echo 'reference not available';
                            continue;
                            //return redirect()->back()->with('failed','Reference data is not available');
                        }
                        $intervals=[];
                        foreach ($reference_table as $item) {
                            $intervals[]=$item->uuc;
                        }
                        $reference=$channels[$m];
                        $min=null;$max=null;$count=count($intervals);
                        if (in_array($reference,$intervals)){
                            $map=array_search($reference,$intervals);
                        }
                        else{
                            for($i=0;$i<$count;$i++){
                                if ($i<$count-1){
                                    if ($reference>$intervals[$i]){
                                        if( $reference<$intervals[$i+1]){
                                            $min=$intervals[$i];
                                            $max=$intervals[$i+1];
                                        }
                                    }
                                }
                                else{
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
                                    $final_error=$item->error;
                                    $error=$reference+$final_error;
                                }
                            }
                        }
                        else{
                            $min_error=null;
                            $max_error=null;
                            foreach ($reference_table as $item) {
                                if ($item->uuc==$min){
                                    $min_error=$item->error;

                                }
                                if ($item->uuc==$max){
                                    $max_error=$item->error;
                                }
                            }
                            $error=((($reference-$min)*($max_error-$min_error))/($max-$min))+$min_error;
                            $error=$reference-$error;
                        }
                        $corrected_values[$m]=$error;
                    }
                }
            }
        }

        $uncertainty_due_to_repaetability_of_indication_of_uuc=0;
        $uncertainty_due_to_inhomogeneity_of_uuc=0;
        $uncertainty_due_to_temp_instability_of_uuc=0;
        $uncertainty_due_to_radiation_effect=0;
        $uncertainty_due_to_loading_effect=0;
        $uuc_reading=$entries->pluck('uuc_reading')->toArray();
        $uuc_average=array_sum($uuc_reading)/count($uuc_reading);
        $asndf=0;
        foreach ($uuc_reading as $item){
            $asndf=$asndf+(($uuc_average-$item)*($uuc_average-$item));
        }
        $uncertainty_due_to_repaetability_of_indication_of_uuc=sqrt($asndf/(count($uuc_reading)-1));
        //dd($uncertainty_due_to_repaetability_of_indication_of_uuc);
        $inhomogeniety=[];
        foreach ($entries as $entry){
            for ($i=1;$i<=10;$i++){
                $index='channel_'.$i;
                $inhomogeniety[]=$entry[$index];
            }
        }
        $uncertainty_due_to_inhomogeneity_of_uuc=(max($inhomogeniety)-(array_sum($inhomogeniety)/count($inhomogeniety)))/sqrt(3);

        $instability=$entries->pluck('uuc_reading')->toArray();
        $other=Incubatormapping::with('parent')->where('parent_id',$request->parent_id)->where('time_interval','=',0)->first();
        $other=json_decode($other->data,true);
        $normal_column='channel_'.$other['normal'];
        $black_column='channel_'.$other['black'];
        $instability_normal=$entries->pluck($normal_column)->toArray();
        $instability_black=$entries->pluck($black_column)->toArray();

        $instability_max=[max($instability)-(array_sum($instability)/count($instability)),max($instability_normal)-(array_sum($instability_normal)/count($instability_normal))];
        $uncertainty_due_to_temp_instability_of_uuc=max($instability_max)/sqrt(3);

        $uncertainty_due_to_radiation_effect=((array_sum($instability_normal)/count($instability_normal))-(array_sum($instability_black)/count($instability_black))*0.2)/sqrt(3);
        $uncertainty_due_to_loading_effect=(array_sum($instability_normal)/count($instability_normal))-(array_sum($instability_black)/count($instability_black))/sqrt(3);
        $data=[
            'uncertainty-due-to-repeatability-of-indication-of-uuc-u6'=>$uncertainty_due_to_repaetability_of_indication_of_uuc,
            'uncertainty-due-to-temp-inhomogenity-of-uuc-u7'=>$uncertainty_due_to_inhomogeneity_of_uuc,
            'uncertainty-due-to-temp-instability-of-uuc-u8'=>$uncertainty_due_to_temp_instability_of_uuc,
            'uncertainty-due-to-radiation-effect-u9'=>$uncertainty_due_to_radiation_effect,
            'uncertainty-due-to-loading-effect-u10'=>$uncertainty_due_to_loading_effect,

        ];
        //return redirect()->back()->with('success',$message);
    }
    //
}
