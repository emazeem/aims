<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Managereference;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\False_;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    public function index(){
        $units=Unit::onlyTrashed()->get();
        dd($units);
        $this->authorize('units-index');
        return view('units.index');
    }
    public function fetch(){
        $this->authorize('units-index');
        $data=Unit::with('parameters')->with('others')->where('primary_',null)->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('primary', function ($data) {
                return $data->unit;
            })
            ->addColumn('secondary', function ($data) {
                $secondary=null;
                foreach ($data->others as $other){
                    $secondary.='<span class="badge" style="white-space:nowrap;" data-toggle="tooltip" data-placement="top" title="'.$other->factor_multiply.'">'.$other->unit.'</span>';
                }
                return $secondary;
            })

            ->addColumn('options', function ($data) {
                $action=null;
                $token=csrf_token();

                if (Auth::user()->can('update-units')){
                    $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/units/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('delete-units')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                }
                return $action;
            })
            ->rawColumns(['options','secondary'])
            ->make(true);

    }


    public function create(){
        $this->authorize('create-units');
        $parameters=Parameter::all();
        return view('units.create',compact('parameters'));
    }
    public function edit($id){
        $this->authorize('update-units');
        $parameters=Parameter::all();
        $edit=Unit::find($id);
        $previous_units=Unit::where('parameter',$edit->parameter)->get();
        return view('units.edit',compact('parameters','edit','previous_units'));
    }

    public function store(Request $request){
        $this->authorize('create-units');
        $this->validate(request(), [
/*            'unit' => 'required|unique:units',*/
            'unit' => 'required',
            'parameter' => 'required',
        ],[
            'unit.required' => 'Unit is required.',
            'parameter.required' => 'Parameter is required.',
        ]);
        /*$alreadyhavepriamry=Unit::where('parameter',$request->parameter)->where('primary_',null)->get();
        if (count($alreadyhavepriamry)!=0){
            return response()->json(['error'=>'This parameter has already primary unit'],404);
        }*/
        $unit=new Unit();
        $unit->unit=$request->unit;
        $unit->parameter=$request->parameter;
        $unit->primary_=($request->primary)?$request->primary:null;
        $unit->factor_multiply=$request->factor_multiply;
        $unit->factor_add=$request->factor_add;
        $unit->save();
        return response()->json(['success'=>'Unit has been added successfully.']);
    }
    public function update(Request $request){
        $this->authorize('update-units');
        $this->validate(request(), [
            'unit' => 'required',
            'parameter' => 'required',
        ],[
            'unit.required' => 'Unit is required.',
            'parameter.required' => 'Parameter is required.',
        ]);
        $u=Unit::find($request->id);
        //dd($unit);
        $u->unit=$request->unit;
        $u->parameter=$request->parameter;
        $u->primary_=($request->primary)?$request->primary:null;
        $u->factor_multiply=$request->factor_multiply;
        $u->factor_add=$request->factor_add;
        $u->save();
        return  response()->json(['success'=> 'Unit has been updated successfully.']);
    }

    public function units_of_assets($id){
        $asset=Asset::find($id);
        $units['units']=Unit::where('parameter',$asset->parameter)->get();
        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);
        $units['show_channels']=false;
        if (in_array($id,$hasChannels)){
            $units['show_channels']=true;
        }
        return response()->json($units);
    }
    public function previous_units($id){
        $units['previous']=Unit::where('parameter',$id)->get();
        $units['primary']=Unit::where('primary_',null)->where('parameter',$id)->get();
        return response()->json($units);
    }
    public function check_both_units($unit,$asset){

        $referenceData=Managereference::where('asset',$asset)->pluck('unit')->toArray();
        $referenceData=array_unique($referenceData);
        $data=null;
        if (count($referenceData)>0){
            $referenceData=$referenceData[0];
            if ($unit==$referenceData){
                $data['conversion']=false;
            }else{
                $data['conversion']=true;
            }
        }else{
            $data['conversion']=false;
        }
        $data['unit']=Unit::find($unit);

        $assetdetails=Asset::find($asset);
        if ($assetdetails->parameter=='13'){
            $data['nominalmasses']=Managereference::where('asset',$asset)->get();
        }
        return response()->json($data);
    }
    public function destroy(Request $request){
        $this->authorize('delete-units');
        Unit::find($request->id)->delete();
        return response()->json(['success'=>'Unit deleted successfully']);
    }
    //
}
