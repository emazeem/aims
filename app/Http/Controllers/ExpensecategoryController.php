<?php

namespace App\Http\Controllers;

use App\Models\Expensecategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpensecategoryController extends Controller
{
    //
    public function index(){
        return view('expensecategory.index');
    }
    public function create(){
        $categories=Expensecategory::all()->where('parent_id',null);
        return view('expensecategory.create',compact('categories'));
    }
    public function fetch(){
        $data=Expensecategory::with('parent')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                if ($data->parent->name==null){
                    return '<b class="text-danger">'.$data->name.'</b>';
                }else{
                    return $data->name;
                }
            })
            ->addColumn('parent', function ($data) {
                return $data->parent->name;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/assets/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options','name'])
            ->make(true);

    }

    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required|unique:expensecategories',
        ],[
            'name.required' => 'Category/Subcategory is requried.',
        ]);
        $cat=new Expensecategory();
        $cat->name=$request->name;
        $cat->parent_id=($request->category_id) ? $request->category_id : null ;
        $cat->save();
        return  redirect()->back()->with('success', 'Category has been added successfully.');
    }



}
