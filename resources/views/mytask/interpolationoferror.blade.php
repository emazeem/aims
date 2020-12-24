<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WORKSHEET</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <div class="col-2 text-center custom-border" style="margin-left: 15px;margin-right: -15px;">
                <img src="{{asset('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
        <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 10px">Calibration Worksheet
                    <br>
                    ( {{$job->item->capabilities->parameters->name}} )
                </p>
            </div>
        <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-TM-FRM-09a</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 01-01-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>
        <div class="col-12 mt-2">
            <table class="table table-bordered ">
                <tbody>
                <colgroup>
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                </colgroup>
                <tr>
                    <th class="font-11" colspan='60'>Measured Observations :</th>
                </tr>
                <tr>
                    <td class="font-11"  colspan='15'>Cal. Range :</td>
                    <td class="font-11"  colspan='15'>{{$job->range}}</td>
                    <td class="font-11"  colspan='15'>Accuracy of UUC :</td>
                    <td class="font-11"  colspan='15'>{{$job->accuracy}}</td>
                </tr>
                <tr>
                    <td class="font-11" colspan="30">Resolution / Readability of UUC :</td>
                    <td class="font-11" colspan="30">{{$job->resolution}}</td>
                </tr>
                <tr>
                    <td class="font-11" colspan="12">Offset of UUC :</td>
                    <td class="font-11" colspan="12">Before Adjustment</td>
                    <td class="font-11" colspan="12">{{$entries->before_offset}}</td>
                    <td class="font-11" colspan="12">After Adjustment</td>
                    <td class="font-11" colspan="12">{{$entries->after_offset}}</td>
                </tr>
                <tr>
                    <th class="font-11 text-center py-2" colspan="50" >Readings on the
                        @if($entries->fixed_type=='UUC')
                            Reference Standard
                        @else
                            UUC
                        @endif
                        :</th>
                    <th class="font-11 text-center" colspan="10" rowspan="2" >Reading on <br> ( {{$entries->fixed_type}} )</th>
                </tr>

                <tr>
                    <td class="font-11 text-center" colspan="10">x1 ↓</td>
                    <td class="font-11 text-center" colspan="10">x2 ↑</td>
                    <td class="font-11 text-center" colspan="10">x3 ↓</td>
                    <td class="font-11 text-center" colspan="10">x4 ↑</td>
                    <td class="font-11 text-center" colspan="10">x5 ↓</td>
                </tr>
                <tr class="text-center">
                    <td class="font-11" colspan="50"> ({{\App\Models\Unit::find($entries->unit)->unit}}) </td>
                    <td class="font-11" colspan="10" >({{\App\Models\Unit::find($entries->unit)->unit}})</td>
                </tr>
                @foreach($entries->child as $entry)
                    <tr>
                        <td class="font-11 text-center" colspan="10">{{$entry->x1}}</td>
                        <td class="font-11 text-center" colspan="10">{{$entry->x2}}</td>
                        <td class="font-11 text-center" colspan="10">{{$entry->x3}}</td>
                        <td class="font-11 text-center" colspan="10">{{$entry->x4}}</td>
                        <td class="font-11 text-center" colspan="10">{{$entry->x5}}</td>
                        <td class="font-11 text-center" colspan="10">{{$entry->fixed_value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>