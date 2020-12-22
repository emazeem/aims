<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master List of Equipments</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style> .font-custom{font-size: 12px;} </style>
</head>
<body>
<div class="container">
    <div class="col-12 font-style mt-2">
        <div class="row custom-border">
            <div class="col-2 text-center custom-border-right">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7  my-auto py-auto">
                <h6 class="text-center" style="margin-top: 10px">
                    MASTER LIST OF EQUIPMENT AND CALIBRATION RECORD
                </h6>
            </div>
            <div class="col-3 row custom-border-left font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-BM-FRM-04,</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 06-10-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>
        </div>
        <div class="row">
            <table class="table table-stripped mt-4 table-sm table-bordered font-custom">
                    <tr>
                        <td>Sr.</td>
                        <td>ID</td>
                        <td>Instrument Name</td>
                        <td>Make</td>
                        <td>Model</td>
                        <td>Serial#</td>
                        {{--<td>Type</td>--}}
                        <td>Loc</td>
                        <td>Commissioned</td>
                        <td>Interval</td>
                        <td>Calibration</td>
                        <td>Next Due</td>
{{--                        <td>Calibration From</td>--}}
                        <td>Certificate#</td>
                        <td>Traceability</td>
                    </tr>
                    @foreach($assets as $asset)
                        <tr>
                            <td>{{$asset->id}}</td>
                            <td>{{$asset->code}}</td>
                            <td>{{$asset->name}}</td>
                            <td>{{$asset->make}}</td>
                            <td>{{$asset->model}}</td>
                            <td>{{$asset->serial_no}}</td>
                            <td>{{$asset->location}}</td>
                            <td>{{$asset->commissioned}}</td>
                            <td>{{$asset->calibration_interval}}</td>
                            <td>{{$asset->calibration}}</td>
                            <td>{{$asset->due}}</td>
                            <td>{{$asset->certificate_no}}</td>
                            <td>{{$asset->traceability}}</td>
                        </tr>
                    @endforeach

                </table>
        </div>
    </div>

</div>
</body>
</html>