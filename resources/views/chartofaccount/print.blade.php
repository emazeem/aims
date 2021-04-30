
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AIMS- Chart of Account</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style> .font-custom{font-size: 12px;} </style>
</head>
<body>
<div class="container">
    <div class="col-12 font-style mt-2">
        <div class="row custom-border">
            <div class="col-2 text-center custom-border-right">
                <img src="{{url('/img/AIMS.png')}}" width="80" class="img-fluid p-1">
            </div>
            <div class="col-10  my-auto py-auto">
                <h3 class="text-center" style="margin-top: 10px">
                    CHART OF ACCOUNT
                </h3>
            </div>

        </div>
        <div class="row ">
            <div class="col-12">
                <ul>
                    @foreach($accounts as $account)
                        <li class="level-1">{{$account->title}}</li>
                        <ul >
                            @foreach($account->leveltwo as $leveltwo)
                                <li class="level-2">{{$leveltwo->title}}</li>
                                <ul class="nested">
                                    @foreach($leveltwo->levelthree as $levelthree)
                                        <li class="level-3"> ({{$levelthree->id}}) {{$levelthree->title}}</li>
                                        <ul>
                                            @foreach($levelthree->levelfour as $chart)
                                                <li class="level-4">
                                                    {{$chart->acc_code}}-{{$chart->title}}
                                                </li>
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

    </div>

</div>
</body>
</html>
