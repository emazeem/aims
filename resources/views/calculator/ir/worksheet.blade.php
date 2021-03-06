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

        <div class="col-2 text-center custom-border">
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
        <div class="col-6 mt-4">
            <table class="table table-bordered">

                <tbody>
                <tr>
                    <th class="font-11" width="30%">Request #:</th>
                    <td class="font-11" width="70%">{{$quote->details}}</td>
                </tr>
                <tr>
                    <th class="font-11">Job #:</th>
                    <td class="font-11">{{$mainjob->id}}</td>
                </tr>
                <tr>
                    <th class="font-11">Certificate #:</th>
                    <td class="font-11"></td>
                </tr>

                <tr>
                    <th class="font-11" colspan="2">Details of Unit Under Calibration:</th>
                </tr>
                <tr>
                    <th class="font-11">UUC:</th>
                    <td class="font-11">{{$job->item->capabilities->name}}</td>
                </tr>
                <tr>
                    <th class="font-11">Make:</th>
                    <td class="font-11">{{$job->make}}</td>
                </tr>
                <tr>
                    <th class="font-11">Model:</th>
                    <td class="font-11">{{$job->model}}</td>
                </tr>
                <tr>
                    <th class="font-11">Serial#:</th>
                    <td class="font-11">{{$job->serial}}</td>
                </tr>
                <tr>
                    <th class="font-11">Asset/ID#:</th>
                    <td class="font-11">{{$job->eq_id}}</td>
                </tr>
                <tr>
                    <th class="font-11">Accuracy:</th>
                    <td class="font-11">{{$job->accuracy}}</td>
                </tr>
                <tr>
                    <th class="font-11">Cal Range:</th>
                    <td class="font-11">{{$job->range}}</td>
                </tr>
                <tr>
                    <th class="font-11">Resolution:</th>
                    <td class="font-11">{{$job->resolution}}</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-6 mt-4">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" width="30%">Customer Name :</th>
                    <td class="font-11"  width="70%">{{$quote->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th class="font-11">Address :</th>
                    <td class="font-11">{{$quote->customers->address}}</td>
                </tr>

                <tr>
                    <th class="font-11" colspan="2">Environmental Details :</th>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Temperature :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11">{{$entries->start_temp}} C</td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11">{{$entries->end_temp}} C</td>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Humidity :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Atmospheric Pressure :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11"></td>
                </tr>

                </tbody>
            </table>

        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" width="20%">Location :</th>
                    <td class="font-11" width="80%">{{$entries->location}}</td>
                </tr>
                <tr>
                    <th class="font-11">Calibration Date :</th>
                    <td class="font-11">{{date('d-M-y',strtotime($entries->created_at))}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="6">Details of Calibration Standards Used :</th>
                </tr>
                <tr>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                </tr>
                <tr>
                    <?php $i=0; ?>
                    @foreach($assets as $asset)
                         <td class="font-11" width="16%">{{\App\Models\Asset::find($asset)->code}}</td>
                         <?php $i++; ?>
                    @endforeach
                    @for($x=$i;$x < 6; $x++)
                         <td class="font-11" {{($x!=5)?'width="16%"':''}}>-</td>
                    @endfor
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11">Calibration Method(s) Used : <span class="font-weight-normal">{{$job->item->capabilities->procedures->name}} <span class="mx-5"></span>{{$job->item->capabilities->procedures->description}}</span></th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
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

{{--
                @foreach($allentries as $entries)
                @endforeach
--}}
                @foreach($entries->child as $k=>$entry)
                    @if($k==0)
                    <tr class="text-center">
                        <td class="font-11" colspan="50"> ({{\App\Models\Unit::find($entry->unit)->unit}})</td>
                        <td class="font-11" colspan="10" >({{\App\Models\Unit::find($entry->unit)->unit}})</td>
                    </tr>
                    @endif
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
        <div class="col-1"></div>
        <div class="col-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="2">Signatures </th>
                    <th class="font-11">Date </th>
                </tr>
                <tr>
                    <td class="font-11">Calibrated By</td>
                    <td class="font-11">-</td>
                    <td class="font-11">{{date('d-M-y')}}</td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="col-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="2">Signatures </th>
                    <th class="font-11">Date </th>
                </tr>
                <tr>
                    <td class="font-11">Checked By</td>
                    <td class="font-11">-</td>
                    <td class="font-11">{{date('d-M-y')}}</td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>