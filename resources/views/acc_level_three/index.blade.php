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
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> Accounting Level Three</h3>
            <div class="text-right mt-2">
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right " data-toggle="modal" data-target="#add-level"><i class="fa fa-plus-circle"></i> Add Level Three</button>

                <a class="btn btn-info btn-sm" href="{{route('acc_level_one')}}">Level One</a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_two')}}">Level Two</a>
                <a class="btn btn-success btn-sm" href="{{route('acc_level_four')}}">Level Four</a>
            </div>

            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code3</th>
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
                    <th>Code3</th>
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
                    "url": "{{route('acc_level_three.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "code3"},
                    {"data": "title"},
                    {"data": "parent"},
                    {"data": "options", "orderable": false},
                ]
            });
        }

        $(document).ready(function () {
            InitTable();
            $('select[name="level1"]').on('change', function() {
                var level1 = $(this).val();
                if(level1) {
                    $.ajax({
                        url: '/acc_level_three/get_level2/'+level1,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="level2of3"]').empty();
                            $('select[name="level2of3"]').append('<option disabled selected>Select Level 2</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level2of3"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="level2of3"]').empty();
                }
            });

            $("#add_level_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_three.store')}}",
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
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('acc_level_three.update')}}",
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
                    "url": "{{url('/acc_level_three/edit')}}/"+id,
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#edit-level').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-level1').val(data.code1);
                        $('#edit-level2of3').append('<option value="'+data.code2+'" selected>'+data['code2_title']+'</option>');
                        $('#edit-title').val(data.title);
                    }
                });
            });
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
                                url: "{{route('acc_level_three.destroy')}}",
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

        });
    </script>
    <div class="modal fade" id="add-level" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Level Three</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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
                            <label for="level2of3" class="col-sm-2 control-label">Level 2</label>
                            <div class="col-12">
                                <select class="form-control text-xs" id="level2of3" name="level2of3">
                                    <option value="" selected disabled>Select Level 2</option>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Update Level Two</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="edit_level_form">
                        @csrf
                        <input type="hidden" id="edit-id" name="id">

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
                            <label for="edit-level2of3" class="col-sm-2 control-label">Level 2</label>
                            <div class="col-12">
                                <select class="form-control text-xs" id="edit-level2of3" name="level2of3">
                                    <option value="" selected disabled>Select Level 2</option>
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
                        <button class="btn btn-success btn-sm " type="submit"> <i class="fa fa-save"></i> Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection