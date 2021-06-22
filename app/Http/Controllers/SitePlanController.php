<?php

namespace App\Http\Controllers;

use App\Models\Jobitem;
use App\Models\QuoteItem;
use App\Models\SitePlan;
use Yajra\DataTables\DataTables;

class SitePlanController extends Controller
{
    //
    public function index(){
        $this->authorize('site-receiving-index');
        return view('site_receiving.index');
    }
    public function fetch(){
        $this->authorize('site-receiving-index');
        $dummies=SitePlan::get();
        $ids=[];
        foreach ($dummies as $dummy){
            if (in_array(auth()->user()->id,explode(',',$dummy->assigned_users))){
                $ids[]=$dummy->id;
            }
        }
        $data=SitePlan::whereIn('id',$ids)->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->jobs->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->jobs->quotes->customers->reg_name;
            })
            ->addColumn('options', function ($data) {
                $action="<a title='view' href=".url('/site_receiving/show/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                return $action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function show($id){
        $this->authorize('site-receiving-index');
        $site=SitePlan::find($id);
        $items=QuoteItem::whereIn('id',[$site->quote_items])->get();
        $sitejobs=Jobitem::where('job_id',$site->job_id)->where('type',1)->get();
        return view('site_receiving.show',compact('site','items','sitejobs'));
    }

}
