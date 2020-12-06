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

<div class="container">
    <div class="row p-">

        <table class="table table-bordered col-12">
            <tbody>
            <tr >
                <th>
                    <div class="row">
                        <div class="col-9 mt-5 pt-5">
                            <h1 class="text-center">ITEM TAG</h1>
                        </div>
                        <div class="col-3">
                            <span class="float-right py-3">{{QrCode::size(200)->generate(route('checkin.create',[$loc,$tag->id]))}}</span>
                        </div>
                    </div>

            </tr>
            <tr>
                <th class="p-3"><h1>Job No : {{$tag->job_id}}</h1></th>
            </tr>
            <tr>
                <th colspan="2" class="p-3"><h1>Item # : {{$index}} of {{$total}}</h1></th>
            </tr>
            <tr>
                <td class="text-center p-0" colspan="3">
                    <h3 class="p-2">Doc # : AIMS-TM-FRM-12 , Rev#: 01</h3>
                </td>
            </tr>
            </tbody>
        </table>
        {{--<div class="col-4">
            {{QrCode::size(340)->generate(route('checkin.create',[$loc,$tag->id]))}}
        </div>--}}
    </div>
</div>
</body>
</html>