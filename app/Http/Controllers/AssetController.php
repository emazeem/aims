<?php

namespace App\Http\Controllers;

use App\Charts\AssetChart;
use App\Models\Asset;
use App\Models\Assetspecification;
use App\Models\Column;
use App\Models\Intermediatechecksofasset;
use App\Models\Parameter;
use App\Models\Preventivemaintenancerecord;
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
    public function index()
    {
        /*$temps=Asset::all();
        foreach ($temps as $temp){
            $asset=Asset::find($temp->id);
            $asset->calibration_interval=1;
            $due=strtotime($temp->calibration)+(60*60*24*365);
            $asset->due=date('Y-m-d',$due);
            $asset->save();
        }
        dd('done');*/

        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }

    public function fetch()
    {
        $data = Asset::with('parameters')->get();
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
                $status = null;
                if ($data->status == 0) {
                    $status .= "<span class='badge badge-success'>Available</span>";
                }
                if ($data->status == 1) {
                    $status .= "<span class='badge badge-danger'>Booked</span>";
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
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/assets/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/assets/show/' . $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";

            })
            ->rawColumns(['options', 'status'])
            ->make(true);

    }

    public function create()
    {
        $parameters = Parameter::all();
        return view('assets.create', compact('parameters'));
    }

    public function edit($id)
    {
        $edit = Asset::find($id);
        $parameters = Parameter::all();
        return view('assets.edit', compact('parameters', 'edit'));
    }

    public function show($id)
    {

        $show = Asset::find($id);
        $parameters = Parameter::all();
        $specifications = Assetspecification::with('columns')->where('asset_id', $id)->get();
        $check_duplicate_specifications = Assetspecification::where('asset_id', $id)->get();
        $duplicate = array();
        foreach ($check_duplicate_specifications as $check_duplicate_specification) {
            $duplicate[] = $check_duplicate_specification->asset_id;
        }
        $columns = Column::all();
        $mycolumns = array();
        foreach ($columns as $column) {
            $assets = explode(',', $column->assets);
            if (in_array($id, $assets)) {
                $mycolumns[] = $column;

            }
        }
        for($x=1;$x<12;$x++){
            $average[$x]=null;
        }
        $intermediatechecks = Intermediatechecksofasset::where('equipment_under_test_id', $id)->get();
        $limit_of_intermediatecheck = true;
        if ($show->calibration == '1900-01-01') {
            $limit_of_intermediatecheck = false;
        } else {
            $limit_of_intermediatecheck = true;
        }
        $available = Intermediatechecksofasset::where('equipment_under_test_id', $id)->first();
        if (isset($available)) {
            $asset = Asset::find($id);
            $difference = strtotime($asset->due) - strtotime($asset->calibration);
            $threemonthscheck = 60 * 60 * 24 * 91;
            $repetition = $difference / $threemonthscheck;
            $repetition = (int)$repetition - 1;
            $count = Intermediatechecksofasset::where('equipment_under_test_id', $id)->count();
            if ($count == $repetition - 1) {
                $limit_of_intermediatecheck = true;
            }
        }
        $limit_of_intermediatecheck = null;
        $checklists = Preventivemaintenancerecord::where('asset_id', $id)->get();
        $ual = null;
        $uwl = null;
        $lwl = null;
        $lal = null;
        $averages = null;
        $ual_points = null;
        $uwl_points = null;
        $lwl_points = null;
        $lal_points = null;

        $slices=count($intermediatechecks);
        if (count($intermediatechecks) > 0) {
            foreach ($intermediatechecks as $key => $intermediatecheck) {
                foreach (explode(',', $intermediatecheck->measured_value) as $measured_value) {
                    if ($key == 0) {
                        $first_columns[] = $measured_value;
                    }else{
                       $temp= explode(',',$intermediatecheck->measured_value);
                       $average[$key]=array_sum($temp)/count($temp);
                    }
                }
            }
            $average[0] = array_sum($first_columns) / count($first_columns);
            $sum_difference_square = 0;
            $average[0] = array_sum($first_columns) / count($first_columns);
            foreach ($first_columns as $first_column) {
                $sum_difference_square = $sum_difference_square + (($first_column - $average[0]) * ($first_column - $average[0]));
            }
            $sd = sqrt($sum_difference_square / (count($first_columns) - 1));
            $uwl = $average[0] + (2 * $sd);
            $lwl = $average[0] - (2 * $sd);
            $ual = $average[0] + (3 * $sd);
            $lal = $average[0] - (3 * $sd);
            $averages = [
                0 => $average[0],
                1 => $average[1],
                2 => $average[2],
                3 => $average[3],
                4 => $average[4],
                5 => $average[5],
                6 => $average[6],
                7 => $average[7],
                8 => $average[8],
                9 => $average[9],
                10 => $average[10],
                11 => $average[11]
            ];
            $ual_points = array(
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual),
                array( "y" => $ual)
            );
            $uwl_points = array(
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl),
                array( "y" => $uwl)
            );
            $average = array(
                array( "y" => $averages[0]),
                array( "y" => $averages[1]),
                array( "y" => $averages[2]),
                array( "y" => $averages[3])
            );
            $lwl_points = array(
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl),
                array( "y" => $lwl)
            );
            $lal_points = array(
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal),
                array( "y" => $lal)
            );
            $ual_points=array_slice($ual_points,0,$slices);
            $uwl_points=array_slice($uwl_points,0,$slices);
            $lwl_points=array_slice($lwl_points,0,$slices);
            $lal_points=array_slice($lal_points,0,$slices);
            $averages=array_slice($averages,0,$slices);
        }





        return view('assets.show', compact('ual', 'uwl', 'lwl', 'lal', 'averages', 'ual_points',
            'uwl_points', 'average', 'lwl_points', 'lal_points', 'parameters', 'show', 'specifications', 'mycolumns',
            'duplicate', 'intermediatechecks', 'limit_of_intermediatecheck', 'checklists'));
    }

    public function store(Request $request)
    {
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
        ], [
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

        $asset = new Asset();
        $asset->name = $request->name;
        $asset->code = $request->code;
        $asset->parameter = $request->parameter;
        $asset->make = $request->make;
        $asset->model = $request->model;
        $asset->range = $request->range;
        $asset->status = $request->status;
        $asset->resolution = $request->resolution;
        $asset->accuracy = $request->accuracy;
        $asset->due = $request->due;
        $asset->commissioned = $request->commissioned;
        $asset->calibration_interval = $request->interval;
        $due = strtotime($request->calibration) + (60 * 60 * 24 * 365) * $request->interval;
        $asset->due = date('Y-m-d', $due);
        $asset->calibration = $request->calibration;
        $asset->certificate_no = $request->certificate;
        $asset->traceability = $request->traceability;
        $asset->serial_no = $request->serial;
        $asset->location = $request->location;
        if (isset($request->image)) {
            $attachment = time() . $request->image->getClientOriginalName();
            Storage::disk('local')->put('/public/assets/' . $attachment, File::get($request->profile));
            $asset->image = $attachment;
        }
        $asset->save();
        return redirect()->back()->with('success', 'Asset added successfully');

    }

    public function update($id, Request $request)
    {
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

            'code' => 'required|unique:assets,code,' . $request->id,
        ], [
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

        $asset = Asset::find($id);
        $asset->name = $request->name;
        $asset->code = $request->code;
        $asset->parameter = $request->parameter;
        $asset->make = $request->make;
        $asset->model = $request->model;
        $asset->range = $request->range;
        $asset->status = $request->status;
        $asset->resolution = $request->resolution;
        $asset->accuracy = $request->accuracy;
        $asset->due = $request->due;
        $asset->commissioned = $request->commissioned;
        $asset->calibration = $request->calibration;
        $asset->calibration_interval = $request->interval;
        $due = strtotime($request->calibration) + (60 * 60 * 24 * 365) * $request->interval;
        $asset->due = date('Y-m-d', $due);
        $asset->certificate_no = $request->certificate;
        $asset->traceability = $request->traceability;
        $asset->serial_no = $request->serial;
        $asset->location = $request->location;
        if (isset($request->image)) {
            $attachment = time() . $request->image->getClientOriginalName();
            Storage::disk('local')->put('/public/assets/' . $attachment, File::get($request->image));
            $asset->image = $attachment;
        }
        $asset->save();
        return redirect()->back()->with('success', 'Asset updated successfully!');

    }
}
