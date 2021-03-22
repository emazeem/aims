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
        foreach ($assets as $asset) {
            $parameters[] = Asset::find($asset)->parameter;
        }
        $parameters = array_unique($parameters);
        $parameters = Parameter::whereIn('id', $parameters)->get();
        $assets = Asset::whereIn('id', $assets)->get();
        $dataentry = Calculatorentries::where('job_type_id', $id)->first();
        $parent = Preference::where('slug', 'aims-labs')->first();
        $labs = Preference::where('category', $parent->id)->get();
        return view('calculator.entries.create', compact('show', 'location', 'labs', 'parameters', 'assets', 'location', 'dataentry'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate(request(), [
            'uuc_resolution' => 'required',
            'start_humidity' => 'required',
            'end_humidity' => 'required',
            'location' => 'required',
            'accuracy' => 'required',
            'range.*' => 'required',
            'start_temp' => 'required',
            'end_temp' => 'required',
            'before_offset' => 'required',
            'after_offset' => 'required',
        ]);
        $labjob = Jobitem::find($request->jobtypeid);
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

        $labjob->accuracy = $request->accuracy;
        $labjob->range = implode(',', $request->range);
        $labjob->resolution = $request->uuc_resolution;
        $exist=Calculatorentries::where('job_type_id',$request->jobtypeid)->get()->count();
        if ($exist>0){
            $entry=Calculatorentries::where('job_type_id',$request->jobtypeid)->first();
        }else{
            $entry = new Calculatorentries();
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
        if ($entry->save()) {
            $labjob->save();
        }
        return redirect()->back()->with('success', 'Worksheet data added successfully');
    }
    //
}