<?php

namespace App\Http\Controllers;

use App\Models\Po;
use App\Models\Purchaseindent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PoController extends Controller
{

    public function index()
    {
        return view('po.index');
    }

    public function fetch()
    {
        $data = Po::with('createdBy')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return 'PO # '.$data->id;
            })
            ->addColumn('indent_id', function ($data) {
                return 'IND # '.$data->indent_id;
            })
            ->addColumn('date', function ($data) {
                return $data->created_at->format('d M y');
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdBy->fname.' '.$data->createdBy->lname;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/vendor/edit/' . $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/purchase-order/show/' . $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";
            })
            ->rawColumns(['options'])
            ->make(true);

    }

    public function create()
    {
        return view('po.create');
    }
    public function show($id)
    {
        $show=Po::find($id);
        return view('po.show',compact('show'));
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
            'purchase_indent' => 'required',
        ]);
        $po=new Po();
        $po->indent_id=$request->purchase_indent;
        $po->created_by=auth()->user()->id;
        $po->save();
        return redirect('/purchase-order/view/'.$po->id)->with('success', 'PO generated successfully');
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate(request(), [
            'reg_no' => 'required',
            'name' => 'required',
            'phone' => 'required',
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
