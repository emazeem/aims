@extends('layouts.master')
@section('content')

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h5 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                HR Requisition
            </h5>
            <span class="float-right">
            <a href="{{route('requisition.print',[$show->id])}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
            </span>
        </div>
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered">
                <tr>
                    <th>Requisition Designation</th>
                    <td>{{$show->designation->name}}</td>
                </tr>
                <tr>
                    <th>Reason</th>
                    <td>{{$show->reason}}</td>
                </tr>
                <tr>
                    <th>Qualification</th>
                    <td>{{$show->qualification}}</td>
                </tr>
                <tr>
                    <th>Special Skills</th>
                    <td>{{$show->special_skills}}</td>
                </tr>
                <tr>
                    <th>Initiated By</th>
                    <td>{{$show->initiated_user->fname}} {{$show->initiated_user->lname}}</td>
                </tr>
                <tr>
                    <th>Time Frame</th>
                    <td>{{ucfirst(str_replace('-', ' ', $show->time_frame))}}</td>
                </tr>
                <tr>
                    <th>HRD Review</th>
                    <td class="text-capitalize">{{str_replace('-', ' ', $show->hrd_review)}}</td>
                </tr>
                <tr>
                    <th>Approved By</th>
                    <td>{{$show->approved_by}}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{$show->remarks}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection