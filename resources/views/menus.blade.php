@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <style>
        label{
            padding: 0;
            margin: 0;
        }
    </style>
<div class="row py-2">
    <div class="col-md-6 col-12 ">
        <h3 class="pull-left font-weight-light"><i class="feather icon-layout"></i> All Menus</h3>
        <a href="{{route('menus.manage')}}" class="btn btn-sm pull-right btn-success shadow-sm">
            <i class="fa fa-sort"></i> Manage Menus</a>
        <button type="button" class="btn btn-sm pull-right btn-primary shadow-sm" data-toggle="modal" data-target="#add_menu"><i class="fa fa-plus-circle"></i> Menu</button>
    </div>
    <div class="col-md-6 col-12">
        <span class="float-right">
            <select class="form-control form-control-sm" id="type" name="type">
                <option selected disabled>Select Type</option>
                <option value="all" selected>All Menus</option>
                <option value="parent">Parent Menu</option>
                <option value="child">Child Menu</option>
                <option value="other">Other Menu</option>
            </select>

        </span>
    </div>

</div>

    <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap bg-white text-dark" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
          <th>Position</th>
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
          <th>Position</th>
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

    function InitTable(type) {
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
                "data":{'type':type, _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "position" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "icon" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable('all');

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
                    $('#edit_position').val(data.position);
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
            var button=$('.menu-save-btn');
            var previous=$('.menu-save-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            $.ajax({
                url: "{{route('menus.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    $('#add_menu').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        $("#example").DataTable().ajax.reload(null,false);
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
        $("#edit_menu_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.menu-update-btn');
            var previous=$('.menu-update-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
            $.ajax({
                url: "{{route('menus.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    $('#edit_menu').modal('hide');
                    swal('success',data.success,'success').then((value) => {
                        $("#example").DataTable().ajax.reload(null,false);
                    });

                },
                error: function(xhr, status, error)
                {
                    button.attr('disabled',null).html(previous);
                    var error;
                    error='';
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
        $('select[name="type"]').on('change', function() {
            var type = $(this).val();
            InitTable(type);
        });

    });

</script>


<div class="modal fade" id="add_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header pb-1">
                <h4 class="font-weight-light"><i class="feather icon-plus-circle"></i> Add Menu</h4>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="feather icon-x-circle"></span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form id="add_menu_form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" placeholder="Slug" autocomplete="off" value="{{old('slug')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="url">Url</label>
                            <input type="text" class="form-control form-control-sm" id="url" name="url" placeholder="Url" autocomplete="off" value="#">
                        </div>

                        <div class="form-group col-12">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control form-control-sm" id="icon" name="icon" placeholder="icon" autocomplete="off" value="{{old('icon')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="position">Position</label>
                            <input type="text" class="form-control form-control-sm" id="position" name="position" placeholder="Position" autocomplete="off" value="{{old('position',0)}}">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="parent">Parent</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control form-control-sm" id="parent" name="parent">
                                    <option selected disabled="">Select Parent</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 form-check text-right mt-2">
                            <div class="checkbox float-right checkbox-fill d-inline">
                                <input type="checkbox" name="has_child" id="has_child">
                                <label class="cr" for="has_child">Has/Is Child</label>
                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button class="btn btn-primary btn-sm menu-save-btn" type="submit"><i class="fa fa-save"></i> Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light pb-1">
                <h4 class='font-weight-light'><i class="feather icon-refresh-cw"></i>  Edit Menu</h4>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="feather icon-x-circle"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_menu_form">
                    @csrf
                    <input type="hidden" value="" id="edit_id" name="id">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" id="edit_name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control form-control-sm" id="edit_slug" name="slug" placeholder="Slug" autocomplete="off" value="{{old('slug')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="url">Url</label>
                            <input type="text" class="form-control form-control-sm" id="edit_url" name="url" placeholder="url" autocomplete="off" value="{{old('url')}}">
                        </div>

                        <div class="form-group col-12">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control form-control-sm" id="edit_icon" name="icon" placeholder="icon" autocomplete="off" value="fa fa-">
                        </div>

                        <div class="form-group col-12">
                            <label for="edit_position">Position</label>
                            <input type="text" class="form-control form-control-sm" id="edit_position" name="position" placeholder="Position" autocomplete="off" value="{{old('position',0)}}">
                        </div>
                        <div class="col-12 mb-1">
                            <label for="parent">Parent</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control form-control-sm" id="edit_parent" name="parent">
                                    <option value="">None</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 form-check text-right mt-2">
                            <div class="checkbox float-right checkbox-fill d-inline">
                                <input type="checkbox" name="has_child" id="edit_has_child">
                                <label class="cr" for="edit_has_child">Has/Is Child</label>
                            </div>

                        </div>

                    </div>
                    </div>

                    <div class="modal-footer bg-light p-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-sm btn-primary menu-update-btn" type="submit"><i class="feather icon-refresh-cw"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


