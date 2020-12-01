<?php

namespace App\Http\Controllers;


use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Suggestion;
use App\Models\Unit;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CapabilitiesController extends Controller
{
    public function index(){
        $procedures=Procedure::all();
        $parameters=DB::table('parameters')->get();
        $units=Unit::all();
        return view('capabilities.index',compact('parameters','procedures','units'));
    }
    public function create(){
        $procedures=Procedure::all();
        $parameters=DB::table('parameters')->get();
        return view('capabilities.create',compact('parameters','procedures'));
    }
    public function edit(Request $request){
        $edit=Capabilities::find($request->id);
        return response()->json($edit);
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
                return $data->units->unit;
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

                $action=null;
                $token=csrf_token();
                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                return "&emsp;
                    <a title='Detail' class='btn btn-sm btn-primary' href='" . url('/capabilities/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>                 ".$action;

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
        return response()->json(['success'=> 'Capability added successfully']);
    }
    public function update(Request $request){
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
        $capabilities=Capabilities::find($request->id);
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
        return response()->json(['success'=> 'Capability updated successfully']);

    }
    public function show($id){
        $parameters=Parameter::all();
        $show=Capabilities::find($id);
        $suggestions=Suggestion::where('capabilities',$id)->get();
        return view('capabilities.show',compact('show','parameters','suggestions'));
    }
    public function delete(Request $request){
        $item=Capabilities::find($request->id);
        $item->delete();
        return response()->json(['success'=> 'Capability deleted successfully']);
    }
    //
}
