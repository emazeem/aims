<?php

namespace App\Http\Controllers;


use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CapabilitiesController extends Controller
{
    public function index(){

        return view('capabilities.index');
    }
    public function create(){
        $procedures=Procedure::all();
        $parameters=DB::table('parameters')->get();
        return view('capabilities.create',compact('parameters','procedures'));
    }
    public function edit($id){
        $procedures=Procedure::all();
        $edit=Capabilities::find($id);
        $parameters=DB::table('parameters')->get();
        return view('capabilities.edit',compact('edit','parameters','procedures'));
    }
    public function fetch(){
        $data=Capabilities::with('parameters')->get ();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('range', function ($data) {
                return $data->range;
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })
            ->addColumn('unit', function ($data) {
                return $data->unit;
            })
            ->addColumn('location', function ($data) {
                return $data->location;
            })
            ->addColumn('accredited', function ($data) {
                return $data->accredited;
            })
            ->addColumn('procedure', function ($data) {
                return $data->procedures->name;
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                    <a title='Detail' class='btn btn-sm btn-primary' href='" . url('/capabilities/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/capabilities/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options'])
            ->make(true);

    }
    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'range' => 'required',
            'unit' => 'required',
            'accuracy' => 'required',
            'price' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'procedure' => 'required',
        ],[
            'name.required' => 'Name field is required *',
            'category.required' => 'Category field is required *',
            'range.required' => 'Range field is required *',
            'unit.required' => 'Unit field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'price.required' => 'Price field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'procedure.required' => 'Procedure field is required *',


        ]);
        $capabilities=new Capabilities();
        $capabilities->name=$request->name;
        $capabilities->parameter=$request->category;
        $capabilities->range=$request->range;
        $capabilities->unit=$request->unit;
        $capabilities->accuracy=$request->accuracy;
        $capabilities->location=$request->location;
        $capabilities->accredited=($request->accredited)?"yes":"no";
        $capabilities->price=$request->price;
        $capabilities->remarks=$request->remarks;
        $capabilities->procedure=$request->procedure;
        $capabilities->save();
        return redirect()->back()->with('success', 'Capability Added Successfully');
    }
    public function update($id,Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'range' => 'required',
            'unit' => 'required',
            'accuracy' => 'required',
            'price' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'procedure' => 'required',

        ],[
            'name.required' => 'Name field is required *',
            'category.required' => 'Category field is required *',
            'range.required' => 'Range field is required *',
            'unit.required' => 'Unit field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'price.required' => 'Price field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'procedure.required' => 'Procedure field is required *',


        ]);
        $capabilities=Capabilities::find($id);
        $capabilities->name=$request->name;
        $capabilities->parameter=$request->category;
        $capabilities->range=$request->range;
        $capabilities->location=$request->location;
        $capabilities->accredited=($request->accredited)?"yes":"no";
        $capabilities->unit=$request->unit;
        $capabilities->accuracy=$request->accuracy;
        $capabilities->price=$request->price;
        $capabilities->remarks=$request->remarks;
        $capabilities->procedure=$request->procedure;
        $capabilities->save();
        return redirect()->back()->with('success', 'Capability Updated Successfully');
    }
    public function show($id){
        $parameters=Parameter::all();
        $show=Capabilities::find($id);
        $suggestions=Suggestion::where('capabilities',$id)->get();
        return view('capabilities.show',compact('show','parameters','suggestions'));
    }
    //
}
