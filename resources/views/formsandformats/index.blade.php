@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">

    <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All Forms and Formats</h3>
    <a href="{{route('forms.create')}}" class="btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle"></i> Form & Format</a>
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


<div class="modal fade" id="add_sop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add SOP</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_sop_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <input class="form-control" id="name" name="name" placeholder="Title of SOP">
                        </div>
                        <div class="form-group col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file">
                                    <label class="custom-file-label" for="file">Upload Document</label>
                                </div>
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

<div class="modal fade" id="edit_sop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit SOP</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_sop_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="form-group col-12  float-left">
                        <input class="form-control" id="name" name="name" placeholder="Title of SOP">
                    </div>
                    <div class="form-group col-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file">
                            <label class="custom-file-label" for="file">Upload Document</label>
                        </div>
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
@endsection


