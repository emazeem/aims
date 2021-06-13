@extends('layouts.master')
@section('content')

    <style>
        .parameter-vs-assets::-webkit-scrollbar {
            height: 5px;
        }

        .parameter-vs-assets::-webkit-scrollbar-track {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .parameter-vs-assets::-webkit-scrollbar-thumb {
            background-color: #136bf7;
            outline: 1px solid #136bf7;
        }
    </style>

    <script src="{{url('/assets/js/1.10.1/jquery.min.js')}}"></script>


    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="row">
        <form method="post" id="check_form">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
        </form>
        <div class="col-12">
            <div class="page-header-title float-left">
                <h3 class="m-b-10 font-weight-light"><i class="feather icon-home"></i> Dashboard</h3>
            </div>
        @if($check==0)
                @if($checkout_missing_status==1)
                    <button type="submit" class="btn btn-sm btn-danger float-right btn-flat checkout">
                        <span class="fa fa-clock-o"></span> Check-out for : <span id="current_time"></span>
                    </button>
                @else
                    <button type="submit" class="btn btn-sm btn-success float-right btn-flat checkin">
                        <span class="fa fa-clock-o"></span> Check-In for : <span id="current_time"></span>
                    </button>
                @endif

            @elseif($check==1)
                <button type="submit" class="btn btn-sm btn-danger float-right btn-flat checkout">
                    <span class="fa fa-clock-o"></span> Check-out for : <span id="current_time"></span>
                </button>
                @else

            @endif
        </div>


        <div class="col-12">
            <div class="row mt-3">

                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-red">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Customers</h6>
                                    <h3 class="m-b-0 text-white">{{$customers}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-blue">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Parameters</h6>
                                    <h3 class="m-b-0 text-white">{{$parameters}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-green">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Capabilities</h6>
                                    <h3 class="m-b-0 text-white">{{$capabilities}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-yellow">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Assets</h6>
                                    <h3 class="m-b-0 text-white">{{$assets}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-green">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Quotes</h6>
                                    <h3 class="m-b-0 text-white">{{$quotes}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-activity text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-yellow">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Jobs</h6>
                                    <h3 class="m-b-0 text-white">{{$jobs}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-blue">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Users</h6>
                                    <h3 class="m-b-0 text-white">{{$personnels}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card prod-p-card bg-c-red">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">Departments</h6>
                                    <h3 class="m-b-0 text-white">{{$departments}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card p-0">
                <div class="card-body">
                    <h6 class="mb-0 float-right">{{$api['weather'][0]['description']}}</h6>
                    <span class="d-block mb-1">{{date('l')}}</span>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <h2 class="text-c-purple m-0">
                                <img src="http://openweathermap.org/img/w/{{$api['weather'][0]['icon']}}.png" alt="">
                                {{round($api['main']['temp']-273.15)}}<sup class="f-20">°</sup></h2>
                        </div>
                        <div class="col text-right">
                            <div class="form-group mb-1">
                                <label class="m-r-5 f-20 mb-0">°F</label>

                                <div class="switch switch-primary d-inline">
                                    <input type="checkbox" id="switch-a-1" checked="">
                                    <label for="switch-a-1" class="cr"></label>
                                </div>
                                <label class="m-l-5 f-20 mb-0">°C</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <small class="float-left">{{date('d M Y')}}</small>
                            <small class="float-right" id="current_time_gadget"></small>
                        </div>
                        <div class="col-12">
                            <small class="float-left"><i class="feather icon-map-pin"></i> {{$api['name']}} , {{$api['sys']['country']}}</small>
                            <small class="float-right" id="current_time_gadget"></small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Parameter vs Asset and Capabilities</h5>
                </div>
                <div class="card-body parameter-vs-assets" style="overflow-x: scroll">
                    <div id="parameters-vs-assets" style="width: 2000px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Quote</h5>
                </div>
                <div class="card-body">
                    <div id="quote-chart"></div>
                </div>
            </div>
        </div>

        {{--<div class="col-12" style="overflow: hidden">
            <h2 class="ml-2">Purchase Indent Revisions</h2>
            <table class="table table-hover font-13 bg-white table-responsive">
                <tbody>
                <?php $count = 0;?>
                @foreach($indentforrevisions as $indentforrevision)
                    @foreach($indentforrevision->indent_items as $item)
                        <tr>
                            <td width="10%">{{$item->title}}</td>
                            <td width="10%">{{$item->item_code}}</td>
                            <td width="10%">{{$item->purpose}}</td>
                            <td width="10%">{{$item->item_description}}</td>
                            <td width="10%">{{$item->ref_code}}</td>
                            <td width="10%">{{$item->unit}}</td>
                            <td width="10%">{{$item->last_six_months_consumption}}</td>
                            <td width="10%">{{$item->current_stock}}</td>
                            <td width="10%">{{$item->qty}}</td>
                            <td width="10%">
                                <a href="{{url('purchase_indent/item/revision/reject/'.$item->id)}}"
                                   title="Reject" class="btn btn-danger btn-sm"><i
                                            class="fa fa-close"></i></a>
                                <a href="{{url('purchase_indent/item/revision/approve/'.$item->id)}}"
                                   title="Accept" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                            </td>
                        </tr>
                        <?php $count = $count + 1;?>
                    @endforeach
                @endforeach
                @if($count==0)
                    <i>No Purchase indent items to review</i>
                @endif
                </tbody>
            </table>
            <h2 class="ml-2">Purchase Indent Approvals</h2>
            <table class="table table-hover font-13 bg-white table-responsive">

                <?php $count = 0;?>
                @foreach($indentforapprovals as $indentforapproval)
                    @foreach($indentforapproval->indent_items as $item)
                        <tr>
                            <td width="10%">{{$item->title}}</td>
                            <td width="10%">{{$item->item_code}}</td>
                            <td width="10%">{{$item->purpose}}</td>
                            <td width="11%">{{$item->item_description}}</td>
                            <td width="10%">{{$item->ref_code}}</td>
                            <td width="10%">{{$item->unit}}</td>
                            <td width="10%">{{$item->last_six_months_consumption}}</td>
                            <td width="10%">{{$item->current_stock}}</td>
                            <td width="10%">{{$item->qty}}</td>
                            <td width="10%">
                                <a href="{{url('purchase_indent/item/approval/reject/'.$item->id)}}"
                                   title="Reject" class="btn btn-danger btn-sm"><i
                                            class="fa fa-close"></i></a>
                                <a href="{{url('purchase_indent/item/approval/approve/'.$item->id)}}"
                                   title="Accept" class="btn btn-success btn-sm"><i
                                            class="fa fa-check"></i></a>
                            </td>
                        </tr>
                        <?php $count = $count + 1;?>
                    @endforeach
                @endforeach
                @if($count==0)
                    <i>No Purchase indent items for approval</i>
                @endif
            </table>
            <h2 class="ml-2">Leave Application Department Approvals</h2>
            @if(count($head_applications))
                <table class="table table-hover font-13 bg-white table-responsive">
                    @foreach($head_applications as $head_application)
                        <tr>
                            <td width="10%">{{$head_application->appraisal->fname}} {{$head_application->appraisal->lname}}</td>
                            <td width="10%">{{$head_application->nature_of_leave}}</td>
                            <td width="10%">{{$head_application->from->format('d-m-Y')}}</td>
                            <td width="11%">{{$head_application->to->format('d-m-Y')}}</td>
                            <td width="10%">{{$head_application->reason}}</td>
                            <td width="10%">
                                <a href="{{url('leave-application/head/reject/'.$head_application->id)}}"
                                   title="Reject" class="btn btn-danger btn-sm"><i
                                            class="fa fa-close"></i></a>
                                <a href="{{url('leave-application/head/approve/'.$head_application->id)}}"
                                   title="Accept" class="btn btn-success btn-sm"><i
                                            class="fa fa-check"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <i>No Application Approvals by Head of Department</i>
            @endif
        </div>--}}


        <div class="col-12 mt-2">
            <h4 class="font-weight-light">Events and Deadlines</h4>
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
    <script>
        $(document).ready(function (e) {
            
            $(document).on('click', '.checkin', function (e) {
                swal({
                    title: "Are you sure to check in?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#check_form").attr("method");
                            var form_data = $("#check_form").serialize();
                            //e.preventDefault();
                            $.ajax({
                                url: "{{route('attendance.checkin')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function () {
                                        $(".loading").fadeOut();
                                        swal("Failed", "Permission denied for this action.", "error");
                                        return false;
                                    }
                                },
                                success: function (data) {
                                    swal("Success", "You are Checked in successfully.", "success");
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000);
                                },
                                error: function () {
                                    $(".loading").fadeOut();
                                    swal("Failed", "Unable to check in.", "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.checkout', function (e) {
                swal({
                    title: "Are you sure to check out?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#check_form").attr("method");
                            var form_data = $("#check_form").serialize();
                            //e.preventDefault();
                            $.ajax({
                                url: "{{route('attendance.checkout')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function () {
                                        $(".loading").fadeOut();
                                        swal("Failed", "Permission denied for this action.", "error");
                                        return false;
                                    }
                                },
                                success: function (data) {
                                    swal("Success", "You are Checked out successfully.", "success");
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000);
                                },
                                error: function () {
                                    $(".loading").fadeOut();
                                    swal("Failed", "Unable to check out.", "error");
                                },
                            });

                        }
                    });

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            setInterval(function () {
                document.getElementById("current_time").innerText = moment().format('MMM D YYYY, h:mm:ss A');
                document.getElementById("current_time_gadget").innerText = moment().format('h:mm:ss A');
            }, 1000);



        });
        $(function() {
            var options = {
                chart: {
                    height: 400,
                    type: 'area',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'straight',
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        gradientToColors: ['#4099ff'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 0.9,
                        opacityTo: 0.5,
                        stops: [0, 100, 100, 100]
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        maxWidth: 20,
                    }
                },
                xaxis: {
                    categories:[@php foreach ($gparameters as $gparameter){ echo "'$gparameter->name'".',';} @endphp],
                },
                colors: ["#4099ff","#ff1712"],
                series: [{
                    name: "Assets",
                    data: [@php foreach ($gparameters as $gparameter){ echo count(\App\Models\Asset::where('parameter',$gparameter->id)->get()).',';} @endphp],
                },{
                    name: "Capabilities",
                    data: [@php foreach ($gparameters as $gparameter){ echo count(\App\Models\Capabilities::where('parameter',$gparameter->id)->get()).',';} @endphp],
                }],
                grid: {
                    row: {
                        opacity: 0.5
                    }
                },
            };
            var chart = new ApexCharts(document.querySelector("#parameters-vs-assets"), options);
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 200,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                series: [{{$pendings_q}}, {{$notsents_q}}, {{$waitings_q}},{{$approved_q}}],
                colors: ["#ff5370","#4099ff","#000000", "#2ed8b6"],
                labels: ["Pending", "To be sent", "Waiting approval","Approved"],
                legend: {
                    show: true,
                    position: 'bottom',
                }
            };
            var chart = new ApexCharts(
                document.querySelector("#quote-chart"),
                options
            );
            chart.render();

        });
    </script>
    <script src="{{url('assets/js/pages/chart.js')}}"></script>
    <script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>

@endsection
