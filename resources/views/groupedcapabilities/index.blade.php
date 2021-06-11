@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="float-left font-weight-light"><i class="feather icon-list"></i> Grouped Capabilities ( Multi-Parameter )</h3>
            <span class="float-right ">
                @can('add-grouped-capabilities')
                    <a class="btn float-right btn-sm btn-primary mt-2 shadow-sm" href="{{route('grouped.capabilities.create')}}" ><i class="feather icon-plus-circle"></i> Grouped Capabilities</a>
                @endcan
            </span>
        </div>
    </div>
    <div class="col-12">
        <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
            <tr>
                <th>Name</th>
                <th>Parameter</th>
                <th>Location</th>
                <th>Underlying</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Parameter</th>
                <th>Location</th>
                <th>Underlying</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
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
                    "url": "{{ route('grouped.capabilities.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "name"},
                    {"data": "parameter"},
                    {"data": "location"},
                    {"data": "underlying"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this capability?",
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
                                url: "{{route('grouped.capabilities.delete')}}",
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
                                        $("#example").DataTable().ajax.reload(null, false);
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


