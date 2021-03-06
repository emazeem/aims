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
@if(Session::has('failed'))
    <script>
        $(document).ready(function () {
            swal("Sorry!", '{{Session('failed')}}', "error");
        });
    </script>
@endif
<div class="row">
    <div class="col-12">
        <h3 class="float-left font-weight-light"><i class="feather icon-help-circle"></i> All Requests</h3>

        <button type="button" class="btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#add_session"><i class="fa fa-plus-square"></i> Request</button>

    </div>

    <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Total Items</th>
        <th>Type</th>
          <th>Status</th>

          <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Total Items</th>
          <th>Type</th>
          <th>Status</th>

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
                { "data": "total" },
                { "data": "type" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
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
                        $.each(data,function (index,value) {
                            $('select[name="principal"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
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
            var button=$('.request-save-btn');
            var previous=$('.request-save-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

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
                    button.attr('disabled',null).html(previous);
                    $('button').attr('disabled',false);
                    $('#add_session').modal('hide');
                    swal('success',data.success,'success').then((value) => {
                        InitTable();
                    });
                },
                error: function(xhr)
                {
                    button.attr('disabled',null).html(previous);
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
            var button=$('.request-edit-btn');
            var previous=$('.request-edit-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            $.ajax({
                url: "{{route('quotes.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    button.attr('disabled',null).html(previous);
                    $('#edit_session').modal('hide');
                    swal('success',data.success,'success').then((value) => {
                        InitTable();
                    });
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
        $('select[name="parameter"]').on('change', function() {
            $('#price').val('');
            $('#range').val('');
            var parameter = $(this).val();
            if(parameter) {
                $.ajax({
                    url: '/items/select-capabilities/'+parameter,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="capability"]').empty();

                        $('select[name="capability"]').append('<option disabled selected>Select Respective Parameter</option>');
                        $.each(data, function(key, value) {
                            $('select[name="capability"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="capability"]').empty();
            }
        });
        $('select[name="capability"]').on('change', function() {
            var capability = $(this).val();
            if(capability) {
                $.ajax({
                    url: '/items/select-price/'+capability,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#price').val(data.price);
                        $('#range').val(data.range);
                        $('#location').val(data.location);
                        $('#accredited').val(data.accredited);
                    }
                });
            }else{
                $('select[name="capability"]').empty();
            }
        });
    });

</script>
<div class="modal fade" id="add_session" tabindex="-1" role="dialog" aria-labelledby="add_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="add_session"><i class="feather icon-plus-circle"></i> Create Request</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <i class="feather icon-x-circle"></i>
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
                                        <option value="{{$customer->id}}">{{$customer->reg_name}}-{{$customer->plant}}</option>
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
                <button class="btn btn-primary btn-sm btn-block request-save-btn" type="submit"><i class="fa fa-save"></i> Save</button>
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
                    <i class="feather icon-x-circle"></i>
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
                        <button class="btn btn-primary btn-sm btn-block request-edit-btn" type="submit"><i class="fa fa-refresh"></i> Update</button>
                    </div>

                </form>

            </div>
    </div>
</div>
@endsection