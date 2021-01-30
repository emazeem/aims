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
                $code='<span class="border-bottom font-weight-bold">'.str_pad($data->code1, 9, '0', STR_PAD_RIGHT).'</span><br>';
                foreach ($data->leveltwo as $item) {
                    $code = $code . '&emsp;<span class="text-primary border-bottom font-weight-bold">' . str_pad($data->code1 . $item->code2, 9, '0', STR_PAD_RIGHT) . '</span><br>';
                    foreach ($item->levelthree as $value) {
                        $code = $code .'<span class="text-warning border-bottom font-weight-bold"> &emsp;&emsp;' . str_pad($data->code1 . $item->code2 . $value->code3, 9, '0', STR_PAD_RIGHT) . '</span><br>';
                        foreach ($value->levelfour as $chart) {
                            $code = $code . ' &emsp;&emsp;&emsp;<span class="text-danger border-bottom font-weight-bold">' . $chart->acc_code . '</span><br>';
                        }
                    }

                    }
                return $code;
            })
            ->addColumn('title', function ($data) {
                $title='<span class="border-bottom font-weight-bold">'.$data->title.'</span><br>';
                foreach ($data->leveltwo as $item){
                    $title=$title.' &emsp;<span class="text-primary border-bottom font-weight-bold">'.$item->title.'</span><br>';
                    foreach ($item->levelthree as $value) {
                        $title = $title . ' &emsp;&emsp;<span class="text-warning border-bottom font-weight-bold">' .$value->title. '</span><br>';
                        foreach ($value->levelfour as $chart) {
                            $title = $title . ' &emsp;&emsp;&emsp;<span class="text-danger border-bottom font-weight-bold">' . $chart->title . '</span><br>';
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