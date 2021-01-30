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
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> General Journal</h3>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customize ID</th>
                    <th>V Type</th>
                    <th>V Date</th>
                    <th>Dr</th>
                    <th>Cr</th>
                    <th>Created By</th>

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
                    <th>Dr</th>
                    <th>Cr</th>
                    <th>Created By</th>
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
                    "url": "{{route('journal.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "customize_id"},
                    {"data": "type"},
                    {"data": "date"},
                    {"data": "cr"},
                    {"data": "dr"},
                    {"data": "created_by"},

                ]
            });
        }

        $(document).ready(function () {
            InitTable();
        });
    </script>
    <a href="print.html"
       onclick="window.open('print.html','newwindow','width=300,height=250');return false;"
    >Print</a>
@endsection