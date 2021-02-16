<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>General Ledger</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-14 mt-4 text-capitalize">
                    Income Statement
                </p>
                <p class="text-center mt-0 pt-0">FROM 01-01-2019 to 01-02-2021</p>
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
{{--        <div class="row py-3">
            <div class="col-6 my-1 font-11 ">Voucher # : <span class="custom-bottom-border px-5">{{$show->customize_id}}</span></div>
            <div class="col-6 my-1 font-11 ">Date : <span class="custom-bottom-border px-5">{{$show->v_date->format('d-m-Y')}}</span></div>
        </div>--}}
        <div class="col-12 text-center">
            <p class=" font-14 b mt-3"></p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-xs">Account Code</th>
                    <th class="text-xs">Narration</th>
                    <th class="text-xs">Dr.</th>
                    <th class="text-xs">Cr.</th>
                    <th class="text-xs">Balance</th>
                </tr>
                </thead>
                <tbody>
                @foreach($entries as $entry)
                    <tr>
                        <td class="text-center">{{$entry->date}}</td>
                        <td class="text-xs">{{$entry->acc_code}}</td>
                        <td class="text-xs">{{$entry->narration}}</td>
                        <td class="text-xs">{{$entry->dr}}</td>
                        <td class="text-xs">{{$entry->cr}}</td>
                        <td class="text-xs">-</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

{{--
        <div class="row py-3">
            <div class="col-4 my-1 font-11 ">Prepared by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Checked by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Approved by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
        </div>
--}}

        <div class="row text-center">
            <p class="col-12 mb-5 custom-border font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission of the company.</p>
        </div>


    </div>
</div>
</body>
</html>