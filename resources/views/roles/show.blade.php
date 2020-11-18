@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Capability Details</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Range</th>
                    <td>{{$show->range}}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{$show->price}}</td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>{{$show->unit}}</td>
                </tr>
                <tr>
                    <th>Accuracy</th>
                    <td>{{$show->accuracy}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td class="text-capitalize">{{$show->location}}</td>
                </tr>
                <tr>
                    <th>Accredited</th>
                    <td class="text-capitalize font-weight-bold">{{$show->accredited}}</td>
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