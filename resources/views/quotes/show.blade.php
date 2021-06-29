@extends('layouts.master')
@section('content')
    @php
        $purchase= $show->customers->contacts->where('type','purchase');
    @endphp

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">

        <div class="col-12">
            <h3 class="float-left font-weight-light"><i class="feather icon-eye"></i> {{$show->cid}}</h3>
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
                    <a title='Revise' class='btn btn-outline-danger btn-sm revise' href='#' data-id='{{$show->id}}'><i class='fa fa-spinner'></i> Revise</a>
                    @if($show->approval_mode)
                        @if(count($purchase)>0)
                            <a title='Approve' class='btn btn-outline-success btn-sm approved' href='#' data-id='{{$show->id}}'><i class='fa fa-check'></i> Approve</a>
                        @endif
                    @endif
                @endif

            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover bg-white table-sm table-bordered nowrap mt-2">
                <tr>
                    <td><b>Quote #</b></td>
                    <td>{{$show->cid}}</td>
                </tr>
                <tr>
                    <td><b>Customer</b></td>
                    <td>
                        {{$show->customers->reg_name}}
                    </td>
                </tr>

                <tr>
                    <td><b>Principal</b></td>
                    <td>
                        {{$show->principals->name}}
                        @if($show->principals->email)
                            <br>
                            {{$show->principals->email?$show->principals->email:null}}
                        @endif
                        @if($show->principals->phone)
                            <br>
                            {{$show->principals->phone?$show->principals->phone:null}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if($show->status==0)
                            [ <span class="text-success">Pending</span> ]
                        @endif
                        @if($show->status==1)
                            [ <span class="text-success">To be Sent to Customer</span> ]
                        @endif
                        @if($show->status==2)
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
                @if($show->status==3)
                <tr>
                    <th>Add Attachments</th>
                    <td>
                        <form id="quote-attachments-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$show->id}}">
                            <div class="row">
                                <label for="type_of_attachment"></label>
                                <select class="form-control col-md-4 col-sm-12 my-sm-2" id="type_of_attachment" name="type_of_attachment">
                                    <option disabled selected>Select Type of Attachments</option>
                                    <option value="PO">PO</option>
                                    <option value="List of Items">List of Items</option>
                                </select>
                                <div class="custom-file col-md-4 col-sm-12 my-sm-2">
                                    <input type="file" class="custom-file-input" name="attachment" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <button class="btn rounded col-md-4 col-sm-12 my-sm-2 btn-primary quote-attachment-save-btn" type="submit">Attach Files</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endif
                @if(count($show->attachments)>0)
                    <tr>
                        <td>Attachments</td>
                        <td>
                            @foreach($show->attachments as $attachment)
                            <div class="row border-bottom">
                                    <div class="col-2"><a class="btn">{{$attachment->title}}</a></div>
                                    <div class="col">
                                        <a href="{{Storage::disk('local')->url('public/quote-attachments/'.$attachment->attachment)}}" target="_blank" class="btn">
                                            <i class="feather icon-file"></i>
                                            {{substr($attachment->attachment,10)}} ( {{number_format((Storage::disk('local')->size('public/quote-attachments/'.$attachment->attachment)/1024),2)}} KBs )
                                        </a>
                                        <style>.delete-attachment{cursor: pointer}</style>
                                        <i data-id="{{$attachment->id}}" class="delete-attachment feather icon-x text-danger"></i>
                                    </div>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                @endif
                @if($show->status>1)
                @if($show->status<3)
                <tr>
                    <th>{{(empty($show->approval_mode))?"Add":"Update"}}
                        Customer Approval</th>
                    <td>
                        <form id="quote-approve-form" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$show->id}}">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group p-0 m-0">
                                        <label for="approval_date">Approval Date</label>
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="date" class="form-control col" id="approval_date"
                                               name="approval_date"
                                               autocomplete="off"
                                               value="{{($show->approval_date)?$show->approval_date:$date}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">

                                    <label for="mode">Approval Mode</label>
                                    <select class="form-control" id="mode" name="mode">
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
                                <div class="col-10 mt-md-2">
                                    <label for="details">Approval Details
                                        ( PO# for by PO, Email-ID for Email, Name/Phone for by
                                        phone
                                        or walk-in )</label>
                                    <textarea type="text" class="form-control " id="details" name="details"
                                              placeholder="Details (PO# for by PO, Email-ID for Email, Name/Phone for by phone or walk-in)"
                                              autocomplete="off"
                                              rows="2">{{($show->approval_mode_details)?$show->approval_mode_details:""}}</textarea>


                                </div>
                                <div class="col-2 mt-auto">
                                    <button class="btn btn-primary rounded float-right approve-quote-save-btn" type="submit">{{(empty($show->approval_mode))?"Add":"Update"}} Approval Details</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                    <tr>
                        <th>
                            Add Purchase Details
                            <br>
                            <ol>
                                @foreach($show->customers->contacts as $contact)
                                    @if($contact->type=='purchase')
                                        <li class="font-weight-light">{!! $contact->name.' <i class="text-danger"> > </i> '.$contact->email.' <i class="text-danger"> > </i> '.$contact->phone!!}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </th>
                        <td><form action="{{url('quotes/purchase_details')}}" id="add-purchase-form" method="post">
                                @csrf
                                <input type="hidden" value="{{$show->customers->id}}" name="customer">
                                <div class="row ">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="purchase" name="pur_name"
                                                   placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                    <div class="form-group">
                                            <input type="text" class="form-control" id="pur_phone"
                                                   name="pur_phone"
                                                   placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="purchase" name="pur_email"
                                                   placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <button class="btn rounded btn-primary add-purchase-btn" type="submit">Add Purchase Details</button>
                                    </div>

                                </div>
                            </form></td>
                    </tr>
                    <tr>
                        <th>Apply Discount</th>
                        <td>
                            <form id="discount-form" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$show->id}}">
                                <div class="row py-3">
                                    <div class="col-md-4 col-12">
                                        <div class="font-italic form-group p-0 m-0">
                                            <input type="text" class="form-control " id="discount" name="discount"
                                                   autocomplete="off" value="" placeholder="Enter % of Discount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <button class="btn btn-primary rounded discount-btn" type="submit">Discount</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endif
                    @endif
            </table>
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
            $(document).on('click','.delete-attachment', function (e) {
                swal({
                    title: "Are you sure to delete this attachment?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('quotes.attachments.destroy')}}",
                                type: 'DELETE',
                                dataType: "JSON",
                                data: {'id': id, _token: token},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });
                                },
                                error: function (data) {
                                    button.attr('disabled',null).html(previous);
                                    $(".loader-gif").hide();
                                    var errors='';
                                    $.each(data.responseJSON.errors,function (i,v) {
                                        errors=errors+v[0]+'* ';

                                    });
                                    swal("Failed", errors, "error");
                                }
                            });

                        }
                    });

            });


            $("#quote-attachments-form").on('submit', (function (e) {
                e.preventDefault();
                var button=$('.quote-attachment-save-btn');
                var previous=$('.quote-attachment-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                $.ajax({
                    url: "{{route('quotes.attachments.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend : function()
                    {
                        $(".loader-gif").fadeIn();
                    },
                    success: function (data) {
                        button.attr('disabled',null).html(previous);
                        $(".loader-gif").hide();
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (data) {
                        button.attr('disabled',null).html(previous);
                        $(".loader-gif").hide();
                        var errors='';
                        $.each(data.responseJSON.errors,function (i,v) {
                            errors=errors+v[0]+'* ';

                        });
                        swal("Failed", errors, "error");
                    }
                });
            }));
            $("#discount-form").on('submit', (function (e) {
                e.preventDefault();
                var button=$('.discount-btn');
                var previous=$('.discount-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                $.ajax({
                    url: "{{route('quotes.discount')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (data) {
                        button.attr('disabled',null).html(previous);
                        var errors='';
                        $.each(data.responseJSON.errors,function (i,v) {
                            errors=errors+v[0]+'* ';

                        });
                        swal("Failed", errors, "error");
                    }
                });
            }));

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

            $("#quote-approve-form").on('submit', (function (e) {
                e.preventDefault();
                var button=$('.approve-quote-save-btn');
                var previous=$('.approve-quote-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                $.ajax({
                    url: "{{url('quotes/approval_details')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
            $("#add-purchase-form").on('submit', (function (e) {
                e.preventDefault();
                var button=$('.add-purchase-btn');
                var previous=$('.add-purchase-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                $.ajax({
                    url: "{{url('quotes/purchase_details')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
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