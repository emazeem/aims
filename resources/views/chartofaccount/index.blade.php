@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
            <h3 class="font-weight-light float-left"><i class="feather icon-activity"></i> Chart of Account</h3>
            <div class="float-right mt-2">
                <a class="btn btn-info btn-sm" href="{{route('acc_level_one')}}"><b>1</b></a>
                <a class="btn btn-warning btn-sm" href="{{route('acc_level_two')}}"><b>2</b></a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_three')}}"><b>3</b></a>
                @can('view-coa')
                    <a class="btn btn-success btn-sm" href="{{route('acc_level_four.show')}}"> <i class="fa fa-eye"></i> Chart of Account</a>
                @endcan
                @can('create-coa')
                    <a class="btn btn-primary btn-sm" href="{{route('acc_level_four.create')}}"> <i class="fa fa-plus-circle"></i> Chart of Account</a>
                @endcan
            </div>
        </div>
        <div class="col-12 mt-3">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Parent</th>
                    <th>Account Code</th>
                    <th>Title</th>
                    <th>Cost Center</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Parent</th>
                    <th>Account Code</th>
                    <th>Title</th>
                    <th>Cost Center</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
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
                "ajax": {
                    "url": "{{route('acc_level_four.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "parent"},
                    {"data": "acc_code"},
                    {"data": "title"},
                    {"data": "cost.center","orderable": false},
                    {"data": "options", "orderable": false},
                ]
            });
        }

        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this chart of account?",
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
                                url: "{{route('acc_level_four.destroy')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                        InitTable();
                                    });
                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.remove-cc', function (e) {
                swal({
                    title: "Are you sure to delete this cost center?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('cost.center.destroy')}}",
                                type: "POST",
                                dataType: "JSON",
                                data: {id:id,_token:token},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                        InitTable();
                                    });
                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });

            });

            $(document).on('click', '.add-cc', function(e) {
                e.preventDefault();
                var id=$(this).attr('data-id');
                $('#parent').val(id);
                $('#add-cc-modal').modal('show');
            });
            $(document).on('click', '.view-cc', function(e) {
                e.preventDefault();
                var id=$(this).attr('data-id');
                e.preventDefault();
                $.ajax({
                    url: "{{url('cost-center/show')}}/"+id,
                    type: "GET",
                    success: function(data)
                    {
                        $('#view-cc-modal').modal('show');
                        $('.show-cc-list').empty();
                        $.each(data,function(index,item){
                            $('.show-cc-list').append(
                                "<tr>" +
                                    "<td>" + item.title + " <i class='remove-cc fa fa-trash text-danger text-right' data-id='"+item.id+"'></i> </td>" +
                                "</tr>"
                            );
                        });
                    },
                    error: function(xhr)
                    {
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            });

            $("#add_cc_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('cost.center.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        swal('success',data.success,'success').then((value) => {
                            $('#add-cc-modal').modal('hide');
                        });
                    },
                    error: function(xhr)
                    {
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

    <div class="modal fade" id="add-cc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Cost Center</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_cc_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="parent" id="parent">
                            <div class="form-group col-12  float-left">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title of Cost Center" autocomplete="off" value="{{old('title')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light p-1">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary " type="submit">Save</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view-cc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Cost Center</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered show-cc-list">

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection