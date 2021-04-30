<?php

namespace App\Http\Controllers;

use App\Models\AccLevelThree;
use App\Models\Chartofaccount;
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

        $categories = InventoryCategory::where('status','Active')->where('parent_id',null)->get();
        /*foreach ($categories as $category){
            $acc=new AccLevelThree();
            $acc->code2=2;
            $acc->code1=1;
            $acc->title=$category->category_name;
            $reserved=AccLevelThree::withTrashed()->where('code2',2)->count();
            $acc->code3=str_pad($reserved+1, 2, '0', STR_PAD_LEFT);
            $acc->save();
        }*/
        return view('inventoryCategories.index')->with('categories',$categories);
    }
    public function fetch(){

        $data = InventoryCategory::with('parent')->with('account3')->with('account4')->orderBy('id','desc')->get();
        return DataTables::of($data)
            ->addColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d');
            })
            ->addColumn('category_name',function($data){
                return $data->category_name;
            })
            ->addColumn('account',function($data){
                if ($data->parent_id){
                    //return $data->account4->acc_code;
                }else{
                    //return $data->account3->codeone->code1.$data->account3->codetwo->code2.$data->account3->code3;
                }
            })
            ->addColumn('parent',function($data){
                if ($data->parent_id){
                    return $data->parent->category_name;
                }else{
                    return null;
                }
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
                /*if($data->status=='Active'){
                    return "&emsp;<a class='btn btn-success btn-sm edit'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-sm btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
                }else if($data->status=='Disable'){
                    return "&emsp;<a class='btn btn-success btn-sm edit'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-sm btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     ";
                }*/
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
        }
        else
        {
            $user_id = Auth::user()->id;
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
                $data = InventoryCategory::findOrFail($request->edit_id);
                $success = 'Category has been updated.';
            }else{
                $data = New InventoryCategory;
                $success = 'Category has been created.';
                if ($request->parent){
                    $category=InventoryCategory::find($request->parent);
                    $levelthree=AccLevelThree::find($category->acc_id);
                    $acc = new Chartofaccount();
                    $acc->code3 = $levelthree->id;
                    $acc->code2 =2;
                    $acc->code1 =1;
                    $acc->title = $request->category_name;
                    $code4=(Chartofaccount::withTrashed()->where('code3',$levelthree->id)->count());
                    $acc->code4 = str_pad($code4+1, 3, '0', STR_PAD_LEFT);
                    $acc->acc_code = $acc->codeone->code1 . $acc->codetwo->code2 . $acc->codethree->code3 . str_pad($code4+1, 4, '0', STR_PAD_LEFT);;
                }else{
                    $acc=new AccLevelThree();
                    $acc->code1=1;
                    $acc->code2=2;
                    $reserved=AccLevelThree::withTrashed()->where('code2',2)->count();
                    $acc->code3=str_pad($reserved+1, 2, '0', STR_PAD_LEFT);
                    $acc->title=$request->category_name;
                }
            }
            $data->category_name = $request->category_name;
            $data->parent_id=$request->parent?$request->parent:null;
            $data->user_id= $user_id;
            $data->status= $request->status;
            if ($data->save()) {
                if (isset($request->edit_id) && ($request->edit_id != "")){

                }else{
                    $acc->save();
                    $data->acc_id = $acc->id;
                }
                $data->save();
            }
            return back()->with('success',$success);
        }
    }
}