@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">

        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-list"></i> All Designations</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus-circle"></i> Designation</button>
    </div>
  <div class="col-lg-12">
    <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Department</th>
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
                "url": "{{ route('designations.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "department_id" },
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
            var self=$(this), button=self.find('input[type="submit"],button');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
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
                error: function(e)
                {
                    swal("Failed", "Fields Required. Try again.", "error");

                }
            });
        }));

    });

</script>
<div class="modal fade" id="add_designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Designation</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_designation_form">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="department" name="department">
                                    <option selected disabled="">Select department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
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

<div class="modal fade" id="edit_designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-pencil"></i>  Edit Designation</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_designation_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_department" name="department">
                                    <option selected disabled="">Select department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3  float-left">
                            <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="col-6">
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


