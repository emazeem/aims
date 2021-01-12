@extends('layouts.master')
@section('content')
        <div class="row">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> All Requisitions</h3>
            <a href="{{route('requisition.create')}}" class="btn btn-primary pull-right btn-sm">
                <span class="fa fa-plus-circle"></span> Add Requisitions
            </a>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Reason</th>
                    <th>Requisition Designation</th>
                    <th>Qualification</th>
                    <th>Time Frame</th>
                    <th>HRD Review</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Reason</th>
                    <th>Requisition Designation</th>
                    <th>Qualification</th>
                    <th>Time Frame</th>
                    <th>HRD Review</th>
                    <th>Remarks</th>
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
                    "url": "{{route('requisition.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "reason"},
                    {"data": "designation"},
                    {"data": "qualification"},
                    {"data": "time_frame"},
                    {"data": "hrd_review"},
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