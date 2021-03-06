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
            <h3 class="font-weight-light float-left"><i class="feather icon-list"></i> Accounting Level Two</h3>
            <div class="text-right">
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right " data-toggle="modal" data-target="#add-level"><i class="fa fa-plus-circle"></i> Add Level Two</button>
                <a class="btn btn-info btn-sm" href="{{route('acc_level_one')}}"><b>1</b></a>
                <a class="btn btn-warning btn-sm" href="{{route('acc_level_two')}}"><b>2</b></a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_three')}}"><b>3</b></a>
                <a class="btn btn-success btn-sm" href="{{route('acc_level_four')}}">Chart of Account</a>

            </div>
        </div>
        <div class="col-12 mt-3">

            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code2</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Code2</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
    </div>
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
                "ajax": {
                    "url": "{{route('acc_level_two.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "code2"},
                    {"data": "title"},
                    {"data": "parent"},
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
                                url: "{{route('acc_level_two.destroy')}}",
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
                var button=$('.acc-save-btn');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_two.store')}}",
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
            $("#edit_level_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$('.acc-update-btn');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_two.update')}}",
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
                    "url": "{{url('/acc_level_two/edit')}}/"+id,
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#edit-level').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-level1').val(data.code1);
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
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Level Two</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x-circle"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_level_form">
                        @csrf

                        <div class="form-group">
                            <label for="level1" class="control-label col-12">Level One</label>
                            <div class="col-12">
                                <select class="form-control" id="level1" name="level1">
                                    <option selected disabled>Select Level One</option>
                                    @foreach($ones as $one)
                                        <option value="{{$one->id}}">{{$one->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label col-12">Title</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="off" value="{{old('title')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12 text-right">
                        <button class="btn btn-success btn-sm acc-save-btn" type="submit"> <i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="fa fa-pencil-alt"></i> Update Level Two</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x-circle"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="edit_level_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="form-group">
                            <label for="edit-level1" class="control-label col-12">Level One</label>
                            <div class="col-12">
                                <select class="form-control" id="edit-level1" name="level1">
                                    <option selected disabled>Select Level One</option>
                                    @foreach($ones as $one)
                                        <option value="{{$one->id}}">{{$one->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-title" class="control-label col-12">Title</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="edit-title" name="title" placeholder="Title" autocomplete="off" value="{{old('title')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12 text-right">
                        <button class="btn btn-success btn-sm acc-update-btn" type="submit"> <i class="fa fa-save"></i> Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection