<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use App\Models\AccLevelThree;
use App\Models\AccLevelTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $reserved=AccLevelTwo::where('code1',$request->level1)->count();
        $acc->code2=str_pad($reserved+1, 2, '0', STR_PAD_LEFT);
        $acc->save();
        return  response()->json(['success'=>'Level 2 added successfully.']);

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
        return  response()->json(['success'=>'Level 2 updated successfully.']);

    }
    public function edit($id){
        $edit=AccLevelTwo::find($id);
        return response()->json($edit);
    }
    public function destroy(Request $request){
        AccLevelTwo::find($request->id)->delete();
        return response()->json(['success'=>'Acc. deleted successfully']);
    }
    //
}
