@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom text-dark">Capabilities Group Details</h3>
            <table class="table table-bordered table-responsive-sm table-hover">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Capabilities</th>
                    <td>
                        @foreach($capabilities as $capability)
                            <h6 class="h1 badge badge-danger">{{$capability}}</h6>
                        @endforeach
                    </td>
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