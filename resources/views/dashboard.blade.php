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
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-home"></i> Dashboard</h3>

        </div>
        <div class="col-md-12">
            <div class="">
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


        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Purchase Indent Revisions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled msg_list col-12">
                        <table class="table table-hover font-13 bg-white">
                            <?php $count=0;?>
                        @foreach($indentforrevisions as $indentforrevision)
                            @foreach($indentforrevision->indent_items as $item)
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->item_code}}</td>
                                        <td>{{$item->purpose}}</td>
                                        <td>{{$item->item_description}}</td>
                                        <td>{{$item->ref_code}}</td>
                                        <td>{{$item->unit}}</td>
                                        <td>{{$item->last_six_months_consumption}}</td>
                                        <td>{{$item->current_stock}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>
                                            <a href="{{url('purchase_indent/item/revision/reject/'.$item->id)}}" title="Reject" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
                                            <a href="{{url('purchase_indent/item/revision/approve/'.$item->id)}}" title="Accept" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        </td>
                                    </tr>
                                        <?php $count=$count+1;?>
                                @endforeach
                            @endforeach
                            @if($count==0)
                                    <i>No Purchase indent items to review</i>
                            @endif
                        </table>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Purchase Indent Approvals</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled msg_list col-12">
                        <table class="table table-hover font-13 bg-white">
                            <?php $count=0;?>
                        @foreach($indentforapprovals as $indentforapproval)
                            @foreach($indentforapproval->indent_items as $item)
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->item_code}}</td>
                                        <td>{{$item->purpose}}</td>
                                        <td>{{$item->item_description}}</td>
                                        <td>{{$item->ref_code}}</td>
                                        <td>{{$item->unit}}</td>
                                        <td>{{$item->last_six_months_consumption}}</td>
                                        <td>{{$item->current_stock}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>
                                            <a href="{{url('purchase_indent/item/approval/reject/'.$item->id)}}" title="Reject" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
                                            <a href="{{url('purchase_indent/item/approval/approve/'.$item->id)}}" title="Accept" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        </td>
                                    </tr>
                                        <?php $count=$count+1;?>
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

        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Events and Deadlines</h2>
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

@endsection
