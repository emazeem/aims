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
    public function index()
    {
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('acc_level_four.index', compact('ones', 'twos', 'threes'));
    }

    public function fetch()
    {
        $data = Chartofaccount::with('codeone','codetwo','codethree');
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->editColumn('acc_code', function ($data) {
                return $data->acc_code;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('parent', function ($data) {
                return $data->codethree->codetwo->codeone->title;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_four/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";
            })
            ->rawColumns(['options',])
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
    public function create()
    {
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('acc_level_four.create', compact('ones', 'twos', 'threes'));
    }

    public function edit($id)
    {
        $level = 4;
        $edit = Chartofaccount::find($id);
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('acc_level_four.edit', compact('ones', 'twos', 'threes', 'edit', 'level'));
    }

    public function store(Request $request)
    {
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
            'level3of4.required' => 'Level three is required.',
        ]);

        $acc = new Chartofaccount();
        $acc->code3 = $request->level3of4;
        $acc->code2 = $request->level2of4;
        $acc->code1 = $request->level1of4;
        $acc->title = $request->title;
        $acc->save();
        $code4=(Chartofaccount::where('code3',$request->level3of4)->count());
        $four = Chartofaccount::find($acc->id);
        $four->code4 = str_pad($code4, 4, '0', STR_PAD_LEFT);
        $four->acc_code = $four->codeone->code1 . $four->codetwo->code2 . $four->codethree->code3 . str_pad($code4, 4, '0', STR_PAD_LEFT);;
        $four->save();
        return redirect()->back()->with('success', 'Chart of Account has added successfully.');
    }
    public function update(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'level1of4' => 'required',
            'level2of4' => 'required',
            'level3of4' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'level1of4.required' => 'Level one is required.',
            'level2of4.required' => 'Level two is required.',
            'level3of4.required' => 'Level two is required.',
        ]);
        $acc = Chartofaccount::find($request->id);
        $acc->code3 = $request->level3of4;
        $acc->code2 = $request->level2of4;
        $acc->code1 = $request->level1of4;
        $acc->title = $request->title;
        $acc->save();
        return redirect()->back()->with('success', 'Chart of Account has updated successfully.');
    }
    //
}