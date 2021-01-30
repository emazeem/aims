<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccLevelTwoController extends Controller
{
    public function index(){
        $ones=AccLevelOne::all();
        return view('acc_level_two.index',compact('ones'));
    }
    public function fetch(){
        $data=AccLevelTwo::with('codeone')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('code2', function ($data) {
                return $data->codeone->code1.$data->code2;
            })
            ->addColumn('parent', function ($data) {
                return '<b class="text-danger">'.$data->codeone->title.'</b>';

            })

            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_two/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
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
            'level1' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1.required' => 'Level one is required.',
        ]);
        $acc=new AccLevelTwo();
        $acc->code1=$request->level1;
        $acc->title=$request->title;
        $acc->save();
        $reserved=AccLevelTwo::where('code1',$request->level1)->count();
        $acc->code2=str_pad($reserved, 2, '0', STR_PAD_LEFT);
        $acc->save();
        return  redirect()->back()->with('success', 'Level 2 has added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'level1' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1.required' => 'Level one is required.',
        ]);
        $acc=AccLevelTwo::find($request->id);
        $acc->code1=$request->level1;
        $acc->title=$request->title;
        $acc->save();
        return  redirect()->back()->with('success', 'Level 2 has updated successfully.');
    }
    public function edit($id){
        $level=2;
        $edit=AccLevelTwo::find($id);
        $ones=AccLevelOne::all();
        return view('acc_level_four.edit',compact('edit','level','ones'));
    }
    //
}
