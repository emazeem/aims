<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index(){
        $this->authorize('menu-index');
        $parents=Menu::where('parent_id',null)->get();

        return view('menus',compact('parents'));
    }
    public function fetch(){
        $check=Session::get('filter_data');
        if (empty($check)){
            $data=Menu::all();
        }else{
            if ($check['type']=='parent'){
                $data=Menu::all()->where('parent_id',null);
            }
            if ($check['type']=='child'){
                $data=Menu::all()->where('has_child',1);
            }
            if ($check['type']=='other'){
                $data=Menu::all()->where('has_child',0)->where('parent_id',!null);
            }

        }
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
            ->addColumn('status', function ($data) {
                if ($data->status==0){
                    return "<span class='badge badge-danger'>Inactive</span>";
                }
                else
                    return "<span class='badge badge-success'>Active</span>";
            })


            ->addColumn('createdat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->created_at));
            })
            ->addColumn('updatedat', function ($data) {
                return date('h:i A d M,Y',strtotime($data->updated_at));
            })
            ->addColumn('options', function ($data) {

                $action=null;
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>
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
            ->rawColumns(['options','icon','status'])
            ->make(true);
    }

    public function store(Request $request){

        $this->validate(request(), [
            'name' => 'required',
            'slug' => 'required',
            'position' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
            'slug.required' => 'Menu slug is required *',
            'position.required' => 'Menu position is required *',
        ]);
        $menus=new Menu();

        $menus->position=$request->position;
        $menus->name=$request->name;
        $menus->slug=$request->slug;
        $menus->url=($request->url)?$request->url:'#';
        if (isset($request->is_nav)){
            $menus->status=1;
        }
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
            'position' => 'required',
        ],[
            'name.required' => 'Menu name is required *',
            'slug.required' => 'Menu slug is required *',
        ]);
        $menus=Menu::find($request->id);
        $menus->name=$request->name;
        $menus->slug=$request->slug;
        $menus->position=$request->position;
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
    public function destroy(Request $request){

        Menu::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    public function search(Request $request){
        $request->session()->forget('filter_data');
        $this->validate($request,[
            'type'=>'required',
        ]);
        $filter_data['type']=$request->type;
        Session::put('filter_data', $filter_data);
//        dd($request->session()->get('filter_data'));
        return back();
    }


    public function manage(){
        $mens=Menu::where('parent_id',null)->where('status',1)->orderBy('position','ASC')->get();
        //$childs=Menu::all()->where('parent_id',!null)->where('status',1)->where('has_child',1);
        return view('manage-menus',compact('mens'));
    }
    public function store_position(Request $request){
        $menus=Menu::find($request->id);
        $menus->position=$request->position;
        $menus->save();
    }
    public function remove_position(Request $request){
        $menus=Menu::find($request->id);
        $menus->position=0;
        $menus->save();
        return response()->json(['success'=>'Position removed successfully']);
    }



    //
}
