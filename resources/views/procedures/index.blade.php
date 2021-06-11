@extends('layouts.master')
@section('content')

    <script src="{{url('/assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="text-dark float-left font-weight-light"><i class="feather icon-activity"></i> All Procedures</h3>
            <a href="{{route('procedures.create')}}" class="btn btn-sm btn-primary shadow-sm float-right mt-2"><i class="fa fa-plus"></i> Procedures</a>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Uncertainties</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
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
                    { "data": "name" },
                    { "data": "description" },
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


