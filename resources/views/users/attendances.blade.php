@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif

    <style>
        .attendance-scroll::-webkit-scrollbar {
            height: 5px;
        }

        .attendance-scroll::-webkit-scrollbar-track {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .attendance-scroll::-webkit-scrollbar-thumb {
            background-color: #136bf7;
            outline: 1px solid #136bf7;
        }
    </style>

    <div class="row pb-3">
        <div class="col-12">
            <h3 class=" font-weight-light pb-1"><i class="feather icon-clock"></i> Attendance [ {{date('F - Y',time())}}
                ]</h3>
            <form class="float-right" method="post">
                @csrf
                <div class="float-left col-md-10">
                    <input type="month" class="form-control" name="searchmonth" required>
                </div>
                <div class="float-right col-md-2">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <table id="repTb" class="table table-sm table-bordered table-responsive table-hover table-sm bg-white text-center attendance-scroll">
                <thead>
                <tr>
                    <th class="pb-3">Users</th>
                    @foreach($dates as $date)
                        <th>
                            {{$date[0]}}<br>
                            {{$date[1]}}
                        </th>
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
                                @if(date_format(date_create(date('Y')."-".date('m')."-".$date[0]),"Y-m-d")> date("Y-m-d"))

                                @else
                                    @if(isset($p))
                                        @if($p->leave_id)
                                            L
                                        @else
                                            <p data-toggle="tooltip" data-placement="top" title="{{date('h:i A',strtotime($p->check_in)).'-'.date('h:i A',strtotime($p->check_out))}}">
                                                P
                                            </p>
                                        @endif
                                    @else
                                        A
                                    @endif
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