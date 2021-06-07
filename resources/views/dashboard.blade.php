@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
                <h5 class="m-b-10">
                    <i class="feather icon-home"></i>
                    Dashboard
                </h5>
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
            <div class="row">
                <!-- order-card start -->
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h6 class="text-white">Customers</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$customers}}</span></h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h6 class="text-white">Parameters</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$parameters}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-body">
                            <h6 class="text-white">Capabilities</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$capabilities}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-red order-card">
                        <div class="card-body">
                            <h6 class="text-white">Assets</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$assets}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-body">
                            <h6 class="text-white">Quotes</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$quotes}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-red order-card">
                        <div class="card-body">
                            <h6 class="text-white">Jobs</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$jobs}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h6 class="text-white">Users</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$personnels}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h6 class="text-white">Departments</h6>
                            <h2 class="text-right text-white"><i class="feather icon-user float-left"></i><span>{{$departments}}</span></h2>
                        </div>
                    </div>
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
            <h2 class="ml-2">Events and Deadlines</h2>
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
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
