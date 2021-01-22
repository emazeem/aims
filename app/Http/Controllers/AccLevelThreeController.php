<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccLevelThreeController extends Controller
{
    public function index(){
        $ones=AccLevelOne::all();
        $twos=AccLevelTwo::all();
        return view('acc_level_three.index',compact('ones','twos'));
    }
    public function fetch(){
        $data=AccLevelThree::with('codeone','codetwo')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('code3', function ($data) {
                return $data->codeone->code1.$data->codetwo->code2.$data->code3;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('parent', function ($data) {
                return '<b class="text-danger">'.$data->codeone->title.'</b> <i class="fa fa-angle-right"> </i> <b class="text-primary">'.$data->codetwo->title.'</b>';
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/units/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options','parent'])
            ->make(true);

    }


    public function create(){
        return view('acc_level_one.create');
    }
    public function store(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'level1of3' => 'required',
            'level2of3' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1of3.required' => 'Level one is required.',
            'level2of3.required' => 'Level two is required.',
        ]);
        $acc=new AccLevelThree();
        $acc->code2=$request->level2of3;
        $acc->code1=$request->level1of3;
        $acc->title=$request->title;
        $acc->save();
        $acc->code3=str_pad($acc->id, 2, '0', STR_PAD_LEFT);
        $acc->save();
        return  redirect()->back()->with('success', 'Level 3 has added successfully.');
    }
    public function get_level2($id){
        $level2=AccLevelTwo::where('code1',$id)->get();
        return response()->json($level2);
    }
    public function get_level3($id){
        $level3=AccLevelThree::where('code2',$id)->get();
        return response()->json($level3);
    }

    //
}
