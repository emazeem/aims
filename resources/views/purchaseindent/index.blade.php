@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-paper-plane"></i> Purchase Indent</h3>
            <span class="text-right">
            <a href="{{route('purchase.indent.create')}}" class="btn float-right mt-1 btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus-circle"></i> Add Purchase Indent</a>
        </span>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Indent By</th>
                    <th>Indent Type</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Required</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Indent By</th>
                    <th>Indent Type</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Required</th>
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

            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('purchase.indent.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "indent_by"},
                    {"data": "indent_type"},
                    {"data": "department"},
                    {"data": "location"},
                    {"data": "required"},
                    {"data": "status"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
        });

    </script>
{{--

    <script>
        $(document).ready(function () {
            $("#add_columns_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('columns.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    statusCode: {
                        403: function () {
                            swal("Failed", "Access Denied", "error");
                            return false;
                        }
                    },
                    success: function (data) {

                        $('#add_column').modal('toggle');
                        swal('success', data.success, 'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (xhr, status, error) {

                        var error;
                        error = null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));
            $("#edit_columns_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('columns.update')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    statusCode: {
                        403: function () {
                            swal("Failed", "Access Denied", "error");
                            return false;
                        }
                    },
                    success: function (data) {

                        $('#edit_column').modal('toggle');
                        swal('success', data.success, 'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (xhr, status, error) {

                        var error;
                        error = null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('/columns/edit')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    beforeSend: function () {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function () {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action.", "error");
                            return false;
                        }
                    },
                    success: function (data) {
                        $('#edit_column').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-column').val(data.column);
                    },
                    error: function () {
                    },
                });
            });

        });
    </script>
--}}
@endsection


