<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trial Balance</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-14 mt-4 text-capitalize">Trial Balance Sheet</p>

            </div>
            <div class="col-3 row custom-border font-9 p-0">
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
        <div class="col-12 text-center">
            <p class="text-center mt-0 pt-0 b">From {{date('d/M/Y',strtotime($dates[0]))}} to {{date('d/M/Y',strtotime($dates[1]))}}</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-xs">Account Code</th>
                    <th class="text-xs">Account Title</th>
                    <th class="text-xs">Dr.</th>
                    <th class="text-xs">Cr.</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{$account->acc_code}}</td>
                        <td>{{$account->title}}</td>
                        <td>
                            @if($entries[$account->acc_code])
                                @if($entries[$account->acc_code]>0)
                                {{$entries[$account->acc_code]}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($entries[$account->acc_code])
                                @if($entries[$account->acc_code]<0)
                                    {{-$entries[$account->acc_code]}}
                                @endif
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row text-center">
            <p class="col-12 mb-5 custom-border font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission of the company.</p>
        </div>
    </div>
</div>
</body>
</html>