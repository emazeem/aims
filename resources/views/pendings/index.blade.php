@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">

        <div class="col-12">
            <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All Pending Reviews</h3>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
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
                    "url": "{{ route('pendings.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "quotes" },
                    { "data": "customer" },
                    { "data": "not_available" },
                    { "data": "createdat" },
                    { "data": "updatedat" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {

            InitTable();
            $(document).on('click', '.nofacility', function(e)
            {
                swal({
                    title: "Are you sure that you have no facility of this quote?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#form"+id).attr("method");
                            var form_data = $("#form"+id).serialize();

                            $.ajax({
                                url: "{{url('items/nofacility')}}/"+id,
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal("Success", "Sent with no facility.", "success");
                                    InitTable();
                                },
                                error: function(){
                                    swal("Failed", "Try again later." , "error");
                                },
                            });

                        }
                    });

            });



        } );
    </script>

@endsection


