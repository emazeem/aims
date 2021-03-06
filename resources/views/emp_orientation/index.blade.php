@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>

    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom text-dark pull-left"><i class="fa fa-tasks"></i> All Employee Orientations</h3>
            <span class="text-right">
            <a href="{{route('emp_orientation.create')}}" class="btn btn-sm pull-right btn-primary shadow-sm" ><i class="fa fa-plus-circle"></i> Orientation</a>
        </span>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Lab Incharge</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Lab Incharge</th>
                    <th>Remarks</th>
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
                    "url": "{{ route('emp_orientation.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "designation"},
                    {"data": "incharge"},
                    {"data": "remarks"},
                    {"data": "options", "orderable": false},
                ]

            });
        }
        $(document).ready(function () {
            InitTable();

        });

    </script>
@endsection


