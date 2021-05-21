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
            <h3><i class="fa fa-dollar"></i> Purchase Invoice</h3>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>PO</th>
                    <th>Voucher</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>PO</th>
                    <th>Voucher</th>
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
                    "url": "{{ route('purchase.invoice.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "po"},
                    {"data": "voucher_id"},
                    {"data": "options", "orderable": false},
                ]
            });
        }
        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.invoice-store', function (e) {
                swal({
                    title: "Are you sure to generate purchase invoice?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = 'POST';
                            var form_data = $("#form" + id).serialize();

                            $.ajax({
                                url: "{{route('purchase.invoice.store')}}",
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