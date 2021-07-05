<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use App\Models\Chartofaccount;
use App\Models\CostCenter;
use App\Models\Customer;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ChartofaccountController extends Controller
{
    public function index()
    {
        /*$customers = Customer::all();
        foreach ($customers as $customer) {
            $acc = new Chartofaccount();
            $acc->code3 = 3;
            $acc->code2 = 1;
            $acc->code1 = 1;
            $acc->title = $customer->reg_name.'-'.$customer->plant;
            $acc->opening_balance=0;
            $code4=(Chartofaccount::withTrashed()->where('code3',3)->count());
            $acc->code4 = str_pad($code4+1, 3, '0', STR_PAD_LEFT);
            $acc->acc_code = $acc->codeone->code1 . $acc->codetwo->code2 . $acc->codethree->code3 . str_pad($code4+1, 3, '0', STR_PAD_LEFT);;
            $acc->save();
            $customer->acc_code=$acc->acc_code;
            $customer->save();
        }
        dd(1);*/






        $this->authorize('index-coa');
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('chartofaccount.index', compact('ones', 'twos', 'threes'));
    }

    public function fetch()
    {
        $this->authorize('index-coa');
        $data = Chartofaccount::with('codeone','codetwo','codethree','cc')->get();
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
                if (Auth::user()->can('update-coa')){
                    $action.="<a title='Edit' class='btn btn-sm btn-success' href='" . url('/chartofaccount/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }
                if (Auth::user()->can('delete-coa')){
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

    public function create()
    {
        $this->authorize('create-coa');
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('chartofaccount.create', compact('ones', 'twos', 'threes'));
    }

    public function edit($id)
    {
        $this->authorize('update-coa');
        $level = 4;
        $edit = Chartofaccount::find($id);
        $ones = AccLevelOne::all();
        $twos = AccLevelTwo::all();
        $threes = AccLevelThree::all();
        return view('chartofaccount.edit', compact('ones', 'twos', 'threes', 'edit', 'level'));
    }

    public function store(Request $request)
    {
        $this->authorize('create-coa');
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
        $acc->opening_balance=$request->opening_balance?$request->opening_balance:0;
        $code4=(Chartofaccount::withTrashed()->where('code3',$request->level3of4)->count());
        $acc->code4 = str_pad($code4+1, 3, '0', STR_PAD_LEFT);
        $acc->acc_code = $acc->codeone->code1 . $acc->codetwo->code2 . $acc->codethree->code3 . str_pad($code4+1, 3, '0', STR_PAD_LEFT);;
        $acc->save();
        return response()->json(['success'=> 'Chart of Account has added successfully.']);
    }
    public function update(Request $request)
    {
        $this->authorize('update-coa');
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
        $acc->opening_balance=$request->opening_balance?$request->opening_balance:0;
        $acc->title = $request->title;
        $acc->save();
        return response()->json(['success'=> 'Chart of Account has updated successfully.']);
    }
    public function destroy(Request $request){
        $this->authorize('delete-coa');
        Chartofaccount::find($request->id)->delete();
        return response()->json(['success'=>'Chart of Account deleted successfully']);
    }
    public function show(){
        $this->authorize('view-coa');
        $accounts =AccLevelOne::all();
        return view('chartofaccount.show',compact('accounts'));
    }
    public function prints(){
        $accounts =AccLevelOne::all();
        return view('chartofaccount.print',compact('accounts'));
    }

    public function mycc($acc){
        $account=Chartofaccount::where('acc_code',$acc)->first();
        $cc=CostCenter::where('parent_id',$account->id)->get();
        return response()->json($cc);
    }
    public function mycoa($id){

        $account=Chartofaccount::where('code3',$id)->get();
        return response()->json($account);
    }

    //
}