@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-light"><i class="feather icon-list"></i> Site Tasks</h4>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Job</th>
                    <th>Customer</th>
                    <th>UUC</th>
                    <th>Model</th>
                    <th>Eq ID</th>
                    <th>Status</th>
                    <th>Asset</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Job</th>
                    <th>Customer</th>
                    <th>UUC</th>
                    <th>Model</th>
                    <th>Eq ID</th>
                    <th>Status</th>
                    <th>Asset</th>
                    <th>Date</th>
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

                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('site.task.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "job" },
                    { "data": "customer" },
                    { "data": "uuc" },
                    { "data": "model" },
                    { "data": "eqid" },
                    { "data": "status" },
                    { "data": "asset" },
                    { "data": "date" },
                    { "data": "options" ,"orderable":false},
                ]

            });
        }
        $(document).ready(function() {
            InitTable();
        });
    </script>

@endsection


