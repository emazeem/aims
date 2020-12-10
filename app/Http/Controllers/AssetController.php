<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Column;
use App\Models\Intermediatechecksofasset;
use App\Models\Parameter;
use App\Models\Procedure;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock;
use Yajra\DataTables\DataTables;

class AssetController extends Controller
{
    //
    public function index(){
/*      $temps=Asset::all();
        foreach ($temps as $temp){
            $asset=Asset::find($temp->id);
            $asset->calibration_interval=1;
            $due=strtotime($temp->calibration)+(60*60*24*365);
            $asset->due=date('Y-m-d',$due);
            $asset->save();
        }
        dd('done');*/
        $assets=Asset::all();
        return view('assets.index',compact('assets'));
    }
    public function fetch(){
        $data=Asset::with('parameters')->get ();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('code', function ($data) {
                return $data->code;
            })

            ->addColumn('parameter', function ($data) {
                return $data->parameters->name;
            })
            ->addColumn('status', function ($data) {
                $status=null;
                if ($data->status==0){
                    $status.="<span class='badge badge-success'>Available</span>";
                }
                if ($data->status==1){
                    $status.="<span class='badge badge-danger'>Booked</span>";
                }
                return $status;

            })

            ->addColumn('make', function ($data) {
                return $data->make;
            })
            ->addColumn('model', function ($data) {
                return $data->model;
            })
            ->addColumn('range', function ($data) {
                return $data->range;
            })
            ->addColumn('resolution', function ($data) {
                return $data->resolution;
            })
            ->addColumn('accuracy', function ($data) {
                return $data->accuracy;
            })
            ->addColumn('due', function ($data) {
                return $data->due;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/assets/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/assets/show/'. $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }

    public function create(){
        $parameters=Parameter::all();
        return view('assets.create',compact('parameters'));
    }
    public function edit($id){
        $edit=Asset::find($id);
        $parameters=Parameter::all();
        return view('assets.edit',compact('parameters','edit'));
    }
    public function show($id){

        $show=Asset::find($id);
        $parameters=Parameter::all();
        $specifications=Assetspecification::with('columns')->where('asset_id',$id)->get();
        $check_duplicate_specifications=Assetspecification::where('asset_id',$id)->get();
        $duplicate=array();
        foreach ($check_duplicate_specifications as $check_duplicate_specification){
            $duplicate[]=$check_duplicate_specification->asset_id;
        }
        $columns=Column::all();
        $mycolumns=array();
        foreach ($columns as $column){
            $assets=explode(',',$column->assets);
            if (in_array($id,$assets)){
                $mycolumns[]=$column;

            }
        }
        $intermediatechecks=Intermediatechecksofasset::where('equipment_under_test_id',$id)->get();
        return view('assets.show',compact('parameters','show','specifications','mycolumns','duplicate','intermediatechecks'));
    }

    public function store(Request $request){
       // dd($request->all());
        $this->validate(request(), [
            'name' => 'required',
            'parameter' => 'required',
            'make' => 'required',
            'model' => 'required',
            'range' => 'required',
            'resolution' => 'required',
            'accuracy' => 'required',
            'interval' => 'required',
            'commissioned' => 'required',
            'calibration' => 'required',
            'traceability' => 'required',
            'serial' => 'required',
            'certificate' => 'required',
            'status' => 'required',
            'code' => 'required|unique:assets',
        ],[
            'name.required' => 'Asset name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'make.required' => 'Make field is required *',
            'model.required' => 'Model field is required *',
            'range.required' => 'Range field is required *',
            'resolution.required' => 'Resolution field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'interval.required' => 'Due field is required *',
            'code.required' => 'Code field is required *',
        ]);

        $asset=new Asset();
        $asset->name=$request->name;
        $asset->code=$request->code;
        $asset->parameter=$request->parameter;
        $asset->make=$request->make;
        $asset->model=$request->model;
        $asset->range=$request->range;
        $asset->status=$request->status;
        $asset->resolution=$request->resolution;
        $asset->accuracy=$request->accuracy;
        $asset->due=$request->due;
        $asset->commissioned=$request->commissioned;
        $asset->calibration_interval=$request->interval;
        $due=strtotime($request->calibration)+(60*60*24*365)*$request->interval;
        $asset->due=date('Y-m-d',$due);
        $asset->calibration=$request->calibration;
        $asset->certificate_no=$request->certificate;
        $asset->traceability=$request->traceability;
        $asset->serial_no=$request->serial;
        $asset->location=$request->location;
        if (isset($request->image)){
            $attachment=time().$request->image->getClientOriginalName();
            Storage::disk('local')->put('/public/assets/'.$attachment, File::get($request->profile));
            $asset->image=$attachment;
        }
        $asset->save();
        return redirect()->back()->with('success', 'Asset added successfully');

    }
    public function update($id,Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'parameter' => 'required',
            'make' => 'required',
            'model' => 'required',
            'range' => 'required',
            'resolution' => 'required',
            'accuracy' => 'required',
            'interval' => 'required',
            'commissioned' => 'required',
            'calibration' => 'required',
            'traceability' => 'required',
            'serial' => 'required',
            'certificate' => 'required',
            'status' => 'required',

            'code' => 'required|unique:assets,code,'.$request->id,
        ],[
            'name.required' => 'Asset name field is required *',
            'parameter.required' => 'Parameter field is required *',
            'make.required' => 'Make field is required *',
            'model.required' => 'Model field is required *',
            'range.required' => 'Range field is required *',
            'resolution.required' => 'Resolution field is required *',
            'accuracy.required' => 'Accuracy field is required *',
            'interval.required' => 'Due field is required *',
            'code.required' => 'Code field is required *',
        ]);

        $asset=Asset::find($id);
        $asset->name=$request->name;
        $asset->code=$request->code;
        $asset->parameter=$request->parameter;
        $asset->make=$request->make;
        $asset->model=$request->model;
        $asset->range=$request->range;
        $asset->status=$request->status;
        $asset->resolution=$request->resolution;
        $asset->accuracy=$request->accuracy;
        $asset->due=$request->due;
        $asset->commissioned=$request->commissioned;
        $asset->calibration=$request->calibration;
        $asset->calibration_interval=$request->interval;
        $due=strtotime($request->calibration)+(60*60*24*365)*$request->interval;
        $asset->due=date('Y-m-d',$due);
        $asset->certificate_no=$request->certificate;
        $asset->traceability=$request->traceability;
        $asset->serial_no=$request->serial;
        $asset->location=$request->location;
        if (isset($request->image)){
            $attachment=time().$request->image->getClientOriginalName();
            Storage::disk('local')->put('/public/assets/'.$attachment, File::get($request->image));
            $asset->image=$attachment;
        }
        $asset->save();
        return redirect()->back()->with('success', 'Asset updated successfully!');

    }
}
