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
        <th>Created By</th>
          <th>Status</th>
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
          <th>Created By</th>
          <th>Status</th>
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
                "url": "{{ route('log_reviews.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "description" },
                { "data": "priority" },
                { "data": "created_by" },
                { "data": "status" },
                { "data": "attachment" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
        $(document).on('click', '.edit', function() {
            $('#add_logs_form')[0].reset();
            var id = $(this).attr('data-id');
            $('.title-log-review').text('Update Log Reviews');
            $('.log-save-btn').html('<i class="fa fa-save"></i> Update');
            $.ajax({
                "url": "{{route('log_reviews.edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                success: function(data)
                {
                    $('#add_logs').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    $('#start').val(data.start);
                    $('#end').val(data.end);
                    $('#priority').val(data.priority);
                }
            });
        });


    });

</script>
<div class="modal fade" id="add_logs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> <span class="title-log-review">Add Log Reviews</span></h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add_logs_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" name="edit_id" id="edit_id">
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
                                <option value="1">↑ High</option>
                                <option value="0">↓ Low</option>
                            </select>

                        </div>
                        <div class="form-group col-12">
                            <label for="attachment">Attachment</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="attachment" id="attachment">
                                <label class="custom-file-label" for="attachment">Attachment</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm log-save-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add_logs_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.log-save-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('log_reviews.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_logs_form').modal('hide');
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
        $(document).on('click', '.delete', function (e) {
            swal({
                title: "Are you sure to delete this review log?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#form" + id).attr("method");
                        var form_data = $("#form" + id).serialize();

                        $.ajax({
                            url: "{{route('log_reviews.delete')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    InitTable();
                                });

                            },
                            error: function (data) {
                                swal("Failed", data.error, "error");
                            },
                        });

                    }
                });

        });

    });
</script>
@endsection


