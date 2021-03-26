<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class InventoryCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = InventoryCategory::where('status','Active')->get();
        return view('inventoryCategories.index')->with('categories',$categories);
    }
    public function fetch(){

        $data = InventoryCategory::orderBy('id','desc')->get();
        return DataTables::of($data)
            ->addColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d');
            })
            ->addColumn('category_name',function($data){
                return $data->category_name;
            })

            ->addColumn('status',function($data){
                if($data->status=='Disable') {
                    return '<span class="label label-danger">Disable</span>';
                }else if($data->status=='Active'){
                    return '<span class="label label-success">Active</span>';
                }
                else{
                    return '<span class="label  label-primary">'.$data->status.'</span>';
                }
            })

            ->addColumn('options',function($data){
                if($data->status=='Active'){
                    return "&emsp;<a class='btn btn-success btn-sm edit'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-sm btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
                }else if($data->status=='Disable'){
                    return "&emsp;<a class='btn btn-success btn-sm edit'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-sm btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     ";
                }
            })->rawColumns(['created_at', 'status','options'])
            ->make(true);
    }
    public function edit(Request $request){
        return response()->json(InventoryCategory::find($request->id));
    }
    public function store(Request $request)
    {
        $rules = array(
            'category_name' => 'required',
        );
        $data = [
            'category_name' => trim($request->get('category_name')),
        ];
        $validator = Validator::make($data,$rules);

        if($validator->fails())
        {
            return  response()->json(['errors'=>$validator->errors()]);
        }else
        {
            $user_id = Auth::user()->id;
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
                $data = InventoryCategory::findOrFail($request->edit_id);
                $data->category_name = $request->category_name;
                $data->status     = $request->status;
                $data->save();
                $success = 'Category has been updated.';
                return back()->with('success',$success);
            }else{
                $data = New InventoryCategory;
                $data->category_name = $request->category_name;
                $data->user_id= $user_id;
                $data->status= $request->status;
                $data->save();
                $success = 'Category has been created.';
                return back()->with('success',$success);
            }
        }
    }

}
