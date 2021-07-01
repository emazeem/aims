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
            <h3 class="font-weight-light float-left"><i class="feather icon-list"></i> All Jobs</h3>
            <div class="form-check form-check-inline float-right mb-2">
                <label for="search"></label>
                <select class="form-control" id="search" name="search">
                    <option value="pending">Pending Jobs</option>
                    <option value="completed">Completed Jobs</option>
                    <option value="all">All Jobs</option>
                </select>
            </div>

        </div>
        <div class="col-12">
        <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Quote ID</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Quote ID</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Status</th>
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
                    "url": "{{ route('jobs.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {'search':search,_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "quote"},
                    {"data": "customer"},
                    {"data": "type"},
                    {"data": "status"},
                    {"data": "options", "orderable": false},
                ]

            });

        }
        $(document).ready(function () {
            InitTable('pending');
            $('select[name="search"]').on('change', function() {
                var search = $(this).val();
                InitTable(search);
            });
        });
    </script>

@endsection