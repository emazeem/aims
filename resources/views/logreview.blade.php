@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-list"></i> Log Reviews</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2" data-toggle="modal" data-target="#add_logs"><i class="fa fa-plus-circle"></i> Log Reviews</button>
    </div>
  <div class="col-lg-12">
    <table id="example" class="table table-bordered bg-white table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Created By</th>
        <th>Attachment</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Created By</th>
          <th>Attachment</th>
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
                "url": "{{ route('designations.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "description" },
                { "data": "priority" },
                { "data": "status" },
                { "data": "created_by" },
                { "data": "options" ,"orderable":false},
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
                success: function(data)
                {
                    $('#edit_designation').modal('toggle');
                    $('#editid').val(data.id);
                    $('#edit_department').val(data.department_id);
                    $('#editname').val(data.name);
                }
            });
        });
        $("#add_designation_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$(this).find('input[type="submit"],button');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('designations.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_designation').modal('hide');
                        InitTable();
                    });

                },
                error: function(xhr)
                {
                    button.attr('disabled',null).html(previous);
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
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
                error: function(xhr)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));

    });

</script>
<div class="modal fade" id="add_logs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Log Reviews</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add_designation_form">
                    @csrf
                    <div class="row">

                        <div class="form-group col-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="start">Start Date</label>
                            <input type="date" class="form-control" id="start" name="start">
                        </div>
                        <div class="form-group col-12">
                            <label for="end">End Date</label>
                            <input type="date" class="form-control" id="end" name="end">
                        </div>
                        <div class="form-group col-12">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" name="priority">
                                <option selected disabled>--Select Priority</option>
                                <option value="1"><i class="fa fa-arrow-up"></i>High</option>
                                <option value="0"><i class="fa fa-arrow-down"></i>Low</option>
                            </select>

                        </div>


                        <div class="col-12 text-right">
                            <button class="btn btn-primary " type="submit">Save</button>
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


