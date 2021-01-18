@extends('layouts.master')
@section('content')
    <style>
        label{
            padding: 0;
            margin: 0;
        }
    </style>
<div class="row">
    <div class="col-12">
        <h3 class="border-bottom text-dark pull-left"><i class="fa fa-tasks"></i> All Menus</h3>
        <span class="text-right">
        <a href="{{route('menus.manage')}}" class="btn btn-sm pull-right btn-success shadow-sm"><i class="fa fa-sort"></i> Manage Menus</a>
        <button type="button" class="btn btn-sm pull-right btn-primary shadow-sm" data-toggle="modal" data-target="#add_menu"><i class="fa fa-plus-circle"></i> Menu</button>
    </span>
    </div>
    <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Icon</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Icon</th>
          <th>Status</th>
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
                "url": "{{ route('menus.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "icon" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/menus/edit')}}",
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
                    $('#edit_menu').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_slug').val(data.slug);
                    $('#edit_icon').val(data.icon);
                    $('#edit_url').val(data.url);
                    if (data.parent_id){
                        $('#edit_parent').val(data.parent_id);
                    }
                    if(data.has_child==1){
                        $("#edit_has_child").prop('checked', true);
                    }else {
                        $("#edit_has_child").prop('checked', false);
                    }
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
            });
        });


        $("#add_menu_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('menus.store')}}",
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
                        $('#add_menu').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            InitTable();
                        });

                    }
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
        $("#edit_menu_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('menus.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#edit_menu').modal('hide');
                    swal('success',data.success,'success').then((value) => {
                        InitTable();
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

        $(document).on('click', '.delete', function(e)
        {
            swal({
                title: "Are you sure to delete this menu?",
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
                            url: "{{url('menus/delete')}}",
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

                    }
                });

        });
    });

</script>


<div class="modal fade" id="add_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header pt-2 pb-0">
                <h4><i class="fa fa-plus-circle"></i> Add Menu</h4>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form id="add_menu_form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" autocomplete="off" value="{{old('slug')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Url" autocomplete="off" value="#">
                        </div>

                        <div class="form-group col-12">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="icon" autocomplete="off" value="{{old('icon')}}">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="parent">Parent</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="parent" name="parent">
                                    <option selected disabled="">Select Parent</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 form-check text-right mt-2">
                            <div class="btn btn-sm btn-success px-5">
                                    <label class="form-check-label" for="has_child">
                                        <input type="checkbox" class="form-check-input"  name="has_child" id="has_child">

                                        Has/Is Child
                                    </label>
                                </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light pt-2 pb-0">
                <h4 class="text-dark"><i class="fa fa-refresh"></i>  Edit Menu</h4>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_menu_form">
                    @csrf
                    <input type="hidden" value="" id="edit_id" name="id">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="edit_slug" name="slug" placeholder="Slug" autocomplete="off" value="{{old('slug')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="edit_url" name="url" placeholder="url" autocomplete="off" value="{{old('url')}}">
                        </div>

                        <div class="form-group col-12">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" id="edit_icon" name="icon" placeholder="icon" autocomplete="off" value="fa fa-">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="parent">Parent</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_parent" name="parent">
                                    <option value="">None</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 form-check text-right mt-2">
                            <div class="btn btn-sm btn-success px-5">
                                <label class="form-check-label" for="has_child">
                                    <input type="checkbox" class="form-check-input"  name="has_child" id="edit_has_child">
                                    Has/Is Child
                                </label>
                            </div>
                        </div>

                    </div>
                    </div>

                    <div class="modal-footer bg-light p-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-refresh"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


