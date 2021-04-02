<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Calculatorentries;
use App\Models\Jobitem;
use App\Models\Parameter;
use App\Models\Preference;
use Illuminate\Http\Request;

class CalclulatorentriesController extends Controller
{
    public function create($location, $id)
    {
        //location 0 is lab, location 1 is site
        $show = Jobitem::find($id);
        $parameters = [];
        if ($location == 0) {
            $assets = explode(',', $show->assign_assets);
        }
        if ($location == 1) {
            $assets = explode(',', $show->group_assets);
        }
        $spectrophotometer=false;
        if (in_array(180,$assets)){
            $spectrophotometer=true;
        }
        foreach ($assets as $asset) {
            $parameters[] = Asset::find($asset)->parameter;
        }
        $parameters = array_unique($parameters);
        $parameters = Parameter::whereIn('id', $parameters)->get();
        $assets = Asset::whereIn('id', $assets)->get();
        $dataentry = Calculatorentries::where('job_type_id', $id)->first();
        $parent = Preference::where('slug', 'aims-labs')->first();
        $labs = Preference::where('category', $parent->id)->get();

        return view('calculator.entries.create', compact('show', 'location', 'labs', 'parameters', 'assets', 'location', 'dataentry','spectrophotometer'));
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $show = Jobitem::find($request->jobtypeid);
        if ($show ->type== 0) {
            $assets = explode(',', $show->assign_assets);
        }
        if ($show ->type == 1) {
            $assets = explode(',', $show->group_assets);
        }
        //spectrophotometer
        if (in_array(180,$assets)){
            $this->validate(request(), [
                't_uuc_resolution' => 'required',
                'a_uuc_resolution' => 'required',
                'w_uuc_resolution' => 'required',
                't_range.*' => 'required',
                'a_range.*' => 'required',
                'w_range.*' => 'required',
                't_noise.*' => 'required',
                'a_noise.*' => 'required',
                'w_noise.*' => 'required',
                't_reproducability.*' => 'required',
                'a_reproducability.*' => 'required',
                'w_reproducability.*' => 'required',
                't_stablitity.*' => 'required',
                'a_stablitity.*' => 'required',
                'w_stablitity.*' => 'required',
                't_baseline_flateness.*' => 'required',
                'a_baseline_flateness.*' => 'required',
                'w_baseline_flateness.*' => 'required',
            ]);
        }else{
            $this->validate(request(), [
                'uuc_resolution' => 'required',
                'range.*' => 'required',
            ]);
        }
        $this->validate(request(), [
            'start_humidity' => 'required',
            'end_humidity' => 'required',
            'location' => 'required',
            'accuracy' => 'required',
            'start_temp' => 'required',
            'end_temp' => 'required',
            'before_offset' => 'required',
            'after_offset' => 'required',
        ]);
        $labjob = Jobitem::find($request->jobtypeid);

        //dd('validated');
        if ($labjob->item->capabilities->calculator  == 'balance-calculator') {
            $this->validate(request(), [
                'start_atmospheric_pressure' => 'required',
                'end_atmospheric_pressure' => 'required',
            ]);
        }
        if ($labjob->item->capabilities->calculator  == 'volume-calculator') {
            $this->validate(request(), [
                'class' => 'required',
                'tolerance' => 'required',
            ]);
        }
        if ($labjob->item->capabilities->calculator == 'vernier-caliper-calculator') {
            $this->validate(request(), [
                'uuc_temp' => 'required',
                'ref_temp' => 'required',
                'anti_parallelism' => 'required',
                'zero_err' => 'required',
            ]);
        }
        if (in_array(180,$assets)) {
            $labjob->accuracy = implode(',',$request->accuracy);
            $labjob->resolution = $request->t_uuc_resolution.','.$request->a_uuc_resolution.','.$request->w_uuc_resolution;
            $labjob->range=implode(',',$request->t_range).'-'.implode(',',$request->a_range).'-'.implode(',',$request->w_range);

        }else{
            $labjob->accuracy = $request->accuracy;
            $labjob->range = implode(',', $request->range);
            $labjob->resolution = $request->uuc_resolution;
        }
            $exist=Calculatorentries::where('job_type_id',$request->jobtypeid)->get()->count();
        if ($exist>0){
            $entry=Calculatorentries::where('job_type_id',$request->jobtypeid)->first();
        }else{
            $entry = new Calculatorentries();
        }
        if (in_array(180,$assets)) {
            $entry->noise = $request->t_noise.','.$request->a_noise.','.$request->w_noise;
            $entry->reproducibility = $request->t_reproducability.','.$request->a_reproducability.','.$request->w_reproducability;
            $entry->stability = $request->t_stablitity.','.$request->a_stablitity.','.$request->w_stablitity;
            $entry->baseline = $request->t_baseline_flateness.','.$request->t_baseline_flateness.','.$request->t_baseline_flateness;
        }
        $entry->job_type_id = $request->jobtypeid;
        $entry->start_temp = $request->start_temp;
        $entry->end_temp = $request->end_temp;
        $entry->start_humidity = $request->start_humidity;
        $entry->end_humidity = $request->end_humidity;
        $entry->fixed_type = $request->fixed;
        $entry->before_offset = $request->before_offset;
        $entry->after_offset = $request->after_offset;
        $entry->location=$request->location;

        $entry->start_atmospheric_pressure = $request->start_atmospheric_pressure?$request->start_atmospheric_pressure:null;
        $entry->end_atmospheric_pressure = $request->end_atmospheric_pressure?$request->end_atmospheric_pressure:null;
        $entry->calibrated_by = auth()->user()->id;
        //for volume only
        if ($labjob->item->capabilities->calculator == 'volume-calculator') {
            $entry->class = $request->class;
            $entry->tolerance = $request->tolerance;
            $entry->balance_id = $request->balance_id;
            $entry->temp_id = $request->temp_id;
            $entry->balance_values = implode(',',$request->balance_values);
            $entry->temp_values = implode(',',$request->temp_values);
            $entry->start_atmospheric_pressure = $request->start_atmospheric_pressure;
            $entry->end_atmospheric_pressure = $request->end_atmospheric_pressure;

        }
        //for balance only

        if ($labjob->item->capabilities->calculator == 'balance-calculator') {
            $entry->start_atmospheric_pressure = $request->start_atmospheric_pressure;
            $entry->end_atmospheric_pressure = $request->end_atmospheric_pressure;
            $entry->repeatability = implode(',', $request->repeatability);
            $entry->uuc_temp = $request->uuc1 . ',' . $request->uuc2 . ',' . $request->uuc3;
            $entry->ref_temp = $request->ref1 . ',' . $request->ref2 . ',' . $request->ref3;

            $center = $request->center;
            $panposition = array(
                'center1' => $center[0],
                'center2' => $center[1],
                'front' => $request->front,
                'left' => $request->left,
                'right' => $request->right,
                'weight' => $request->weight,
                'rare' => $request->rare,
            );
            $entry->pan_position = json_encode($panposition);
        }
        if ($labjob->item->capabilities->calculator == 'vernier-caliper-calculator') {
            $entry->uuc_temp = implode(',',$request->uuc_temp);
            $entry->ref_temp = implode(',',$request->ref_temp);
            $antiparallelism = array(
                'vernier_jaw' => $request->anti_parallelism[0],
                'between_1' => $request->anti_parallelism[1],
                'center' => $request->anti_parallelism[2],
                'between_2' => $request->anti_parallelism[3],
                'fixed_jaw' => $request->anti_parallelism[4],
            );
            $entry->anti_parallelism =json_encode($antiparallelism);
            $entry->zero_error = implode(',',$request->zero_err);
        }
        if ($entry->save()) {
            $labjob->save();
        }
        return redirect()->back()->with('success', 'Worksheet data added successfully');
    }
    //
}