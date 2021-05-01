@extends('layouts.master')
@section('content')

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif

    <script>
        var myObject =function () {
            var value=0;
            console.log(value);
            return {
                m1:function () {
                    value++;
                    console.log(value);
                },
                m2:function () {
                    value--;
                    console.log(value);
                },
            }
        };
    </script>
    <div class="row">

        <form method="post" id="check_form">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
        </form>
        <div class="col-12">
            <h4 class="pull-left"><i class="fa fa-home"></i> Dashboard</h4>
            @if($check==0)
                @if($checkout_missing_status==1)
                    <button type="submit" class="btn btn-sm btn-danger pull-right btn-flat checkout">
                        <span class="fa fa-clock-o"></span> Check-out for : <span id="current_time"></span>
                    </button>
                @else
                    <button type="submit" class="btn btn-sm btn-success pull-right btn-flat checkin">
                        <span class="fa fa-clock-o"></span> Check-In for : <span id="current_time"></span>
                    </button>
                @endif

            @elseif($check==1)
                <button type="submit" class="btn btn-sm btn-danger pull-right btn-flat checkout">
                    <span class="fa fa-clock-o"></span> Check-out for : <span id="current_time"></span>
                </button>
                @else

            @endif
        </div>
        <div class="col-12">

            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                        synth. Cosby sweater eu banh mi, qui irure terr.
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                        booth letterpress, commodo enim craft beer mlkshk aliquip
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                        booth letterpress, commodo enim craft beer mlkshk
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="x_content">
                <div class="row">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-users"></i>
                            </div>
                            <div class="count">{{$customers}}</div>
                            <h3><a href="{{url('customers')}}">Customers</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-tasks"></i>
                            </div>
                            <div class="count">{{$parameters}}</div>
                            <h3><a href="{{url('parameters')}}">Parameters</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-dollar"></i>
                            </div>
                            <div class="count">{{$capabilities}}</div>
                            <h3><a href="{{url('capabilities')}}">Capabilities</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-tasks"></i>
                            </div>
                            <div class="count">{{$assets}}</div>
                            <h3><a href="{{url('assets')}}">Assets</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-question"></i>
                            </div>
                            <div class="count">{{$quotes}}</div>
                            <h3><a href="{{url('quotes')}}">Quotes</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-recycle"></i>
                            </div>
                            <div class="count">{{$jobs}}</div>
                            <h3><a href="{{url('jobs')}}">Jobs</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-user-plus"></i>
                            </div>
                            <div class="count">{{$personnels}}</div>
                            <h3><a href="{{url('users')}}">Users</a></h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-history"></i>
                            </div>
                            <div class="count">{{$departments}}</div>
                            <h3><a href="{{url('departments')}}">Departments</a></h3>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-12" style="overflow: hidden">
            <div class="x_panel p-0" style="overflow: hidden">
                <div class="x_title">
                    <h2 class="ml-2">Purchase Indent Revisions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-0 m-0">
                    <ul class="list-unstyled msg_list col-12">
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="x_panel p-0 m-0">
                <div class="x_title">
                    <h2 class="ml-2">Purchase Indent Approvals</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-0 m-0">
                    <ul class="list-unstyled msg_list col-12 ">
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="x_panel p-0 m-0">
                <div class="x_title">
                    <h2 class="ml-2">Leave Application Department Approvals</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-0 m-0">
                    <ul class="list-unstyled msg_list col-12 ">
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
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 mt-2">
            <div class="x_panel p-0">
                <div class="x_title">
                    <h2 class="ml-2">Events and Deadlines</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({});
        });
    </script>
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
            }, 1000);

        });
    </script>
@endsection
