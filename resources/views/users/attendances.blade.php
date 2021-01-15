@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif

    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-clock-o"></i> Attendance [ {{date('F - Y',time())}} ]</h3>
            <form class="pull-right" method="post" >
                @csrf
                <div class="pull-left col-md-10">
                    <input type="month" class="form-control" name="searchmonth" required>
                </div>
                <div class="pull-right col-md-2">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-responsive table-hover table-sm bg-white text-center">
                <thead>
                <tr>
                    <th>Users</th>
                    @foreach($dates as $date)
                        <td>
                            {{$date[0]}}<br>
                            {{$date[1]}}
                        </td>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>{{$user->user->fname.' '.$user->user->lname}}</th>
                        @foreach($dates as $date)
                            @php
                                $p=\App\Models\Attendance::where('user_id',$user->user_id)->where('check_in_date',date_format(date_create(date('Y')."-".date('m')."-".$date[0]),"Y-m-d"))->first();
                            @endphp
                            <td>
                                @if(!empty($p))
                                P
                                @else
                                    A
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection