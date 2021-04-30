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
            <h5 class="border-bottom pull-left"> <i class="fa fa-eye"></i> Vendor Details</h5>
        </div>
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered table-sm bg-white table-hover">

                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Reg #</th>
                    <td>{{$show->reg_no}}</td>
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
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$show->address}}</td>
                </tr>
                <tr>
                    <th>Person</th>
                    <td>{{$show->person}}</td>
                </tr>
                <tr>
                    <th>Account Code</th>
                    <td>{{$show->acc_code}}</td>
                </tr>


                <tr>
                    <th>Category</th>
                    <td>{{$show->category}}</td>
                </tr>
                <tr>
                    <th>Scope of Supply</th>
                    <td>{{$show->scope_of_supply}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{$show->status}}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection