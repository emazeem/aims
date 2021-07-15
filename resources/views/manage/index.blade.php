@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
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
            <h3 class="float-left font-weight-light"><i class="feather icon-list"></i> Manage Jobs</h3>
            <div class="form-check form-check-inline col-3 p-0 m-0 float-right mb-2">
                <select class="form-control" id="search" name="search">
                    <option value="incomplete">Quotes having Pending Items</option>
                    <option value="complete">Closed Quotes & its Closed Jobs</option>
                    <option value="all">All Quotes</option>
                </select>
            </div>

        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Turnaround</th>
                    <th>Items (Q/J)</th>
                    <th>Jobs</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Turnaround</th>
                    <th>Items (Q/J)</th>
                    <th>Jobs</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>

        function InitTable(search) {
            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('jobs.manage.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {search:search,_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "customer"},
                    {"data": "turnaround"},
                    {"data": "total"},
                    {"data": "jobs"},
                    {"data": "type"},
                    {"data": "options", "orderable": false},
                ]
            });
        }

        $(document).ready(function () {
            InitTable('incomplete');
            $('select[name="search"]').on('change', function() {
                var search = $(this).val();
                InitTable(search);
            });
        });
    </script>
@endsection