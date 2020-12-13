@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h2>Job Detail</h2>
        </div>
        <div class="col-12">
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{$job->id}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($job->status==0)
                            <span class="badge badge-primary">Pending</span>
                        @else
                            <span class="badge badge-primary">Complete</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Quote ID</th>
                    <td>{{$job->quote_id}}</td>
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
                    <th>Customer</th>
                    <td>{{$job->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Turnaround</th>
                    <td>{{$job->quotes->turnaround}}</td>
                </tr>
                <tr>
                    <th>Mode</th>
                    <td>{{$job->quotes->mode}}</td>
                </tr>
            </table>
        </div>

        @if($labjobs)

            <div class="col-12">
                <h4>Lab Detail</h4>
                <table class="table table-hover table-bordered table-responsive table-sm">

                    <thead>
                    <tr>
                        <th class="text-center">Quote ID</th>
                        <th>Equipment ID</th>
                        <th>Serial</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Accessories</th>
                        <th>Visual Inspection</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Started At</th>
                        <th>Ended At</th>
                        <th>Assign User</th>
                        <th>Assign Assets</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $sr=0; @endphp
                    @foreach($labjobs as $labjob)
                        <tr>
                            <?php $sr++ ?>
                            <td class="text-center">
                                Item {{$sr}} of {{count($labjobs)+count($sitejobs)}}<br>
                                <a href="{{url('jobs/print/jobtag/lab/'.$sr.'/'.$labjob->id)}}" class="btn"><i
                                            class="fas fa-qrcode text-danger fa-2x"></i></a>
                            </td>
                            <td>@if($labjob->eq_id){{$labjob->eq_id}}@else ---@endif</td>
                            <td>@if($labjob->serial){{$labjob->serial}}@else ---@endif</td>
                            <td>@if($labjob->make){{$labjob->make}}@else ---@endif</td>
                            <td>@if($labjob->model){{$labjob->model}}@else ---@endif</td>
                            <td>@if($labjob->accessories){{$labjob->accessories}}@else ---@endif</td>
                            <td>@if($labjob->visual_inspection){{$labjob->visual_inspection}}@else ---@endif</td>
                            <td>@if($labjob->start){{$labjob->start}}@else ---@endif</td>
                            <td>@if($labjob->end){{$labjob->end}}@else ---@endif</td>
                            <td>@if($labjob->started_at){{$labjob->started_at}}@else ---@endif</td>
                            <td>@if($labjob->ended_at){{$labjob->ended_at}}@else ---@endif</td>
                            <td>
                                @if($labjob->assign_user)
                                    {{\App\Models\User::find($labjob->assign_user)->fname}}{{\App\Models\User::find($labjob->assign_user)->lname}}
                                @endif
                                    @if($labjob->assign_user)@else ---@endif
                            </td>
                            @php $assets=explode(',',$labjob->assign_assets) @endphp
                            <td>
                                @if($labjob->assign_assets)
                                    @foreach($assets as $asset)
                                        <span class="badge badge-dark">{{\App\Models\Asset::find($asset)->name}}</span>
                                    @endforeach
                                @endif
                                    @if($labjob->assign_assets)@else ---@endif
                            </td>
                            <td>
                                @if($labjob->status==0)
                                    <span class="badge badge-primary">New Entry</span>
                                @elseif($labjob->status==1)
                                    <span class="badge badge-danger">Checked-in</span>
                                @elseif($labjob->status==2)
                                    <span class="badge badge-success">Assigned</span>
                                @elseif($labjob->status==3)
                                    <span class="badge badge-success">Started</span>
                                @elseif($labjob->status==4)
                                    <span class="badge badge-success">Calculated</span>
                                @elseif($labjob->status==5)
                                    <span class="badge badge-success">Ended</span>
                                @endif
                                <br>
                                <span class="text-center col-12">
                                        <a href="#" data-id="{{$labjob->id}}" data-type="lab"
                                           class="btn scan btn-primary mt-1 btn-sm"><i class="fa fa-search"></i></a>
                                    </span>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endif
        @if(count($sitejobs)>0)
            <div class="col-12">
                <h4>Site Detail</h4>
                <table class="table table-hover table-bordered table-responsive table-sm">
                    <thead>
                    <tr>
                        <th>Quote ID</th>
                        <th>Equipment ID</th>
                        <th>Model</th>
                        <th>Visual Inspection</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Started At</th>
                        <th>Ended At</th>
                        <th>Assign Assets</th>
                        <th>Assign User</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    @foreach($sitejobs as $sitejob)
                        <tbody>
                        <tr>
                            <td>{{$sitejob->jobs->quote_id}}</td>
                            <td>@if($sitejob->eq_id){{$sitejob->eq_id}}@else ---@endif</td>
                            <td>@if($sitejob->model){{$sitejob->model}}@else ---@endif</td>
                            <td>@if($sitejob->visual_inspection){{$sitejob->visual_inspection}}@else ---@endif</td>
                            <td>@if($sitejob->start){{$sitejob->start}}@else ---@endif</td>
                            <td>@if($sitejob->end){{$sitejob->end}}@else ---@endif</td>
                            <td>@if($sitejob->started_at){{$sitejob->started_at}}@else ---@endif</td>
                            <td>@if($sitejob->ended_at){{$sitejob->ended_at}}@else ---@endif</td>
                            <td>@if($sitejob->assign_assets){{$sitejob->assign_assets}}@else ---@endif</td>
                            <td>@if($sitejob->assign_user){{$sitejob->assign_user}}@else ---@endif</td>
                            <td>
                                @if($sitejob->status==0)
                                    <span class="badge badge-primary">New Entry</span>
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
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>

                @foreach($sitejobs as $sitejob)
                    <h4>All Assets</h4>
                    @php $all_assets=explode(',',$sitejob->group_assets); @endphp
                    @if(isset($sitejob->group_assets))
                        @foreach($all_assets as $asset)
                            <div class="col-12">
                                <li>{{\App\Models\Asset::find($asset)->name}}
                                    ( {{\App\Models\Asset::find($asset)->code}} )
                                </li>
                            </div>
                        @endforeach
                    @endif
                    <h4>All Users</h4>

                    @php $all_users=explode(',',$sitejob->group_users); @endphp
                    @if(isset($sitejob->group_users))

                        @foreach($all_users as $user)
                            <div class="col-12">
                                <li>{{\App\Models\User::find($user)->fname}} {{\App\Models\User::find($user)->lname}}</li>
                            </div>
                        @endforeach

                    @endif
                    @break
                @endforeach

            </div>

        @endif


    </div>
    <script>
        $(document).ready(function () {
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
            $("#add_details_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (!data.errors) {
                            $('#add_details').modal('toggle');
                            swal('success', data.success, 'success').then((value) => {
                                location.reload();
                            });

                        }
                    },
                    error: function (xhr, status, error) {
                        var error;
                        error = null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    },
                });
            }));
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

@endsection