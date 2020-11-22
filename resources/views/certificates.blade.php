@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">All Certificates</h1>
</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>Certificate #</th>
        <th>Quote</th>
        <th>Customer</th>
        <th>Job</th>
        <th>Equipment ID</th>
        <th>Model</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>Certificate #</th>
          <th>Quote</th>
          <th>Customer</th>
          <th>Job</th>
          <th>Equipment ID</th>
          <th>Model</th>
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
                "url": "{{ route('certificates.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "quote" },
                { "data": "customer" },
                { "data": "job" },
                { "data": "eq_id" },
                { "data": "model" },
            ]
        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/designations/edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                beforeSend : function()
                {
                    $(".loading").fadeIn();
                },
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Permission deneid for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_designation').modal('toggle');
                    $('#editid').val(data.id);
                    $('#edit_department').val(data.department_id);
                    $('#editname').val(data.name);
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
            });
        });


        $("#add_designation_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('designations.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied" , "error");
                        return false;
                    }
                },
                success: function(data)
                {

                    if(!data.errors)
                    {
                        //$('#add_designation').modal('toggle');
                        swal("Success", "designation added successfully", "success");
                        location.reload();
                        InitTable();
                    }
                },
                error: function()
                {
                    swal("Failed", "Fields Required. Try again.", "error");
                }
            });
        }));
        $("#edit_designation_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('designations.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    if(!data.errors)
                    {
                        $('#edit_designation').modal('toggle');
                        swal("Success", "designation updated successfully", "success");
                        InitTable();
                    }
                },
                error: function(e)
                {
                    swal("Failed", "Fields Required. Try again.", "error");

                }
            });
        }));

    });

</script>

@endsection


