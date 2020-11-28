@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="border-bottom text-dark">All Columns</h2>

    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_column"><i class="fas fa-plus"></i> Add Specific Column</button>

</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Column</th>
        <th>Assets</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Column</th>
          <th>Assets</th>
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
                "url": "{{ route('columns.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "column" },
                { "data": "assets" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
</script>
<script>
    $(document).ready(function() {
        InitTable();
        $("#add_columns_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('columns.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                statusCode: {
                    403: function() {
                        swal("Failed", "Access Denied" , "error");
                        return false;
                    }
                },
                success: function(data)
                {

                    $('#add_column').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {

                    var error;
                    error=null;
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }

            });
        }));
        $("#edit_columns_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('columns.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                statusCode: {
                    403: function() {
                        swal("Failed", "Access Denied" , "error");
                        return false;
                    }
                },
                success: function(data)
                {

                    $('#edit_column').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {

                    var error;
                    error=null;
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }

            });
        }));

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('/columns/edit')}}",
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
                        swal("Failed", "Permission denied for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_column').modal('toggle');
                    $('#edit-id').val(data.id);
                    $('#edit-column').val(data.column);
                },
                error: function(){},
            });
        });

    });
</script>
<div class="modal fade" id="add_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Column</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_columns_form">
                    @csrf
                    <input type="hidden" value="" name="procedure">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="assets" name="assets[]" style="width: 100%" multiple>
                            @foreach($assets as $asset)
                                <option value="{{$asset->id}}">{{$asset->name}} {{$asset->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-10">
                            <input type="text" class="form-control" id="column" name="column" placeholder="Column" autocomplete="off" value="">
                        </div>
                        <div class="col-2">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('#assets').select2({
        placeholder: 'Select an option'
    });


</script>

@endsection


