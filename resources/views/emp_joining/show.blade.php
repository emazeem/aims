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
            <h3 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Employee Contract
            </h3>
            <span class="float-right">
            <a href="{{route('emp_joining.print',[$show->id])}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
            </span>
        </div>
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered bg-white">

                <tr>
                    <th>Appraisal ID</th>
                    <td>{{$show->appraisal->fname}} {{$show->appraisal->lname}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('d-m-Y - h:i',strtotime($show->created_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection