<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PreferenceController extends Controller
{
    public function index(){
         return view('preferences.index');
    }
    public function fetch(){
        $data=Preference::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name?$data->name:$data->category;
            })
            ->addColumn('slug', function ($data) {
                return $data->slug;
            })
            ->addColumn('value', function ($data) {
                return $data->value;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;<a title='Edit' class='btn btn-sm btn-success' href='" . url('/preferences/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }
    public function create(){
        $categories=Preference::where('name',null)->get();
        return view('preferences.create',compact('categories'));
    }
    public function edit($id){
        $edit=Preference::find($id);
        $categories=Preference::where('name',null)->get();
        return view('preferences.edit',compact('categories','edit'));
    }

    public function store_category(Request $request){
        if ($request->edit_category){
            $this->validate($request,[
                'category'=>'required'
            ]);

            $slugify = new Slugify();
            $slug=$slugify->slugify($request->category);
            $preferences=Preference::find($request->edit_category);
            $preferences->slug=$slug;
            $preferences->category=$request->category;
            $preferences->save();
            return redirect()->back()->with('success','Category updated successfully');
        }
        $this->validate($request,[
            'category'=>'required'
        ]);
        $slugify = new Slugify();
        $slug=$slugify->slugify($request->category);
        $preferences=new Preference;
        $preferences->category=$request->category;
        $preferences->slug=$slug;
        $preferences->save();
        return redirect()->back()->with('success','Category added successfully');
    }
    public function store(Request $request){
        $slugify = new Slugify();
        $slug=$slugify->slugify($request->name);
        $this->validate($request,[
            'name'=>'required',
            'category'=>'required',
            'value'=>'required'
        ]);
        $preferences=new Preference;
        $preferences->name=$request->name;
        $preferences->slug=$slug;
        $preferences->category=$request->category;
        $preferences->value=$request->value;
        $preferences->save();
        return redirect()->back()->with('success','Preference value added successfully');
    }
    public function update(Request $request){
        $slugify = new Slugify();
        $slug=$slugify->slugify($request->name);
        $this->validate($request,[
            'name'=>'required',
            'category'=>'required',
            'value'=>'required'
        ]);
        $preferences=Preference::find($request->id);
        $preferences->name=$request->name;
        $preferences->slug=$slug;
        $preferences->category=$request->category;
        $preferences->value=$request->value;
        $preferences->save();
        return redirect()->back()->with('success','Preference value updated successfully');
    }


    //
}
