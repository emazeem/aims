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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> Accounting Level One</h3>
            <div class="text-right mt-2">
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right " data-toggle="modal" data-target="#add-level"><i class="fa fa-plus-circle"></i> Level <b>1</b></button>

                <a class="btn btn-info btn-sm" href="{{route('acc_level_one')}}"><b>1</b></a>
                <a class="btn btn-warning btn-sm" href="{{route('acc_level_two')}}"><b>2</b></a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_three')}}"><b>3</b></a>
                <a class="btn btn-success btn-sm" href="{{route('acc_level_four')}}">Chart of Account</a>

            </div>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code1</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Code1</th>
                    <th>Title</th>
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
                    "url": "{{route('acc_level_one.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "code"},
                    {"data": "title"},
                    {"data": "options", "orderable": false},
                ]
            });
        }
        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this account?",
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
                                url: "{{route('acc_level_one.destroy')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });

            });

            $("#add_level_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_one.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#add-level').modal('hide');
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
            $("#update_level_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_one.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#edit-level').modal('hide');
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

            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/acc_level_one/edit')}}/"+id,
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#edit-level').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-title').val(data.title);
                    }
                });
            });

        });
    </script>
    <div class="modal fade" id="add-level" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Level One</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_level_form">
                        @csrf

                            <div class="form-group">
                                <label for="unit" class="control-label col-12">Title</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Title" autocomplete="off" value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                                    @endif
                                </div>
                            </div>
                </div>
                <div class="modal-footer">

                <div class="col-12 text-right">
                            <button class="btn btn-success btn-sm " type="submit"> <i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="edit-level" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Update Level One</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="update_level_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                            <div class="form-group">
                                <label for="edit-title" class="control-label col-12">Title</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="edit-title" name="title"
                                           placeholder="Title" autocomplete="off" value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                                    @endif
                                </div>
                            </div>
                </div>
                <div class="modal-footer">

                <div class="col-12 text-right">
                            <button class="btn btn-success btn-sm " type="submit"> <i class="fa fa-save"></i> Update</button>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>


@endsection