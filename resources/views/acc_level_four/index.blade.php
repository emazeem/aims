@extends('layouts.master')
@section('content')
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
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> Chart of Account</h3>
            <div class="text-right mt-2">
                <a class="btn btn-success btn-sm" href="{{route('acc_level_one')}}">Level One</a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_two')}}">Level Two</a>
                <a class="btn btn-info btn-sm" href="{{route('acc_level_three')}}">Level Three</a>
                <a class="btn btn-primary btn-sm" href="{{route('acc_level_four.create')}}"> <i class="fa fa-plus-circle"></i> Add Levels</a>
            </div>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Account Code</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Account Code</th>
                    <th>Title</th>
                    <th>Parent</th>
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
                    "url": "{{route('acc_level_four.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "acc_code"},
                    {"data": "title"},
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