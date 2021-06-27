<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Tag</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="main">
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-2 text-center">
            {{QrCode::size(500)->generate('Serial # '.$tag->id)}}
            <h1>Serial # {{str_pad($tag->id, 10, '0', STR_PAD_LEFT)}}</h1>
        </div>
    </div>
</div>
</body>
</html>