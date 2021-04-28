<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher</title>
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
                <p class="text-center b font-14 mt-5 text-capitalize">
                    {{str_replace('-',' ',$show->type)}}
                </p>
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
        <div class="row py-3">
            <div class="col-6 my-1 font-11 ">Voucher # : <span class="custom-bottom-border px-5">{{$show->customize_id}}</span></div>
            <div class="col-6 my-1 font-11 ">Date : <span class="custom-bottom-border px-5">{{$show->date->format('d-m-Y')}}</span></div>
        </div>
        <div class="row mt-5 pt-5">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-xs">Sr#</th>
                    <th class="text-xs">Account Code</th>
                    <th class="text-xs">Account Description & Narration</th>
                    <th class="text-xs">Cost Center</th>
                    <th class="text-xs">Dr.</th>
                    <th class="text-xs">Cr.</th>
                </tr>
                </thead>
                <tbody>
                @php $dr=0;$cr=0; @endphp
                @foreach($show->details as $k=>$detail)
                    <tr>
                        <td class="font-11">{{$k+1}}</td>
                        <td class="font-11">{{$detail->account->acc_code}}</td>
                        <td class="font-11"><b>{{$detail->account->title}}</b><br>
                            {{$detail->narration}}
                        </td>
                        <td class="font-11">{{$detail->cc->title}}</td>
                        <td class="font-11">{{$detail->dr}}</td>
                        <td class="font-11">{{$detail->cr}}</td>
                    </tr>
                    @php $dr=$dr+$detail->dr;$cr=$cr+$detail->cr; @endphp
                @endforeach
                <tr>
                <th class="border-0" colspan="4"></th>
                <th>{{$dr}}</th>
                <th>{{$cr}}</th>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row py-3">
            <div class="col-4 my-1 font-11 ">Prepared by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Checked by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Approved by : <span class="custom-bottom-border px-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
        </div>

        <div class="row text-center">
            <p class="col-12 mb-5 custom-border font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission of the company.</p>
        </div>


    </div>
</div>
</body>
</html>