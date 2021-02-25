@extends('layouts.master')
@section('content')
@if(Session::has('success'))
    <script>
        $(document).ready(function () {
            swal("Done!", '{{Session('success')}}', "success");
        });
    </script>
@endif
@if(Session::has('failed'))
    <script>
        $(document).ready(function () {
            swal("Sorry!", '{{Session('failed')}}', "error");
        });
    </script>
@endif
<div class="row">
    <div class="loader"></div>
    <div class="col-12">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> All Requests</h3>
        <span class="">
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#add_session"><i class="fa fa-plus-circle"></i> Request</button>
        </span>
    </div>

    <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Total Items</th>
        <th>Location</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Status</th>
          <th>Total Items</th>
          <th>Location</th>
          <th>Action</th>
      </tr>
      </tfoot>
    </table>

  </div>
</div>
<script>

</script>
<script>

    function InitTable() {
        $(".loading").fadeIn();

        $('#example').DataTable({
            responsive: true,
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,
            "order": [[0, 'asc']],
            "pageLength": 25,
            "ajax":{
                "url": "{{ route('generaterequests.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "customer" },
                { "data": "status" },
                { "data": "total" },
                { "data": "type" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        $('.loader').hide();
        InitTable();
        $('select[name="customer"]').on('change', function() {
            var customer = $(this).val();
            //alert(customer);
            if(customer) {
                $.ajax({
                    url: "{{url('/quotes/get_principal')}}/"+customer,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="principal"]').empty();
                        if (data.prin_name[0]!=null){
                            $('select[name="principal"]').append('<option value="'+ data.prin_name[0] +'">'+ data.prin_name[0] +'</option>');
                        }
                        if (data.prin_name[1]!=null){
                            $('select[name="principal"]').append('<option value="'+ data.prin_name[1] +'">'+ data.prin_name[1] +'</option>');
                        }
                        if (data.prin_name[2]!=null){
                            $('select[name="principal"]').append('<option value="'+ data.prin_name[2] +'">'+ data.prin_name[2] +'</option>');
                        }

                    }
                });
            }else{
                $('select[name="principal"]').empty();
            }
        });
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/quotes/edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                beforeSend : function()
                {
                    $(".loading").fadeIn();
                },
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Permission denied for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_session').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#edit_tm').val(data.tm);
                    $("#edit_customer").val(data.customer_id);
                   // $("#edit_customer_principal").val(data.principal);
                    $("#edit_rfq_mode").val(data.rfq_mode);
                    $("#edit_rfq_mode_details").val(data.rfq_mode_details);
                    $('#edit_customer_principal').append('<option value="'+ data.principal +'" selected>'+ data.principal +'</option>');
                },
                error: function(){},
            });
        });
        $("#add_session_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('quotes.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    if(!data.errors)
                    {
                        //$(".loading").();
                        $('button').attr('disabled',false);
                        $('#add_session').modal('hide');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });
                    }else {
                        swal("Warning", data.errors, "warning");
                    }
                },
                error: function(xhr)
                {
                    $('button').attr('disabled',false);
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_session_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('quotes.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    if(!data.errors)
                    {
                        $('#edit_session').modal('hide');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    }
                    else
                    {
                        jQuery.each(data.errors, function (key, value) {
                            swal({
                                title: "Pesan Eror",
                                text: value,
                                timer: 5000,
                                showConfirmButton: false,
                                type: "error"
                            })
                        });
                    }
                },
                error: function(xhr)
                {
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

</script>

<div class="modal fade" id="add_session" tabindex="-1" role="dialog" aria-labelledby="add_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="add_session"><i class="fa fa-plus-circle"></i> Create Request</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <small><i class="fa fa-times-circle"></i></small>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_session_form">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <label for="customer" class="p-0 m-0"><small>Select Customer</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="customer" name="customer">
                                    <option selected disabled="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="show_customer_principal" class="p-0 m-0"><small>Select Principal</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="show_customer_principal" name="principal">
                                    <option selected disabled="">Select Principal Name</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="rfq_mode" class="p-0 m-0"><small>Mode of RFQ</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="rfq_mode" name="rfq_mode">
                                    <option selected disabled="">Select Mode of RFQ</option>
                                    <option value="email">By Email</option>
                                    <option value="whatsapp">By Whatsapp</option>
                                    <option value="walk-in">By Walk In</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="rfq_mode_details" class="p-0 m-0"><small>RFQ Mode Details</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <textarea class="form-control" id="rfq_mode_details" name="rfq_mode_details" placeholder="Details of RFQ Mode" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tm" class="p-0 m-0"><small>Select TM</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control col-12" id="tm" name="tm">
                                    <option selected disabled="">Select Technical Manager</option>
                                    @foreach($tms as $tm)
                                        <option value="{{$tm->id}}">{{$tm->fname}} {{$tm->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer text-right bg-light">
                <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-save"></i> Save</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="edit_session" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="edit_session"> <i class="fa fa-refresh"></i> Edit Request</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_session_form">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-12">
                            <label for="customer" class="p-0 m-0"><small>Select Customer</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_customer" name="customer">
                                    <option selected disabled="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="edit_customer_principal" class="p-0 m-0"><small>Select Principal</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_customer_principal" name="principal">
                                    <option selected disabled="">Select Principal Name</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="rfq_mode" class="p-0 m-0"><small>Mode of RFQ</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_rfq_mode" name="rfq_mode">
                                    <option selected disabled="">Select Mode of RFQ</option>
                                    <option value="email">By Email</option>
                                    <option value="whatsapp">By Whatsapp</option>
                                    <option value="walk-in">By Walk In</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="rfq_mode_details" class="p-0 m-0"><small>RFQ Mode Details</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <textarea class="form-control" id="edit_rfq_mode_details" name="rfq_mode_details" placeholder="Details of RFQ Mode" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tm" class="p-0 m-0"><small>Select TM</small></label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control col-12" id="edit_tm" name="tm">
                                    @foreach($tms as $tm)
                                        <option selected disabled="">Select Technical Manager</option>
                                        <option value="{{$tm->id}}">{{$tm->fname}} {{$tm->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
            </div>
            </div>

                    <div class="modal-footer text-right bg-light">
{{--                        <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-refresh"></i> Update</button>--}}
                    </div>

                </form>

            </div>
    </div>
</div>

@endsection