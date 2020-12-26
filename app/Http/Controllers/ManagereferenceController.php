<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Managereference;
use App\Models\Parameter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManagereferenceController extends Controller
{
    //
    public function index(){

        $this->authorize('manage-reference-index');
        return view('reference_errors.index');
    }
    public function fetch(){
        //$data=Managereference::with('units','assets')->get();
        $ids=Managereference::select('asset')->distinct()->get();
        $asset_id=array();
        foreach ($ids as $id){
            $asset_id[]=$id->asset;
        }
        $unique_ids=array();
        for ($i=0;$i<count($asset_id);$i++){
            $asset=Managereference::where('asset',$asset_id[$i])->first();
            $unique_ids[]=$asset->id;
        }
        $data=Managereference::with('units','assets')->whereIn('id',$unique_ids)->get();


        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('asset', function ($data) {
                return $data->assets->name.'='.$data->assets->code;
            })
            ->addColumn('unit', function ($data) {
                return $data->units->unit;
            })
            ->addColumn('ref', function ($data) {
                return $data->ref;
            })
            ->addColumn('error', function ($data) {
                return $data->error;
            })
            ->addColumn('uncertainty', function ($data) {
                return $data->uncertainty;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;<a title='Show' class='btn btn-sm btn-primary' href='" . url('/manage-reference/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/manage-reference/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }


    public function create(){
        //$units=Unit::all();
        $this->authorize('manage-reference-index');
        $parameters=Parameter::all();
        return view('reference_errors.create',compact('parameters'));
    }
    public function edit($id){
        $this->authorize('manage-reference-index');
        $parameters=Parameter::all();
        $edit=Managereference::find($id);
        $multiples=Managereference::where('asset',$edit->asset)->get();
        return view('reference_errors.edit',compact('parameters','edit','multiples'));
    }

    public function store(Request $request){
        $reference=array();
        $uuc=array();
        $uncertainty=array();
        foreach ($request->reference as $item) {
            $reference[]=$item;
        }
        foreach ($request->uuc as $item) {
            $uuc[]=$item;

        }
        foreach ($request->uncertainty as $item) {
            $uncertainty[]=$item;
        }
        $this->validate(request(), [
            'parameter' => 'required',
            'assets' => 'required',
            'uuc' => 'required',
            'units' => 'required',
            'reference' => 'required',
            'uncertainty' => 'required',
        ],[
            'parameter.required' => 'Parameter name field is required *',
        ]);
        for ($i=0;$i<count($reference);$i++){
            $manageref=new Managereference();
            $manageref->parameter=$request->parameter;
            $manageref->asset=$request->assets;
            $manageref->unit=$request->units;
            $manageref->uuc=$uuc[$i];
            $manageref->ref=$reference[$i];
            $manageref->error=$uuc[$i]-$reference[$i];
            $manageref->uncertainty=$uncertainty[$i];
            $manageref->save();
        }

        return back()->with('success','Error & uncertainty added successfully');
    }
    public function update(Request $request){
        $delentries=Managereference::where('asset',$request->assets)->get();

        $reference=array();
        $uuc=array();
        $uncertainty=array();
        foreach ($request->reference as $item) {
            $reference[]=$item;
        }
        foreach ($request->uuc as $item) {
            $uuc[]=$item;

        }
        foreach ($request->uncertainty as $item) {
            $uncertainty[]=$item;
        }
        $this->validate(request(), [
            'parameter' => 'required',
            'assets' => 'required',
            'uuc' => 'required',
            'units' => 'required',
            'reference' => 'required',
            'uncertainty' => 'required',
        ],[
            'parameter.required' => 'Parameter name field is required *',
        ]);
        for ($i=0;$i<count($reference);$i++){
            $manageref=new Managereference();
            $manageref->parameter=$request->parameter;
            $manageref->asset=$request->assets;
            $manageref->unit=$request->units;
            $manageref->uuc=$uuc[$i];
            $manageref->ref=$reference[$i];
            $manageref->error=$uuc[$i]-$reference[$i];
            $manageref->uncertainty=$uncertainty[$i];
            foreach ($delentries as $delentry){
                $delentry->delete();
            }
            $manageref->save();
        }

        return redirect('manage-reference')->with('success','Error & uncertainty added successfully');
    }
    public function show($id){
        $show=Managereference::find($id);
        $multiples=Managereference::where('asset',$show->asset)->get();
        return view('reference_errors.show',compact('show','multiples'));
    }
}
