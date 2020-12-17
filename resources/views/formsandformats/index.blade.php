@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">

    <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All Forms and Formats</h3>
    <a data-toggle="modal" data-target="#add_form" href="#" class="btn btn-sm btn-primary shadow-sm" ><i class="fa fa-plus-circle"></i> Form & Format</a>
</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
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
                "url": "{{ route('forms.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function () {
        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('/forms/edit')}}",
                type: "POST",
                data: {'id': id, _token: '{{csrf_token()}}'},
                dataType: "json",
                beforeSend: function () {
                    $(".loading").fadeIn();
                },
                statusCode: {
                    403: function () {
                        $(".loading").fadeOut();
                        swal("Failed", "Permission deneid for this action.", "error");
                        return false;
                    }
                },
                success: function (data) {
                    $('#edit_form').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);

                    $('#editsops').val(data.sops );
                    //Populating Form Data to Edit Ends
                },
                error: function () {
                },
            });
        });


        $("#add_form_form").on('submit', (function (e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('forms.store')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                statusCode: {
                    403: function () {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied", "error");
                        return false;
                    }
                },
                success: function (data) {
                    swal('success', data.success, 'success').then((value) => {
                        $('#add_form').modal('hide');
                        InitTable();
                    });

                },
                error: function (xhr) {
                    var error = '';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error += item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_form_form").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('forms.update')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    swal('success', data.success, 'success').then((value) => {
                        $('#edit_form').modal('hide');
                        InitTable();
                    });

                },
                error: function (xhr) {
                    var error = '';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error += item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        InitTable();
        $(document).on('click', '.delete', function(e)
        {
            swal({
                title: "Are you sure to delete this Forms&Formats?",
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
                            url: "{{url('forms/destroy')}}",
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
                            error: function(data){
                                swal("Failed", data.error , "error");
                            },
                        });

                    }
                });
        });
    });

</script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<div class="modal fade" id="add_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Forms & Formats</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form_form">
                    @csrf
                    <div class="row pb-2">
                        <label for="sops" class="control-label">SOP's</label>
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="sops" name="sops[]" multiple style="width: 100%">
                                    @foreach($sops as $sop)
                                        <option value="{{$sop->id}}">{{$sop->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="name" class="control-label">Name</label>
                        <div class="form-group col-12  float-left">
                            <input class="form-control" id="name" name="name" placeholder="Name of SOP Document">
                        </div>
                        <div class="col-12 text-right">
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
<div class="modal fade" id="edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Edit Forms&Formats</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form_form">
                    @csrf
                    <input class="form-control" id="editid" name="id" value="" type="hidden">
                    <div class="row pb-2">
                        <label for="sops" class="control-label">SOP's</label>
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="editsops" name="sops[]" multiple style="width: 100%">
                                    @foreach($sops as $sop)
                                        <option value="{{$sop->id}}">{{$sop->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <input class="form-control" id="editname" name="name" placeholder="Name of SOP Document">
                        </div>
                        <div class="col-12 text-right">
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
<script>
    $('#sops').select2({
        placeholder: 'Select / Search SOP\'s'
    });
    $('#editsops').select2({
        placeholder: 'Select / Search SOP\'s'
    });

</script>
@endsection


