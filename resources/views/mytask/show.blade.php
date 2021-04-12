@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif

    <div class="col-12">
        <ol class="breadcrumb col-12">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/mytasks')}}">My Tasks</a></li>
            @if($location==0)
                <li class="breadcrumb-item"><a href="{{url('mytasks/view/'.$show->id)}}">Task Detail</a></li>
            @endif
            @if($location==1)
                <li class="breadcrumb-item"><a href="{{url('mytasks/s_view/'.$show->id)}}">Task Detail</a></li>
            @endif
        </ol>

        <h4><i class="fa fa-eye"></i> My Task Details</h4>
        @if($show->status==2)
            <form method="post" action="{{route('mytasks.start')}}">
                @csrf
                <input type="hidden" name="id" value="{{$show->id}}">
                <input type="hidden" name="location" value="{{$location}}">
                <button class="btn btn-success btn-sm " type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</button>
            </form>
        @endif
        @if($show->status==4)
            <form method="post" action="{{route('mytasks.end')}}">
                @csrf
                <input type="hidden" name="location" value="{{$location}}">
                <input type="hidden" name="id" value="{{$show->id}}">
                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-hourglass-start"
                                                                                   aria-hidden="true"></i> End
                </button>
            </form>
        @endif
        @if($show->status==5)
        <form method="post" action="{{route('getcertificate')}}">
            @csrf
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="id" value="{{$show->id}}">
            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
        </form>
        @endif
        @if($show->status==3)
             <a href="{{route('calculator.data.entry.create',[$location,$show->id])}}" class="btn btn-sm btn-success"><i class="fa fa-calculator"></i> Data Entry for Cal</a>
        @endif
        @if($location==1)
            @if($show->status==1)
                <a href="#" data-id="{{$show->id}}" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i> Add Detail</a>
            @endif
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
            <table class="table table-bordered table-sm table-hover bg-white    ">
                <tr >
                    <th  width="50%">ID</th>
                    <td  width="50%">{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Capability</th>
                    <td>{{$show->item->capabilities->name.' '.$show->item->capabilities->range}}</td>
                </tr>
                <tr>
                    <th>Procedure</th>
                    <td>{{$show->item->capabilities->procedures->name}}</td>
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
                <tr>
                    <th>Calculator</th>
                    <td>{{$show->item->capabilities->calculators->name}}</td>
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

            @if($show->general)
                <h4><i class="fa fa-eye"></i> General Entry</h4>
            @if($show->item->capabilities->calculator=='incubator-calculator')
                    <a href="{{route('incubator.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Incubator Entries</a>
                    @elseif($show->item->capabilities->calculator=='volume-calculator')
                    <a href="{{route('volume.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Volume Entries</a>
                    @elseif($show->item->capabilities->calculator=='spectrophotometer-calculator')
                    <a href="{{route('spectro.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Spectrophotometer Entries</a>
                @elseif($show->item->capabilities->calculator=='vernier-caliper-calculator')
                    <a href="{{route('vernier.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Vernier Calliper Entries</a>
                @elseif($show->item->capabilities->calculator=='micrometer-calculator')
                    <a href="{{route('micrometer.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Micrometer Entries</a>
                @elseif($show->item->capabilities->calculator=='dial-gauge-calculator')
                    <a href="{{route('dialgauge.calculator',[$show->general->id])}}" class="btn btn-sm btn-success">Dial Gauge Entries</a>

                @endif
                <table class="table table-bordered table-sm table-hover bg-white    ">
                    <tr>
                        <th width="50%">Start Temperature</th>
                        <td width="50%">{{$show->general->start_temp}}°C</td>
                    </tr>
                    <tr>
                        <th>End Temperature</th>
                        <td>{{$show->general->end_temp}}°C</td>
                    </tr>
                    <tr>
                        <th>Start Humidity</th>
                        <td>{{$show->general->start_humidity}}%RH</td>
                    </tr>
                    <tr>
                        <th>End Humidity</th>
                        <td>{{$show->general->end_humidity}}%RH</td>
                    </tr>
                    @if($show->general->start_atmospheric_pressure)
                    <tr>
                        <th>Start Atmospheric Pressure</th>
                        <td>{{$show->general->start_atmospheric_pressure}} hPa</td>
                    </tr>
                    @endif
                    @if($show->general->end_atmospheric_pressure)
                    <tr>
                        <th>End Atmospheric Pressure</th>
                        <td>{{$show->general->end_atmospheric_pressure}} hPa</td>
                    </tr>
                    @endif
                    @if($show->item->capabilities->calculator=='balance-calculator')
                        <tr>
                            <th>Pan Position</th>
                            <td>{{$show->general->pan_position}}</td>
                        </tr>
                        <tr>
                            <th>Repeatability</th>
                            <td>{{$show->general->repeatability}}</td>
                        </tr>
                        <tr>
                            <th>Temp. Diff UUC</th>
                            <td>{{$show->general->uuc_temp}}</td>
                        </tr>
                        <tr>
                            <th>Temp. Diff Ref</th>
                            <td>{{$show->general->ref_temp}}</td>
                        </tr>


                    @endif
                    @if($show->item->capabilities->calculator=='volume-calculator')
                        <tr>
                            <th>Class</th>
                            <td class="text-capitalize">Class {{$show->general->class}}</td>
                        </tr>
                        <tr>
                            <th>Tolerance</th>
                            <td>{{$show->general->tolerance}}</td>
                        </tr>
                        <tr>
                            <th>Temp_ID</th>
                            <td>{{$show->general->temp_id}}</td>
                        </tr>
                        <tr>
                            <th>Temp_ Values</th>
                            <td>{{$show->general->temp_values}}</td>
                        </tr>
                        <tr>
                            <th>Balance_ID</th>
                            <td>{{$show->general->balance_id}}</td>
                        </tr>
                        <tr>
                            <th>Balance_ Values</th>
                            <td>{{$show->general->balance_values}}</td>
                        </tr>
                    @endif
                    @if($show->item->capabilities->calculator=='vernier-caliper-calculator' or $show->item->capabilities->calculator=='micrometer-calculator')
                        <tr>
                            <th>UUC Temp</th>
                            <td>{{$show->general->uuc_temp}}</td>
                        </tr>
                        <tr>
                            <th>Ref Temp</th>
                            <td>{{$show->general->ref_temp}}</td>
                        </tr>
                        <tr>
                            <th>Measuring Faces</th>
                            <td>{{$show->general->measuring_faces}}</td>
                        </tr>
                        <tr>
                            <th>Zero Error</th>
                            <td>{{$show->general->zero_error}}</td>
                        </tr>
                        <tr>
                            <th>UUC Type</th>
                            <td>{{$show->general->uuc_type}}</td>
                        </tr>

                    @endif
                </table>

            @if(count($show->general->incubatorentries)>0)
                <table class="table table-bordered table-sm table-hover bg-white">
                    <tr>
                        <th>x1</th>
                        <th>x2</th>
                        <th>x3</th>
                        <th>Set Value</th>
                        <th>UUC Indication</th>
                    </tr>
                    @foreach($show->general->incubatorentries as $k=>$mapping)
                        @if($k==0)
                            ASSET : {{\App\Models\Asset::find($mapping->asset_id)->name}}<br>
                            UNIT : {{\App\Models\Unit::find($mapping->unit)->unit}}<br>
                        @endif
                        <tr>
                            <td>{{$mapping->x1}}</td>
                            <td>{{$mapping->x2}}</td>
                            <td>{{$mapping->x3}}</td>
                            <td>{{$mapping->set_value}}</td>
                            <td>{{$mapping->uuc_indication}}</td>
                        </tr>
                    @endforeach
                </table>
                @endif
            @if(count($show->general->mappings)>0)
                <table class="table table-bordered table-sm table-hover bg-white    ">
                    <tr>
                        <th>Interval</th>
                        <th>UUC</th>
                        <th>Ch#1</th>
                        <th>Ch#2</th>
                        <th>Ch#3</th>
                        <th>Ch#4</th>
                        <th>Ch#5</th>
                        <th>Ch#6</th>
                        <th>Ch#7</th>
                        <th>Ch#8</th>
                        <th>Ch#9</th>
                        <th>Ch#10</th>
                    </tr>
                    @foreach($show->general->mappings as $mapping)
                        @if($mapping->time_interval==0)

                            @php $data=json_decode($mapping->data,true); @endphp
                            START TIME : {{$data['start_time']}}<br>
                            END TIME : {{$data['end_time']}}<br>
                            NORMAL CENTRAL PROB : {{$data['end_time']}}<br>
                            BLACK CENTRAL PROB : {{$data['end_time']}}
                            @else
                            <tr>
                                <td>{{$mapping->time_interval}}</td>
                                <td>{{$mapping->uuc_reading}}</td>
                                <td>{{$mapping->channel_1}}</td>
                                <td>{{$mapping->channel_2}}</td>
                                <td>{{$mapping->channel_3}}</td>
                                <td>{{$mapping->channel_4}}</td>
                                <td>{{$mapping->channel_5}}</td>
                                <td>{{$mapping->channel_6}}</td>
                                <td>{{$mapping->channel_7}}</td>
                                <td>{{$mapping->channel_8}}</td>
                                <td>{{$mapping->channel_9}}</td>
                                <td>{{$mapping->channel_10}}</td>
                            </tr>
                        @endif

                    @endforeach
                </table>
                @endif
            @endif
        </div>
    </div>


     {{--for general calculator--}}
    @if($show->item->capabilities->calculator=='general-calculator')
        @if($dataentrie)
            @if(count($dataentrie->child)>0)
            <div class="col-12">
            <a href="{{route('general.calculator.print_worksheet',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Worksheet</a>
            <a href="{{route('general.calculator.print_certificate',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Certificate</a>
            <a href="{{route('general.calculator.print_uncertainty',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Uncertainty</a>
            <a href="{{route('general.calculator.print_dataentrysheet',[$location,$show->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Data Entry Sheet</a>
            </div>
            @endif
            <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered table-sm bg-white">
                <tr>
                    <th colspan="2">
                        {{--{{\App\Models\Asset::find($dataentries->asset_id)->name}} {
                        {{\App\Models\Asset::find($dataentries->asset_id)->code}} }
                        --}}
                        @if($show->item->capabilities->procedures->name=='ASTM E2847-11')
                            <a href="{{route('ir.calculator',[$dataentrie->id])}}" class="btn btn-sm btn-light pull-right border"><i class="fa fa-plus"></i></a>
                        @elseif($show->item->capabilities->procedures->name=='ASTM E77')
                            <a href="{{route('lig.calculator',[$dataentrie->id])}}" class="btn btn-sm btn-light pull-right border"><i class="fa fa-plus"></i></a>
                        @else
                            <a href="{{route('general.calculator',[$dataentrie->id])}}" class="btn btn-sm btn-light pull-right border"><i class="fa fa-plus"></i></a>
                        @endif

                    </th>
                </tr>
                @foreach($dataentrie->child as $dataentry)
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
    @endif

    {{--for balance calculator--}}

    @if($show->item->capabilities->calculator=='balance-calculator')

    @if($dataentrie)

        <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered table-sm bg-white">

                <tr>
                    <th colspan="2" class="h6">
                        {{--{{\App\Models\Asset::find($dataentries->asset_id)->name}} { {{\App\Models\Asset::find($dataentries->asset_id)->code}} }
                        --}}
                        <form method="get" action="{{route('balance.calculator',[$dataentrie->id])}}">
                            {{--@csrf--}}
                            <div class="form-group col-md-6">
                                <label for="assets" class="control-label">Assets</label>
                                <select class="form-control" id="assets" name="assets">
                                    <option selected disabled>Assets</option>
                                    @foreach($assets as $asset)
                                        <option value="{{$asset->id}}">{{$asset->name}} ({{$asset->code}}) ({{$asset->range}})
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('assets'))
                                    <span class="text-danger"><strong>{{ $errors->first('assets') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="units" class=" control-label">Units</label>
                                <select class="form-control " id="units" name="units">
                                    <option selected disabled>Select Unit</option>
                                </select>
                                @if ($errors->has('units'))
                                    <span class="text-danger"><strong>{{ $errors->first('units') }}</strong></span>
                                @endif
                            </div>
                            {{--<input type="text" value="" id="mulitplying_factor" name="mulitplying_factor">
                            <input type="text" value="" id="adding_factor" name="adding_factor">
                            <input type="text" value="" id="ref_unit" name="ref_unit">--}}
                            <button type="submit" class="btn btn-sm btn-light pull-right border"><i class="fa fa-plus"></i></button>
                        </form>
                    </th>
                </tr>
                @foreach($dataentrie->child as $dataentry)
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
    @endif

    <div class="modal fade" id="add_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
                                <input type="text" class="form-control" id="eq_id" name="eq_id"
                                       placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #"
                                       autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                                       autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="make" name="make" placeholder="make"
                                       autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="accessories">Accessories</label>
                                <input type="text" class="form-control" id="model" name="accessories"
                                       placeholder="Accessories" autocomplete="off" value="NILL">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection"
                                       placeholder="Visual Inspection" autocomplete="off" value="OK">
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
    <div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="edit_make" name="make" placeholder="make" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_model">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="edit_serial" name="serial" placeholder="Serial #" autocomplete="off" value="">
                            </div>


                            <div class="form-group col-12  float-left">
                                <label for="edit_eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="edit_eq_id" name="eq_id"
                                       placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_accessories">Accessories</label>
                                <input type="text" class="form-control" id="edit_accessories" name="accessories"
                                       placeholder="Accessories" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="edit_visualinspection"
                                       name="visualinspection" placeholder="Visual Inspection" autocomplete="off"
                                       value="">
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
    <script>
        $(document).ready(function () {
            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                $('#add_id').val(id);
                $('#add_details').modal('toggle');
            });
            $("#add_details_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.storesite')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        console.log(data);
                        if (!data.errors) {
                            $('#add_details').modal('toggle');
                            swal("Success", "Item checked in successfully", "success");
                            location.reload();

                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }));
            $('select[name="assets"]').on('change', function () {
                var parameter = $(this).val();
                if (parameter) {
                    $.ajax({
                        url: '/units/units_of_assets/' + parameter,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="units"]').empty();
                            $('select[name="units"]').append('<option disabled selected>Select Respective Units</option>');
                            $.each(data['units'], function (key, value) {
                                if (key!='show_channels'){
                                    $('select[name="units"]').append('<option value="'+ value.id +'">'+ value.unit +'</option>');
                                }
                                //$('select[name="units"]').append('<option value="' + value.id + '">' + value.unit + '</option>');

                            });
                        }
                    });
                } else {
                    $('select[name="units"]').empty();
                }
            });
        });
    </script>
@endsection
