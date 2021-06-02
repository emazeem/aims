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
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> AIMS/QT/{{date('y')}}/{{$show->id}}
                Detail</h3>
        </div>
        <form id="form{{$show->id}}" action="" method='post' role='form'>
            @csrf
            <input name='id' type='hidden' value='{{$show->id}}'>
        </form>
        <div class="col-12 text-right">
            <a onclick="window.open('{{url('/quotes/print/'.$show->id)}}','newwindow','width=1100,height=1000');return false;"
               href="{{url('/quotes/print/'.$show->id)}}" title='Print' class='pull-left btn btn-sm btn-success'><i
                        class="fa fa-print"></i> Print</a>
            @if($show->status==1)

                <a title='Send to Customer' class='btn btn-outline-success btn-sm sendtocustomer' href='#'
                   data-id='{{$show->id}}'><i class='fa fa-send'></i> Send to Customer</a>

            @else
                @if($show->status<3)
                    <a title='Revise' class='btn btn-outline-danger btn-sm revise' href='#' data-id='{{$show->id}}'><i class='fa fa-refresh'></i> Revise</a>
                    @if($show->approval_mode)
                        @if($show->customers->pur_name)
                            <a title='Approve' class='btn btn-outline-success btn-sm approved' href='#' data-id='{{$show->id}}'><i class='fa fa-check'></i> Approve</a>
                        @endif
                    @endif
                @endif

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
        <div class="col-12">
            @if($show->status<3)
                <div class="card shadow">
                    <!-- Card Header - Accordion -->
                    <a href="#approval_card" class="d-block card-header py-3" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">{{(empty($show->approval_mode))?"Add":"Update"}}
                            Customer Approval
                            Details </h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="approval_card">
                        <div class="card-body">
                            <form action="{{url('/quotes/approval_details')}}" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{$show->id}}">
                                    <div class="col-12">
                                        <div class="font-italic form-group p-0 m-0">
                                            <label class="" id="approval_date">Approval Date</label>
                                            <?php
                                            $date = date('Y-m-d');
                                            ?>
                                            <input type="date" class="form-control " id="approval_date"
                                                   name="approval_date"
                                                   autocomplete="off"
                                                   value="{{($show->approval_date)?$show->approval_date:$date}}">
                                        </div>

                                        <label id="mode">Approval Mode</label>

                                        <div class="form-check form-check-inline" style="width: 100%">
                                            <select class="form-control col-12 " id="mode" name="mode">
                                                <option disabled selected>Select Mode of Approval</option>
                                                <option value="By Email" {{($show->approval_mode=="By Email")?"selected":""}}>
                                                    By Email
                                                </option>
                                                <option value="By Phone" {{($show->approval_mode=="By Phone")?"selected":""}}>
                                                    By Phone
                                                </option>
                                                <option value="By PO" {{($show->approval_mode=="By PO")?"selected":""}}>
                                                    By PO
                                                </option>
                                                <option value="By Walk-in" {{($show->approval_mode=="By Walk-in")?"selected":""}}>
                                                    By Walk-in
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label id="details">Approval Details</label>

                                            <textarea type="text" class="form-control " id="details" name="details"
                                                      placeholder="Details (PO# for by PO, Email-ID for Email, Name/Phone for by phone or walk-in)"
                                                      autocomplete="off"
                                                      rows="5">{{($show->approval_mode_details)?$show->approval_mode_details:""}}</textarea>

                                            <label id="details">PO# for by PO, Email-ID for Email, Name/Phone for by
                                                phone
                                                or walk-in</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Add Approval Details</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <!-- Card Header - Accordion -->
                    <a href="#purchase_card" class="d-block card-header py-3" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">{{(!$show->customers->pur_name)?'Add':'Update'}}
                            Purchase Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="purchase_card">
                        <div class="card-body">
                            <form action="{{url('/quotes/purchase_details')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$show->customers->id}}" name="customer">
                                <div class="row ">
                                    <div class="col-12 bg-white border ">
                                        <label for="purchase" class="col-form-label">Purchase Contact</label>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="purchase" name="pur_name"
                                                   placeholder="Name" autocomplete="off"
                                                   value="{{old('pur_name',$show->customers->pur_name?$show->customers->pur_name: null)}}">
                                            @if ($errors->has('pur_name'))
                                                <span class="text-danger">
                          <strong>{{ $errors->first('pur_name') }}</strong>
                      </span>
                                            @endif

                                        </div>

                                        <?php
                                        $purchase_phones = null;
                                        if (isset($show->customers->pur_phone)) {
                                            $purchase_phones = explode('-', $show->customers->pur_phone);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="pur_phone"
                                                   name="pur_phone[]"
                                                   placeholder="Phone" autocomplete="off"
                                                   value="{{old('pur_phone',$purchase_phones?$purchase_phones[0]:null)}}">
                                            @if ($errors->has('pur_phone'))
                                                <span class="text-danger">
                          <strong>{{ $errors->first('pur_phone') }}</strong>
                      </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="pur_phone"
                                                   name="pur_phone[]"
                                                   placeholder="Phone (opt)" autocomplete="off"
                                                   value="{{old('pur_phone',$purchase_phones?$purchase_phones[1]:null)}}">
                                            @if ($errors->has('pur_phone'))
                                                <span class="text-danger">
                          <strong>{{ $errors->first('pur_phone') }}</strong>
                      </span>
                                            @endif

                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="purchase" name="pur_email"
                                                   placeholder="Email" autocomplete="off"
                                                   value="{{old('pur_email',$show->customers->pur_email?$show->customers->pur_email: null)}}">
                                            @if ($errors->has('pur_email'))
                                                <span class="text-danger">
                          <strong>{{ $errors->first('pur_email') }}</strong>
                      </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">Add Purchase Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <!-- Card Header - Accordion -->
                    <a href="#discount_card" class="d-block card-header py-3" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"> Apply Discount</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="discount_card">
                        <div class="card-body">
                            <form action="{{route('quotes.discount')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$show->id}}">
                                <div class="row py-3">
                                    <div class="col-6">
                                        <div class="font-italic form-group p-0 m-0">
                                            <input type="text" class="form-control " id="discount" name="discount"
                                                   autocomplete="off" value="" placeholder="Enter % of Discount">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary" type="submit">Discount</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 my-2">

            @if($show->status==0)
                <a href="{{url('/items/create/'.$show->id)}}" class='btn btn-sm btn-outline-primary float-right'><i
                            class='fa fa-plus'></i> Items</a>
            @endif
        </div>
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
            $(document).on('click', '.edit', function () {
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

                            swal("Success", "Updated successfully", "success");
                            $('#add_na').modal('hide');
                            location.reload();
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
            $(document).on('click', '.approved', function (e) {
                swal({
                    title: "Are you sure to approve this quote?",
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
                                url: "{{url('quotes/approved')}}/" + id,
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
            $(document).on('click', '.sendtocustomer', function (e) {
                swal({
                    title: "Are you sure that you sent quote to customer?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('quotes.sendtocustomer')}}",
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

            $(document).on('click', '.revise', function (e) {
                swal({
                    title: "Are you sure to revise this quote?",
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
                                url: "{{url('quotes/revised')}}/" + id,
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
    <div class="modal fade" id="edit_na" tabindex="-1" role="dialog" aria-labelledby="add_na" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_na">Edit Misc.</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_na_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="edit_name" name="name"
                                       placeholder="Put capability name (not listed)" autocomplete="off"
                                       value="{{old('name')}}">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="edit_quantity" name="quantity"
                                       placeholder="quantity" autocomplete="off" value="{{old('quantity')}}">
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="printdetails" tabindex="-1" role="dialog"
         aria-labelledby="edit_session" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit_session">Add Quote Detail</h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-md-5">

                </div>
            </div>
        </div>
    </div>
    @if(count($show->logs)>0)
        <h4 class="mt-4 border-bottom">Revision Log </h4>
        <table id="example" class="table table-hover bg-white table-sm table-bordered mt-2 display nowrap">

            @foreach($show->logs as $log)
                <tr>
                    <td>{{$log->description}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection