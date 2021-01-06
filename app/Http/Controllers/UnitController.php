<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Parameter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    public function index(){
        return view('units.index');
    }
    public function fetch(){
        $data=Unit::with('parameters')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('unit', function ($data) {
                return $data->unit;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/units/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }


    public function create(){
        $parameters=Parameter::all();
        return view('units.create',compact('parameters'));
    }
    public function edit($id){
        $parameters=Parameter::all();
        $edit=Unit::find($id);
        $previous_units=Unit::where('parameter',$edit->parameter)->get();
        return view('units.edit',compact('parameters','edit','previous_units'));
    }

    public function store(Request $request){
        $this->validate(request(), [
/*            'unit' => 'required|unique:units',*/
            'unit' => 'required',
            'parameter' => 'required',
        ],[
            'unit.required' => 'Unit is required.',
            'parameter.required' => 'Parameter is required.',
        ]);
        $unit=new Unit();
        $unit->unit=$request->unit;
        $unit->parameter=$request->parameter;
        $unit->primary_=($request->primary)?$request->primary:null;
        $unit->factor_multiply=$request->factor_multiply;
        $unit->factor_add=$request->factor_add;
        $unit->save();
        return  redirect()->back()->with('success', 'Unit has been added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'unit' => 'required|unique:units,unit,'.$request->id,
            'parameter' => 'required',
        ],[
            'unit.required' => 'Unit is requried.',
            'parameter.required' => 'Parameter is requried.',
        ]);
        $unit=Unit::find($request->id);
        $unit->unit=$request->unit;
        $unit->parameter=$request->parameter;
        $unit->primary=($request->primary)?$request->primary:null;
        $unit->factor_multiply=$request->factor_multiply;
        $unit->factor_add=$request->factor_add;
        $unit->save();
        return  redirect()->back()->with('success', 'Unit has been added successfully.');
    }

    public function units_of_assets($id){
        $asset=Asset::find($id);
        $units=Unit::where('parameter',$asset->parameter)->get();
        return response()->json($units);
    }
    public function previous_units($id){
        $units=Unit::where('parameter',$id)->get();
        $units['primary']=Unit::where('primary_',null)->where('parameter',$id)->get();
        return response()->json($units);
    }
    //
}
