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
        $sops=Sops::all()->where('parent_id',null);
        return view('formsandformats.index',compact('sops'));
    }
    public function fetch(){
        $data=Formsandformats::all()->where('parent_id',null);
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
                $action.="<a data-id='".$data->id."' href='#' title='Edit' class='btn edit btn-sm btn-primary' ><i class='fa fa-pencil'></i></a>";
                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                <form id=\"form$data->id\" method='post' role='form'><input name=\"_token\" type=\"hidden\" value=\"$token\"><input name=\"id\" type=\"hidden\" value=\"$data->id\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\"></form>";
                return $action;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function create($id)
    {
        return view('formsandformats.create',compact('id'));
    }

    public function store(Request $request)
    {
        if ($request->id){

            $this->validate(request(), [
                'doc' => 'required',
                'issue' => 'required',
                'revision' => 'required',
                'file' => 'required',
                'issue_date' => 'required',
                'location' => 'required',
                'reviewed_on' => 'required',
                'reviewed_by' => 'required',
                'mode_of_storage' => 'required',
                'status' => 'required',
            ]);
            $forms=new Formsandformats();
            $forms->parent_id=$request->id;
            $forms->doc_no=$request->doc;
            $forms->rev_no=$request->revision;
            $forms->issue_no=$request->issue;
            $forms->issue=$request->issue_date;

            $forms->location=$request->location;
            $forms->reviewed_by=$request->reviewed_by;
            $forms->reviewed_on=$request->reviewed_on;
            $forms->status=$request->status;
            $forms->mode_of_storage=$request->mode_of_storage;

            $attachment=date('d-m-y').$request->file->getClientOriginalName();
            Storage::disk('local')->put('/public/Forms&Formats/'.$forms->name.'/'.$attachment, File::get($request->file));
            $forms->file=$attachment;
            $forms->save();
            return redirect()->back()->with('success','Added Successfully');
        }
        $this->validate(request(), [
            'name' => 'required',
            'sops' => 'required',
        ]);
        $forms=new Formsandformats();
        $forms->sops=implode(',',$request->sops);
        $forms->name=$request->name;
        $forms->save();
        return response()->json(['success'=>'Added successfully']);

    }
    public function edit(Request $request)
    {
        $edit=Formsandformats::find($request->id);
        //$edit->sops=explode(',',$edit->sops);
        return response()->json($edit);
    }

    public function edit_details($id)
    {
        $edit=Formsandformats::find($id);
        return view('formsandformats.edit',compact('edit'));
    }

    public function update(Request $request)
    {
        if ($request->detail_id){

           $this->validate(request(), [
                'doc' => 'required',
                'issue' => 'required',
                'revision' => 'required',
               'issue_date'=>'required',
               'location' => 'required',
               'reviewed_on' => 'required',
               'reviewed_by' => 'required',
               'mode_of_storage' => 'required',
               'status' => 'required',
            ]);
            $forms=Formsandformats::find($request->detail_id);
            $forms->doc_no=$request->doc;
            $forms->rev_no=$request->revision;
            $forms->issue_no=$request->issue;
            $forms->issue=$request->issue_date;

            $forms->location=$request->location;
            $forms->reviewed_by=$request->reviewed_by;
            $forms->reviewed_on=$request->reviewed_on;
            $forms->status=$request->status;
            $forms->mode_of_storage=$request->mode_of_storage;

            if ($request->file){
                $attachment=date('d-m-y').$request->file->getClientOriginalName();
                Storage::disk('local')->put('/public/Forms&Formats/'.$forms->name.'/'.$attachment, File::get($request->file));
                $forms->file=$attachment;

            }
            $forms->save();
            return redirect()->back()->with('success','Updated Successfully');
        }
        $this->validate(request(), [
            'name' => 'required',
            /*'doc' => 'required',
            'issue' => 'required',
            'revision' => 'required',*/
            'sops' => 'required',
            //'file' => 'required',
        ]);
        $forms=Formsandformats::find($request->id);
        $forms->sops=implode(',',$request->sops);
        $forms->name=$request->name;
        /*$forms->doc_no=$request->doc;
        $forms->rev_no=$request->revision;
        $forms->issue_no=$request->issue;
        if ($request->file){
            $attachment=date('d-m-y').$request->file->getClientOriginalName();
            Storage::disk('local')->put('/public/Forms&Formats/'.$forms->name.'/'.$attachment, File::get($request->file));
            $forms->file=$attachment;
        }*/
        $forms->save();
        return response()->json(['success'=>'Updated successfully']);

    }
    public function destroy(Request $request){
        Formsandformats::find($request->id)->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }
    public function show($id){
        $show=Formsandformats::find($id);
        $details=Formsandformats::where('parent_id',$id)->get();
        return view('formsandformats.show',compact('show','details'));
    }
    //
}
