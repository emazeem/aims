<?php

namespace App\Http\Controllers;

use App\Models\Dataentry;
use App\Models\Jobitem;
use App\Models\Labjob;
use Illuminate\Http\Request;

class DataentryController extends Controller
{
    //
    public function store(Request $request){
        $this->validate(request(), [
            'assets' => 'required',
            'units' => 'required',
            'uuc_resolution' => 'required',
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

/*        if ($request->jobtype==0){*/
            $already_exsited=Dataentry::where('job_type',0)->where('asset_id',$request->assets)->where('unit',$request->units)->first();
            if ($already_exsited){
                $x1=[];$x2=[];$x3=[];$x4=[];$x5=[];$fixed=[];
                foreach ($request->x1 as $item){$x1[]=$item;}
                foreach ($request->x2 as $item){$x2[]=$item;}
                foreach ($request->x3 as $item){$x3[]=$item;}
                foreach ($request->x4 as $item){$x4[]=$item;}
                foreach ($request->x5 as $item){$x5[]=$item;}
                foreach ($request->fixed_value as $item){$fixed[]=$item;}
                for ($i=0;$i<count($x1);$i++){
                    $item=new Dataentry();
                    $item->fixed_value=$fixed[$i];
                    $item->x1=$x1[$i];
                    $item->x2=$x2[$i];
                    $item->x3=$x3[$i];
                    $item->x4=$x4[$i];
                    $item->x5=$x4[$i];
                    $item->x6=null;
                    $item->parent_id=$already_exsited->id;
                    $item->save();
                }
                return redirect()->back()->with('success','Entry added successfully');
            }
            $labjob=Jobitem::find($request->jobtypeid);
            $labjob->accuracy=$request->accuracy;
            $labjob->range=$request->range;
            $labjob->resolution=$request->uuc_resolution;
            $labjob->save();
            $entry=new Dataentry();
            $entry->job_type=0;
            $entry->job_type_id=$request->jobtypeid;
            $entry->location=$request->location;
            $entry->start_temp=$request->start_temp;
            $entry->end_temp=$request->end_temp;
            $entry->unit=$request->units;
            $entry->fixed_type=$request->fixed;
            $entry->asset_id=$request->assets;
            $entry->before_offset=$request->before_offset;
            $entry->after_offset=$request->after_offset;
            $entry->calibrated_by=auth()->user()->id;
            if ($entry->save()){$labjob->save();}
            $x1=[];$x2=[];$x3=[];$x4=[];$x5=[];$fixed=[];
            foreach ($request->x1 as $item){$x1[]=$item;}
            foreach ($request->x2 as $item){$x2[]=$item;}
            foreach ($request->x3 as $item){$x3[]=$item;}
            foreach ($request->x4 as $item){$x4[]=$item;}
            foreach ($request->x5 as $item){$x5[]=$item;}
            foreach ($request->fixed_value as $item){$fixed[]=$item;}
            for ($i=0;$i<count($x1);$i++){
                $item=new Dataentry();
                $item->fixed_value=$fixed[$i];
                $item->x1=$x1[$i];
                $item->x2=$x2[$i];
                $item->x3=$x3[$i];
                $item->x4=$x4[$i];
                $item->x5=$x4[$i];
                $item->x6=null;
                $item->parent_id=$entry->id;
                $item->save();
            }
            //dd($request->all());
            return redirect()->back()->with('success','Entry added successfully');

        /*}*/


    }
}
