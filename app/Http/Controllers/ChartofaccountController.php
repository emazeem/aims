<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use App\Models\Chartofaccount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ChartofaccountController extends Controller
{
    public function index(){
        $ones=AccLevelOne::all();
        $twos=AccLevelTwo::all();
        $threes=AccLevelThree::all();
        return view('acc_level_four.index',compact('ones','twos','threes'));
    }
    public function fetch(){
        $data=AccLevelOne::with('leveltwo')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('acc_code', function ($data) {
                $code='<div class="bg-dark text-light font-weight-bold">'.str_pad($data->code1, 9, '0', STR_PAD_RIGHT).'</div>';
                foreach ($data->leveltwo as $item) {
                    $code = $code . '<div class="bg-primary text-light font-weight-bold ml-5">' . str_pad($data->code1 . $item->code2, 9, '0', STR_PAD_RIGHT) . '</div>';
                    foreach ($item->levelthree as $value) {
                        $code = $code .'<div class="font-weight-bold ml-5"><div class="bg-warning ml-5">' . str_pad($data->code1 . $item->code2 . $value->code3, 9, '0', STR_PAD_RIGHT) . '</div></div>';
                        foreach ($value->levelfour as $chart) {
                            $code = $code . '<div class="font-weight-bold ml-5 text-light"><div class=" ml-5"><div class="bg-danger ml-5">' . $chart->acc_code . '</div></div></div>';
                        }
                    }

                    }
                return $code;
            })
            ->addColumn('title', function ($data) {
                $title='<div class="bg-dark text-light font-weight-bold m-0">'.$data->title.'</div>';
                foreach ($data->leveltwo as $item){
                    $title=$title.'<div class="bg-primary text-light font-weight-bold ml-5">'.$item->title.'</div>';
                    foreach ($item->levelthree as $value) {
                        $title = $title . '<div class="ml-5 font-weight-bold"><div class="bg-warning ml-5">' .$value->title. '</div></div>';
                        foreach ($value->levelfour as $chart) {
                            $title = $title . '<div class="ml-5 font-weight-bold text-light"><div class=" ml-5"><div class="bg-danger ml-5">' . $chart->title . '</div></div></div>';
                        }
                    }
                }
                return $title;
            })
            ->addColumn('parent', function ($data) {
                return $data->title;
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_four/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";
            })
            ->rawColumns(['options','title','acc_code'])
            ->make(true);
    }
    /*public function fetch(){
        $data=Chartofaccount::with('codeone','codetwo','codethree')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('acc_code', function ($data) {
                return $data->acc_code;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('parent', function ($data) {
                return '<b class="text-danger">'.$data->codeone->title.'</b> <i class="fa fa-angle-right"> </i> <b class="text-primary">'.$data->codetwo->title.'</b></b> <i class="fa fa-angle-right"> </i> <b class="text-success">'.$data->codethree->title.'</b>';
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_four/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";
            })
            ->rawColumns(['options','parent'])
            ->make(true);
    }
    */
    public function create(){
        $ones=AccLevelOne::all();
        $twos=AccLevelTwo::all();
        $threes=AccLevelThree::all();
        return view('acc_level_four.create',compact('ones','twos','threes'));
    }
    public function edit($id){
        $level=4;
        $edit=Chartofaccount::find($id);
        $ones=AccLevelOne::all();
        $twos=AccLevelTwo::all();
        $threes=AccLevelThree::all();
        return view('acc_level_four.edit',compact('ones','twos','threes','edit','level'));
    }
    public function store(Request $request){


        //dd($request->all());
        $this->validate(request(), [
            'title' => 'required',
            'level1of4' => 'required',
            'level2of4' => 'required',
            'level3of4' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1of4.required' => 'Level one is required.',
            'level2of4.required' => 'Level two is required.',
            'level3of4.required' => 'Level two is required.',
        ]);
        $acc=new Chartofaccount();
        $acc->code3=$request->level3of4;
        $acc->code2=$request->level2of4;
        $acc->code1=$request->level1of4;
        $acc->title=$request->title;
        $acc->save();
        $acc->code4=str_pad($acc->id, 4, '0', STR_PAD_LEFT);
        $acc->save();
        $four=Chartofaccount::find($acc->id);
        $four->acc_code=$four->codeone->code1.$four->codetwo->code2.$four->codethree->code3.$four->code4;
        $four->save();
        return  redirect()->back()->with('success', 'Chart of Account has added successfully.');
    }
    public function update(Request $request){


        //dd($request->all());
        $this->validate(request(), [
            'title' => 'required',
            'level1of4' => 'required',
            'level2of4' => 'required',
            'level3of4' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1of4.required' => 'Level one is required.',
            'level2of4.required' => 'Level two is required.',
            'level3of4.required' => 'Level two is required.',
        ]);
        $acc=Chartofaccount::find($request->id);
        $acc->code3=$request->level3of4;
        $acc->code2=$request->level2of4;
        $acc->code1=$request->level1of4;
        $acc->title=$request->title;
        $acc->save();
        return  redirect()->back()->with('success', 'Chart of Account has updated successfully.');
    }

    //
}