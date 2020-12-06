<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Tag</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="main">
{{--
<style>
    .container {
        height: 100vh;
        position: relative;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
</style>
--}}
<style>

    .font-1{
        font-size: 100px;
    }
    .font-2{
        font-size: 80px;
    }
    .font-3{
        font-size: 55px;
    }


</style>
<div class="container">
    <div class="row">
        <div class="col-8 p-1">
            <h1 class="text-center font-1">ITEM TAG</h1>
            <h1 class="font-2">Job No : {{$tag->job_id}}</h1>
            <h1 class="font-2">Item # : {{$index}} of {{$total}}</h1>
            <h3 class="p-2 font-3">AIMS-TM-FRM-12 R#01</h3>
        </div>
        <div class="col-4">
            <span class="float-right py-3">{{QrCode::size(375)->generate(route('checkin.create',[$loc,$tag->id]))}}</span>
        </div>
    </div>
</div>
</body>
</html>