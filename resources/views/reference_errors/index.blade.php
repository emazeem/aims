@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-tasks"></i> Manage Reference Errors & Uncertainty</h3>
            <span class="pull-right mt-1">
            <a href="{{route('units')}}" class="btn btn-sm btn-warning shadow-sm"><i class="fa fa-eye"></i> Manage Units</a>
            <a href="{{route('manageref.create')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle"></i> Add Errors & Uncertainty</a>
        </span>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>

                    <th>#</th>
                    <th>Asset</th>
                    <th>Unit</th>
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>

                    <th>#</th>
                    <th>Asset</th>
                    <th>Unit</th>
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
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
                    "url": "{{ route('manageref.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [

                    {"data": "id"},
                    {"data": "asset"},
                    {"data": "unit"},
                    {"data": "uuc"},
                    {"data": "ref"},
                    {"data": "error"},
                    {"data": "uncertainty"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
        });

    </script>
@endsection


