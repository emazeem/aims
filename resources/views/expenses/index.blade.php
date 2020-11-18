@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expenses Details</h1>
        <span>
        <a href="{{route('expenses_categories')}}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-eye"></i> Expense Categories & Subcategories</a>
        <a href="{{route('expenses.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Expenses</a>
    </span>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-striped table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>To</th>
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
                    "url": "{{ route('expenses.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "category"},
                    {"data": "subcategory"},
                    {"data": "amount"},
                    {"data": "description"},
                    {"data": "to"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
        });

    </script>
@endsection


