<?php

namespace App\Http\Controllers;

use App\Models\AccLevelFour;
use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccLevelFourController extends Controller
{
    public function index(){
        $ones=AccLevelOne::all();
        $twos=AccLevelTwo::all();
        $threes=AccLevelThree::all();
        return view('acc_level_four.index',compact('ones','twos','threes'));
    }
    public function fetch(){
        $data=AccLevelFour::with('codeone','codetwo','codethree')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('code2', function ($data) {
                return $data->codetwo->code2;
            })
            ->addColumn('code3', function ($data) {
                return $data->codethree->code3;
            })
            ->addColumn('acc_code', function ($data) {
                return $data->acc_code;
            })


            ->addColumn('code1', function ($data) {
                return $data->codeone->code1;
            })

            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/units/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }


    public function create(){
        return view('acc_level_one.create');
    }
    public function store(Request $request){


        //dd($request->all());
        $this->validate(request(), [
            'title' => 'required',
            'level1' => 'required',
            'level2' => 'required',
            'level3' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1.required' => 'Level one is required.',
            'level2.required' => 'Level two is required.',
            'level3.required' => 'Level two is required.',
        ]);
        $acc=new AccLevelFour();
        $acc->code3=$request->level3;
        $acc->code2=$request->level2;
        $acc->code1=$request->level1;
        $acc->title=$request->title;
        $acc->save();
        $acc->code4=str_pad($acc->id-1, 3, '0', STR_PAD_LEFT);
        $acc->save();
        $four=AccLevelFour::find($acc->id);
        $four->acc_code=$four->codeone->code1.$four->codetwo->code2.$four->codethree->code3.$four->code4;
        $four->save();
        return  redirect()->back()->with('success', 'Level 4 has added successfully.');
    }
    //
}
