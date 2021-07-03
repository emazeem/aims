<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>General Ledger</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center border border-dark border-right-0 p-2">
                <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-10 border border-dark  p-2" >
                <h1 class="text-center b font-14 mt-4 text-capitalize">
                    General Ledger
                </h1>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12 mb-2">
                @if($dates)
                    <span class="h4 border-dark border-bottom">From {{date('d-M Y',strtotime($dates[0]))}} to {{date('d-M Y',strtotime($dates[1]))}}</span>
                @endif
            </div>

            <div class="col-3"><p> <b>A/C CODE</b> : {{$account->acc_code}}</p></div>
            <div class="col-3"><p> <b>A/C TITLE</b> : {{$account->title}}</p></div>

        </div>
        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-info text-light">
                <tr>
                    <td >Date</td>
                    <td>Voucher#</td>
                    <td >Narration</td>
                    <td >Reference</td>
                    <td >Cost Center</td>
                    <td >Dr.</td>
                    <td >Cr.</td>
                    <td >Balance</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">Opening Balance</td>
                    <td class="text-right">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right">{{number_format($opening_balance)}}</td>
                </tr>
                @php $dr=0;$cr=0; @endphp
                @foreach($entries as $entry)
                    <tr>
                        @if($entry->parent)
                        <td class="text-center">{{$entry->parent->date->format('d-M-Y')}}</td>
                        <td class="text-xs">{{$entry->parent->customize_id}}</td>
                        <td class="text-xs">{{$entry->narration}}</td>
                        <td class="text-xs text-capitalize">{{str_replace('-',' ',$entry->parent->type)}}</td>
                        <td class="text-xs">{{$entry->cost_center}}</td>
                        <td class="text-right">{{$entry->dr?number_format($entry->dr):''}}</td>
                        <td class="text-right">{{$entry->cr?number_format($entry->cr):''}}</td>
                        <td class="text-right">
                            @if($entry->dr)
                                @php $opening_balance=$opening_balance+$entry->dr @endphp

                            @endif
                            @if($entry->cr)
                                @php $opening_balance=$opening_balance-$entry->cr @endphp
                            @endif
                                {{$opening_balance>0?number_format($opening_balance): '('.number_format(abs($opening_balance)).')'}}
                        </td>

                    </tr>
                    @php $dr=$dr+$entry->dr;$cr=$cr+$entry->cr; @endphp
                    @endif
                @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td class="text-right">{{number_format($dr)}}</td>
                        <td class="text-right">{{number_format($cr)}}</td>
                    </tr>

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