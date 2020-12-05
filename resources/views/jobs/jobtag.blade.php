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
    @media print {
        @page {
            size: 25.4mm 50.8mm; /* DIN A4 standard, Europe */
            margin: 0;
        }
        html, body {
            background: #ff00f9;
            overflow: visible;
        }
        body * ,.sticker-size *{
            visibility: hidden;
        }
        .sticker-size, .sticker-size * {
            visibility: visible;
        }
    }
    .sticker-size {
        width: 50.8mm;
        height: 25.4mm;
        font-size: 10px;
    }
</style>
<div class="container">


    <table class="table table-bordered sticker-size">
        <tbody>
        <tr>
            <th colspan="2" class="text-center"> ITEM TAG</th>
            <td rowspan="3" class="text-center py-3">
                {{QrCode::size(30)->generate(route('checkin.create',[$loc,$tag->id]))}}
            </td>
        </tr>
        <tr>
            <th>Job No : {{$tag->job_id}}</th>
        </tr>
        <tr>
            <th colspan="2">Item # : {{$index}} of {{$total}}</th>
        </tr>
        <tr>
            <td class="text-center p-0" colspan="3">
                <small>Doc # : AIMS-TM-FRM-12 , Rev#: 01</small>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>