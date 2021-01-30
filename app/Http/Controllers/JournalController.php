<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JournalController extends Controller
{
    public function index(){
        return view('journal.index');
    }
    public function fetch(){
        $data=Journal::with('createdby')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customize_id', function ($data) {
                return $data->customize_id;
            })
            ->addColumn('type', function ($data) {
                return ucwords(str_replace('-',' ',$data->v_type)).' Voucher';
            })
            ->addColumn('date', function ($data) {
                return $data->date;
                //return $data->v_date->format('d-M-Y');
            })
            ->addColumn('dr', function ($data) {
                return $data->dr;
            })
            ->addColumn('cr', function ($data) {
                return $data->cr;
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdby->fname.' '.$data->createdby->lname;
            })->make(true);
    }
}