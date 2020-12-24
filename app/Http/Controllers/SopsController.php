<?php

namespace App\Http\Controllers;

use App\Models\Sops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SopsController extends Controller
{

    public function index(){
        $this->authorize('sop-index');
        return view('sop.index');
    }
    public function fetch(){
        $data=Sops::all()->where('parent_id',null);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='Edit' class='btn btn-sm btn-dark' href='".url('/sop/view/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-primary' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>";
                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                <form id=\"form$data->id\" method='post' role='form'><input name=\"_token\" type=\"hidden\" value=\"$token\"><input name=\"id\" type=\"hidden\" value=\"$data->id\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\"></form>";
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function store(Request $request){
        if (isset($request->id)){
            //dd($request->all());
            $this->validate(request(), [
                'revision' => 'required',
                'issue' => 'required',
                'doc' => 'required',
                'issue_date' => 'required',
                'file' => 'required',
            ],[
                'revision.required' => 'Sop Revision # is required *',
                'issue.required' => 'Sop Issue # is required *',
                'doc.required' => 'Sop Document # is required *',
                'file.required' => 'Sop File is required *',
                'issue_date.required' => 'Sop Issue is required *',
            ]);
            $sop=new Sops();
            $sop->parent_id=$request->id;
            $sop->issue_no=$request->issue;
            $sop->issue=$request->issue_date;
            $sop->rev_no=$request->revision;
            $sop->doc_no=$request->doc;
            if (isset($request->file)){
                $attachment=date('d-m-y').$request->file->getClientOriginalName();
                Storage::disk('local')->put('/public/SOPS/'.$sop->name.'/'.$attachment, File::get($request->file));
                $sop->file=$attachment;
            }
            $sop->save();
            return response()->json(['success'=>'Added successfully']);
        }
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'Sop name field is required *',
        ]);
        $sops=new Sops();
        $sops->name=$request->name;
        $sops->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        if (isset($request->detail_id)){
            $this->validate(request(), [
                'revision' => 'required',
                'issue' => 'required',
                'doc' => 'required',
                'issue_date' => 'required',
            ],[
                'revision.required' => 'Sop Revision # is required *',
                'issue.required' => 'Sop Issue # is required *',
                'doc.required' => 'Sop Document # is required *',
                'issue_date.required' => 'Issue Document # is required *',
            ]);
            $sop=Sops::find($request->detail_id);
            $sop->issue_no=$request->issue;
            $sop->rev_no=$request->revision;
            $sop->doc_no=$request->doc;
            $sop->issue=$request->issue_date;
            if (isset($request->file)){
                $attachment=date('d-m-y').$request->file->getClientOriginalName();
                Storage::disk('local')->put('/public/SOPS/'.$sop->name.'/'.$attachment, File::get($request->file));
                $sop->file=$attachment;
            }
            $sop->save();
            return response()->json(['success'=>'Updated successfully']);
        }
        $this->validate(request(), [
            'name' => 'required',
        ],[
            'name.required' => 'SOP name field is required *',
        ]);
        $parameter=Sops::find($request->id);
        $parameter->name=$request->name;
        $parameter->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        //$this->authorize('department-edit');
        $edit=Sops::find($request->id);
        return response()->json($edit);
    }
    public function show($id){
        $show=Sops::find($id);
        $details=Sops::where('parent_id',$show->id)->get();
        return view('sop.show',compact('show','details'));
    }
    public function destroy(Request $request){
        Sops::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    //
}
