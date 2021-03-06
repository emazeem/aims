<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Models\Capabilities;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Procedure;
use App\Models\Suggestion;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return DataTables::of($data)
            ->addColumn('@', function ($data) {
                if ($data->group_id!=null){
                    return "
                <div class='checkbox checkbox-fill checkbox-danger d-inline'>
                     <input type='checkbox' name='action[]' disabled checked>
                     <label class='cr' for='actions".$data->id."'></label>                 
                </div>";
                }if ($data->is_group==1){
                    return null;
                }
                else{
                    return "
                <div class='checkbox checkbox-fill d-inline'>
                     <input type='checkbox' data-id='".$data->id."' name='action[]' class='actions' id='actions".$data->id."'>
                     <label class='cr' for='actions".$data->id."'></label>                 
                </div>";
                }
            })
            ->addColumn('suggestions', function ($data) {
                $sug=null;
                foreach ($data->suggestions as $k=>$suggestion){
                    $sug.='<div class="col-12 py-1"><small class="badge bg-danger text-light">';
                    foreach(explode(',',$suggestion->assets) as $asset){
                        $as=Asset::find($asset);
                        if (isset($as)){
                            $sug.=$as->name.'<b>( '.$as->code.' )</b><br>';
                        }
                    }
                    if (Auth::user()->can('delete-suggestions')){
                        $sug.="</small><a class=\"float-right text-danger delete-suggestions\" data-id='{$suggestion->id}' href=\"javascript:void(0)\"><i
                                            class=\"fa fa-trash\"></i></a>";
                    }
                    $sug.='</div>';
                }
                return $sug;

            })
            ->addColumn('name', function ($data) {
                return $data->name.' - '.$data->id;
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
                if (Auth::user()->can('capabilities-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                if (Auth::user()->can('capabilities-view')){
                    $action.="<a title='Detail' class='btn btn-sm btn-primary' href=".url('/capabilities/view/'. $data->id) ." data-id='".$data->id ."'><i class='fa fa-eye'></i></a>";
                }
                if (Auth::user()->can('capabilities-edit')){
                    $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='".$data->id."'><i class='fa fa-edit'></i></button>";
                }
                if (Auth::user()->can('add-suggestions')){
                    $action.= '<button data-id="'.$data->id.'" class="btn btn-sm btn-dark add_suggestion_btn" data-parameter="'.$data->parameter.'" data-id="'.$data->id.'" data-capability-name="'.$data->name.'"><i class="feather icon-help-circle"></i></button>';
                }
                return $action;
            })
            ->rawColumns(['options','@','suggestions'])
            ->make(true);

    }
    public function store(Request $request){
        $this->authorize('capabilities-create');
        $this->validate(request(), [
            'add_name' => 'required',
            'add_parameter' => 'required',
            'add_min_range' => 'required',
            'add_max_range' => 'required',
            'add_unit' => 'required',
            'add_accuracy' => 'required',
            'add_price' => 'required',
            'add_remarks' => 'required',
            'add_location' => 'required',
            'add_procedure' => 'required',
            'add_calculator' => 'required',
        ],[
            'add_name.required' => 'Name field is required *',
            'add_parameter.required' => 'Parameter field is required *',
            'add_min_range.required' => 'Min Range field is required *',
            'add_max_range.required' => 'Max Range field is required *',
            'add_unit.required' => 'Unit field is required *',
            'add_accuracy.required' => 'Accuracy field is required *',
            'add_price.required' => 'Price field is required *',
            'add_remarks.required' => 'Remarks field is required *',
            'add_location.required' => 'Location field is required *',
            'add_procedure.required' => 'Procedure field is required *',
            'add_calculator.required' => 'Procedure field is required *',
        ]);
        $unit=Unit::find($request->add_unit);
        if ($request->add_parameter!=$unit->parameter){
            return response()->json(['error'=>'----'],401);
        }

        $capabilities=new Capabilities();
        $capabilities->name=$request->add_name;
        $capabilities->parameter=$request->add_parameter;
        $capabilities->min_range=$request->add_min_range;
        $capabilities->accredited_min_range=$request->add_acc_min_range;
        $capabilities->accredited_max_range=$request->add_acc_max_range;
        $capabilities->max_range=$request->add_max_range;
        $capabilities->unit=$request->add_unit;
        $capabilities->calculator=$request->add_calculator;
        $capabilities->accuracy=$request->add_accuracy;
        $capabilities->location=$request->add_location;
        $capabilities->accredited=$request->add_accredited;
        $capabilities->price=$request->add_price;
        $capabilities->remarks=$request->add_remarks;
        $capabilities->procedure=$request->add_procedure;
        $capabilities->save();
        return response()->json(['success'=> 'Capability added successfully']);
    }
    public function update(Request $request){
        $this->authorize('capabilities-edit');
        $this->validate(request(), [
            'edit_name' => 'required',
            'edit_parameter' => 'required',
            'edit_min_range' => 'required',
            'edit_max_range' => 'required',
            'edit_unit' => 'required',
            'edit_accuracy' => 'required',
            'edit_price' => 'required',
            'edit_remarks' => 'required',
            'edit_location' => 'required',
            'edit_procedure' => 'required',
            'edit_calculator' => 'required',

        ],[
            'edit_name.required' => 'Name field is required *',
            'edit_parameter.required' => 'Parameter field is required *',
            'edit_min_range.required' => 'Min Range field is required *',
            'edit_max_range.required' => 'Max Range field is required *',
            'edit_unit.required' => 'Unit field is required *',
            'edit_accuracy.required' => 'Accuracy field is required *',
            'edit_price.required' => 'Price field is required *',
            'edit_remarks.required' => 'Remarks field is required *',
            'edit_location.required' => 'Location field is required *',
            'edit_procedure.required' => 'Procedure field is required *',
            'edit_calculator.required' => 'Calculator field is required *',

        ]);

        $unit=Unit::find($request->edit_unit);
        if ($request->edit_parameter!=$unit->parameter){
            return response()->json(['error'=>'----'],401);
        }

        $capabilities=Capabilities::find($request->id);
        $capabilities->name=$request->edit_name;
        $capabilities->parameter=$request->edit_parameter;

        $capabilities->min_range=$request->edit_min_range;
        $capabilities->accredited_min_range=$request->edit_acc_min_range;
        $capabilities->accredited_max_range=$request->edit_acc_max_range;
        $capabilities->max_range=$request->edit_max_range;
        $capabilities->location=$request->edit_location;
        $capabilities->accredited=$request->edit_accredited;
        $capabilities->unit=$request->edit_unit;
        $capabilities->accuracy=$request->edit_accuracy;
        $capabilities->price=$request->edit_price;
        $capabilities->remarks=$request->edit_remarks;
        $capabilities->procedure=$request->edit_procedure;
        $capabilities->calculator=$request->edit_calculator;
        $capabilities->save();
        return response()->json(['success'=> 'Capability updated successfully']);

    }
    public function show($id){
        $this->authorize('capabilities-view');
        $parameters=Parameter::orderBy('name','ASC')->get();
        $show=Capabilities::with('suggestions')->where('id',$id)->first();
        return view('capabilities.show',compact('show','parameters'));
    }
    public function delete(Request $request){
        $this->authorize('capabilities-delete');
        $item=Capabilities::find($request->id);
        $item->delete();
        return response()->json(['success'=> 'Capability deleted successfully']);
    }
    public function prints(){
        $capabilities = Capabilities::orderBy('name','ASC')->get();
        return view('capabilities.print',compact('capabilities'));
    }
    public function respectiveassets($id){
        $ids=[];
        foreach (Asset::all() as $asset){
            if ($asset->other_parameter){
                if (in_array($id,explode(',',$asset->other_parameter))){
                    $ids[]=$asset->id;
                }
            }
            if ($asset->parameter==$id){
                $ids[]=$asset->id;
            }
        }

        $ids=array_unique($ids);
        $assets=Asset::whereIn('id',$ids)->get();
        return response()->json($assets);
    }
    //
}
