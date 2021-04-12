<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Balancedataentries;
use App\Models\Calculatorentries;
use App\Models\Dataentry;
use App\Models\Generaldataentries;
use App\Models\Job;
use App\Models\Jobitem;
use App\Models\Managereference;
use App\Models\Massreference;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Quotes;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;
use phpDocumentor\Reflection\DocBlock;

class BalanceCalculatorController extends Controller
{
    public function create($id,Request $request){
        $this->validate(request(), [
            'assets' => 'required',
            'units' => 'required',
        ]);
        $p=Preference::where('slug','aims-labs')->first();
        $labs=Preference::where('category',$p->id)->get();
        $parent=Calculatorentries::find($id);
        $assets=$request->assets;
        $units=$request->units;
        $nominal_masses=Managereference::where('asset',$assets)->get();
        return view('calculator.balance.create',compact('id','labs','parent','assets','units','nominal_masses'));
    }
    public function store(Request $request){
        $parent=Calculatorentries::find($request->parent_id);
       /*$reference_table=Managereference::where('asset',$parent->asset_id)->get();
       if (count($reference_table)==0){
            return redirect()->back()->with('failed','Reference data is not available');
        }*/

       $this->validate(request(), [
            'nominal_mass' => 'required',
            'x1' => 'required',
            'x2' => 'required',
            'x3' => 'required',
            'x4' => 'required',
        ]);
        $item = new Generaldataentries();
        $item->fixed_value = implode(',',$request->nominal_mass);
        $item->x1 = $request->x1;
        $item->x2 = $request->x2;
        $item->x3 = $request->x3;
        $item->x4 = $request->x4;
        $item->parent_id = $request->parent_id;
        //$item->save();
        dd('saved');
        $item=Generaldataentries::find($item->id);
        $avg_temp=($parent->start_temp+$parent->end_temp)/2;
        $avg_humidity=($parent->start_humidity+$parent->end_humidity)/2;
        $avg_ap=($parent->start_atmospheric_pressure+$parent->end_atmospheric_pressure)/2;

        $pa=((0.348444*$avg_ap)-($avg_humidity*((0.00252*$avg_temp)-0.020582)))/(273.15+$avg_temp);

        $dev_temp=abs(($parent->start_temp-$parent->end_temp)/2);
        $dev_humidity=abs(($parent->start_humidity-$parent->end_humidity)/2);
        $dev_ap=abs(($parent->start_atmospheric_pressure-$parent->end_atmospheric_pressure)/2);

        $u_temp=$dev_temp/(2*sqrt(3));
        $u_humidity=$dev_humidity/(2*sqrt(3));
        $u_ap=$dev_ap/(2*sqrt(3));

        $relative_u= sqrt(((0.001*$u_ap)*(0.001*$u_ap))+((-0.004*$u_temp)*(-0.004*$u_temp))+((-0.009*$u_humidity)*(-0.009*$u_humidity))+(0.000679*0.000679));
        $standard_u_in_air_density=$relative_u*$pa;

        $pp=json_decode($parent->pan_position,true);
        $avg_center=($pp['center1']+$pp['center2'])/2;
        $dev_rare=abs($pp['rare']-$avg_center);
        $dev_weight=abs($pp['weight']-$avg_center);
        $dev_right=abs($pp['right']-$avg_center);
        $dev_left=abs($pp['left']-$avg_center);
        $dev_front=abs($pp['front']-$avg_center);
        $pp_error=max([$dev_rare,$dev_weight,$dev_right,$dev_left,$dev_front]);

        $ref_mass=explode(',',$parent->repeatability);
        $avg_ref_mass=array_sum($ref_mass)/count($ref_mass);

        $nskdflsd=0;
        foreach ($ref_mass as $mass){
            $nskdflsd=$nskdflsd+(($mass-$avg_ref_mass)*($mass-$avg_ref_mass));
        }
        $sd_repeatability=sqrt($nskdflsd/(count($ref_mass)-1));
        $typeA_repeatability=$sd_repeatability/sqrt(count($ref_mass));

        $nlskdfnlsads=explode(',',$item->fixed_value);
        $nominal_mass=0;
        $volumeofweights=0;
        $totalweightdensity=[];
        $refuncertainty=0;
        foreach ($nlskdfnlsads as $nlskdfnlsad){
            $dsfsl=Managereference::find($nlskdfnlsad);
            $refuncertainty=$refuncertainty+$dsfsl->uncertainty;
            $nominal_mass=$nominal_mass+$dsfsl->ref;
            $massref=Massreference::where('parent_id',$dsfsl->id)->first();
            if (!$massref){
                return back()->with('success','Mass details are not added');
            }else{
                $volumeofweights=$volumeofweights+$massref->volume;
                $totalweightdensity[]=$massref->volume;
            }
        }
        $pnod=1.20139;
        $conventionaldensity=8000;
        $totalweightdensity=max($totalweightdensity);

        $airbuyoncycorrectioninkg=$nominal_mass*(($pa-$pnod))*((1/$totalweightdensity)-(1/$conventionaldensity));
        //convert kg into mg
        $airbuyoncycorrection=1000000*$airbuyoncycorrectioninkg;
        $stduncertaintyforairbuyoncy=$airbuyoncycorrection/sqrt(3);

        $relativeuncertaintyforairbuyoncycorrection=($standard_u_in_air_density*$standard_u_in_air_density)*(((1/$totalweightdensity)-(1/$conventionaldensity))*((1/$totalweightdensity)-(1/$conventionaldensity)))
            +((($pa-$pnod)*($pa-$pnod))*($standard_u_in_air_density*$standard_u_in_air_density))/($totalweightdensity*$totalweightdensity*$totalweightdensity*$totalweightdensity);

        $stduncertaintyforairbuyoncycorrection=$relativeuncertaintyforairbuyoncycorrection*$airbuyoncycorrectioninkg;
        //in mg
        $stduncertaintyforairbuyoncycorrection=$stduncertaintyforairbuyoncycorrection*1000000;
        $umc=$refuncertainty/2;

        $uncertaintyduetodriftofstd=$refuncertainty/sqrt(3);
        $jobitem=Jobitem::find($item->parent->job_type_id);
        $uncetaintyduetoroundingoflastdigit=(($jobitem->resolution*1000)/2)/sqrt(3);
        $uncertaintyduetononrepeatabilityofload=$typeA_repeatability*1000;


        $uncertaintyduetoeccentricityofload=($pp_error*1000)/(2*sqrt(3));
        $uncertaintyduetosensitivityshiftofbalance=(0.0000015*$dev_temp*$nominal_mass*1000)/sqrt(3);


        $data=[
            'air-density'=>$pa,
            'uncertainty-in-temp-measurement'=>$u_temp,
            'uncertainty-in-pressure-measurement'=>$u_ap,
            'uncertainty-in-rh-measurement'=>$u_humidity,
            'relative-uncertainty-in-air-density'=>$relative_u,
            'standard-uncertainty-in-air-density'=>$standard_u_in_air_density,
            'total-weight-density'=>$totalweightdensity,
            'conventional-density'=>$conventionaldensity,
            'air-buyoncy-correction'=>$airbuyoncycorrection,
            'standard-uncertainty-for-air-bouyancy'=>$stduncertaintyforairbuyoncycorrection,
            'relative-uncertainty-for-air-bouyancy'=>$relativeuncertaintyforairbuyoncycorrection
            'pan-position-error'=>$pp_error,
            'type-a-repeatability'=>$typeA_repeatability

        ];

        return redirect()->back()->with('success','Data entered successfully');
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
        $entries=Calculatorentries::where('job_type',$location)->where('job_type_id',$id)->with('child')->first();
        $allentries=Generaldataentries::where('parent_id',$entries->id)->get();
        return view('calculator.balance.worksheet',compact('entries','job','quote','mainjob','assets','allentries'));
    }

}
