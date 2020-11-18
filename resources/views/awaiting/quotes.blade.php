@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Item Entries</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <table id="example" class="table table-striped table-bordered table-responsive-sm table-sm" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Description</th>
                    <th>Parameter</th>
                    <th>Equipment ID</th>
                    <th>Model</th>
                    <th>Accessories</th>
                    <th>Visual Inspection</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)

                        <tr>
                            <td>{{$job->id}}</td>
                            <td>{{\App\Models\Capabilities::find($job->items->capability)->name}}</td>
                            <td>{{\App\Models\Parameter::find($job->items->parameter)->name}}</td>
                            <td>
                                @if($job->eq_id)
                                {{$job->eq_id}}
                                    @else
                                    <small class="font-italic text-danger">NULL</small>
                                @endif
                            </td>
                            <td>
                                @if($job->model)
                                {{$job->model}}
                                    @else
                                    <small class="font-italic text-danger">NULL</small>
                                @endif
                            </td>
                            <td>
                                @if($job->accessories)
                                {{$job->accessories}}
                                    @else
                                    <small class="font-italic text-danger">NULL</small>
                                @endif
                            </td>
                            <td>
                                @if($job->visual_inspection)
                                {{$job->visual_inspection}}
                                    @else
                                    <small class="font-italic text-danger">NULL</small>
                                @endif
                            </td>
                            <td>
                                @if($job->status==0)
                                    <span class="badge badge-danger">Awaiting</span>
                                @else
                                    <span class="badge badge-success">Checked in</span>
                                @endif
                            </td>
                            <td>
                                @if($job->status==2)
                                    Assigned
                                @elseif($job->status==1)
                                    <a href="#" data-id="{{$job->id}}" class="btn edit btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                @elseif($job->status==0)
                                    <a href="#" data-id="{{$job->id}}" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Item Description</th>
                    <th>Parameter</th>
                    <th>Status</th>
                    <th>Equipment ID</th>
                    <th>Model</th>
                    <th>Accessories</th>
                    <th>Visual Inspection</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                $('#add_id').val(id);
                $('#add_details').modal('toggle');
            });
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('awaitings/checkin/edit/')}}/"+id,
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
                        $('#edit_details').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_eq_id').val(data.eq_id);
                        $('#edit_model').val(data.model);
                        $('#edit_accessories').val(data.accessories);
                        $('#edit_visualinspection').val(data.visual_inspection);
                        //Populating Form Data to Edit Ends
                    },
                    error: function(){},
                });
            });

            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#add_details').modal('toggle');
                            swal("Success", "Item checked in successfully", "success");
                            location.reload();

                        }
                    },
                    error: function(e)
                    {
                        swal("Failed", "Fields Required. Try again.", "error");

                    }
                });
            }));
            $("#edit_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#edit_details').modal('toggle');
                            swal("Success", "Item checked in updated successfully", "success");
                            location.reload();

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
    <div class="modal fade" id="add_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_details_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="" id="add_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="accessories">Accessories</label>
                                <input type="text" class="form-control" id="model" name="accessories" placeholder="Accessories" autocomplete="off" value="NILL">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="OK">
                            </div>


                            <div class="col-3">
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
    <div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_details_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="" id="edit_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="edit_eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="edit_eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_model">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_accessories">Accessories</label>
                                <input type="text" class="form-control" id="edit_accessories" name="accessories" placeholder="Accessories" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="edit_visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="">
                            </div>


                            <div class="col-3">
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


