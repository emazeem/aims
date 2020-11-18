@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Procedures</h1>
        <a href="{{route('procedures.create')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Procedures</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Uncertainties</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Uncertainties</th>
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
                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('procedures.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "uncertainties" },
                    { "data": "options" ,"orderable":false},
                ]

            });
        }
        $(document).ready(function() {
            InitTable();
        });

    </script>

@endsection


