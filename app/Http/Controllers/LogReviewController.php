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
        $this->authorize('designation-index');
        return view('logreview');
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
                return $data->description;
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
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdby->fname.' '.$data->createdby->lname;
            })
            ->addColumn('attachment', function ($data) {

                if($data->attachment){
                    $image="<img src='".Storage::disk('local')->url('public/log-reviews/'.$data->attachment)."' class='img-fluid' width='100'>";
                }
                return $image;
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></button>
                  ";

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
}
