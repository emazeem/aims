@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif

    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
            <h6 class="text-dark"><i class="fa fa-file-text-o"></i> {{$show->name}}</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_sop"><i
                        class="fa fa-plus-circle"></i> SOP Details
            </button>
        </div>
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered">
                <tr>
                    <th>Issue #</th>
                    <th>Revision #</th>
                    <th>Doc #</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
                @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->issue_no}}</td>
                        <td>{{$detail->rev_no}}</td>
                        <td>{{$detail->doc_no}}</td>
                        <td>{{$detail->file}}
                            <a href="{{Storage::disk('local')->url('SOPS/'.$show->name.'/'.$detail->file)}}" download
                               class="btn border px-2 p-0 m-0 pull-right">
                                <small>Download <i class="fa fa-download"></i></small>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary edit shadow-sm" data-id="{{$detail->id}}"><i class="fa fa-pencil"></i></button>
                            <a class='btn btn-danger btn-sm delete' href='#' data-id='{{$detail->id}}'><i class='fa fa-trash-o'></i></a>
                            <form id="form{{$detail->id}}" method='post' role='form'>
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                <input name="id" type="hidden" value='{{$detail->id}}'>
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="modal fade" id="add_sop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add SOP Details</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add_sop_form">
                            @csrf
                            <input class="form-control" id="id" name="id" value="{{$show->id}}" type="hidden">
                            <div class="form-group row">
                                <label for="issue" class="col-sm-2 control-label">Issue #</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline" style="width: 100%">
                                        <select class="form-control" id="issue" name="issue">
                                            <option selected disabled="">Select Issue #</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="revision" class="col-sm-2 control-label">Revision #</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline" style="width: 100%">
                                        <select class="form-control" id="revision" name="revision">
                                            <option selected disabled="">Select Revision #</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doc" class="col-sm-2 control-label">Doc #</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="doc" name="doc" placeholder="Doc #">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file">
                                    <label class="custom-file-label" for="file">Upload File</label>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Edit SOP Details</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit_sop_form">
                            @csrf
                            <input class="form-control" id="editid" name="detail_id" value="{{$show->id}}" type="hidden">
                            <div class="form-group row">
                                <label for="editissue" class="col-sm-2 control-label">Issue #</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline" style="width: 100%">
                                        <select class="form-control" id="editissue" name="issue">
                                            <option selected disabled="">Select Issue #</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editrevision" class="col-sm-2 control-label">Revision #</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline" style="width: 100%">
                                        <select class="form-control" id="editrevision" name="revision">
                                            <option selected disabled="">Select Revision #</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="editdoc" class="col-sm-2 control-label">Doc #</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="editdoc" name="doc" placeholder="Doc #">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file">
                                    <label class="custom-file-label" for="file">Upload File</label>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function(){
            $("#add_sop_form").on('submit',(function(e) {

                e.preventDefault();
                $.ajax({
                    url: "{{route('sops.store')}}",
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
                            $('#add_sop').modal('hide');
                            location.reload();
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
            $("#edit_sop_form").on('submit',(function(e) {

                e.preventDefault();
                $.ajax({
                    url: "{{route('sops.update')}}",
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
                            $('#add_sop').modal('hide');
                            location.reload();
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
                        $('#editdoc').val(data.doc_no);
                        $('#editissue').val(data.issue_no);
                        $('#editrevision').val(data.rev_no);
                        //Populating Form Data to Edit Ends
                    },
                    error: function () {
                    },
                });
            });
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this document?",
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
@endsection