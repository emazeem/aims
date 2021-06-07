@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom text-dark pull-left"><i class="fa fa-tasks"></i> All Leave Applications</h3>
            <span class="text-right">
            <a href="{{route('leave_application.create')}}" class="btn btn-sm pull-right btn-primary shadow-sm" ><i class="fa fa-plus-circle"></i> Leave Application</a>
        </span>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Nature of Leave</th>
                    <th>Type of Leave</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Nature of Leave</th>
                    <th>Type of Leave</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
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
                    "url": "{{ route('leave_application.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "nature"},
                    {"data": "type"},
                    {"data": "from"},
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


