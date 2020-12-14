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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">SOP</h2>
        <a href="{{route('clauses.create',[$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Clauses</a>
    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A  d-M-Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A  d-M-Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
        <h3 class="border-bottom text-dark m-2">All Clauses</h3>
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered"><tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
                @foreach($clauses as $clause)
                    <tr>
                        <td>{{$clause->title}}</td>
                        <td>
                            <a href="{{url('/clauses/edit/'.$clause->id)}}" class="btn float-right"><i class="fa fa-edit"></i></a>
                            {!! $clause->description !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection