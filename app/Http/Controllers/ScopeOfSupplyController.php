<?php

namespace App\Http\Controllers;

use App\Models\ScopeOfSupply;
use Illuminate\Http\Request;

class ScopeOfSupplyController extends Controller
{
    public function store(Request $request){
        //$this->authorize('department-create');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Scope of supply field is required *',
        ]);
        $parameter=new ScopeOfSupply();
        $parameter->title=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Added successfully']);
    }
    //
}
