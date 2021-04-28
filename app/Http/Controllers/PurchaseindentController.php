<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Purchaseindent;
use App\Models\Purchaseindentitem;
use App\Models\PurchaseVendor;
use App\Models\User;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PurchaseindentController extends Controller
{
    public function index(){
        return view('purchaseindent.index');
    }
    public function fetch(){
    $data=Purchaseindent::get();
    //dd($data);
    return DataTables::of($data)
        ->addColumn('id', function ($data) {
            return $data->id;
        })
        ->addColumn('indent_by', function ($data) {
            return User::find($data->indenter)->fname.' '.User::find($data->indenter)->lname;
        })
        ->addColumn('indent_type', function ($data) {
            return $data->indent_type;
        })
        ->addColumn('department', function ($data) {
            return Department::find($data->department_id)->name;
        })
        ->addColumn('location', function ($data) {
            return $data->location;
        })
        ->addColumn('required', function ($data) {
            return $data->required;
        })
        ->addColumn('status', function ($data) {
            $status=null;
            if ($data->status==0){
                //need approval
                $status.="<span class='badge badge-warning'>Waiting for TM Prioritize</span>";
            }
            if ($data->status==1){
                $status.="<span class='badge badge-danger'>TM is reviewing</span>";
            }
            if ($data->status==2){
                $status.="<span class='badge badge-danger'>Finalizing Vendor</span>";
            }
            if ($data->status==3){
                $status.="<span class='badge badge-danger'>Ready for PO</span>";
            }
            return $status;
        })
        ->addColumn('options', function ($data) {
            return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/purchase_indent/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/purchase_indent/show/'. $data->id) . "'><i class='fa fa-eye'></i></a>
                  <a title='Print' class='btn btn-sm btn-outline-secondary' href='" . url('/purchase_indent/print/'. $data->id) . "'><i class='fa fa-print'></i></a>
                  ";
        })
        ->rawColumns(['options','status'])
        ->make(true);

}

    public function create(){
        $departments=Department::all();
        return view('purchaseindent.create',compact('departments'));
    }
    public function edit($id){
        $departments=Department::all();
        $edit=Purchaseindent::find($id);
        return view('purchaseindent.edit',compact('departments','edit'));
    }

    public function store(Request $request){
        $this->validate(request(),[
            'indent_type' => 'required',
            'department_id' => 'required',
            'chargeable_to' => 'required',
            'deliver_to' => 'required',
            'location' => 'required',
            'required' => 'required',
            'indenter' => 'required',
        ]);
        $indent=new Purchaseindent();
        $indent->indent_type=$request->indent_type;
        $indent->department_id=$request->department_id;
        $indent->chargeable_to=$request->chargeable_to;
        $indent->deliver_to=$request->deliver_to;
        $indent->location=$request->location;
        $indent->required=$request->required;
        $indent->status=0;
        $indent->indenter=$request->indenter;
        $indent->prepared_by=auth()->user()->id;
        $indent->checked_by=auth()->user()->id;
        $indent->approved_by=auth()->user()->id;
        $indent->save();
        return redirect($request->url)->with('success','Purchase indent added successfully');
    }
    public function update(Request $request){
        $this->validate(request(),[
            'indent_type' => 'required',
            'department_id' => 'required',
            'chargeable_to' => 'required',
            'deliver_to' => 'required',
            'location' => 'required',
            'required' => 'required',
            'indenter' => 'required',
        ]);
        $indent=Purchaseindent::find($request->id);
        $indent->indent_type=$request->indent_type;
        $indent->department_id=$request->department_id;
        $indent->chargeable_to=$request->chargeable_to;
        $indent->deliver_to=$request->deliver_to;
        $indent->location=$request->location;
        $indent->required=$request->required;
        $indent->status=0;
        $indent->indenter=$request->indenter;
        $indent->prepared_by=auth()->user()->id;
        $indent->checked_by=auth()->user()->id;
        $indent->approved_by=auth()->user()->id;
        $indent->save();
        return redirect()->back()->with('success','Purchase indent updated successfully');
    }
    public function show($id){
        $show=Purchaseindent::find($id);
        $vendorids=[];
        foreach ($show->indent_vendors as $vendor){
            $vendorids[]=$vendor->id;
        }
        $selectedvendors=Vendors::all()->whereIn('id',$vendorids);
        return view('purchaseindent.show',compact('show','selectedvendors'));
    }
    public function print_indent($id){
        $indent=Purchaseindent::with('indent_items','indenters','departments','approvedBy','checkedBy')->find($id);
        if (count($indent->indent_items)==0){
            return redirect()->back()->with('success','Drop items in purchase indent');
        }
        return view('purchaseindent.material_indent',compact('indent'));
    }
    //
}
