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

    </div>
    <div class="row pb-3">
        <div class="col-12">
            <h5 class="pull-left"><i class="fa fa-eye"></i> PO
                <small>{Details}</small>

            </h5>
        </div>
        <div class="col-12">
            @foreach($show->grn as $grn)
                <a href="{{url('vouchers/show/'.$grn->voucher_id)}}">Voucher # {{$grn->voucher_id}}</a>
            @endforeach
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
                                        <select type="text" name="type" id="type" style="width: 50px;height: 18px">
                                            <option value="fixed-asset">Fixed Assets</option>
                                            <option value="consumable-inventory">Consumable Inventory</option>
                                            <option value="trading-inventory">Trading Inventory</option>
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
                    <th>Select</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Received From</th>
                    <th>Physical Check</th>
                    <th>Meet Specifications</th>
                    <th>Unit</th>
                    <th>Qty</th>
                </tr>
                <form action="{{route('material.receiving.grn.create')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> GRN</button>
                    <input type="hidden" value="{{$show->id}}" name="po">
                    @foreach($show->po_items as $item)
                    @if($item->receiving->received_from)
                    <tr>
                        <td><input type="checkbox" {{in_array($item->receiving->id,$grnid)?'disabled checked':''}} name="grn[]" id="grn" value="{{$item->receiving->id}}"></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->receiving->received_from}}</td>
                        <td>{{$item->receiving->physical_check==0?'No':'Yes'}}</td>
                        <td>{{$item->receiving->meet_specifications==0?'Yes':'No'}}</td>
                        <td>{{$item->receiving->unit}}</td>
                        <td>{{$item->receiving->qty}}</td>
                    </tr>
                    @endif
                @endforeach
                </form>
            </table>
        </div>
    </div>

@endsection