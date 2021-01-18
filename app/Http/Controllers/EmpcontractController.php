<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Empcontract;
use App\Models\Interviewappraisal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmpcontractController extends Controller
{
    public function index(){
        return view('emp_contract.index');
    }
    public function prints($id){
        $show=Empcontract::find($id);
        return view('emp_contract.print',compact('show'));
    }
    public function fetch(){
        $data=Empcontract::with('appraisal')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->appraisal->fname.' '.$data->appraisal->lname;
            })
            ->addColumn('cnic', function ($data) {
                return $data->cnic;
            })
            ->addColumn('designations', function ($data) {
                return $data->designations;
            })
            ->addColumn('commencement', function ($data) {
                return $data->commencement;
            })
            ->addColumn('place_of_work', function ($data) {
                return $data->place_of_work;
            })
            ->addColumn('probation_period', function ($data) {
                return $data->probation_period;
            })

            ->addColumn('options', function ($data) {
                return "&emsp;
                <a title='Edit' class='btn btn-sm btn-success' href='" . url('/emp_contract/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                <a title='Show' class='btn btn-sm btn-primary' href='" . url('/emp_contract/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                ";
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function create(){
        $appraisals=Interviewappraisal::all();
        $designations=Designation::all();
        return view('emp_contract.create',compact('appraisals','designations'));
    }
    public function edit($id){
        $edit=Empcontract::find($id);
        $appraisals=Interviewappraisal::all();
        $designations=Designation::all();
        return view('emp_contract.edit',compact('appraisals','designations','edit'));
    }
    public function show($id){
        $show=Empcontract::find($id);
        return view('emp_contract.show',compact('show'));
    }


    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'name'=>'required',
            'termination_period'=>'required',
            'probation_applicable'=>'required',
            'probation_period'=>'required',
            'designations'=>'required',
            'place_of_work'=>'required',
            'salary'=>'required',
            'allowances'=>'required',
            'cnic'=>'required',
            'commencement'=>'required'
        ]);
        $empcontract=new Empcontract();
        $empcontract->appraisal_id=$request->name;
        $empcontract->termination_period=$request->termination_period;
        $empcontract->probation_period=$request->probation_period;
        $empcontract->probation_applicable=$request->probation_applicable;
        $empcontract->designations=$request->designations;
        $empcontract->place_of_work=$request->place_of_work;
        $empcontract->salary=$request->salary;
        $empcontract->allowances=$request->allowances;
        $empcontract->cnic=$request->cnic;
        $empcontract->commencement=$request->commencement;
        $empcontract->save();

        return  redirect()->back()->with('success', 'Employee Contract has added successfully.');
    }
    public function update(Request $request){
        $this->validate(request(), [
            'name'=>'required',
            'termination_period'=>'required',
            'probation_applicable'=>'required',
            'probation_period'=>'required',
            'designations'=>'required',
            'place_of_work'=>'required',
            'salary'=>'required',
            'allowances'=>'required',
            'cnic'=>'required',
            'commencement'=>'required'
        ]);
        $empcontract=Empcontract::find($request->id);
        $empcontract->appraisal_id=$request->name;
        $empcontract->termination_period=$request->termination_period;
        $empcontract->probation_period=$request->probation_period;
        $empcontract->probation_applicable=$request->probation_applicable;
        $empcontract->designations=$request->designations;
        $empcontract->place_of_work=$request->place_of_work;
        $empcontract->salary=$request->salary;
        $empcontract->allowances=$request->allowances;
        $empcontract->cnic=$request->cnic;
        $empcontract->commencement=$request->commencement;
        $empcontract->save();

        return  redirect()->back()->with('success', 'Employee Contract has updated successfully.');
    }

    //
}
