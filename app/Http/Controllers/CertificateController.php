<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Labjob;
use App\Models\Sitejob;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CertificateController extends Controller
{
    //
    public function index(){
        $this->authorize('certificates-index');
        return view('certificates');
    }
    public function fetch(){
        $data=Certificate::with('labjobs','sitejobs')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('job', function ($data) {
                if($data->location=="LAB"){
                    return $data->labjobs->job_id;
                }else{
                    return $data->sitejobs->job_id;

                }
            })
            ->addColumn('quote', function ($data) {
                if($data->location=="LAB"){
                    return $data->labjobs->jobs->quote_id;
                }
                else{
                    return $data->sitejobs->jobs->quote_id;

                }
            })
            ->addColumn('eq_id', function ($data) {
                if ($data->location=="SITE"){
                    $eq=$data->sitejobs->eq_id;
                }
                if ($data->location=="LAB"){
                    $eq=$data->labjobs->eq_id;
                }
                return $eq;
            })
            ->addColumn('model', function ($data) {
                if ($data->location=="SITE"){
                    $model=$data->sitejobs->model;
                }
                if ($data->location=="LAB"){
                    $model=$data->labjobs->model;
                }
                return $model;
            })
            ->addColumn('customer', function ($data) {
                if ($data->location=="LAB") {
                    return $data->labjobs->jobs->quotes->customers->reg_name;

                }else{
                    return $data->sitejobs->jobs->quotes->customers->reg_name;
                }
            })
            ->make(true);
    }


}
