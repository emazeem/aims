<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Parameter;
use App\Models\Procedure;
use App\Models\Uncertainty;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProcedureController extends Controller
{
    public function index(){
        $parameters=Parameter::all();
        return view('procedures.index',compact('parameters'));
    }
    public function fetch(){
        $data=Procedure::with('parameters')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('description', function ($data) {
                return $data->description;
            })

            ->addColumn('uncertainties', function ($data) {
                $all=null;
                foreach (explode(',',$data->uncertainties) as $item){
                    $all.='<b class="badge badge-primary">'.$item.'</b><br>';
                }
                return $all;
            })
            ->addColumn('options', function ($data) {

                $token=csrf_token();
                $action="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                return "&emsp;
                    <a title='Edit' class='btn btn-sm btn-success' href='".url('/procedures/edit/'.$data->id)."'><i class='fa fa-edit'></i></button>
                    <a title='Show' class='btn btn-sm btn-warning' href='".url('/procedures/show/'.$data->id)."'><i class='fa fa-eye'></i></button>
                  ".$action;

            })
            ->rawColumns(['options','uncertainties'])
            ->make(true);
    }

    public function store(Request $request){
        //dd($request->all());
        //$this->authorize('designation-create');
        $this->validate(request(), [
            'uncertainties' => 'required',
            'name' => 'required',
            'description' => 'required',
        ],[
            'uncertainties.required' => 'Procedure uncertainties field are required *',
            'name.required' => 'Procedure name is required *',
            'description.required' => 'Procedure description is required *',
        ]);
        $procedure=new Procedure();
        $procedure->uncertainties=implode(',',$request->uncertainties);
        $procedure->name=$request->name;
        $procedure->description=$request->description;
        $procedure->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        //$this->authorize('designation-create');
        $this->validate(request(), [
            'uncertainties' => 'required',
            'name' => 'required',
        ],[
            'uncertainties.required' => 'Procedure uncertainties field are required *',
            'name.required' => 'Procedure name is required *',
        ]);
        $procedure=Procedure::find($request->id);
        $procedure->uncertainties=implode(',',$request->uncertainties);
        $procedure->name=$request->name;
        $procedure->save();
        return response()->json(['success'=>'Updated successfully']);
    }


    public function get_assets($id){
        $assets=Asset::where('parameter',$id)->get();
        return response()->json($assets);
    }
    public function edit($id){
        $edit=Procedure::find($id);
        $uncertainties=Uncertainty::all();
        $parameters=Parameter::all();
        return view('procedures.edit',compact('parameters','edit','uncertainties'));

    }
    public function create(){
        $parameters=Parameter::all();
        $uncertainties=Uncertainty::all();
        return view('procedures.create',compact('parameters','uncertainties'));
    }
    public function show($id){
        $show=Procedure::find($id);
        $parameters=Parameter::all();
        return view('procedures.show',compact('parameters','show'));
    }
    public function destroy(Request $request){
        Procedure::find($request->id)->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }

    //
}
