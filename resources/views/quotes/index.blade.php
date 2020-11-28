@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="border-bottom text-dark">All Quotes</h2>

    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_session"><i class="fas fa-plus"></i> Quote</button>
</div>

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
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Turnaround</th>
        <th>Status</th>
        <th>Total Items</th>
        <th>Type</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Turnaround</th>
          <th>Status</th>
          <th>Total Items</th>
          <th>Type</th>
          <th>Action</th>
      </tr>
      </tfoot>
    </table>

  </div>
</div>
<script>

    function InitTable() {
        $(".loading").fadeIn();

        $('#example').DataTable({
            responsive: true,
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,
            "order": [[0, 'desc']],
            "pageLength": 25,
            "ajax":{
                "url": "{{ route('quotes.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "customer" },
                { "data": "turnaround" },
                { "data": "status" },
                { "data": "total" },
                { "data": "type" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
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
                    $('#edit_turnaround').val(data.turnaround);
                    $("#edit_customer").val(data.customer_id);
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
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied" , "error");
                        return false;
                    }
                },
                success: function(data)
                {

                    if(!data.errors)
                    {
                        $('#add_session').modal('hide');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });
                    }else {
                        swal("Warning", data.errors, "warning");
                    }
                },
                error: function()
                {
                    swal("Failed", "Fields Required. Try again.", "error");
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
                error: function(e)
                {
                    swal("Failed", "Fields Required. Try again.", "error");

                }
            });
        }));

    });

</script>

<div class="modal fade" id="add_session" tabindex="-1" role="dialog" aria-labelledby="add_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_session">Add Quote</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_session_form">
                    @csrf
                    <div class="row">
                        <h5 class="px-3"></h5>
                        <input type="hidden" name="id" id="session_id_print">
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control col-12" id="tm" name="tm">
                                    @foreach($tms as $tm)
                                        <option selected disabled="">Select Technical Manager</option>
                                        <option value="{{$tm->id}}">{{$tm->fname}} {{$tm->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="turnaround" name="turnaround">
                                    <option selected disabled="">Select Working Days</option>
                                    <option value="6 Days">06 Days</option>
                                    <option value="12 Days">12 Days</option>
                                    <option value="18 Days">18 Days</option>
                                    <option value="24 Days">24 Days</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="customer" name="customer">
                                    <option selected disabled="">Select customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="show_customer_principal" name="principal">
                                    <option selected disabled="">Select Principal Name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary btn-block" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_session" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_session">Edit Quote</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_session_form">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row">
                        <h5 class="px-3"></h5>
                        <div class="col-12">
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
                    <div class="row">

                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_turnaround" name="turnaround">
                                    <option selected disabled="">Select Working Days</option>
                                    <option value="6 Days">06 Days</option>
                                    <option value="12 Days">12 Days</option>
                                    <option value="18 Days">18 Days</option>
                                    <option value="24 Days">24 Days</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_customer" name="customer">
                                    <option selected disabled="">Select customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_customer_principal" name="principal">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary btn-block" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>

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
                    if (data.prin_name_1!=null){
                        $('select[name="principal"]').append('<option value="'+ data.prin_name_1 +'">'+ data.prin_name_1 +'</option>');
                    }
                    if (data.prin_name_2!=null){
                        $('select[name="principal"]').append('<option value="'+ data.prin_name_2 +'">'+ data.prin_name_2 +'</option>');
                    }
                    if (data.prin_name_3!=null){
                        $('select[name="principal"]').append('<option value="'+ data.prin_name_3 +'">'+ data.prin_name_3 +'</option>');
                    }
                }
            });
        }else{
            $('select[name="principal"]').empty();
        }
    });
</script>
@endsection