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
        font-size: 110px;
    }
    .font-2{
        font-size: 100px;
    }
    .font-4{
        font-size: 90px;
    }

    .font-3{
        font-size: 70px;
    }


</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-6 p-0 m-0">
            <h1 class="font-1 p-0 m-0">ITEM TAG</h1>
            <h1 class="font-2 p-0 m-0">Job # {{$tag->job_id}}</h1>
            <h1 class="font-4 p-0 m-0">Item # {{$index}} of {{$total}}</h1>
            <h3 class="font-3 p-0 m-0">AIMS-TM-FRM-12 R#01</h3>
        </div>
        <div class="col-6 p-0 m-0">
            {{QrCode::size(500)->generate('Item # 01 , Job # 001 , Asset ID / Serial # 34728934')}}
        </div>
    </div>
</div>
</body>
</html>