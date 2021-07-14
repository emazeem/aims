@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
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
                                    <h3 class="m-b-0 text-white count">{{$customers}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$parameters}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$capabilities}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$assets}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$quotes}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$jobs}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$personnels}}</h3>
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
                                    <h3 class="m-b-0 text-white count">{{$departments}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Gate::check('finance-accounts'))
                    <div class="col-xl-4 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="fa fa-money-bill text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h6 class="m-b-5">Revenue</h6>
                                        <h6 class="m-b-0 text-c-red">Sales this Month</h6>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <h6 class="m-b-0"><span class="count">{{$revenue}}</span> Rs</h6>
                                    </div>
                                </div>
                                <h6 class="pt-badge badge-light-danger">{{date('F')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="fa fa-money-bill text-c-green f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h6 class="m-b-5">Invoices</h6>
                                        <h6 class="m-b-0 text-c-green">Invoices this Month</h6>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <h6 class="m-b-0"> <span class="count">{{$invoices->count()}}</span> Inv</h6>
                                    </div>
                                </div>
                                <h6 class="pt-badge badge-light-success">{{date('F')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                    <div class="card proj-t-card">
                        <div class="card-body">
                            <div class="row align-items-center m-b-30">
                                <div class="col-auto">
                                    <i class="fa fa-money-bill text-c-blue f-30"></i>
                                </div>
                                <div class="col p-l-0">
                                    <h6 class="m-b-5">Expenses</h6>
                                    <h6 class="m-b-0 text-c-blue">Expenses this Month</h6>
                                </div>
                            </div>
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <h6 class="m-b-0"> <span class="count">{{$expenses}}</span> Rs.</h6>
                                </div>
                            </div>
                            <h6 class="pt-badge badge-light-primary">{{date('F')}}</h6>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(Gate::check('lab-task-index') || Gate::check('site-task-index'))
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>My Tasks Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2 class="d-inline-block text-c-blue m-r-10">{{$pending_mt}}</h2>
                                <div class="d-inline-block">
                                    @php $total_mt=$pending_mt+$started_mt+$completed_mt; @endphp
                                    <p class="m-b-0"><i
                                                class="fa fa-caret-up m-r-10 text-c-green"></i>{{$total_mt==0?'0':round($pending_mt/($total_mt)*100)}}
                                        %</p>
                                    <p class="text-muted">My Pending Tasks</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="d-inline-block text-c-green m-r-10">{{$started_mt}}</h2>
                                <div class="d-inline-block">
                                    <p class="m-b-0"><i
                                                class="fa fa-caret-down m-r-10 text-c-red"></i>{{$total_mt==0?'0':round($started_mt/($total_mt)*100)}}
                                        %</p>
                                    <p class="text-muted">My Started Tasks</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="d-inline-block text-c-red m-r-10">{{$completed_mt}}</h2>
                                <div class="d-inline-block">
                                    <p class="m-b-0"><i
                                                class="fa fa-caret-up m-r-10 text-c-green"></i>{{$total_mt==0?'0':round($completed_mt/($total_mt)*100)}}
                                        %</p>
                                    <p class="text-muted">My Completed Tasks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card p-0">
                <div class="card-body">
                    <h6 class="mb-0 float-right">
                        <div class="spinner-border spinner-border-sm loading-component"></div>
                        <span class="weather-description"></span>

                    </h6>
                    <span class="d-block mb-1">
                        <div class="spinner-border spinner-border-sm loading-component"></div>
                        <span class="day"></span>

                    </span>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <h2 class="text-c-purple m-0">
                                <img class="temp-icon">
                                <span class="temp-in-centi"></span>
                                <sup class="f-20">°</sup></h2>
                        </div>
                        <div class="col text-right">
                            <div class="form-group mb-1">
                                <label class="m-r-5 f-20 mb-0">°F</label>

                                <div class="switch switch-primary d-inline">
                                    <input type="checkbox" id="switch-a-1" class="temp-toggler">
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
                            <small class="float-left">
                                <div class="spinner-border spinner-border-sm loading-component"></div>
                                <span class="country-city"></span>
                            </small>
                            <small class="float-right" id="current_time_gadget"></small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @can('daily-attendance-dashboard')
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 float-left font-weight-light">Attendance</h5>
                        <label for="date-attendance"></label>
                        <input type="date" id="date-attendance" class="form-control float-right col-md-3"
                               name="date-attendance" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="card-body border-top table-responsive" id="pro-det-edit-1">
                        <table class="table table-hover table-sm bg-white">
                            <thead>
                            <tr>
                                <th>By</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                            </tr>
                            </thead>
                            <tbody class="attendance-table">
                            </tbody>
                        </table>
                        <div class="col-12 text-center">
                            <img src="{{url('assets/images/lazy-loader.gif')}}" alt="" class="lazy-loader"
                                 style="display: none;">
                        </div>

                    </div>
                </div>
            </div>
        @endcan
        @can('quote-index')
            <div class="col-md-6 col-12">
                <div class="card py-3">
                    <div id="quoteContainer"></div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card py-3">
                    <div id="jobContainer"></div>
                </div>
            </div>
        @endcan
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Incoming Requests</h5>
                </div>
                <div class="card-body p-0 incomeing-scroll">
                    <div class="mt-3 mb-3">
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-blue f-10 m-r-5"></i>Customers Scattering</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-green f-10 m-r-5"></i>You have 2 pending requests..</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-red f-10 m-r-5"></i>You have 3 pending tasks</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-yellow f-10 m-r-5"></i>New order received</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-purple f-10 m-r-5"></i>Incoming requests</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-green f-10 m-r-5"></i>The 3 Golden Rules Professional Design..</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-red f-10 m-r-5"></i>You have 4 pending tasks</span>
                        <hr>
                        <span class="px-4 d-block"><i class="fas fa-circle text-c-yellow f-10 m-r-5"></i>New order received</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 table-responsive" style="overflow: hidden">
            {{--<h2 class="ml-2">Purchase Indent Revisions</h2>
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
            --}}
            @can('application-department-approval')
                <div class="card">
                    <div class="card-header pb-0 mb-0">
                        <h4 class="card-title font-weight-light">Leave Application Department Approvals</h4>
                    </div>
                    <div class="card-body py-0 my-0">
                        <table class="table table-hover bg-white table-responsive table-sm">
                            @if(count($head_applications))
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>From-To</th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($head_applications as $head_application)
                                    <tr>
                                        <td width="10%">{{$head_application->users->fname}} {{$head_application->users->lname}}</td>
                                        <td width="10%">{{$head_application->nature->name}}</td>
                                        <td width="10%">{{$head_application->from->format('d/m/Y').' '.$head_application->to->format('d/m/Y')}}</td>
                                        <td width="10%">{{$head_application->reason}}</td>
                                        <td width="20%">
                                            {{$head_application->head_remarks}}
                                            <form action="{{route('leave_application.remarks')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$head_application->id}}">
                                                <input type="hidden" name="approvalno" value="1">
                                                <textarea type="text" class="form-control" id="reason"
                                                          placeholder="Enter Remarks of Application"
                                                          name="remarks"></textarea>
                                                <button type="submit" class="btn btn-sm btn-success btn-block">Save
                                                </button>
                                            </form>
                                        </td>
                                        <td width="10%">
                                            <a href="{{url('leave-applications/head/reject/'.$head_application->id)}}"
                                               title="Reject" class="btn btn-danger btn-sm"><i
                                                        class="feather icon-x"></i></a>
                                            <a href="{{url('leave-applications/head/approve/'.$head_application->id)}}"
                                               title="Accept" class="btn btn-success btn-sm"><i
                                                        class="feather icon-check"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tr>
                                    <td colspan="5">No Application Approvals by Head of Department</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            @endcan
            @can('application-ceo-approval')
                @if(auth()->user()->id==1 or auth()->user()->id==19)
                    <div class="card">
                        <div class="card-header pb-0 mb-0">
                            <h4 class="card-title font-weight-light">Leave Application CEO Approvals</h4>
                        </div>
                        <div class="card-body py-0 my-0">
                            <table class="table table-hover bg-white table-responsive table-sm">
                                @if(count($ceo_applications))
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>From-To</th>
                                        <th>Reason</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($ceo_applications as $ceo_application)
                                        <tr>
                                            <td width="10%">{{$ceo_application->users->fname}} {{$ceo_application->users->lname}}</td>
                                            <td width="10%">{{$ceo_application->nature->name}}</td>
                                            <td width="10%">{{$ceo_application->from->format('d/m/Y').' '.$ceo_application->to->format('d/m/Y')}}</td>
                                            <td width="10%">{{$ceo_application->reason}}</td>
                                            <td width="20%">
                                                {{$ceo_application->ceo_remarks}}
                                                <form action="{{route('leave_application.remarks')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$ceo_application->id}}">
                                                    <input type="hidden" name="approvalno" value="2">
                                                    <textarea type="text" class="form-control" id="reason"
                                                              placeholder="Enter Remarks of Application"
                                                              name="remarks"></textarea>
                                                    <button type="submit" class="btn btn-sm btn-success btn-block">
                                                        Save
                                                    </button>
                                                </form>
                                            </td>
                                            <td width="10%">
                                                <a href="{{url('leave-applications/ceo/reject/'.$ceo_application->id)}}"
                                                   title="Reject" class="btn btn-danger btn-sm"><i
                                                            class="feather icon-x"></i></a>
                                                <a href="{{url('leave-applications/ceo/approve/'.$ceo_application->id)}}"
                                                   title="Accept" class="btn btn-success btn-sm"><i
                                                            class="feather icon-check"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <tr>
                                        <td colspan="5">No Application Approvals by CEO</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @endif
            @endcan

        </div>
        <div class="col-12 mt-2">
            <h4 class="font-weight-light">Events and Deadlines</h4>
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
    @include('dashboard.js')
    <script src="{{url('js/canvasjs.min.js')}}"></script>
@endsection
<style>

    #quoteContainer, #jobContainer {

        height: 300px;
        width: 100%;
    }

    .canvasjs-chart-credit {
        display: none;
    }

    .fc-row.fc-week.fc-widget-content.fc-rigid {
        background-color: white;
    }
</style>

