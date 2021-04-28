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
            <h5 class="pull-left"> <i class="fa fa-eye"></i> PO <small>{Details}</small></h5>
        </div>
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered table-sm bg-white table-hover">
                <tr>
                    <th>PO #</th>
                    <td>PO / {{$show->id}}</td>
                </tr>
                <tr>
                    <th>Indent #</th>
                    <td>IND /{{$show->indent_id}}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{$show->createdBy->fname.' '.$show->createdBy->lname}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{$show->created_at->format('d M y')}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection