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
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> Payment Voucher</h3>
            <div class="text-right mt-2">
                <a class="btn btn-warning btn-sm" href="{{route('vouchers.all')}}"> <i class="fa fa-eye"></i> All Vouchers</a>

                <a class="btn btn-primary btn-sm" href="{{route('vouchers.create')}}"> <i class="fa fa-plus-circle"></i> Add Payment Voucher</a>
            </div>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customize ID</th>
                    <th>V Type</th>
                    <th>V Date</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Customize ID</th>
                    <th>V Type</th>
                    <th>V Date</th>
                    <th>Created By</th>
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
                    "url": "{{route('vouchers.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "customize_id"},
                    {"data": "type"},
                    {"data": "date"},
                    {"data": "created_by"},
                    {"data": "options", "orderable": false},
                ]
            });
        }

        $(document).ready(function () {
            InitTable();
        });
    </script>
@endsection