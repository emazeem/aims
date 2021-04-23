<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                return $data->codeone->code1.'.'.$data->codetwo->code2.'.'.$data->code3.'.000';
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('parent', function ($data) {
                return '<b class="text-danger">'.$data->codeone->title.'</b> <i class="fa fa-angle-right"> </i> <b class="text-primary">'.$data->codetwo->title.'</b>';
            })
            ->addColumn('cost-center', function ($data) {

                $action=null;
                $token=csrf_token();
                $action="<a title='Edit' class='btn btn-sm btn-success edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
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

            ->addColumn('options', function ($data) {

                $action=null;
                $token=csrf_token();
                $action="<a title='Edit' class='btn btn-sm btn-success edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
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
            ->rawColumns(['options','parent','cost-center'])
            ->make(true);

    }


    public function create(){
        return view('acc_level_one.create');
    }
    public function store(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'level1' => 'required',
            'level2of3' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1of3.required' => 'Level one is required.',
            'level2of3.required' => 'Level two is required.',
        ]);
        $acc=new AccLevelThree();
        $acc->code2=$request->level2of3;
        $acc->code1=$request->level1;
        $acc->title=$request->title;
        $reserved=AccLevelThree::withTrashed()->where('code2',$request->level2of3)->count();
        $acc->code3=str_pad($reserved+1, 2, '0', STR_PAD_LEFT);
        $acc->save();
        return  response()->json(['success'=>'Level 3 added successfully.']);

    }
    public function update(Request $request){
        $this->validate(request(), [
            'title' => 'required',
            'level1' => 'required',
            'level2of3' => 'required',
        ],[
            'title.required' => 'Title is required.',
            'level1of3.required' => 'Level one is required.',
            'level2of3.required' => 'Level two is required.',
        ]);
        $acc=AccLevelThree::find($request->id);
        $acc->code2=$request->level2of3;
        $acc->code1=$request->level1;
        $acc->title=$request->title;
        $acc->save();
        return  response()->json(['success'=>'Level 3 updated successfully.']);

    }
    public function get_level2($id){
        $level2=AccLevelTwo::where('code1',$id)->get();
        return response()->json($level2);
    }
    public function get_level3($id){
        $level3=AccLevelThree::where('code2',$id)->get();
        return response()->json($level3);
    }

    public function edit($id){
        $edit=AccLevelThree::find($id);
        $edit['code2_title']=AccLevelTwo::find($edit->code2)->title;
        return response()->json($edit);
    }
    public function destroy(Request $request){
        AccLevelThree::find($request->id)->delete();
        return response()->json(['success'=>'Acc. deleted successfully']);
    }
    //
}
