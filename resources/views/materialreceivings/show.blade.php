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
    <div class="col-12 d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="border-bottom"><i class="fa fa-tasks"></i> Material Receiving</h3>
        <span class="text-right">
            <a href="{{url('material_receiving/create/'.$show->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Material Receiving</a>
        </span>
    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr>
                    <th>Indent ID</th>
                    <td>{{$show->indent_id}}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{$show->title}}</td>
                </tr>
                <tr>
                    <th>Purpose</th>
                    <td>{{$show->purpose}}</td>
                </tr>
                <tr>
                    <th>Item Code</th>
                    <td>{{$show->item_code}}</td>
                </tr>
                <tr>
                    <th>Item Description</th>
                    <td>{{$show->item_description}}</td>
                </tr>
                <tr>
                    <th>Ref Code</th>
                    <td>{{$show->ref_code}}</td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>{{$show->unit}}</td>
                </tr>
                <tr>
                    <th>Last 6 Months Consumption</th>
                    <td>{{$show->last_six_months_consumption}}</td>
                </tr>
                <tr>
                    <th>Current Stock</th>
                    <td>{{$show->current_stock}}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{$show->qty}}</td>
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
            <div class="row">
                <h4 class="border-bottom ml-3"><i class="fa fa-tasks"></i> Material Receiving</h4>
            </div>
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr class="bg-light">
                    <th>Received From</th>
                    <th>Purchase Type</th>
                    <th>Physical Check</th>
                    <th>Meet Specifications</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($show->receivings as $receiving)
                    <tr>
                        <td>{{$receiving->received_from}}</td>
                        <td class="text-capitalize">{{$receiving->purchase_type}} Purchase</td>
                        <td>{!! ($receiving->physical_check==1)?'<span class="badge badge-primary">YES</span>':'<span class="badge badge-danger">NO</span>'!!}</td>
                        <td>{!! ($receiving->meet_specifications==1)?'<span class="badge badge-primary">YES</span>':'<span class="badge badge-danger">NO</span>'!!}
                            <br>
                            @if($receiving->specifications==0)
                                <input type="checkbox" readonly checked> As per indent
                            @endif
                            @if($receiving->specifications==1)
                                <input type="checkbox" readonly checked> As per specs sheet of OEM
                            @endif
                            @if($receiving->specifications==1)
                                <input type="checkbox" readonly checked>  As per requirement of process
                            @endif
                        </td>
                        <td class="text-capitalize">{{$receiving->unit}}</td>
                        <td>{{$receiving->qty}}</td>
                        <td>
                            @if($receiving->status==0)
                                <span class=' badge badge-warning'>Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('material_receiving/edit/'.$receiving->id)}}" class="btn btn-success btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection