@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="font-weight-light float-left"><i class="feather icon-list"></i> My Leave Applications</h3>
            <div class="form-check form-check-inline float-right">
                <label for="search"></label>
                <select class="form-control form-control-sm" id="search" name="search">
                    <option value="my">My Leaves</option>
                    @can('all-leave-applications')
                        <option value="all">All Leaves</option>
                    @endcan
                </select>
            </div>
            <a href="{{route('leave_application.create')}}" class="btn btn-sm float-right rounded btn-primary shadow-sm mr-2"><i
                        class="feather icon-plus-circle"></i> Leave Application</a>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white" width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Nature of Leave</th>
                    <th>Type of Leave</th>
                    <th>From-To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Nature of Leave</th>
                    <th>Type of Leave</th>
                    <th>From-To</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>
        function InitTable(filter) {
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
                    "data": {'filter':filter,_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "name"},
                    {"data": "nature"},
                    {"data": "type"},
                    {"data": "from-to"},
                    {"data": "options", "orderable": false},
                ]
            });
        }
        $(document).ready(function () {
            InitTable('my');
            $('select[name="search"]').on('change', function() {
                var search = $(this).val();
                InitTable(search);
            });
        });
    </script>
@endsection


