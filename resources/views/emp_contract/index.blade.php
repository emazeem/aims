@extends('layouts.master')
@section('content')
        <div class="row">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> All Employee Contract</h3>
            <a href="{{route('emp_contract.create')}}" class="btn btn-primary pull-right btn-sm">
                <span class="fa fa-plus-circle"></span> Add Employee Contract
            </a>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>Commencement</th>
                    <th>Place of Work</th>
                    <th>Probation Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>Commencement</th>
                    <th>Place of Work</th>
                    <th>Probation Period</th>
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
                    "url": "{{route('emp_contract.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "cnic"},
                    {"data": "designations"},
                    {"data": "commencement"},
                    {"data": "place_of_work"},
                    {"data": "probation_period"},
                    {"data": "options", "orderable": false},
                ]
            });
        }
        $(document).ready(function () {
            InitTable();
        });
    </script>
@endsection