@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <h2 class="border-bottom text-dark">Asset Group Details</h2>
        <div class="col-12">
            <button type="button" class="btn btn-sm btn-primary shadow-sm mb-3 float-right" data-toggle="modal" data-target="#add_preventive_checklist"><i class="fas fa-plus-circle"></i> Preventive Checklist</button>
            <table class="table table-bordered table-responsive-sm table-hover">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Assets</th>
                    <?php $assets=\App\Models\Asset::where('group_id',$show->id)->get(); ?>
                    <td>
                        @foreach($assets as $asset)
                            <span class="badge badge-danger my-1" style="font-size: 15px">{{$asset->name.' '.$asset->code}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal fade" id="add_preventive_checklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Preventive Checklist</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_preventive_checklist_form">
                        @csrf
                        <input type="hidden" name="group_id" value="{{$show->id}}">
                        <div class="row">
                            <div class="form-group col-12  float-left">
                                <textarea class="form-control" id="tasktodo" name="tasktodo" placeholder="Task to do" rows="5" autocomplete="off">{{old('tasktodo')}}</textarea>
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
    <div class="modal fade" id="edit_preventive_checklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Preventive Checklist</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_preventive_checklist_form">
                        @csrf
                        <input type="hidden" name="id" id="edit_id" value="">
                        <div class="row">
                            <div class="form-group col-12  float-left">
                                <textarea class="form-control" id="edit_tasktodo" name="tasktodo" placeholder="Task to do" rows="5" autocomplete="off">{{old('tasktodo')}}</textarea>
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
        $("#add_preventive_checklist_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('preventive.checklist.store')}}",
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
                        $('#add_preventive_checklist').modal('hide');
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
        $("#edit_preventive_checklist_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('preventive.checklist.update')}}",
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
                        $('#edit_preventive_checklist').modal('hide');
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

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{route('preventive.checklist.edit')}}",
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
                    $('#edit_preventive_checklist').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#edit_tasktodo').val(data.tasktodo);
                },
                error: function(){},
            });
        });
    </script>
    @if(count($checklists)>0)
        <table class="table table-hover table-bordered">
            <tr>
                <th>Task to Do</th>
                <th>Action</th>
            </tr>
            @foreach($checklists as $checklist)
                <tr>
                    <td>{{$checklist->tasktodo}}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success shadow-sm mb-3 edit" data-id="{{$checklist->id}}"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
            @endforeach

        </table>
    @endif

@endsection