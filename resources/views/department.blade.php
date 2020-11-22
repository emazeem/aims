@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">All Departments</h1>
  <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_department"><i class="fas fa-plus"></i> Department</button>
</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
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
          <th>Name</th>
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
                "url": "{{ route('departments.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "createdat" },
                { "data": "updatedat" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/departments/edit')}}",
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
                    $('#edit_department').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
            });
        });


        $("#add_department_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('departments.store')}}",
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
                        swal("Success", "Department added successfully", "success");
                        InitTable();
                        location.reload();
                    }
                },
                error: function()
                {
                    swal("Failed", "Fields Required. Try again.", "error");
                }
            });
        }));
        $("#edit_department_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('departments.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    if(!data.errors)
                    {
                        $('#edit_department').modal('toggle');
                        swal("Success", "Department updated successfully", "success");
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


<div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add department</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_department_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit department</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_department_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@endsection


