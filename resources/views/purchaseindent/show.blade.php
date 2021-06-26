@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
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
            @if($show->status==0)
                @if(count($show->indent_items)>0)
                    @if(count($show->indent_vendors)>0)
                <a title='Send to TM' class='btn btn-outline-primary btn-sm send-to-tm' href='#'
                   data-id='{{$show->id}}'><i class='fa fa-thumbs-up'></i> Send to TM</a>

                    @endif
                        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#add_vendor"><i class="fa fa-plus-circle"></i> Select Vendor & Suppliers</button>
                @endif
                <a href="{{url('purchase_indent/item/create/'.$show->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Purchase Indent Items</a>
            @endif
            @if($show->status==1)
                <a title='Prioritized' class='btn btn-outline-primary btn-sm prioritized' href='#'
                   data-id='{{$show->id}}'><i class='fa fa-thumbs-up'></i> Prioritized</a>
            @endif

        </span>
    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr>
                    <th>Indent ID</th>
                    <td>IND # {{$show->id}}</td>
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
                    <th>Status</th>
                    <td>
                        @if($show->status==0)
                            @if(count($show->indent_items)>0)
                                <span class="btn btn-sm btn-warning badge">Waiting for TM Prioritize</span>
                            @else
                                <span class="btn btn-sm btn-warning badge">Empty Purchase Indent</span>
                            @endif
                        @endif
                        @if($show->status==1)
                            <span class="btn btn-sm btn-warning badge">TM is reviewing</span>
                        @endif
                        @if($show->status==2)
                            <span class="btn btn-sm btn-warning badge">Finalizing Vendor</span>
                        @endif
                        @if($show->status==3)
                            <span class="btn btn-sm btn-warning badge">Ready for PO</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{$show->departments->name}}</td>
                </tr>
                <tr>
                    <th>Selected Vendors</th>
                    <td>{!! $show->selected_vendor?$show->selectedvendors->vendors->name:'<i>NULL</i>'!!}</td>
                </tr>

                <tr>
                    <th>Indent By</th>
                    <td>{{$show->indenters->fname}} {{$show->indenters->lname}}</td>
                </tr>
                <tr>
                    <th>Checked by</th>
                    <td>{{$show->checkedBy->fname}} {{$show->checkedBy->lname}}</td>
                </tr>
                <tr>
                    <th>Approved by</th>
                    <td>{{$show->approvedBy->fname}} {{$show->approvedBy->lname}}</td>
                </tr>
                <tr>
                    <th>Required Date</th>
                    <td>{{$show->required->format('d M Y')}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{$show->created_at->format('h:i A , d M Y ')}}</td>
                </tr>
            </table>
            <h4 class="pull-left">Purchase Indent Selected Vendors</h4>
            @if($show->status==1)
                <button type="button" class="btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#prioritize"><i class="fa fa-sort-numeric-asc"></i> Prioritize Quotation</button>
            @endif
            @if($show->status==2)
                <span class="pull-right">
                    <form method="post" action="{{route('purchase.vendor.selected.vendor')}}">
                        @csrf
                        <span class="pull-right">
                            <button type="submit" name="submit" style="height: 37px;" class="pull-right border border-dark">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </span>
                        <span class="pull-right">
                            <input type="hidden" value="{{$show->id}}" name="id">
                        <select class="form-control" id="selected-vendor" name="selected-vendor" style="width: 100%">
                                    <option selected disabled="">Select Vendor for Items</option>
                            @foreach($show->indent_vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->vendors->name}}</option>
                            @endforeach
                        </select>

                        </span>

                    </form>
                </span>
            @endif
                <table class="table table-hover table-bordered bg-white">
                <tr class="bg-light">
                    <th>ID</th>
                    <th>Vendor</th>
                    <th>Priority</th>
                    <th>Quotation</th>
                    <th>Quotation #</th>
                </tr>
                @foreach($show->indent_vendors as $vendor)
                    <tr class="bg-light">
                        <td>{{$vendor->id}}</td>
                        <td class="text-capitalize">{{$vendor->vendors->name}}</td>
                        <td> {{$vendor->priority}}</td>
                        <td>
                            <a href="{{Storage::disk('local')->url('public/purchase-quotation/'.$vendor->quotation)}}" download
                               class="btn border px-2 p-0 m-0 bg-light">
                                <small class="badge font-weight-light">Download <i class="fa fa-download"></i></small>
                            </a>
                        </td>
                        <td> {{$vendor->quotation_ref}}</td>
                    </tr>
                @endforeach

            </table>
                @if(count($show->indent_items)>0)
                <h4>Purchase Indent Items</h4>
            <table class="table table-hover font-13 table-bordered bg-white">
                <tr class="bg-light">
                    <th>Title</th>
                    <th>Item Code</th>
                    <th>Purpose</th>
                    <th>Description</th>
                    <th>Reference Code</th>
                    <th>Unit</th>
                    <th>Last 6 Months Consumption</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
                    @foreach($show->indent_items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->purpose}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->ref_doc}}</td>
                        <td>{{$item->unit}}</td>
                        <td>{{$item->consumption_6months}}</td>
                        <td>{{$item->qty}}</td>
                        <td>
                            <a href="{{url('purchase_indent/item/edit/'.$item->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
            @endforeach
            </table>
            @endif
        </div>
    </div>
    <div class="modal fade" id="add_vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Select Vendor & Suppliers
                    </h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span class="feather icon-x-circle"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('purchase.vendor.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$show->id}}" name="id">
                        <div class="col-12 mb-1">
                            <label for="vendor">Vendors & Suppliers</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="vendor" name="vendor" style="width: 100%">
                                    <option selected disabled="">Select Vendor & Suppliers</option>
                                    @foreach(\App\Models\Vendors::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12 row">
                            <label for="quotation" class="control-label">Quotation</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="quotation" id="quotation">
                                <label class="custom-file-label" for="quotation">Quotation</label>
                            </div>
                            @if ($errors->has('quotation'))
                                <span class="text-danger">
                          <strong>{{ $errors->first('quotation') }}</strong>
                      </span>
                            @endif
                        </div>
                        <div class="form-group col-12 row">
                            <label for="quotation_ref" class="control-label">Quotation #</label>
                            <div class="custom-file">
                                <input type="text" class="form-control" name="quotation_ref" id="quotation_ref" placeholder="Quotation #">
                            </div>
                            @if ($errors->has('quotation_ref'))
                                <span class="text-danger">
                          <strong>{{ $errors->first('quotation_ref') }}</strong>
                      </span>
                            @endif
                        </div>

                </div>
                <div class="modal-footer bg-light p-2">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="prioritize" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-sort-numeric-asc"></i> Prioritize Quotation
                    </h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span class="feather icon-x-circle"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('purchase.vendor.set.priority')}}">
                        @csrf
                        <table class="table table-hover bg-white">
                            <tr class="bg-light">
                                <th>Vendor</th>
                                <th>Quotation</th>
                                <th>Prioritize</th>
                            </tr>
                            @foreach($show->indent_vendors as $vendor)
                                <tr class="bg-light">
                                    <td class="text-capitalize">{{$vendor->vendors->name}}</td>

                                    <td>
                                        <a href="{{Storage::disk('local')->url('public/purchase-quotation/'.$vendor->quotation)}}" download
                                           class="btn border px-2 p-0 m-0 bg-light">
                                            <small class="badge font-weight-light">Download <i class="fa fa-download"></i></small>
                                        </a>
                                    </td>
                                    <input type="hidden" value="{{$vendor->id}}" name="id[]">
                                    <td>
                                        <div class="col-12">
                                            <div class="form-check form-check-inline" style="width: 100%">
                                                <select class="form-control" id="priority" name="priority[]" style="width: 100%">
                                                    <option selected disabled="">Select Priority</option>
                                                    @for($x=1;$x<=count($show->indent_vendors);$x++)
                                                        <option value="{{$x}}" {{$x==$vendor->priority?'selected':''}}>{{$x}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                </div>
                <div class="modal-footer bg-light p-2">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.send-to-tm', function (e) {
                swal({
                    title: "Are you sure to send purchase indent to Technical Manager?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('purchase.vendor.send.to.tm')}}",
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                },
                                statusCode: {
                                    403: function () {
                                        swal("Failed", "Permission denied.", "error");
                                        return false;
                                    }
                                },
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });
                                },
                                error: function () {
                                    swal("Failed", "Please try again later", "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.prioritized', function (e) {
                swal({
                    title: "Are you sure you have prioritized all quotations?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('purchase.vendor.prioritized')}}",
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                },
                                statusCode: {
                                    403: function () {
                                        swal("Failed", "Permission denied.", "error");
                                        return false;
                                    }
                                },
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });
                                },
                                error: function () {
                                    swal("Failed", "Please try again later", "error");
                                },
                            });

                        }
                    });

            });

        });
    </script>
    <script>
        $('#vendor').select2({
            placeholder: 'Select Vendors & Suppliers'
        });
    </script>
@endsection