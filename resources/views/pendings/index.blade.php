
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>{{--
@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">

        <div class="col-12">
            <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All Pending Reviews</h3>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
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

                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('pendings.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "quotes" },
                    { "data": "customer" },
                    { "data": "not_available" },
                    { "data": "createdat" },
                    { "data": "updatedat" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {

            InitTable();
            $(document).on('click', '.nofacility', function(e)
            {
                swal({
                    title: "Are you sure that you have no facility of this quote?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#form"+id).attr("method");
                            var form_data = $("#form"+id).serialize();

                            $.ajax({
                                url: "{{url('items/nofacility')}}/"+id,
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal("Success", "Sent with no facility.", "success");
                                    InitTable();
                                },
                                error: function(){
                                    swal("Failed", "Try again later." , "error");
                                },
                            });

                        }
                    });

            });

            $(document).on('click', '.checks', function() {
                var id = $(this).attr('data-id');
                $('#id').val(id);
                $('#add_checks').modal('toggle');
            });

            $("#add_checks_form").on('submit',(function(e) {
                e.preventDefault();
                var self=$(this), button=self.find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('pendings.checks')}}",
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
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#add_checks').modal('hide');
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



        } );
    </script>
    <div class="modal fade" id="add_checks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Checks of items for Review Form</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_checks_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="id">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="ref_std" name="ref_std">
                                    <label class="form-check-label" for="ref_std">Reference Std</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cal_procedure" name="cal_procedure">
                                    <label class="form-check-label" for="cal_procedure">Cal Procedure</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cal_schedule" name="cal_schedule">
                                    <label class="form-check-label" for="cal_schedule">Cal Schedule</label>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection--}}
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
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> All Pending Requests</h3>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Items for Review</th>
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
                    <th>Items for Review</th>
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
                    "url": "{{ route('pendings.fetch') }}",
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
            InitTable();
        });
    </script>

@endsection