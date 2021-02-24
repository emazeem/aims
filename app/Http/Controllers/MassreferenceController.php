<?php

namespace App\Http\Controllers;

use App\Models\Massreference;
use Illuminate\Http\Request;

class MassreferenceController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->id){
            $this->validate($request, [
                'density' => 'required',
                'expanded_uncertainty' => 'required',
                'volume' => 'required',
                'gradient_temp' => 'required',
            ]);
            $massref=Massreference::find($request->id);
            $massref->density=$request->density;
            $massref->expanded_uncertainty=$request->expanded_uncertainty;
            $massref->volume=$request->volume;
            $massref->gradient_temp=implode(',',$request->gradient_temp);
            $massref->save();
            return response()->json(['success'=>'Updated Successfully']);
        }
        //dd($request->all());
        $this->validate($request, [
            'density' => 'required',
            'expanded_uncertainty' => 'required',
            'volume' => 'required',
            'gradient_temp' => 'required',
        ]);
        $massref=new Massreference();
        $massref->parent_id=$request->reference;
        $massref->density=$request->density;
        $massref->expanded_uncertainty=$request->expanded_uncertainty;
        $massref->volume=$request->volume;
        $massref->gradient_temp=implode(',',$request->gradient_temp);
        $massref->save();
        return response()->json(['success'=>'Added Successfully']);
    }
    public function edit(Request $request)
    {
        $massref=Massreference::find($request->id);
        $massref['gradient_temp']=explode(',',$massref->gradient_temp);
        return response()->json($massref);
    }

}
