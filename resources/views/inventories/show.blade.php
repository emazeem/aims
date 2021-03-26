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
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> Inventory</h3>
        </div>
        <div class="col-12">
            <table class="table table-sm bg-white table-bordered table-responsive-sm table-hover font-13">
                <tr>
                    <th>Title</th>
                    <td>{{$show->title}}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{$show->category->category_name}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$show->model}}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{$show->price}}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{$show->description}}</td>
                </tr>
                <tr>
                    <th>Departments</th>
                    <td>{{$show->departments->name}}</td>
                </tr>
                <tr>
                    <th>Consumable</th>
                    <td>{{$show->consumable=='on'?'True':'False'}}</td>
                </tr>
            </table>

        </div>
        <div class="col-12">
            <table class="table table-sm bg-white table-bordered table-responsive-sm table-hover font-13">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Serial#</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($show->quantities as $quantity)
                    <tr>
                        <td>{{$quantity->id}}</td>
                        <td>{{$quantity->serial_no}}</td>
                        <td>#</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection