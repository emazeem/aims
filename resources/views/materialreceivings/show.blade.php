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
            <h5 class="pull-left"><i class="fa fa-eye"></i> PO
                <small>{Details}</small>
            </h5>
            <a href="{{route('po.create',[$show->id])}}" class="btn btn-sm btn-success pull-right"> <i
                        class="fa fa-plus-circle"></i> Add Items </a>
            <a href="{{route('po.prints',[$show->id])}}" class="btn btn-sm btn-success pull-right"> <i
                        class="fa fa-print"></i> Print </a>

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
                <h5 class="pull-left"><i class="fa fa-eye"></i> PO Items</h5>
                <table class="text-dark table table-hover font-13 table-bordered table-sm bg-white table-hover">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                    @foreach($show->po_items as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->price*$item->qty}}</td>
                            <td>
                                <a href="{{url('material_receiving/create/'.$item->id)}}"
                                   class="btn btn-light border btn-sm"><i class="fa fa-arrow-circle-down"></i> GRN</a>
                                @if($item->receiving->id!=null)
                                    @if(!$item->inventory_id)
                                    <form action="{{route('inventory.store')}}" class="bg-warning p-2"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{$item->id}}">
                                        <input type="hidden" name="title" value="{{$item->title}}">
                                        <input type="hidden" name="category" value="{{$item->category_id}}">
                                        <input type="hidden" name="description" value="{{$item->description}}">
                                        <input type="hidden" name="subcategory" value="{{$item->subcategory_id}}">
                                        <input type="hidden" name="model" value="{{$item->model}}">
                                        <input type="hidden" name="quantity" value="{{$item->qty}}">
                                        <input type="text" name="depreciation" value="" style="width: 50px;height: 18px" placeholder="Depreciation">
                                        <select type="text" name="depreciation_duration" id="depreciation_duration">
                                            @for($i=1;$i<=10;$i++)
                                                <option value="{{$i}}">{{$i}} Year{{$i>1?'s':''}}</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                        <input type="hidden" name="department" value="{{$show->indent->department_id}}">
                                        <button type="submit" style="height: 20px;padding: 0;border: none" class="px-2"><i class="fa fa-arrow-circle-down"></i> Move to Inventory</button>

                                    </form>
                                        @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12">

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
                @foreach($show->po_recievings as $receiving)
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