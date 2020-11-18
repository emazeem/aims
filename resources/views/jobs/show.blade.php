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
            <table class="table table-bordered table-striped table-sm">
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
                <table class="table table-striped table-responsive table-sm ">
                    <thead>
                    <tr>
                        <th>Quote ID</th>
                        <th>Equipment ID</th>
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
                    @foreach($labjobs as $labjob)
                        <tr>
                            <td>{{$labjob->jobs->quote_id}}</td>
                            <td>{{$labjob->eq_id}}</td>
                            <td>{{$labjob->model}}</td>
                            <td>{{$labjob->accessories}}</td>
                            <td>{{$labjob->visual_inspection}}</td>
                            <td>{{$labjob->start}}</td>
                            <td>{{$labjob->end}}</td>
                            <td>{{$labjob->started_at}}</td>
                            <td>{{$labjob->ended_at}}</td>
                            <td>
                                @if($labjob->assign_user)
                                    {{\App\Models\User::find($labjob->assign_user)->fname}}{{\App\Models\User::find($labjob->assign_user)->lname}}
                                @endif

                            </td>
                            @php $assets=explode(',',$labjob->assign_assets) @endphp
                            <td>
                                @if($labjob->assign_assets)
                                    @foreach($assets as $asset)
                                        <li>{{\App\Models\Asset::find($asset)->name}}</li>
                                    @endforeach
                                @endif
                            </td>

                            <td>{{$labjob->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endif
        @if(count($sitejobs)>0)
            <div class="col-12">
                <h4>Site Detail</h4>
            </div>
            <table class="table table-striped table-responsive">
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
                        <td>{{$sitejob->eq_id}}</td>
                        <td>{{$sitejob->model}}</td>
                        <td>{{$sitejob->visual_inspection}}</td>
                        <td>{{$sitejob->start}}</td>
                        <td>{{$sitejob->end}}</td>
                        <td>{{$sitejob->started_at}}</td>
                        <td>{{$sitejob->ended_at}}</td>
                        <td>{{$sitejob->assign_assets}}</td>
                        <td>{{$sitejob->assign_user}}</td>
                        <td>{{$sitejob->status}}</td>
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
                        <li>{{\App\Models\Asset::find($asset)->name}} ( {{\App\Models\Asset::find($asset)->code}} )</li>
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

        @endif


    </div>
@endsection