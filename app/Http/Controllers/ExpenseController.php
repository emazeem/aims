<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Expensecategory;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(){
        return view('expenses.index');
    }
    public function fetch(){
        $data=Expense::with('categories')->with('subcategories')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('category', function ($data) {
                return $data->categories->name;
            })
            ->addColumn('subcategory', function ($data) {
                return $data->subcategories->name;
            })

            ->addColumn('description', function ($data) {
                return $data->description;
            })
            ->addColumn('amount', function ($data) {
                return $data->amount;
            })
            ->addColumn('to', function ($data) {
                return $data->user_name;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/expenses/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  ";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }

    public function create(){
        $users=User::all();
        $categories=Expensecategory::all()->where('parent_id',null);
        return view('expenses.create',compact('categories','users'));
    }
    public function edit($id){
        $users=User::all();
        $edit=Expense::find($id);
        $categories=Expensecategory::all()->where('parent_id',null);
        $subcategories=Expensecategory::all()->where('parent_id',!null);
        return view('expenses.edit',compact('categories','users','edit','subcategories'));
    }

    public function get_subcategories($id){
        $states=Expensecategory::where('parent_id', $id)
            ->pluck('id', 'name')
            ->all();
        return response()->json($states);
    }
    public function store(Request $request){
        $this->validate(request(), [
            'category' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);
        $expense=new Expense();
        $expense->category=$request->category;
        $expense->subcategory=$request->subcategory;
        $expense->amount=$request->amount;
        $expense->user_name=$request->user;
        $expense->description=$request->description;
        $expense->save();
        return  redirect()->back()->with('success', 'Expense has been added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'category' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);
        $expense=Expense::find($request->id);
        $expense->category=$request->category;
        $expense->subcategory=$request->subcategory;
        $expense->amount=$request->amount;
        $expense->user_name=$request->user;
        $expense->description=$request->description;
        $expense->save();
        return  redirect()->back()->with('success', 'Expense has been updated successfully.');
    }



    //
}
