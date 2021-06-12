<?php

namespace App\Http\Controllers;

use App\Models\LogReview;
use App\Models\User;

use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class LogReviewController extends Controller
{

    public function index(){
        $this->authorize('log-reviews');
        return view('logreview.index');
    }
    public function show($id){
        $this->authorize('view-log-reviews');
        $show=LogReview::find($id);
        $next=$show->next();
        $previous=$show->previous();
        return view('logreview.show',compact('show','next','previous'));
    }

    public function fetch(){
        $this->authorize('log-reviews');
        $data=LogReview::with('createdby')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('title', function ($data) {
                return $data->title;
            })
            ->addColumn('description', function ($data) {
                return strlen($data->description)>40?substr($data->description,0,40).'...':$data->description;
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
                    return '<span class="badge badge-danger px-2 py-1"> Pending</span> ';
                }
                if ($data->status==1){
                    return '<span class="badge badge-info px-2 py-1"> Started</span> ';
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
                $action=null.'<div class="btn-group ">';
                if (Auth::user()->can('edit-log-reviews')) {
                    $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                }
                if (Auth::user()->can('view-log-reviews')) {
                    $action.="<a title='Show' class='btn rounded-0 btn-sm btn-warning' href='".url('log-reviews/show/'.$data->id)."'><i class='fa fa-eye'></i></a>";
                }
                if (Auth::user()->can('delete-log-reviews')) {
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                    </form>";
                }
                return $action."</div>";

            })
            ->rawColumns(['options','priority','status','attachment'])
            ->make(true);
    }
    public function store(Request $request){
        $this->authorize('add-log-reviews');
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
        $this->authorize('edit-log-reviews');
        $edit=LogReview::find($request->id);
        $edit->start=$edit->start->format('Y-m-d');
        $edit->end=$edit->end->format('Y-m-d');
        return response()->json($edit);
    }
    public function destroy(Request $request){
        $this->authorize('delete-log-reviews');
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

        $users = User::where('user_type', 1)->get();
        $url = '/log-reviews/show/'.$log->id;
        $message = collect(['title' => 'Task completed successfully','by'=>auth()->user()->id, 'body' => \auth()->user()->fname.' '.\auth()->user()->lname.' has finished Task # '.$log->id, 'redirectURL' => $url]);
        Notification::send($users, new CustomNotification($message));

        return response()->json(['success'=>'Task Completed Successfully']);
    }
}
