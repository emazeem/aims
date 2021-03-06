<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Inventories;
use App\Models\InventoriesQuantity;
use App\Models\InventoryCategory;
use App\Models\Purchaseindentitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InventoriesController extends Controller
{
    public function index(){
        $categories=InventoryCategory::all()->where('parent_id',null);
        $departments=Department::all();
        return view('inventories.index',compact('categories','departments'));
    }
    public function fetch(){
        $data=Inventories::get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('category', function ($data) {
                return $data->category->category_name;
            })
            ->addColumn('department', function ($data) {
                return $data->department;
            })
            ->addColumn('model', function ($data) {
                return $data->model;
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })
            ->addColumn('subcategory', function ($data) {
                return $data->subcategory->category_name;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>
                    <a href='".url('/inventories/view/'.$data->id)."' title='View' class='btn btn-sm btn-warning'><i class='fa fa-eye'></i></a>
                  ";

            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request)
    {


        $this->validate(request(), [
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'depreciation' => 'required',
            'depreciation_duration' => 'required',
            'department' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $quantity = $request->quantity;
        $data = new Inventories();
        $data->user_id = $user_id;
        $data->title = $request->title;
        $data->model = $request->model;
        $data->department_id = $request->department;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->type = $request->type;
        $data->save();
        if ($request->item_id){
            $item=Purchaseindentitem::find($request->item_id);
            $item->inventory_id=$data->id;
            $item->save();
        }
        for ($i=0;$i<$quantity;$i++){
            $inventoryQty=new InventoriesQuantity();
            $inventoryQty->inventory_id=$data->id;
            $serial_no = str_replace(' ','-',$request->title).strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
            $inventoryQty->serial_no=$serial_no;
            $inventoryQty->quantity_type='IN';
            $inventoryQty->user_id=$user_id;
            $inventoryQty->status=0;
            $inventoryQty->save();
        }
        $success = 'Inventory has been created.';
        return back()->with('success',$success);
    }
    public function view($id){
        $show=Inventories::find($id);
        return view('inventories.show',compact('show'));
    }
    public function get_subcategories($id){
        $data=InventoryCategory::where('parent_id',$id)->get();
        return response()->json($data);
    }

    //

}
