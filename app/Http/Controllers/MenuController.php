<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index(){
        $this->authorize('menu-index');
        $parents=Menu::where('parent_id',null)->get();

        return view('menus',compact('parents'));
    }
    public function fetch(){
        $data=Menu::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('slug', function ($data) {
                return $data->slug;
            })
            ->addColumn('icon', function ($data) {
                return "<i class='".$data->icon."'></i> ".$data->icon;
            })

            ->addColumn('createdat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->created_at));
            })
            ->addColumn('updatedat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->updated_at));
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>
                ";
                $token=csrf_token();
                if (Auth::user()->can('items-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                }

                return "&emsp;".$action;

            })
            ->rawColumns(['options','icon'])
            ->make(true);
    }

    public function store(Request $request){

        $this->validate(request(), [
            'name' => 'required',
            'slug' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
            'slug.required' => 'Menu slug is required *',
        ]);
        $menus=new Menu();

        $menus->name=$request->name;
        $menus->slug=$request->slug;
        $menus->url=($request->url)?$request->url:'#';
        if (isset($request->is_nav)){
            $menus->status=1;
        }
        $max=Menu::max('position');
        $menus->position=$max+1;
        $menus->has_child=($request->has_child)?1:0;
        $menus->parent_id=($request->parent)?$request->parent:null;
        $menus->icon=($request->icon)?$request->icon:"fa fa-";
        $menus->status=1;
        $menus->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){

        $this->validate(request(), [
            'name' => 'required',
            'slug' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
            'slug.required' => 'Menu slug is required *',
        ]);
        $menus=Menu::find($request->id);
        $menus->name=$request->name;
        $menus->slug=$request->slug;
        $menus->url=($request->url)?$request->url:'#';
        $menus->parent_id=($request->parent)?$request->parent:null;
        $menus->has_child=($request->has_child)?1:0;
        $menus->status=1;
        $menus->icon=($request->icon)?$request->icon:"fa fa-";
        $menus->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $edit=Menu::find($request->id);

        return response()->json($edit);
    }
    public function manage(){
        $mens=Menu::all()->where('parent_id',null)->where('status',1);
        return view('manage-menus',compact('mens'));
    }
    public function manage_store(Request $request){
        //dd($request->all());
        $mens=Menu::all()->where('parent_id',null)->where('status',1);
        $i=0;
        foreach ($mens as $men) {
            $change=Menu::find($men->id);
            $change->position=$request->menu[$i];
            $change->save();
            $i++;
        }
        return redirect()->back()->with('success','Ordered successfully');

    }
    public function destroy(Request $request){

        Menu::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }


    //
}
