@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light"><i class="feather icon-eye"></i> Job Detail</h3>
            <div class="float-right">
                <a onclick="window.open('{{url('/jobs/print/jobform/'.$job->id)}}','newwindow','width=1100,height=1000');return false;"
                   href="{{url('/jobs/print/jobform/'.$job->id)}}" title='Print' class='pull-left btn btn-sm btn-info'><i
                            class="fa fa-print"></i> JN</a>
                <a onclick="window.open('{{url('/jobs/print/DN/'.$job->id)}}','newwindow','width=1100,height=1000');return false;"
                   href="{{url('/jobs/print/DN/'.$job->id)}}" title='Print' class='pull-left btn btn-sm btn-info'><i
                            class="fa fa-print"></i> DN</a>
                @if(count($ifassigned)>0)
                <a title='Gatepass' onclick="window.open('{{url('/jobs/print/GP/'.$job->id)}}','newwindow','width=1100,height=1000');return false;"
                    class='btn btn-sm btn-info' href="{{url('jobs/print/GP/'.$job->id)}}"><i class="fa fa-print"></i> GP</a>
                @endif
            </div>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered table-sm bg-white">
                <tr>
                    <th>ID</th>
                    <td>{{$job->cid}}</td>
                </tr>
                <tr>
                    <th>Quote ID</th>
                    <td>{{$job->quotes->cid}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$job->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($job->status==0)
                            <span class="badge badge-primary px-2 py-1">Pending</span>
                        @else
                            <span class="badge badge-primary px-2 py-1">Complete</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                        @if($labjobs->count()>0 and $sitejobs->count()==0)
                            LAB
                        @elseif($labjobs->count()==0 and $sitejobs->count()>0)
                            SITE
                        @else
                            LAB+SITE
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Turnaround</th>
                    <td>{{$job->quotes->turnaround}} Days</td>
                </tr>
            </table>
        </div>
        @include('jobs.create')
    </div>
    <script>
        'use strict';
        $(document).ready(function () {


            $('.select-2-users').select2();
            $('.select-2-asset').select2();

            $(document).on('click', '.assign-lab-task', function () {
                var id = $(this).attr('data-id');

                $('#assign-lab-task').modal('show');
                $('#lab_task_id').val(id);
            });
            $(document).on('click', '.scan', function () {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $('#scan_id').val(id);
                $('#scan_type').val(type);
                $('#scan').modal('toggle');
                $('#scan').on('shown.bs.modal', function () {
                    $('#scan_url').focus();
                });
            });
            $('#scan_url').change(function () {
                setTimeout(function () {
                    //var data = JSON.stringify( $('#scan_form').serializeArray() );
                    var data = $("#scan_form").serializeArray();
                    var type = null;
                    var id = null;
                    var url = null;
                    $.each(data, function (i, fields) {
                        if (fields.name == 'type') {
                            type = fields.value;
                        }
                        if (fields.name == 'id') {
                            id = fields.value;
                        }
                        if (fields.name == 'url') {
                            url = fields.value;
                        }
                        //console.log(fields.name + ":" + fields.value + " ");
                    });

                    window.location.href = 'https://' + url + '/' + type + '/' + id;
                }, 2000);
            });

        });
    </script>
    <div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Scan your Equipment</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="scan_form">
                        @csrf
                        <input type="text" value="" name="type" id="scan_type" class="form-control" hidden>
                        <input type="text" value="" name="id" id="scan_id" class="form-control" hidden>
                        <input type="text" value="" class="form-control" id="scan_url" name="url">
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @include('tasks.labjob')


    <div class="x_content">

        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lab-tab" data-toggle="tab" href="#lab" role="tab" aria-controls="home" aria-selected="true">Lab Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="site-tab" data-toggle="tab" href="#site" role="tab" aria-controls="profile" aria-selected="false">Site Items</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="lab" role="tabpanel" aria-labelledby="lab-tab">
                @if(count($labjobs)>0)
                    <div class="col-12">
                        @php $sr=0; @endphp
                        <div class="row">
                            @foreach($labjobs as $labjob)
                                <div class="col-md-4 col-12 mt-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#" data-id="{{$labjob->id}}" data-type="lab"
                                               class="btn btn-light border btn-sm scan"><i class="fa fa-search"></i></a>
                                            <button type="button" data-id="{{$labjob->id}}" class="btn btn-sm btn-light border pull-right assign-lab-task"><i class="fa fa-plus-square"></i> Assign</button>
                                            @if($labjob->status>0)
                                                <a href="#" data-id="{{$labjob->id}}" class="btn edit btn-light border btn-sm"><i class="fa fa-edit"></i> Receiving</a>
                                            @elseif($labjob->status==0)
                                                <a href="#" data-id="{{$labjob->id}}" class="btn add btn-light border btn-sm"><i class="fa fa-plus"></i> Receiving</a>
                                            @endif

                                        </div>
                                        <div class="card-body">

                                            <p class="m-0">↪ <b>Status : </b>
                                                @if($labjob->status==0)

                                                    <span class="badge badge-primary">Pending</span>
                                                @elseif($labjob->status==1)

                                                    <span class="badge badge-danger">Checked-in</span>
                                                @elseif($labjob->status==2)

                                                    <span class="badge badge-success">Assigned</span>
                                                @elseif($labjob->status==3)
                                                    <span class="badge badge-success">Started</span>
                                                @elseif($labjob->status==4)
                                                    <span class="badge badge-success">Ended</span>
{{--                                                    <span class="badge badge-success">Calculated</span>--}}
                                                @elseif($labjob->status==5)
                                                    <span class="badge badge-success">Ended</span>
                                                @endif
                                            </p>

                                            <p class="m-0">↪ <b>Parameter : </b>{{\App\Models\Parameter::find($labjob->item->parameter)->name}}</p>
                                            <p class="m-0">↪ <b>Capability : </b>{{\App\Models\Capabilities::find($labjob->item->capability)->name}}</p>
                                            <p class="m-0">↪ <b>Range : </b>{{$labjob->item->range}}</p>
                                            <p class="m-0">↪ <b>Accredited : </b>{{$labjob->item->accredited}}</p>
                                            @if($labjob->cid)
                                                <p class="m-0">↪ <b>Certificate # : </b>{{$labjob->cid}}</p>
                                            @endif
                                            @if($labjob->status<1)
                                                <span class="badge badge-info px-3 py-2 m-1">Waiting for store entry</span>
                                            @else
                                                <p class="m-0">↪ <b>Equipment ID : </b>{{$labjob->eq_id}}</p>
                                                <p class="m-0">↪ <b>Serial : </b>{{$labjob->serial}}</p>
                                                <p class="m-0">↪ <b>Make : </b>{{$labjob->make}}</p>
                                                <p class="m-0">↪ <b>Model : </b>{{$labjob->model}}</p>
                                                <p class="m-0">↪ <b>Accessories : </b>{{$labjob->accessories}}</p>
                                                <p class="m-0">↪ <b>Visual Inspection : </b>{{$labjob->eq_id}}</p>
                                            @endif
                                            @if($labjob->status<2)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Assigned yet</span>
                                            @else
                                                <p class="m-0">↪ <b>Start : </b>{{$labjob->start}}</p>
                                                <p class="m-0">↪ <b>End : </b>{{$labjob->end}}</p>
                                                <p class="m-0">↪ <b>Assign User : </b>
                                                @if($labjob->assign_user)
                                                    {{\App\Models\User::find($labjob->assign_user)->fname}}{{\App\Models\User::find($labjob->assign_user)->lname}}
                                                @endif
                                            </p>
                                                <p class="m-0">↪ <b>Assign Asset : </b>
                                                <br>
                                                @if($labjob->assign_assets)
                                                    @php $assets=explode(',',$labjob->assign_assets); @endphp
                                                    @foreach($assets as $asset)
                                                        <span class="badge border py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                                    @endforeach
                                                @endif

                                            </p>
                                            @endif
                                            @if($labjob->status<3)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Started yet</span>

                                            @else
                                                <p class="m-0">↪ <b>Started : </b>{{$labjob->started_at}}</p>
                                            @endif
                                            @if($labjob->status<5)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Ended yet</span>
                                            @else
                                                <p class="m-0">↪ <b>Ended : </b>{{$labjob->ended_at}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


            </div>
            <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                @if(count($sitejobs)>0)
                    <div class="row">
                        <div class="col-12 mt-2">
                            <a href="{{route('tasks.site_assign',[$job->id])}}" title='Assign Site Job' class='btn btn-sm btn-light border assign-site float-right'> <i class="fa fa-plus-square"></i> Assign</a>
                            @foreach($sitejobs as $sitejob)
                                @php $all_assets=explode(',',$sitejob->group_assets); @endphp
                                @if(isset($sitejob->group_assets))
                                    <h5 class="font-weight-light">Assets Assigned</h5>
                                @foreach($all_assets as $asset)
                                        <span class="badge border px-3 bg-white py-2 m-1">
                                        {{\App\Models\Asset::find($asset)->name}} ( {{\App\Models\Asset::find($asset)->code}} )
                                        </span>
                                    @endforeach
                                @endif


                                @php $all_users=explode(',',$sitejob->group_users); @endphp
                                @if(isset($sitejob->group_users))
                                    <h5 class="font-weight-light">Assigned Users</h5>
                                    @foreach($all_users as $user)
                                        <span class="badge border px-3 bg-white py-2 m-1">
                                        {{\App\Models\User::find($user)->fname}} {{\App\Models\User::find($user)->lname}}
                                        </span>
                                    @endforeach

                                @endif
                                @break
                            @endforeach
                        </div>
                    @foreach($sitejobs as $sitejob)
                            <div class="col-md-4 col-12 mt-1">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#" data-id="{{$sitejob->id}}" data-type="lab" class="btn btn-light border btn-sm scan"><i class="fa fa-search"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0">↪ <b>Parameter : </b>{{\App\Models\Parameter::find($sitejob->item->parameter)->name}}</p>
                                        <p class="m-0">↪ <b>Capability : </b>{{\App\Models\Capabilities::find($sitejob->item->capability)->name}}</p>
                                        <p class="m-0">↪ <b>Range : </b>{{$sitejob->item->range}}</p>
                                        <p class="m-0">↪ <b>Accredited : </b>{{$sitejob->item->accredited}}</p>
                                        <p class="m-0">↪ <b>Status : </b>
                                            @if($sitejob->status==0)
                                                <span class="badge badge-primary">Pending</span>
                                            @elseif($sitejob->status==1)
                                                <span class="badge badge-success">Assigned</span>
                                            @elseif($sitejob->status==2)
                                                <span class="badge badge-danger">Checked-in</span>
                                            @elseif($sitejob->status==3)
                                                <span class="badge badge-success">Started</span>
                                            @elseif($sitejob->status==4)
                                                <span class="badge badge-success">Calculated</span>
                                            @elseif($sitejob->status==5)
                                                <span class="badge badge-success">Ended</span>
                                            @endif
                                        </p>
                                        @if($sitejob->status<1)
                                            <span class="badge badge-info px-3 py-2 m-1">Waiting for store entry</span>
                                        @else
                                            <p class="m-0">↪ <b>Equipment ID : </b>{{$sitejob->eq_id}}</p>
                                            <p class="m-0">↪ <b>Serial : </b>{{$sitejob->serial}}</p>
                                            <p class="m-0">↪ <b>Make : </b>{{$sitejob->make}}</p>
                                            <p class="m-0">↪ <b>Model : </b>{{$sitejob->model}}</p>
                                            <p class="m-0">↪ <b>Accessories : </b>{{$sitejob->accessories}}</p>
                                            <p class="m-0">↪ <b>Visual Inspection : </b>{{$sitejob->eq_id}}</p>
                                        @endif


                                        @if($sitejob->status<2)
                                            <span class="badge badge-info px-3 py-2 m-1">Not Assigned yet</span>
                                        @else
                                            <p class="m-0">↪ <b>Start : </b>{{$sitejob->start}}</p>
                                            <p class="m-0">↪ <b>End : </b>{{$sitejob->end}}</p>
                                            <p class="m-0">↪ <b>Assign User : </b>
                                                @if($labjob->assign_user)
                                                    {{\App\Models\User::find($sitejob->assign_user)->fname}}{{\App\Models\User::find($sitejob->assign_user)->lname}}
                                                @endif
                                            </p>
                                            <p class="m-0">↪ <b>Assign Asset : </b>
                                                <br>
                                                @if($sitejob->assign_assets)
                                                    @php $assets=explode(',',$sitejob->assign_assets); @endphp
                                                    @foreach($assets as $asset)
                                                        <span class="badge badge-info py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                                    @endforeach
                                                @endif

                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                @endif
            </div>
        </div>
    </div>
@endsection