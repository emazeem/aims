@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
                location.reload();
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Task Details</h1>
        <a href="{{route('calculator',[$location,$show->id])}}" class="btn btn-success"><i class="fa fa-calculator"></i> Calculator</a>
    @if($show->status==2)
        <form method="post" action="{{route('mytasks.start')}}">
            @csrf
            <input type="hidden" name="id" value="{{$show->id}}">
            <input type="hidden" name="location" value="{{$location}}">
            <button class="btn btn-success float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</button>
        </form>
        @endif
        @if($show->status==3)
        <form method="post" action="{{route('mytasks.end')}}">
            @csrf
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="id" value="{{$show->id}}">
            <button class="btn btn-danger float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> End</button>
        </form>
        @endif

        @if($show->status==4 && $location==0)
        <form method="post" action="{{route('getcertificate')}}">
            @csrf
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="id" value="{{$show->id}}">
            <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
        </form>
        @endif
        @if($show->status==5 && $location==1)
        <form method="post" action="{{route('getcertificate')}}">
            @csrf
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="id" value="{{$show->id}}">
            <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
        </form>
        @endif

        @if($show->status==4 && $location==1)
            <a href="#" data-id="{{$show->id}}" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i> Add Detail</a>
        @endif
    </div>
    <div class="row pb-3">
        <div class="col-12 text-right">

            <h5>
                @if($show->status==6 or $show->status==5)
                    @if($show->certificate)
                        Certificate # {{$show->certificate}}
                    @endif
                @endif
            </h5>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-sm table-hover">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Capability</th>
                    <td>{{$show->items->capabilities->name}}</td>
                </tr>
                <tr>
                    <th>Procedure</th>
                    <td>{{$show->items->capabilities->procedures->name}}</td>
                </tr>

                <tr>
                    <th>Equipment ID</th>
                    <td>{{$show->eq_id}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$show->model}}</td>
                </tr>

                <tr>
                    <th>Start</th>
                    <td>{{$show->start}}</td>
                </tr>
                <tr>
                    <th>End</th>
                    <td>{{$show->end}}</td>
                </tr>
                @if($show->assign_assets)
                <tr>
                    <th>Assign Assets</th>
                    <td>
                        @foreach($assets as $asset)
                            {{$asset->name}} <b>{{$asset->code}}</b>
                            <br>
                        @endforeach
                    </td>
                </tr>
                @endif
                <tr>
                    <th>Visual Inspection</th>
                    <td>{{$show->visual_inspection}}</td>
                </tr>
                @if($show->accessories)
                <tr>
                    <th>Accessories</th>
                    <td>{{$show->accessories}}</td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td>
                        @if($show->status==2)
                            <i class="badge badge-danger">Pending</i>
                        @elseif($show->status==3)
                            <i class="badge badge-primary">In Progress</i>
                            <br>
                            <b>Started at : </b>{{date('d M, y h:i A',strtotime($show->started_at))}}
                        @else
                            <i class="badge badge-success">Completed</i>

                            <br>
                            <b>Started at : </b>{{date('d M, y h:i A',strtotime($show->started_at))}}
                        <br>
                            <b>Ended at : </b>{{date('d M, y h:i A',strtotime($show->ended_at))}}

                        @endif
                    </td>
                </tr>

            </table>
        </div>
        <div class="col-12 text-right">
            @if($show->status==2)
                <form method="post" action="{{route('mytasks.start')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$show->id}}">
                    <input type="hidden" name="location" value="{{$location}}">
                    <button class="btn btn-success float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</button>
                </form>
            @endif
            @if($show->status==3)
                <form method="post" action="{{route('mytasks.end')}}">
                    @csrf
                    <input type="hidden" name="location" value="{{$location}}">
                    <input type="hidden" name="id" value="{{$show->id}}">
                    <button class="btn btn-danger float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> End</button>
                </form>
            @endif

            @if($show->status==4 && $location==0)
                <form method="post" action="{{route('getcertificate')}}">
                    @csrf
                    <input type="hidden" name="location" value="{{$location}}">
                    <input type="hidden" name="id" value="{{$show->id}}">
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
                </form>
            @endif
            @if($show->status==5 && $location==1)
                <form method="post" action="{{route('getcertificate')}}">
                    @csrf
                    <input type="hidden" name="location" value="{{$location}}">
                    <input type="hidden" name="id" value="{{$show->id}}">
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
                </form>
            @endif

            @if($show->status==4 && $location==1)
                <a href="#" data-id="{{$show->id}}" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i> Add Detail</a>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                $('#add_id').val(id);
                $('#add_details').modal('toggle');
            });
            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.storesite')}}",
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
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="OK">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($dataentries)
    <div class="col-12 table-responsive">
        <b>Location :</b>
        @if($dataentries->job_type==0)
            Lab
        @else
            Site
        @endif
        <br>
        <b>Fixed Value : </b>
        @if($dataentries->fixed_type=='UUC')
            Reference Standard
        @else
            UUC
        @endif
        <br>
        <b>Unit : </b>
        {{\App\Models\Unit::find($dataentries->unit)->unit}}
        <br>
        <span class="mb-3">
            <a href="{{route('mytasks.print_worksheet',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Worksheet</a>
            <a href="{{route('mytasks.print_certificate',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Certificate</a>
        </span>
        <table class="table table-hover table-bordered">

            <tr>
                <th>Fixed Value</th>
                <th>Repeated Values</th>
            </tr>
            @foreach($dataentries->child as $dataentry)
            <tr>

                <td>
                    {{$dataentry->fixed_value}}
                </td>
                <th>
                    <span class="badge badge-dark p-2">{{$dataentry->x1}}</span>
                    <span class="badge badge-dark p-2">{{$dataentry->x2}}</span>
                    <span class="badge badge-dark p-2">{{$dataentry->x3}}</span>
                    <span class="badge badge-dark p-2">{{$dataentry->x4}}</span>
                    <span class="badge badge-dark p-2">{{$dataentry->x5}}</span>
                    <span class="badge badge-dark p-2">{{$dataentry->x6}}</span>
                </th>

            </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection