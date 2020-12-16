@extends('layouts.master')
@section('content')

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
@endsection
