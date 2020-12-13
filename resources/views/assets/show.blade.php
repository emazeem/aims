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
                        @if($show->image=="default.jpg")
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

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Intermediate Checks</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('vendor/chart.js/Chart.min.js')}}"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 10000, 5000, 0, 4000, 20000, 15000, 25000, 20000, 10000, 25000, 1000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

    </script>
@endsection