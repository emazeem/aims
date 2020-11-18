@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="card mb-4 py-3 border-left-primary">

        <div class="card-body">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Details</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-bordered table-striped table-responsive-sm">
                <tr>
                    <th>First Name</th>
                    <td>{{$show->fname}}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{$show->lname}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$show->email}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$show->phone}}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{$show->father_name}}</td>
                </tr>
                <tr>
                    <th>CNIC</th>
                    <td>{{$show->cnic}}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{$show->departments->name}}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td>{{$show->designations->name}}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{$show->roles->name}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$show->address}}</td>
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
        </div></div>
@endsection