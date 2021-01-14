@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">

</div>

<div class="row">
    <div class="col-12">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-list"></i> All Departments</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus-circle"></i> Department</button>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Department Name</th>
        <th>Department Head</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Department Name</th>
          <th>Department Head</th>
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
                "url": "{{ route('departments.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "head" },
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
                    $('#edithead').val(data.head);
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
                    swal('success',data.success,'success').then((value) => {
                        $('#add_department').modal('hide');
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
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Department</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_department_form">
                    @csrf
                    <div class="row">

                        <div class="form-group col-12  float-left">
                            <label for="name">Name of Department</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Department" autocomplete="off" value="{{old('name')}}">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="head">Head of Department</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="head" name="head">
                                    <option selected disabled="">Select Head of Department</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-pencil"></i> Edit Department</h5>
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
                            <label for="name">Name of Department</label>
                            <input type="text" class="form-control" id="editname" name="name" placeholder="Enter Name of Department" autocomplete="off" value="{{old('name')}}">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="edithead">Head of Department</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edithead" name="head">
                                    <option selected disabled="">Select Head of Department</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
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


