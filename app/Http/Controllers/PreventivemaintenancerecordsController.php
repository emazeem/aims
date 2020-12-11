<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetgroup;
use App\Models\Preventivechecklist;
use App\Models\Preventivemaintenancerecord;
use Illuminate\Http\Request;

class PreventivemaintenancerecordsController extends Controller
{
    //
    public function create($id){
        $asset=Asset::find($id);
        $group=Assetgroup::find($asset->group_id);
        $checklists=Preventivechecklist::where('group_id',$group->id)->get();
        return view('preventive_maintenance.create',compact('asset','group','checklists'));
    }
    public function edit($id){
        $edit=Preventivemaintenancerecord::find($id);
        $asset=Asset::find($edit->asset_id);
        $group=Assetgroup::find($asset->group_id);
        $checklists=Preventivechecklist::where('group_id',$group->id)->get();
        return view('preventive_maintenance.edit',compact('asset','group','checklists','edit'));
    }


    public function store(Request $request)
    {

        $this->validate(request(), [
            'checklists' => 'required',
        ],[
            'checklists.required' => 'Checklist field is required *',
        ]);
        $unchecked=[];
        foreach (explode(',',$request->all) as $item){
            if (!in_array($item,$request->checklists)){
                $unchecked[]=$item;
            }
        }
        $maintenancerecord=new Preventivemaintenancerecord();
        $maintenancerecord->checked=implode(',',$request->checklists);
        $maintenancerecord->unchecked=implode(',',$unchecked);
        if ($request->breakdowndescription){
            $maintenancerecord->breakdown_description=$request->breakdowndescription;
        }
        if ($request->correctivemaintenance){
            $maintenancerecord->corrective_description=$request->correctivemaintenance;
        }
        $maintenancerecord->performed_by=auth()->user()->id;
        $maintenancerecord->lab_in_charge=1;
        $maintenancerecord->asset_id=$request->id;
        $maintenancerecord->save();
        return redirect()->back()->with('success', 'Added successfully');
    }
    public function update(Request $request)
    {
        //dd($request->all());

        $this->validate(request(), [
            'checklists' => 'required',
        ],[
            'checklists.required' => 'Checklist field is required *',
        ]);
        $unchecked=[];
        foreach (explode(',',$request->all) as $item){
            if (!in_array($item,$request->checklists)){
                $unchecked[]=$item;
            }
        }
        $maintenancerecord=Preventivemaintenancerecord::find($request->id);
        $maintenancerecord->checked=implode(',',$request->checklists);
        $maintenancerecord->unchecked=implode(',',$unchecked);
        if ($request->breakdowndescription){
            $maintenancerecord->breakdown_description=$request->breakdowndescription;
        }
        if ($request->correctivemaintenance){
            $maintenancerecord->corrective_description=$request->correctivemaintenance;
        }
        $maintenancerecord->performed_by=auth()->user()->id;
        $maintenancerecord->lab_in_charge=1;
        $maintenancerecord->save();
        return redirect()->back()->with('success', 'Updated successfully');
    }
}
