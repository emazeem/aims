@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">

</div>

<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-list"></i> All Business Line</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus-circle"></i> Business Line</button>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Title</th>
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
                "url": "{{ route('business.line.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/business-lines/edit')}}",
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
                    $('#editname').val(data.title);
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
            });
        });


        $("#add_department_form").on('submit',(function(e) {
            e.preventDefault();
            $('button').attr('disabled',true);
            $.ajax({
                url: "{{route('business.line.store')}}",
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
                    $('button').attr('disabled',false);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_department').modal('hide');
                        InitTable();
                    });

                },
                error: function(xhr)
                {
                    $('button').attr('disabled',false);
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_department_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('business.line.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    swal('success',data.success,'success').then((value) => {
                        $('#edit_department').modal('hide');
                        InitTable();
                    });

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


<div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Business Line</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_department_form">
                    @csrf
                    <div class="row">

                        <div class="form-group col-12  float-left">
                            <label for="name">Name of Business Line</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Business Line" autocomplete="off" value="{{old('name')}}">
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer bg-light p-2">
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-pencil"></i> Edit Business Line</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>

                </button>
            </div>
            <div class="modal-body">
                <form id="edit_department_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">

                        <div class="form-group col-12  float-left">
                            <label for="name">Name of Business Line</label>
                            <input type="text" class="form-control" id="editname" name="name" placeholder="Enter Name of Business Line" autocomplete="off" value="{{old('name')}}">
                        </div>

                    </div>
                    </div>
                    <div class="modal-footer p-2 bg-light">
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-refresh"></i> Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection


