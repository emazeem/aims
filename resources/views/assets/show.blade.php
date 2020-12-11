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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">{{$show->name}}
            <small>[ {{$show->code}} ]</small>
        </h2>
        <span>

            <a href="{{url('preventive/maintenance/create/'.$show->id)}}" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus-circle"></i> Add Preventive Maintenance</a>
            @if($show->calibration!='1900-01-01')
                @if($limit_of_intermediatecheck== true)
                    <a href="{{url('assets/intermediate-checks/create/'.$show->id)}}" class="btn btn-primary btn-sm"><i
                                class="fa fa-plus-circle"></i> Add Intermediate Checks</a>
                @endif
            @endif
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#add_specification"><i class="fas fa-plus-circle"></i> Add Specifications
        </button>
        </span>
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
                    <th>Commissioned Date</th>
                    <td>{{$show->commissioned}}</td>
                </tr>
                <tr>
                    <th>Calibration Date</th>
                    <td>{{$show->calibration}}</td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>{{$show->due}}</td>
                </tr>
                <tr>
                    <th>Calibration Interval</th>
                    <td>{{($show->calibration_interval==1)?'1 Year':'2 Years'}}</td>
                </tr>

                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @if(empty($show->image))
                            <img src="{{url('/img/default_asset.jpg')}}" class="img-fluid" width="70">
                        @else
                            <img src="{{Storage::disk('local')->url('/assets/'.$show->image)}}" class="img-fluid"
                                 width="100">
                        @endif
                    </td>
                </tr>

                @if(count($specifications)>0)
                    <tr>
                        <th colspan="2" class="text-center bg-primary"><h6 class="font-weight-bold text-white">
                                Specifications</h6></th>
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
    <div class="modal fade" id="add_specification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
                                <input type="text" class="form-control" id="value" name="value" placeholder="Value"
                                       autocomplete="off" value="">
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
    <div class="modal fade" id="edit_specification" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <input type="text" class="form-control" id="edit-value" name="value" placeholder="Value"
                                       autocomplete="off" value="">
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
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('/specifications/edit')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    beforeSend: function () {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function () {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action.", "error");
                            return false;
                        }
                    },
                    success: function (data) {
                        $('#edit_specification').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-value').val(data.value);
                        $('#edit-attribute').val(data.title);
                    },
                    error: function () {
                    },
                });
            });

            $("#add_specifications_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('specifications.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    statusCode: {
                        403: function () {
                            swal("Failed", "Access Denied", "error");
                            return false;
                        }
                    },
                    success: function (data) {

                        $('#add_specification').modal('toggle');
                        swal('success', data.success, 'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (xhr, status, error) {

                        var error;
                        error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));
            $("#edit_specifications_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('specifications.update')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    statusCode: {
                        403: function () {
                            swal("Failed", "Access Denied", "error");
                            return false;
                        }
                    },
                    success: function (data) {
                        $('#edit_specification').modal('toggle');
                        swal('success', data.success, 'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function (xhr, status, error) {
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));
        });
    </script>
    @if(count($intermediatechecks)>0)
        <table class="table table-hover table-bordered">
            <tr>
                <th>Check Reference</th>
                <th>Reference Value</th>
                <th>Measured Value</th>
                <th>Action</th>
            </tr>
            @foreach($intermediatechecks as $intermediatecheck)
                <tr>
                    <td>{{\App\Models\Asset::find($intermediatecheck->check_reference_id)->name .' ( '. \App\Models\Asset::find($intermediatecheck->check_reference_id)->code. ' )'}}</td>
                    <td>{{$intermediatecheck->reference_value}}</td>
                    <td>
                        @foreach(explode(',',$intermediatecheck->measured_value) as $measured_value)
                            <span class="badge badge-dark">{{$measured_value}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a title='Edit' class='btn btn-sm btn-success'
                           href='{{route('intermediate-checks.edit',[$intermediatecheck->id])}}'><i
                                    class='fa fa-edit'></i></a>
                    </td>
                </tr>
            @endforeach

        </table>
    @endif
    @if(count($checklists)>0)
        <table class="table table-hover table-bordered">
            <tr class="text-center">
                <th>List</th>
                <th>Breakdown <br>Description</th>
                <th>Corrective <br>Description</th>
                <th>Performed <br>By</th>
                <th>Lab <br>Incharge</th>
                <th>Action</th>
            </tr>
            @foreach($checklists as $checklist)
                <tr>
                    <td>
                        @foreach(explode(',',$checklist->checked) as $id)
                            <b class="m-1"><input type="checkbox" checked disabled> {{\App\Models\Preventivechecklist::find($id)->tasktodo}}</b>
                            <br>
                        @endforeach
                        @if($checklist->unchecked)
                            @foreach(explode(',',$checklist->unchecked) as $id)
                                <b class="m-1"><input type="checkbox" disabled> {{\App\Models\Preventivechecklist::find($id)->tasktodo}}
                                </b><br>
                            @endforeach
                        @endif
                    </td>
                    <td>{{$checklist->breakdown_description}}</td>
                    <td>{{$checklist->corrective_description}}</td>
                    <td>{{\App\Models\User::find($checklist->performed_by)->fname.' '.\App\Models\User::find($checklist->performed_by)->lname}}</td>
                    <td>{{\App\Models\User::find($checklist->lab_in_charge)->fname.' '.\App\Models\User::find($checklist->lab_in_charge)->lname}}</td>
                    <td>
                        <a title='Edit' class='btn btn-sm btn-success' href='{{route('preventive.maintenance.edit',[$checklist->id])}}'><i class='fa fa-edit'></i></a>
                    </td>
                </tr>
            @endforeach

        </table>
    @endif

@endsection