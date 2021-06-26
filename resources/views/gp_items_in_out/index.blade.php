@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light pb-1"><i class="feather icon-list"></i> Gate Pass Items IN/OUT</h3>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered bg-white table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Job</th>
                    <th>Customer</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Job</th>
                    <th>Customer</th>
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
                "ajax":{
                    "url": "{{ route('gp.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "job" },
                    { "data": "customer" },
                    { "data": "options" ,"orderable":false},
                ]

            });
        }
        $(document).ready(function() {
            InitTable();
        });
    </script>
@endsection


