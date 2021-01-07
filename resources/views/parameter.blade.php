@extends('layouts.master')
@section('content')
    <div class="row">
    <div class="col-12">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> All Parameters</h3>
        <span class="pull-right">
    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_parameter"><i class="fa fa-plus-circle"></i> Parameter</button>

        </span>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table bg-white table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Parent</th>
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
                "url": "{{ route('parameters.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "parent" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/parameters/edit')}}",
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
                    $('#edit_parameter').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);
                    $('#editparent').val(data.parent);
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
            });
        });
        $(document).on('click', '.view-assets', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('/parameters/view_assets')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                beforeSend : function()
                {
                    $(".loader").fadeIn();
                },
                statusCode: {
                    403: function() {
                        $(".loader").fadeOut();
                        swal("Failed", "Permission deneid for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $(".loader").fadeOut();
                    $('#assets-table').empty();
                    $('#view_assets').modal('toggle');
                    $.each(data,function(index,item){
                        $('#assets-table').append(
                            "<tr>" +
                            "<td>" + item.name + "</td>" +
                            "<td>" + item.code + "</td>" +
                            "</tr>"
                        );
                    });
                },
                error: function(){},
            });
        });

        $(document).on('click', '.view-capabilities', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/parameters/view_capabilities')}}",
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
                    $('#capabilities-table').empty();
                    $('#view_capabilities').modal('toggle');
                    $.each(data,function(index,item){
                        $('#capabilities-table').append(
                            "<tr>" +
                            "<td>" + item.name + "</td>" +
                            "<td>" + item.range + "</td>" +
                            "<td>" + item.accuracy + "</td>" +
                            "<td>" + item.price + "</td>" +
                            "</tr>"
                        );
                    });
                },
                error: function(){},
            });
        });




        $("#add_parameter_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('parameters.store')}}",
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
                        $('#add_parameter').modal('toggle');
                        swal("Success", "Parameter added successfully", "success");
                        InitTable();
                    }
                },
                error: function()
                {
                    swal("Failed", "Fields Required. Try again.", "error");
                }
            });
        }));
        $("#edit_parameter_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('parameters.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {

                    if(!data.errors)
                    {
                        $('#edit_parameter').modal('toggle');
                        swal("Success", "Parameter updated successfully", "success");
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


<div class="modal fade" id="add_parameter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Parameter</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_parameter_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>

                        <div class="col-9">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="parent" name="parent" >
                                    <option disabled selected>Select Parent (if any)</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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

<div class="modal fade" id="edit_parameter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-pencil"></i> Edit Parameter</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_parameter_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>

                        <div class="col-9">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="editparent" name="parent" >
                                    <option disabled selected>Select Parent (if any)</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
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

<div class="modal fade" id="view_assets" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-tasks"></i> Assets List</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="assets-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-tasks"></i> Capabilities List</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="capabilities-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Range</th>
                        <th>Accuracy</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



@endsection


