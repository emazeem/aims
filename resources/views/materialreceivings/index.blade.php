@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left pb-1"><i class="fa fa-tasks"></i> All Purchase Orders</h3>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>PO #</th>
                    <th>Indent ID</th>
                    <th>Date</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>

                    <th>PO #</th>
                    <th>Indent ID</th>
                    <th>Date</th>
                    <th>Created By</th>
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

                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('material.receiving.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "indent_id" },
                    { "data": "date" },
                    { "data": "created_by" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {
            InitTable();
        });
    </script>
@endsection


