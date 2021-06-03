@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <style>
            table td {
                word-wrap: break-word;         /* All browsers since IE 5.5+ */
                overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
            }
        </style>
        <div class="col-12">
            <h3 class="pull-left pb-1"><i class="fa fa-list"></i> Log Reviews</h3>
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2 add_logs_btn"><i class="fa fa-plus-circle"></i> Log Reviews</button>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered bg-white table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th style="white-space:normal;word-break: break-all;word-wrap: break-spaces">Description</th>
                    <th>Priority</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Attachment</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Attachment</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
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
                "url": "{{ route('log_reviews.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "description" },
                { "data": "priority" },
                { "data": "created_by" },
                { "data": "status" },
                { "data": "attachment" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }

    $(document).ready(function () {
        InitTable();
        $(document).on('click', '.edit', function() {
            $('#add_logs_form')[0].reset();
            var id = $(this).attr('data-id');
            $('.title-log-review').text('Update Log Reviews');
            $('.log-save-btn').html('<i class="fa fa-save"></i> Update');
            $.ajax({
                "url": "{{route('log_reviews.edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                success: function(data)
                {
                    $('#add_logs').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    let start_d = new Date(data.start);
                    let start_ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(start_d);
                    let start_mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(start_d);
                    let start_da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(start_d);
                    var start=`${start_ye}-${start_mo}-${start_da}`;

                    let end_d = new Date(data.end);
                    let end_ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(end_d);
                    let end_mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(end_d);
                    let end_da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(end_d);
                    var end=`${end_ye}-${end_mo}-${end_da}`;


                    $('#start').val(start);
                    $('#end').val(end);
                    $('#priority').val(data.priority);
                }
            });
        });
        $(document).on('click', '.add_logs_btn', function() {
            $('#add_logs').modal('toggle');
            $('.log-save-btn').html('<i class="fa fa-save"></i> Save');
            $('.title-log-review').text('Add Log Reviews');
        });
        $("#add_logs_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.log-save-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('log_reviews.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_logs').modal('hide');
                        $('#add_logs_form')[0].reset();
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
        $(document).on('click', '.delete', function (e) {
            swal({
                title: "Are you sure to delete this review log?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#form" + id).attr("method");
                        var form_data = $("#form" + id).serialize();

                        $.ajax({
                            url: "{{route('log_reviews.delete')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    InitTable();
                                });

                            },
                            error: function (data) {
                                swal("Failed", data.error, "error");
                            },
                        });

                    }
                });

        });
    });
</script>

<div class="modal fade" id="add_logs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> <span class="title-log-review">Add Log Reviews</span></h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add_logs_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" name="edit_id" id="edit_id">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="start">Start Date</label>
                            <input type="date" class="form-control" id="start" name="start" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="end">End Date</label>
                            <input type="date" class="form-control" id="end" name="end" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" name="priority">
                                <option selected disabled>--Select Priority</option>
                                <option value="1">↑ High</option>
                                <option value="0">↓ Low</option>
                            </select>

                        </div>
                        <div class="form-group col-12">
                            <label for="assign_to">Assign To</label>
                            <select class="form-control" id="assign_to" name="assign_to">
                                <option selected disabled>--Select Assignee</option>
                                <option value="19" selected>{{\App\Models\User::find(19)->fname.' '.\App\Models\User::find(19)->lname}}</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="attachment">Attachment</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="attachment" id="attachment">
                                <label class="custom-file-label" for="attachment">Attachment</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm log-save-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection


