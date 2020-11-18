<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Column;
use App\Models\Parameter;
use App\Models\Procedure;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock;
use Yajra\DataTables\DataTables;

class AssetController extends Controller
{
    //
    public function index(){
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
                return $data->next_due;
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
        return view('assets.show',compact('parameters','show','specifications','mycolumns','duplicate'));
    }

    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'make' => 'required',
            'model' => 'required',
            'range' => 'required',
            'resolution' => 'required',
            'accuracy' => 'required',
            'due' => 'required',
            'code' => 'required|unique:assets',
        ],[
            'name.required' => 'Asset name field is required *',
            'category.required' => 'Parameter field is required *',
            'make.required' => 'Make field is required *',
            'model.required' => 'Make field is required *',
            'range.required' => 'Make field is required *',
            'resolution.required' => 'Make field is required *',
            'accuracy.required' => 'Make field is required *',
            'due.required' => 'Make field is required *',
            'code.required' => 'Code field is required *',
        ]);

        $asset=new Asset();
        $asset->name=$request->name;
        $asset->code=$request->code;
        $asset->parameter=$request->category;
        $asset->make=$request->make;
        $asset->model=$request->model;
        $asset->range=$request->range;
        $asset->status=0;
        $asset->resolution=$request->resolution;
        $asset->accuracy=$request->accuracy;
        $asset->next_due=$request->due;
        $asset->save();
        return redirect()->back()->with('success', 'Asset Added Successfully');

    }
    public function update($id,Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'make' => 'required',
            'model' => 'required',
            'range' => 'required',
            'resolution' => 'required',
            'accuracy' => 'required',
            'due' => 'required',
            'code' => 'required|unique:assets',
        ],[
            'name.required' => 'Asset name field is required *',
            'category.required' => 'Parameter field is required *',
            'make.required' => 'Make field is required *',
            'model.required' => 'Make field is required *',
            'range.required' => 'Make field is required *',
            'resolution.required' => 'Make field is required *',
            'accuracy.required' => 'Make field is required *',
            'due.required' => 'Make field is required *',
            'code.required' => 'Code field is required *',
        ]);
        $asset=Asset::find($id);
        $asset->code=$request->code;
        $asset->name=$request->name;
        $asset->parameter=$request->category;
        $asset->make=$request->make;
        $asset->model=$request->model;
        $asset->range=$request->range;
        $asset->resolution=$request->resolution;
        $asset->accuracy=$request->accuracy;
        $asset->next_due=$request->due;
        $asset->save();
        return redirect()->back()->with('success', 'Asset Updated Successfully');

    }
}
