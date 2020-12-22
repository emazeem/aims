@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">

            <h4 class="border-bottom text-dark pull-left"><i class="fa fa-tasks"></i> All Categories & Subcategories</h4>
            <span>
                <a href="{{route('expenses_categories.create')}}" class="btn btn-primary pull-right btn-sm">
                <span class="fa fa-plus"></span> Add categories
                </a>
            </span>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category name</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Category name</th>
                    <th>Parent Category</th>
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

                    "order": [[0, 'desc']],
                    "pageLength": 25,
                    "ajax": {
                        "url": "{{route('expenses_categories.fetch')}}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {_token: "{{csrf_token()}}"}
                    },
                    "columns": [
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "parent"},
                        {"data": "options", "orderable": false},
                    ]

                });
            }
            $(document).ready(function () {
                InitTable();
            });

        </script>
@endsection


