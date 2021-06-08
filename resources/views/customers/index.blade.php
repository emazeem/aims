@extends('layouts.master')
@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <h5 class="m-b-10 font-weight-light float-left"><i class="feather icon-user"></i> Customers</h5>
            <a href class="btn btn-sm add btn-primary shadow-sm float-right mt-2"><i
                        class="fa fa-plus-circle"></i> Customer</a>
        </div>

    <div class="col-12">
        <table id="example" class="table dt-responsive table-hover bg-white display nowrap table-sm" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Registered Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="text-capitalize">
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Registered Name</th>
                <th>Address</th>
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
                "ajax": {
                    "url": "{{ route('customers.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "address"},
                    {"data": "options", "orderable": false},
                ]

            });
        }

        $(document).ready(function () {
            InitTable();

            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this customer?",
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
                                url: "{{route('customers.destroy')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        $("#example").DataTable().ajax.reload(null,false);
                                    });

                                },
                                error: function (xhr) {
                                    var error='';
                                    $.each(xhr.responseJSON.errors, function (key, item) {
                                        error+=item;
                                    });
                                    swal("Failed", error, "error");
                                },
                            });

                        }
                    });

            });

        });
    </script>
    @include('customers.create')
    @include('customers.show')

@endsection