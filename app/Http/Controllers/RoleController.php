<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(){
        $this->authorize('roles-index');
        return view('roles.index');
    }
    public function fetch(){
        $this->authorize('roles-index');
        $data=Role::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<a href='roles/edit/".$data->id."' title='Edit' class='btn edit btn-sm btn-success'><i class='fa fa-edit'></i></a>
                ";
                $token=csrf_token();
                if (Auth::user()->can('items-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                }
                return "&emsp;".$action;

            })
            ->rawColumns(['options'])
            ->make(true);
    }

    public function create(){
        //$this->authorize('roles-create');
        //$menulist=Menu::all();
        $menuus=Menu::with('parent')->where('parent_id',null)->get();
        //dd($m);
        return view('roles.create',compact('menuus'));
    }
    public function edit($id){
        //$this->authorize('roles-edit');
        $edit=Role::find($id);
        $permissions=explode(',',$edit->permissions);
        $menuus=Menu::with('parent')->where('parent_id',null)->get();
        return view('roles.edit',compact('menuus','edit','permissions'));
    }

    public function store(Request $request){
        $this->authorize('roles-create');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
        ]);
        $permissions=implode(',',$request->menu_arr);
        $roles=new Role();
        $roles->name=$request->name;
        $roles->permissions=$permissions;
        $roles->save();
        return back()->with('success','Role created successfully');
    }
    public function update(Request $request){
        //$this->authorize('roles-edit');
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
        ]);
        $permissions=implode(',',$request->menu_arr);
        $roles=Role::find($request->id);
        $roles->name=$request->name;
        $roles->permissions=$permissions;
        $roles->save();
        return back()->with('success','Role updated successfully');
    }

    public function destroy(Request $request){
        Role::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }

    //
}
