<?php

namespace App\Http\Controllers;

use App\Models\Assetspecification;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class AssetspecificationController extends Controller
{
    public function index(){
        return view('assetspecifications.index');
    }
    public function edit(Request $request){
        $specifications=Assetspecification::find($request->id);
        return response()->json($specifications);
    }
    public function store(Request $request){
        //dd($request->all());
        $slugify = new Slugify();
        $this->validate($request,
            [
               'attribute'=>'required',
               'value'=>'required',
            ],[
                'attribute.required'=>'Select column to add specifications. ',
                'value.required'=>'Enter value to add specifications',
            ]);
        $specifications=new Assetspecification();
        $specifications->asset_id=$request->asset_id;
        $specifications->column=$request->attribute;
        $specifications->value=$request->value;
        $specifications->save();
        return response()->json(['success'=>'Specification added successfully']);

    }
    public function update(Request $request){
        //dd($request->all());
        $slugify = new Slugify();
        $this->validate($request,
            [
               'value'=>'required',
            ],[
                'value.required'=>'Enter value to add specifications',
            ]);
        $specifications=Assetspecification::find($request->id);
        $specifications->value=$request->value;
        $specifications->save();
        return response()->json(['success'=>'Specification updated successfully']);

    }

    //
}
