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

        .table-light td, .table-light th{
            padding: 4px !important;
        }
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
            <h3 class=" font-weight-light pb-1 float-left"><i class="feather icon-clock"></i> Attendance [ {{date('F - Y',time())}}
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
        <div class="col-12 mt-3 table-responsive">
            <table id="repTb" class="table table-light table-sm table-bordered table-hover text-center attendance-scroll">
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
                            <th>
                                @if(date_format(date_create(date('Y')."-".date('m')."-".$date[0]),"Y-m-d")> date("Y-m-d"))

                                @else
                                    @if(isset($p))
                                        @if($p->leave_id)
                                            <span class="text-warning">L</span>
                                        @else
                                            <p data-toggle="tooltip" data-placement="top" title="{{date('h:i A',strtotime($p->check_in)).'-'.date('h:i A',strtotime($p->check_out))}}">
                                                P
                                            </p>
                                        @endif
                                    @else
                                        <span class="text-danger">A</span>
                                    @endif
                                @endif
                            </th>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection