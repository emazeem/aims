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
                        <ul >
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
            color: rgb(223, 10, 17);
            list-style-type: circle;
        }
        .level-2{
            font-size: 20px;
            font-weight: bold;
            color: black;

            list-style-type: disc;
        }
        .level-3{
            font-size: 20px;
            font-weight: normal;
            color: rgb(223, 10, 17);
            list-style-type: circle;
        }
        .level-4{
            font-size: 18px;
            font-weight: normal;
            color: black;

            list-style-type: disc;
        }
    </style>
@endsection
