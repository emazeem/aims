<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function index(){
        return view('activitylog.index');
    }
    public function show(){
        $activities = Activity::orderBy('id','DESC')->get();
        return view('activitylog.show',compact('activities'));
    }
    public function fetch(){
        $data=Activity::with('performedBy')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->addColumn('subject_id', function ($data) {
                return $data->subject_id;
            })
            ->addColumn('subject_type', function ($data) {
                return $data->subject_type;
            })
            ->addColumn('causer_id', function ($data) {
                return $data->performedBy->fname.' '.$data->performedBy->lname;
            })
            ->addColumn('properties', function ($data) {
                return $data->properties;
            })
            ->addColumn('created_at', function ($data) {
                return $data->created_at;
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    //
}
