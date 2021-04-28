<?php

namespace App\Http\Controllers;

use App\Models\ScopeOfSupply;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Laravel\Passport\Scope;
use Yajra\DataTables\DataTables;

class VendorsController extends Controller
{

    public function index()
    {
        return view('vendors.index');
    }

    public function fetch()
    {
        $data = Vendors::all();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('reg_no', function ($data) {
                return $data->reg_no;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('phone', function ($data) {
                return $data->phone;
            })
            ->addColumn('email', function ($data) {
                return $data->email;
            })
            ->addColumn('category', function ($data) {
                return $data->category;
            })
            ->addColumn('scope_of_supply', function ($data) {
                return $data->scope_of_supply;
            })

            ->addColumn('status', function ($data) {
                $status = null;
                if ($data->status == 0) {
                    $status .= "<span class='badge badge-success'>Inactive</span>";
                }
                if ($data->status == 1) {
                    $status .= "<span class='badge badge-danger'>Active</span>";
                }
                return $status;

            })
            ->addColumn('options', function ($data) {

                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/vendor/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/vendor/show/' . $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";
            })
            ->rawColumns(['options', 'status'])
            ->make(true);

    }

    public function create()
    {
        $scopes=ScopeOfSupply::all();
        return view('vendors.create',compact('scopes'));
    }
    public function show($id)
    {
        $show=Vendors::find($id);
        return view('vendors.show',compact('show'));
    }

    public function edit($id)
    {
        $edit=Vendors::find($id);
        $scopes=ScopeOfSupply::all();
        return view('vendors.edit',compact('scopes','edit'));
    }


    public function store(Request $request)
    {
        $this->validate(request(), [
            'reg_no' => 'required',
            'name' => 'required',
            'address' => 'required',
            'person' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'category' => 'required',
            'scope_of_supply' => 'required',
            'approval_basis' => 'required',
            'status' => 'required',
            'expiry_date' => 'required',
            ]);

        $vendors=new Vendors();
        $vendors->reg_no=$request->reg_no;
        $vendors->name=$request->name;
        $vendors->phone=$request->phone;
        $vendors->address=$request->address;
        $vendors->person=$request->person;
        $vendors->email=$request->email;
        $vendors->category=$request->category;
        $vendors->scope_of_supply=$request->scope_of_supply;
        $vendors->approval_basis=$request->approval_basis;
        $vendors->expiry_date=$request->expiry_date;
        $vendors->status=$request->status;
        $vendors->save();

        return redirect()->back()->with('success', 'Vendor added successfully');

    }

    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate(request(), [
            'reg_no' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'person' => 'required',
            'email' => 'required',
            'category' => 'required',
            'scope_of_supply' => 'required',
            'approval_basis' => 'required',
            'status' => 'required',
            'expiry_date' => 'required',
            ]);

        $vendors=Vendors::find($request->id);
        $vendors->reg_no=$request->reg_no;
        $vendors->name=$request->name;
        $vendors->phone=$request->phone;
        $vendors->email=$request->email;
        $vendors->address=$request->address;
        $vendors->person=$request->person;
        $vendors->category=$request->category;
        $vendors->scope_of_supply=$request->scope_of_supply;
        $vendors->approval_basis=$request->approval_basis;
        $vendors->expiry_date=$request->expiry_date;
        $vendors->status=$request->status;
        $vendors->save();

        return redirect()->back()->with('success', 'Vendor updated successfully');

    }

    //
}
