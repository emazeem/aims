@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">

        <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> All SOP's</h3>
        <a class="btn btn-success btn-sm" href="{{url('sop/master_list_of_documents')}}">Master list of Documents</a>
        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_sop"><i
                    class="fa fa-plus-circle"></i> SOP
        </button>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
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
                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('sops.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/sop/edit')}}",
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
                        $('#edit_sop').modal('toggle');
                        $('#editid').val(data.id);
                        $('#editname').val(data.name);
                        //Populating Form Data to Edit Ends
                    },
                    error: function () {
                    },
                });
            });


            $("#add_sop_form").on('submit', (function (e) {

                e.preventDefault();
                $.ajax({
                    url: "{{route('sops.store')}}",
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
                            $('#add_sop').modal('hide');
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
            $("#edit_sop_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('sops.update')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        swal('success', data.success, 'success').then((value) => {
                            $('#edit_sop').modal('hide');
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
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this SOP?",
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
                                url: "{{url('sop/delete')}}",
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


    <div class="modal fade" id="add_sop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
    <div class="modal fade" id="edit_sop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Edit SOP</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_sop_form">
                        @csrf
                        <input class="form-control" id="editid" name="id" value="" type="hidden">
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

@endsection


