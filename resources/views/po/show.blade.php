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
            <a href="{{route('po.create',[$show->id])}}" class="btn btn-sm btn-success pull-right"> <i class="fa fa-plus-circle"></i> Add Items </a>
            <a href="{{route('po.prints',[$show->id])}}" class="btn btn-sm btn-success pull-right"> <i class="fa fa-print"></i> Print </a>

        </div>
        <div class="col-12">
            <table class="text-dark table table-hover font-13 table-bordered table-sm bg-white table-hover">
                <tr>
                    <th>PO #</th>
                    <td>PO / {{$show->id}}</td>
                </tr>
                <tr>
                    <th>Indent #</th>
                    <td>IND /{{$show->indent_id}}</td>
                </tr>
                <tr>
                    <th>Delivery Terms</th>
                    <td>{{$show->delivery_term}}</td>
                </tr>
                <tr>
                    <th>Payment Term</th>
                    <th class="text-danger">{{strtoupper(str_replace('-',' ',$show->payment_term))}}</th>
                </tr>

                <tr>
                    <th>Created By</th>
                    <td>{{$show->createdBy->fname.' '.$show->createdBy->lname}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{$show->created_at->format('d M Y')}}</td>
                </tr>
            </table>
            @if(count($show->po_items)>0)
                <h5 class="pull-left"> <i class="fa fa-eye"></i> PO Items</h5>
                <table class="text-dark table table-hover font-13 table-bordered table-sm bg-white table-hover">
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>

                @foreach($show->po_items as $item)
                    <tr>
                        <td>{{$item->description}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->price*$item->qty}}</td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
@endsection