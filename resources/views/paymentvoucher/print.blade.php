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
                <img src="{{url('/img/AIMS.png')}}" class="ml-2 p-2" width="100">
            </div>
            <div class="col-10 border-left-0 custom-border" >
                <h2 class="text-center b  mt-4 text-capitalize">
                    {{str_replace('-',' ',$show->type)}}
                </h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-2 my-1 font-11 "><b>Voucher#</b>
            </div>
            <div class="text-right">
                <span class="custom-bottom-border">{{$show->customize_id}}</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2 font-11 "><b>Date :</b>
            </div>
            <div class="text-right">
                <span class="custom-bottom-border ">{{$show->date->format('d-m-Y')}}</span>
            </div>
        </div>
        <div class="row mt-2">
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
                        <td class="font-11 text-right">{{$detail->dr?number_format($detail->dr):''}}</td>
                        <td class="font-11 text-right">{{$detail->cr?number_format($detail->cr):''}}</td>
                    </tr>
                    @php $dr=$dr+$detail->dr;$cr=$cr+$detail->cr; @endphp
                @endforeach
                <tr>
                <th colspan="4"></th>
                <th class="text-right py-2">{{number_format($dr)}}</th>
                <th class="text-right py-2">{{number_format($cr)}}</th>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row py-3">
            <div class="col-4 my-1 font-11 ">Prepared by : <span class="custom-bottom-border pr-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Checked by : <span class="custom-bottom-border pr-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
            <div class="col-4 my-1 font-11 ">Approved by : <span class="custom-bottom-border pr-5">{{$show->createdby->fname}} {{$show->createdby->lname}}</span></div>
        </div>


    </div>
</div>
</body>
</html>