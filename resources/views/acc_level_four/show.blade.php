@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif


    <div class="row ">
        <h1 class="border-bottom pull-left"><i class="fa fa-money"></i> Chart of Account</h1>
        <div class="col-12">
            <ul>
                @foreach($accounts as $account)
                    <li class="level-1">{{$account->title}}</li>
                        <ul>
                            @foreach($account->leveltwo as $leveltwo)
                                <li class="level-2">{{$leveltwo->title}}</li>
                                    <ul class="nested">
                                        @foreach($leveltwo->levelthree as $levelthree)
                                            <li class="level-3">{{$levelthree->title}}</li>
                                            <ul>
                                            @foreach($levelthree->levelfour as $chart)
                                                    <li class="level-4">{{$chart->title}}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                            @endforeach
                        </ul>
                @endforeach
            </ul>
        </div>
    </div>
    <style>
        .level-1{
            font-size: 22px;
            font-weight: bolder;
            color: black;
        }
        .level-2{
            font-size: 20px;
            font-weight: bold;
            color: rgb(0, 8, 122);
        }
        .level-3{
            font-size: 20px;
            font-weight: normal;
            color: rgb(0, 8, 167);
        }
        .level-4{
            font-size: 18px;
            font-weight: normal;
            color: rgb(27, 121, 255);
        }
    </style>
@endsection
