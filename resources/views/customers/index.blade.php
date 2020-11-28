@extends('layouts.master')
@section('content')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="border-bottom text-dark">Customer Details</h2>
            <a href="{{route('customers.create')}}" class="mt-2 btn btn-sm float-right btn-primary shadow-sm"><i class="fas fa-plus"></i> Customer</a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
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