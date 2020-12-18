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
        <h3 class="border-bottom"><i class="fa fa-tasks"></i> Purchase Indent</h3>
        <span>
            <a href="{{url('purchase_indent/item/create/'.$show->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Purchase Indent Items</a>
        </span>
    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr>
                    <th>Indent ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Indent Type</th>
                    <td class="text-capitalize">{{$show->indent_type}} Purchase</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{$show->location}}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{\App\Models\Department::find($show->department)->name}}</td>
                </tr>
                <tr>
                    <th>Indent By</th>
                    <td>{{\App\Models\User::find($show->indent_by)->fname.' '.\App\Models\User::find($show->indent_by)->lname}}</td>
                </tr>
                <tr>
                    <th>Checked by</th>
                    <td>{{\App\Models\User::find($show->checked_by)->fname.' '.\App\Models\User::find($show->checked_by)->lname}}</td>
                </tr>
                <tr>
                    <th>Approved by</th>
                    <td>{{\App\Models\User::find($show->approved_by)->fname.' '.\App\Models\User::find($show->approved_by)->lname}}</td>
                </tr>
                <tr>
                    <th>Required Date</th>
                    <td>{{$show->required}}</td>
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
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr class="bg-light">
                    <th>Title</th>
                    <th>Item Code</th>
                    <th>Purpose</th>
                    <th>Description</th>
                    <th>Reference Code</th>
                    <th>Unit</th>
                    <th>Last 6 Months Consumption</th>
                    <th>Current Stock</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            @foreach($items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->item_code}}</td>
                        <td>{{$item->purpose}}</td>
                        <td>{{$item->item_description}}</td>
                        <td>{{$item->ref_code}}</td>
                        <td>{{$item->unit}}</td>
                        <td>{{$item->last_six_months_consumption}}</td>
                        <td>{{$item->current_stock}}</td>
                        <td>{{$item->qty}}</td>
                        <td>
                            <a href="{{url('purchase_indent/item/edit/'.$item->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
            @endforeach
            </table>
        </div>
    </div>
@endsection