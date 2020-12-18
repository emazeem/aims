@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All Roles</h3>
            <a href="{{route('roles.create')}}" class="btn float-right btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus-circle"></i> Roles</a>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
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
                    "url": "{{ route('roles.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this role?",
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
                                url: "{{url('roles/delete')}}",
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
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });

            });
        });
    </script>
@endsection


