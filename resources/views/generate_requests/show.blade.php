@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">

        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i>
                AIMS/QT/{{date('y')}}/{{$show->id}}Detail
            </h3>
        </div>
        <form id="form{{$show->id}}" action="" method='post' role='form'>
            @csrf
            <input name='id' type='hidden' value='{{$show->id}}'>
        </form>
        <div class="col-12 text-right">
            @if(count($items)>0)
                @if($noaction==false)
                    @if($show->status==0)
                        @if(!empty($show->turnaround))
                            <a title='Mark as Complete' class='btn btn-outline-primary btn-sm complete' href='#'
                               data-id='{{$show->id}}'><i class='fa fa-thumbs-up'></i> Mark as Complete</a>
                        @endif
                    @endif
                @endif
            @endif
            @if($show->status>0)
                    <a href="{{url('/quotes/view/'.$show->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> AIMS/QT/{{date('y')}}/{{$show->id}}</a>
            @endif
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <table class="table table-hover bg-white table-sm table-bordered mt-2">
                <tr>
                    <td><b>Quote #</b></td>
                    <td>AIMS/QT/{{date('y')}}/{{$show->id}}</td>
                </tr>
                <tr>
                    <td><b>Customer</b></td>
                    <td>
                        <a href="{{url('/customers/view/'.$show->customers->id)}}">{{$show->customers->reg_name}}</a>
                    </td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if($show->status==0)
                            [ <span class="text-success">Pending</span> ]
                        @endif
                        @if($show->status==1)
                            [ <span class="text-success">Marked as Complete</span> ]
                            [ <span class="text-success">Still not Sent to Customer</span> ]
                        @endif
                        @if($show->status==2)
                            [ <span class="text-success">Quote Sent to Customer</span> ]
                            [ <span class="text-success">Awaiting Customer Approval</span> ]
                        @endif
                        @if($show->status==3)
                            [ <span class="text-success">Quote is approved by Customer</span> ]
                        @endif



                        @if($noaction==true)
                            [ <span class="text-danger">Item(s) pending for review</span> ]
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>RFQ Mode</b></td>
                    <td>{{$show->rfq_mode}}</td>
                </tr>
                <tr>
                    <td><b>RFQ Mode Details</b></td>
                    <td>{{$show->rfq_mode_details}}</td>
                </tr>
                @if($show->approval_mode)
                    <tr>
                        <td><b>Customer Mode of Approval</b></td>
                        <td>{{$show->approval_mode}}</td>
                    </tr>

                    <tr>
                        <td><b>Customer Approval Details</b></td>
                        <td>{{$show->approval_mode_details}}</td>
                    </tr>
                    <tr>
                        <td><b>Customer Date of Approval</b></td>
                        <td>{{date('d M, Y',strtotime($show->approval_date))}}</td>
                    </tr>
                @endif

                @if($show->remarks)
                    <tr>
                        <td><b>Remarks</b></td>
                        <td>{{$show->remarks}}</td>
                    </tr>
                @endif
                @if($show->turnaround)
                    <tr>
                        <td><b>Turnaround</b></td>
                        <td>{{$show->turnaround}} working days</td>
                    </tr>
                @endif


                <tr>
                    <td><b>Created on</b></td>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-hover bg-white table-sm table-bordered mt-2 display nowrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Parameter</th>
                    <th>Capability</th>
                    <th>Location</th>
                    <th>Range</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Parameter</th>
                    <th>Capability</th>
                    <th>Location</th>
                    <th>Range</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        @if($show->status==0)
            @if(count($show->items)>0)
                <div class="col-12">
                    <div class="card shadow">
                        <!-- Card Header - Accordion -->
                        <a href="#remarks_card" class="d-block card-header py-3" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary"> Remarks & Turnaround</h6>
                        </a>
                        <div class="collapse" id="remarks_card">
                            <div class="card-body">
                                <form action="{{url('/quotes/remarks')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$show->id}}">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="font-italic form-group p-0 m-0">
                                                <label for="remarks">Remarks (if any)</label>
                                                <input type="text" class="form-control " id="remarks" name="remarks" autocomplete="off" value="{{old('remarks')}}" placeholder="Enter RFQ Remarks">
                                            </div>
                                            @if ($errors->has('remarks'))
                                                <span class="text-danger">
                                            <strong>{{ $errors->first('remarks') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-5">

                                            <label for="turnaround"><i>Tentative Turnaround </i></label>
                                            <div class="form-check form-check-inline" style="width: 100%">
                                                <select class="form-control" id="turnaround" name="turnaround">
                                                    <option disabled selected>Select Turnaround</option>
                                                    <option value="3" {{(count($show->items)>0 && count($show->items)<=5)?'selected':''}}>3 working days</option>
                                                    <option value="8" {{(count($show->items)>5 && count($show->items)<=10)?'selected':''}}>8 working days</option>
                                                    <option value="15" {{(count($show->items)>10 && count($show->items)<=50)?'selected':''}}>15 working days</option>
                                                    <option value="30" {{(count($show->items)>50)?'selected':''}}>30 working days</option>
                                                </select>
                                                @if ($errors->has('turnaround'))
                                                    <span class="text-danger">
                                                <strong>{{ $errors->first('turnaround') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <button class="btn btn-primary mt-4" type="submit"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

    </div>
    <script>

        function InitTable() {
            $(".loading").fadeIn();
            var id = '{{$id}}';
            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('items.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "parameter"},
                    {"data": "capability"},
                    {"data": "location"},
                    {"data": "range"},
                    {"data": "uprice"},
                    {"data": "quantity"},
                    {"data": "sprice"},
                    {"data": "status"},
                    {"data": "options", "orderable": false},
                ]
            });

        }

        $(document).ready(function () {
            //InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this item?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();

                            var request_method = $("#form" + id).attr("method");
                            var form_data = $("#form" + id).serialize();

                            $.ajax({
                                url: "{{url('items/delete')}}/" + id,
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function () {
                                        swal("Failed", "Permission denied.", "error");
                                        return false;
                                    }
                                },
                                success: function (data) {
                                    swal("Success", "Deleted successfully.", "success");
                                    InitTable();
                                },
                                error: function () {
                                    swal("Failed", "Unable to delete.", "error");
                                },
                            });

                        }
                    });

            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.edit-na', function () {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/items/editNA')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    beforeSend: function () {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function () {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission deneid for this action.", "error");
                            return false;
                        }
                    },
                    success: function (data) {
                        $('#edit_na').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.not_available);
                        $('#edit_quantity').val(data.quantity);
                        //Populating Form Data to Edit Ends
                    },
                    error: function () {
                    },
                });
            });
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/items/editNA')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    beforeSend: function () {
                        $(".loading").fadeIn();
                    },
                    success: function (data) {
                        $('#edit_item_id').val(data.id);
                        $('.item_btn').val('Update');
                        $('#parameter').val(data.parameter);
                        $('#capability').append('<option selected value="'+data.capability+'">'+data.capability_name+'</option>');
                        $('#range').val(data.range);
                        $('#price').val(data.price);
                        $('#location').val(data.location);
                        $('#accredited').val(data.accredited);
                        $('#quantity').val(data.quantity);
                        //Populating Form Data to Edit Ends
                    },
                    error: function () {
                    },
                });
            });
            $("#edit_na_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('items.updateNA')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    statusCode: {
                        403: function () {
                            $(".loading").fadeOut();
                            swal("Failed", "Access Denied", "error");
                            return false;
                        }
                    },
                    success: function (data) {

                        if (!data.errors) {
                            swal('success', data.success, 'success').then((value) => {
                                location.reload();
                            });

                            InitTable();
                        }
                    },
                    error: function () {
                        swal("Failed", "Fields Required. Try again.", "error");
                    }
                });
            }));
        });
        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.complete', function (e) {
                swal({
                    title: "Are you sure to mark this quote as complete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('quotes.complete')}}",
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
    <div class="modal fade" id="edit_na" tabindex="-1" role="dialog" aria-labelledby="edit_na" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_na"><i class="fa fa-edit"></i> Edit Misc.</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_na_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit_id">
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="name">Capability</label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                       placeholder="Put capability name (not listed)" autocomplete="off"
                                       value="{{old('name')}}">
                            </div>
                            <div class="col-sm-4">
                                <label for="quantity">Qty</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity"
                                       placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer m-0 py-2">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-refresh"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($show->status==0)
        @include('items.create')
    @endif
@endsection
{{--@if(count($show->logs)>0)
        <h4 class="mt-4 border-bottom">Revision Log </h4>
        <table id="example" class="table table-hover bg-white table-sm table-bordered mt-2 display nowrap">

            @foreach($show->logs as $log)
                <tr>
                    <td>{{$log->description}}</td>
                </tr>
            @endforeach
        </table>
    @endif
    --}}