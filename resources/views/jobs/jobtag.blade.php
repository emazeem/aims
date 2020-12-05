<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Tag</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="main">
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
<style>
    @media print
    {
        @page {
            size: 25.4mm 50.8mm; /* DIN A4 standard, Europe */
            margin:0;
        }
        html, body {
            width: 50.8mm;
            /* height: 297mm; */
            height: 25.4mm;
            background: #ff00f9;
            overflow:visible;
        }
    }
</style>
<div class="container">
    <div class="col-12 font-style vertical-center">
        <div class="col-5 m-auto" id="printarea">

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th colspan="2"  class="text-center pt-3 pb-1"> ITEM TAG</th>
                    <td rowspan="3" class="text-center m-0 py-4">
                        {{QrCode::size(100)->generate(route('checkin.create',[$loc,$tag->id]))}}
                    </td>
                </tr>
                <tr>
                    <th class="pt-2">Job No :  {{$tag->job_id}}</th>
                </tr>
                <tr>
                    <th class="pt-2" colspan="2">Item # : {{$index}}<span class="px-md-4"></span> of<span class="px-md-4"></span>  {{$total}}</th>
                </tr>
                </tbody>
            </table>
            <p class="text-center"><small>Doc # : AIMS-TM-FRM-12 , Rev#: 01</small></p>
        </div>
    </div>
</div>
</body>
</html>