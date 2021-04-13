<?php

namespace App\Http\Controllers;

use App\Models\AccLevelOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AccLevelOneController extends Controller
{
    public function index(){
        return view('acc_level_one.index');
    }
    public function fetch(){
        $data=AccLevelOne::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('code', function ($data) {
                return $data->code1;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                $token=csrf_token();
                $action="<a title='Edit' class='btn btn-sm btn-success edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                if (Auth::user()->can('customer-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                return $action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function edit($id){
        $edit=AccLevelOne::find($id);
        return response()->json($edit);
    }
    public function store(Request $request){
        $this->validate(request(), [
            'title' => 'required',
        ],[
            'title.required' => 'Title is required.',
        ]);
        $acc=new AccLevelOne();
        $acc->title=$request->title;
        $acc->save();
        $reserved=AccLevelOne::get()->count();
        $acc->code1=str_pad($reserved, 1, '0', STR_PAD_LEFT);
        $acc->save();
        return  response()->json(['success'=>'Level 1 has added successfully.']);
    }
    public function update(Request $request){
        $this->validate(request(), [
            'title' => 'required',
        ],[
            'title.required' => 'Title is required.',
        ]);
        $acc=AccLevelOne::find($request->id);
        $acc->title=$request->title;
        $acc->save();
        return  response()->json(['success'=>'Level 1 has updated successfully.']);

    }
    public function destroy(Request $request){
        AccLevelOne::find($request->id)->delete();
        return response()->json(['success'=>'Acc. deleted successfully']);
    }
    //
}