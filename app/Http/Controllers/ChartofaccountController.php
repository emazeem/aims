<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use App\Models\Chartofaccount;
use App\Models\CostCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $data = Chartofaccount::with('codeone','codetwo','codethree','cc');
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
                return '<b class="text-danger">'.$data->codeone->title.'</b> <i class="fa fa-angle-right"> </i> <b class="text-primary">'.$data->codetwo->title.'</b> <i class="fa fa-angle-right"> </i> <b class="text-warning">'.$data->codethree->title.'</b>';
            })
            ->addColumn('cost.center', function ($data) {
                $action=null;
                $action.="<a title='Show Cost Center' href='' class='btn btn-warning btn-sm view-cc' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                $action.="<a title='Add Cost Center' href='' class='btn btn-primary btn-sm add-cc' data-id='" . $data->id . "'><i class='fa fa-plus-circle'></i></a>";
                return $action;
            })

            ->addColumn('options', function ($data) {
                $action=null;
                $token=csrf_token();
                $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/acc_level_four/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                if (Auth ::user()->can('customer-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                return $action;
            })
            ->rawColumns(['options','parent','cost.center'])
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
        $code4=(Chartofaccount::withTrashed()->where('code3',$request->level3of4)->count());
        $acc->code4 = str_pad($code4+1, 3, '0', STR_PAD_LEFT);
        $acc->acc_code = $acc->codeone->code1 . $acc->codetwo->code2 . $acc->codethree->code3 . str_pad($code4+1, 4, '0', STR_PAD_LEFT);;
        $acc->save();
        return response()->json(['success'=> 'Chart of Account has added successfully.']);
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
    public function destroy(Request $request){
        Chartofaccount::find($request->id)->delete();
        return response()->json(['success'=>'Chart of Account deleted successfully']);
    }
    public function show(){
        $accounts =AccLevelOne::all();
        return view('acc_level_four.show',compact('accounts'));
    }
    public function mycc($acc){
        $account=Chartofaccount::where('acc_code',$acc)->first();
        $cc=CostCenter::where('parent_id',$account->id)->get();
        return response()->json($cc);
    }
    //
}