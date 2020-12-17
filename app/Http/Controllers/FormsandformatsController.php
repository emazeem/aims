<?php

namespace App\Http\Controllers;

use App\Models\Formsandformats;
use App\Models\Sops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FormsandformatsController extends Controller
{
    public function index()
    {
        return view('formsandformats.index');
    }
    public function fetch(){
        $data=Formsandformats::all();
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
                $action.="<a title='Edit' class='btn btn-sm btn-dark' href='".url('/forms/view/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                $action.="<a href='".url('/forms/edit/'.$data->id)."' title='Edit' class='btn btn-sm btn-primary' ><i class='fa fa-pencil'></i></a>";
                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                <form id=\"form$data->id\" method='post' role='form'><input name=\"_token\" type=\"hidden\" value=\"$token\"><input name=\"id\" type=\"hidden\" value=\"$data->id\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\"></form>";
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function create()
    {
        $sops=Sops::all()->where('parent_id',null);
        return view('formsandformats.create',compact('sops'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'doc' => 'required',
            'issue' => 'required',
            'revision' => 'required',
            'sops' => 'required',
            'file' => 'required',
        ]);
        $forms=new Formsandformats();
        $forms->sops=implode(',',$request->sops);
        $forms->name=$request->name;
        $forms->doc_no=$request->doc;
        $forms->rev_no=$request->revision;
        $forms->issue_no=$request->issue;
        $attachment=date('d-m-y').$request->file->getClientOriginalName();
        Storage::disk('local')->put('/public/Forms&Formats/'.$forms->name.'/'.$attachment, File::get($request->file));
        $forms->file=$attachment;
        $forms->save();
        return redirect()->back()->with('success','Added Successfully');
    }
    public function edit($id)
    {
        $sops=Sops::all()->where('parent_id',null);
        $edit=Formsandformats::find($id);
        return view('formsandformats.edit',compact('edit','sops'));
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'doc' => 'required',
            'issue' => 'required',
            'revision' => 'required',
            'sops' => 'required',
            'file' => 'required',
        ]);
        $forms=Formsandformats::find($request->id);
        $forms->sops=implode(',',$request->sops);
        $forms->name=$request->name;
        $forms->doc_no=$request->doc;
        $forms->rev_no=$request->revision;
        $forms->issue_no=$request->issue;
        if ($request->file){
            $attachment=date('d-m-y').$request->file->getClientOriginalName();
            Storage::disk('local')->put('/public/Forms&Formats/'.$forms->name.'/'.$attachment, File::get($request->file));
            $forms->file=$attachment;
        }
        $forms->save();
        return redirect()->back()->with('success','Updated Successfully');
    }
    public function destroy(Request $request){
        Formsandformats::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    public function show($id){
        $show=Formsandformats::find($id);
        return view('formsandformats.show',compact('show'));
    }


    //
}
