@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Reference Errors & Uncertainty</h1>
        <span>
        <a href="{{route('units')}}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-eye"></i> Manage Units</a>
        <a href="{{route('manageref.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Errors & Uncertainty</a>
    </span>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-striped table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
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
                    <th>ID</th>
                    <th>Asset</th>
                    <th>Unit</th>
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                    <th>Action</th>                </tr>
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


