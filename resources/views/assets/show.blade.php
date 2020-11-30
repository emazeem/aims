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
            $( document ).ready(function() {
                swal("Failed", "{{session('failed')}}", "error");
            });

        </script>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">{{$show->name}} <small>[  {{$show->code}} ]</small></h2>

        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_specification"><i class="fas fa-plus"></i> Add Specifications</button>

    </div>

    <div class="row pb-3">
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered">

                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Range</th>
                    <td>{{$show->range}}</td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td>{{$show->code}}</td>
                </tr>
                <tr>
                    <th>Make</th>
                    <td>{{$show->make}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$show->model}}</td>
                </tr>
                <tr>
                    <th>Certificate #</th>
                    <td>{{$show->certificate_no}}</td>
                </tr>
                <tr>
                    <th>Serial #</th>
                    <td>{{$show->serial_no}}</td>
                </tr>
                <tr>
                    <th>Traceability #</th>
                    <td>{{$show->traceability}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$show->model}}</td>
                </tr>

                <tr>
                    <th>Range</th>
                    <td>{{$show->range}}</td>
                </tr>
                <tr>
                    <th>Resolution</th>
                    <td>{{$show->resolution}}</td>
                </tr>
                <tr>
                    <th>Accuracy</th>
                    <td>{{$show->accuracy}}</td>
                </tr>


                <tr>
                    <th>Due Date</th>
                    <td>{{$show->due}}</td>
                </tr>
                <tr>
                    <th>Commissioned Date</th>
                    <td>{{$show->commissioned}}</td>
                </tr>
                <tr>
                    <th>Calibration Date</th>
                    <td>{{$show->calibration}}</td>
                </tr>


                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
                @if(count($specifications)>0)
                <tr>
                    <th colspan="2" class="text-center bg-primary"><h6 class="font-weight-bold text-white">Specifications</h6></th>
                </tr>
                @foreach($specifications as $specification)
                <tr>
                    <th>{{$specification->columns->column}}</th>
                    <td>
                        <a data-id="{{$specification->id}}" class="edit"><i class="fa fa-edit"></i>
                        {{$specification->value}}
                        </a>
                    </td>
                </tr>
                @endforeach
                    @endif
            </table>
        </div>
    </div>
    <div class="modal fade" id="add_specification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Specification</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_specifications_form">
                        @csrf
                        <input type="hidden" value="{{$show->id}}" name="asset_id">
                        <div class="row">
                            <div class="form-group col-12  float-left">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="attribute" name="attribute">
                                        <option selected disabled>Select Attribute</option>
                                        @foreach($mycolumns as $column)
                                            @if(!in_array($column->id,$duplicate))
                                                <option value="{{$column->id}}">{{$column->column}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12  float-left">
                                <input type="text" class="form-control" id="value" name="value" placeholder="Value" autocomplete="off" value="">
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
    <div class="modal fade" id="edit_specification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Specification</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_specifications_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="row">
                            <div class="form-group col-12  float-left">
                                <input type="text" class="form-control" id="edit-value" name="value" placeholder="Value" autocomplete="off" value="">
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


    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('/specifications/edit')}}",
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
                            swal("Failed", "Permission denied for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#edit_specification').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-value').val(data.value);
                        $('#edit-attribute').val(data.title);
                    },
                    error: function(){},
                });
            });

            $("#add_specifications_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('specifications.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {

                        $('#add_specification').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function(xhr, status, error)
                    {

                        var error;
                        error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));
            $("#edit_specifications_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('specifications.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#edit_specification').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function(xhr, status, error)
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

@endsection