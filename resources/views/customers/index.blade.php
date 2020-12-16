@extends('layouts.master')
@section('content')


        <div class="row">
            <div class="col-12">
                <h3 class="pull-left border-bottom pb-1"><i class="fa fa-users"></i> Customers</h3>
                <a href="{{route('customers.create')}}" class="btn btn-sm btn-primary shadow-sm pull-right"><i class="fa fa-plus-circle"></i> Customer</a>
            </div>
            <div class="col-lg-12">
                <table id="example" class="table table-bordered table-hover display nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Registered Name</th>
                        <th>Physical Address</th>
                        <th>Principal Name</th>
                        <th>Principal Phone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-capitalize">
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Registered Name</th>
                        <th>Physical Address</th>
                        <th>Principal Name</th>
                        <th>Principal Phone</th>
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
                        "url": "{{ route('customers.fetch') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data":{ _token: "{{csrf_token()}}"}
                    },
                    "columns": [
                        { "data": "id" },
                        { "data": "name" },
                        { "data": "address" },
                        { "data": "prin_name" },
                        { "data": "prin_phone" },
                        { "data": "options" ,"orderable":false},
                    ]

                });

            }
            $(document).ready(function () {
                InitTable();
            });
        </script>

@endsection