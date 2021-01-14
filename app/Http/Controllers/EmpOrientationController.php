<?php

namespace App\Http\Controllers;

use App\Models\Empcontract;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmpOrientationController extends Controller
{
    public function index(){
        return view('emp_orientation.index');
    }
    public function create(){
        $employees=Empcontract::all()->where('status','>',0);
        $orientors=User::all();
        return view('emp_orientation.create',compact('employees','orientors'));
    }

    public function edit($id){
        $edit=Empcontract::find($id);
        $orientors=User::all();
        $employees=Empcontract::all()->where('status','>',0);
        return view('emp_orientation.edit',compact('employees','edit','orientors'));
    }
    public function fetch(){
        $data=Empcontract::all()->where('status',2);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->appraisal->fname.' '.$data->appraisal->lname;
            })
            ->addColumn('designation', function ($data) {
                return $data->designation->name;
            })

            ->addColumn('remarks', function ($data) {
                return $data->remarks;
            })
            ->addColumn('incharge', function ($data) {
                return $data->orientators->fname.' '.$data->orientators->lname;
            })
            ->addColumn('options', function ($data) {
                $action=null;
                return "&emsp;                                
                <a title='Edit' class='btn btn-sm btn-success' href='" . url('/emp_orientation/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    public function store(Request $request){
        $this->validate(request(), [
            'employee' => 'required',
            'orientor' => 'required',
            'remarks' => 'required',
            'introduction-to-key-personnel' => 'required',
            'facility-and-operations-familiarization' => 'required',
            'review-of-safety-regulations' => 'required',
            'disciplinary-instructions' => 'required',
            'conduct-with-clients-and-colleagues' => 'required',
            'company-organization-chart' => 'required',
            'function-of-different-departments' => 'required',
            'individual-responsibility-and-understanding-of-quality-policy' => 'required',
            'companys-quality-assurance-manual-and-AIMS-standard-or-procedures' => 'required',
            'contractual-obligations-of-personnel' => 'required',
        ]);
        $areas=[
            'introduction-to-key-personnel' => 1,
            'facility-and-operations-familiarization' => 1,
            'review-of-safety-regulations' => 1,
            'disciplinary-instructions' => 1,
            'conduct-with-clients-and-colleagues' => 1,
            'company-organization-chart' => 1,
            'function-of-different-departments' => 1,
            'individual-responsibility-and-understanding-of-quality-policy' => 1,
            'companys-quality-assurance-manual-and-AIMS-standard-or-procedures' => 1,
            'contractual-obligations-of-personnel' => 1,
        ];
        $emp=Empcontract::find($request->employee);
        $emp->status=2;
        $emp->orientator=$request->orientor;
        $emp->remarks=$request->remarks;
        $emp->o_area=json_encode($areas);
        $emp->save();
        return redirect()->back()->with('success','Employee Orientation Details added successfully');
    }
    //
}
