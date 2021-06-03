<?php

namespace App\Http\Controllers;

use App\Models\LogReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class LogReviewController extends Controller
{

    public function index(){
        $this->authorize('log-reviews');
        return view('logreview.index');
    }
    public function show($id){
        $this->authorize('log-reviews');
        $show=LogReview::find($id);
        return view('logreview.show',compact('show'));
    }

    public function fetch(){
        $data=LogReview::with('createdby')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('description', function ($data) {
                return substr($data->description,0,40).'...';
            })
            ->addColumn('priority', function ($data) {
                if ($data->priority==0){
                    $priority='<i class="fa fa-arrow-down text-success"></i> LOW';
                }
                if ($data->priority==1){
                    $priority='<i class="fa fa-arrow-up text-danger"></i> HIGH';
                }

                return $priority;
            })
            ->addColumn('status', function ($data) {
                if ($data->status==0){
                    return '<span class="badge badge-info px-2 py-1"> Pending</span> ';
                }
                if ($data->status==1){
                    return '<span class="badge badge-primary px-2 py-1"> Started</span> ';
                }
                if ($data->status==2){
                    return '<span class="badge badge-success px-2 py-1"> Completed</span> ';
                }

            })
            ->addColumn('created_by', function ($data) {
                return $data->createdby->fname.' '.$data->createdby->lname;
            })
            ->addColumn('attachment', function ($data) {

                if($data->attachment){
                    $image="<img src='".Storage::disk('local')->url('public/log-reviews/'.$data->attachment)."' class='img-fluid' width='100'>";
                }else{
                    $image='';
                }
                return $image;
            })

            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='Show' class='btn btn-sm btn-warning' href='".url('log-reviews/show/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>";
                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                return $action;

            })
            ->rawColumns(['options','priority','status','attachment'])
            ->make(true);
    }
    public function store(Request $request){

        $this->authorize('designation-create');
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'start' => 'required',
            'end' => 'required',
            'assign_to' => 'required',
        ]);
        if ($request->edit_id){
            $message='Updated Successfully';
            $log=LogReview::find($request->edit_id);
        }else{
            $message='Added Successfully';
            $log=new LogReview();
        }
        $log->title=$request->title;
        $log->description=$request->description;
        $log->priority=$request->priority;
        $log->assign_to=$request->assign_to;
        $log->start=$request->start;
        $log->end=$request->end;
        if ($request->attachment){
            $attachment = time().$request->attachment->getClientOriginalName();
            Storage::disk('local')->put('public/log-reviews/'. $attachment, File::get($request->attachment));
            $log->attachment = $attachment;
        }
        $log->created_by=auth()->user()->id;
        $log->save();
        return response()->json(['success'=>$message]);
    }
    public function edit(Request $request){
        $edit=LogReview::find($request->id);
        return response()->json($edit);
    }
    public function shows(Request $request){
        $show=LogReview::find($request->id);
        if ($show->priority==0){
            $show->priority='<i class="fa fa-arrow-down text-success"></i> LOW';
        }else{
            $show->priority='<i class="fa fa-arrow-up text-danger"></i> HIGH';
        }
        if ($show->status==0){
            $status= '<span class="badge badge-info px-2 py-1"> Pending</span>';
        }
        $show->status=$status;
        if ($show->attachment){
            $image="<img src='".Storage::disk('local')->url('public/log-reviews/'.$show->attachment)."' class='img-fluid' width='100'>";
        }else{
            $image='-';
        }
        $show->image=$image;

        return response()->json($show);
    }

    public function destroy(Request $request){
        $log=LogReview::find($request->id);
        Storage::delete('public/log-reviews/'.$log->attachment);
        $log->delete();
        return response()->json(['success'=>'Deleted Successfully']);
    }
    public function start(Request $request){
        date_default_timezone_set("Asia/Karachi");
        $log=LogReview::find($request->id);
        $log->status=1;
        $log->started=date('Y-m-d h:i:s');
        $log->save();
        return response()->json(['success'=>'Task Started Successfully']);

    }
    public function end(Request $request){

        date_default_timezone_set("Asia/Karachi");
        $log=LogReview::find($request->id);
        $log->status=2;
        $log->ended=date('Y-m-d h:i:s');
        $log->save();
        return response()->json(['success'=>'Task Completed Successfully']);

    }


}
