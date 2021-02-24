<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA SHEET</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<div class="container-fluid wrapper">
    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border" style="margin-left: 15px; margin-right: -15px;">
                <img src="{{url('/img/AIMS.png')}}" class="pl-2 pt-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border">
                <p class="text-center b font-24 mt-4" style="margin-top: 10px">
                    DATA ENTRY SHEET
                </p>
            </div>
            <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">Doc # AIMS-TM-FRM-09</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date: Oct 06, 2016</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 00
                </p>
            </div>
        </div>

        <table class="table table-bordered table-sm mt-3">
            <tr>
                <td colspan="6" class="text-center">Reading on {{($fixed_type=='UUC')?"Ref":$fixed_type}}</td>
                <td class="text-center">Values obs on {{$fixed_type}}</td>
            </tr>
            <tr class="text-center">
                <td>X1</td>
                <td>X2</td>
                <td>X3</td>
                <td>X4</td>
                <td>X5</td>
                <td>Mean</td>
                <td>Fixed Value</td>
                <td>Corrected Value of Std</td>
                <td>Error</td>
                <td>Error of Std</td>
            </tr>

            @foreach($allentries as $entry)
                <tr class="text-center">
                    <td>{{$data[$entry->fixed_value]['x_entries'][0]}}</td>
                    <td>{{$data[$entry->fixed_value]['x_entries'][1]}}</td>
                    <td>{{$data[$entry->fixed_value]['x_entries'][2]}}</td>
                    <td>{{$data[$entry->fixed_value]['x_entries'][3]}}</td>
                    <td>{{$data[$entry->fixed_value]['x_entries'][4]}}</td>
                    <td>{{$data[$entry->fixed_value]['average']}}</td>
                    <td>{{$entry->fixed_value}}</td>
                    <td>{{$data[$entry->fixed_value]['corrected']}}</td>
                    <td>{{$data[$entry->fixed_value]['error']}}</td>
                    <td>{{$data[$entry->fixed_value]['errorofstd']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>