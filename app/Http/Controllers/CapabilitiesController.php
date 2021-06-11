<?php

namespace App\Http\Controllers;


use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Procedure;
use App\Models\Suggestion;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CapabilitiesController extends Controller
{
    public function index(){
        $this->authorize('capabilities-index');
        $procedures=Procedure::orderBy('name','ASC')->get();
        $parameters=Parameter::orderBy('name','ASC')->get();
        $units=Unit::all();
        $parent=Preference::where('slug','calculators')->first();
        $calculators=Preference::where('category',$parent->id)->get();
        return view('capabilities.index',compact('parameters','procedures','units','calculators'));
    }
    public function edit(Request $request){
        $this->authorize('capabilities-edit');
        $edit=Capabilities::find($request->id);
        $edit['units']=Unit::all()->where('parameter',$edit->parameter);
        return response()->json($edit);
    }
    public function fetch(){
        $this->authorize('capabilities-index');
        $data=Capabilities::with('parameters')->where('is_group',0)->get();
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
                return $data->min_range.'-'.$data->max_range;
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
            ->addColumn('calculator', function ($data) {
                return $data->calculators->name;
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
        $this->authorize('capabilities-create');
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'min_range' => 'required',
            'max_range' => 'required',
            'unit' => 'required',
            'accuracy' => 'required',
            'price' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'procedure' => 'required',
            'calculator' => 'required',
        ],[
            'name.required' => 'Name field is required *',
            'category.required' => 'Category field is required *',
            'min_range.required' => 'Min Range field is required *',
            'max_range.required' => 'Max Range field is required *',
            'unit.required' => 'Unit field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'price.required' => 'Price field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'procedure.required' => 'Procedure field is required *',
            'calculator.required' => 'Procedure field is required *',
        ]);
        $capabilities=new Capabilities();
        $capabilities->name=$request->name;
        $capabilities->parameter=$request->category;
        $capabilities->min_range=$request->min_range;
        $capabilities->accredited_min_range=$request->acc_min_range;
        $capabilities->accredited_max_range=$request->acc_max_range;
        $capabilities->max_range=$request->max_range;
        $capabilities->unit=$request->unit;
        $capabilities->calculator=$request->calculator;
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
        $this->authorize('capabilities-edit');
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'min_range' => 'required',
            'max_range' => 'required',
            'unit' => 'required',
            'accuracy' => 'required',
            'price' => 'required',
            'remarks' => 'required',
            'location' => 'required',
            'procedure' => 'required',
            'calculator' => 'required',

        ],[
            'name.required' => 'Name field is required *',
            'category.required' => 'Category field is required *',
            'min_range.required' => 'Min Range field is required *',
            'max_range.required' => 'Max Range field is required *',
            'unit.required' => 'Unit field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'price.required' => 'Price field is required *',
            'remarks.required' => 'Remarks field is required *',
            'location.required' => 'Location field is required *',
            'procedure.required' => 'Procedure field is required *',
            'calculator.required' => 'Calculator field is required *',

        ]);
        $capabilities=Capabilities::find($request->id);
        $capabilities->name=$request->name;
        $capabilities->parameter=$request->category;

        $capabilities->min_range=$request->min_range;
        $capabilities->accredited_min_range=$request->acc_min_range;
        $capabilities->accredited_max_range=$request->acc_max_range;
        $capabilities->max_range=$request->max_range;
        $capabilities->location=$request->location;
        $capabilities->accredited=($request->accredited)?"yes":"no";
        $capabilities->unit=$request->unit;
        $capabilities->accuracy=$request->accuracy;
        $capabilities->price=$request->price;
        $capabilities->remarks=$request->remarks;
        $capabilities->procedure=$request->procedure;
        $capabilities->calculator=$request->calculator;
        $capabilities->save();
        return response()->json(['success'=> 'Capability updated successfully']);

    }
    public function show($id){
        $this->authorize('capabilities-view');
        $parameters=Parameter::all();
        $show=Capabilities::find($id);
        $suggestions=Suggestion::where('capabilities',$id)->get();
        return view('capabilities.show',compact('show','parameters','suggestions'));
    }
    public function delete(Request $request){
        $this->authorize('capabilities-delete');
        $item=Capabilities::find($request->id);
        $item->delete();
        return response()->json(['success'=> 'Capability deleted successfully']);
    }
    //
}
