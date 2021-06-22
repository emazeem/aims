<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gate Pass</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
    .font-sm{
        font-size: 12px;
    }
</style>
<body>

<button onclick="window.print()" id="printPageButton" class="btn btn-danger btn-sm float-right">Print</button>
<div class="container">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-14 mt-5">Gate Pass for Equipment Going Outside of AIMS Cal Lab</p>
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
            <div class="col-2 font-11 ">Quote Ref :</div>
            <div class="col-2 custom-bottom-border text-center" >

                {{$job->quotes->cid}}
            </div>
            <div class="col-2 font-11 ">Address :</div>
            <div class="col-6 custom-bottom-border text-center font-sm" >
                {{$job->quotes->customers->address}}
            </div>
            <div class="col-12 my-2"></div>
            <div class="col-2 font-11 ">Job Number :</div>
            <div class="col-2 custom-bottom-border text-center" >
                {{$job->cid}}
            </div>
            <div class="col-2 font-11 ">Start From :</div>
            <div class="col-2 custom-bottom-border text-center" >
                {{$plan->start}}
            </div>
            <div class="col-2 font-11 ">Date To :</div>
            <div class="col-2 custom-bottom-border text-center" >
                {{$plan->end}}
            </div>
            <div class="col-12 my-2"></div>
            <div class="col-6 font-11 ">
                Returnable <input type="checkbox" checked>
            </div>
            <div class="col-6 font-11 ">
                Nonreturnable <input type="checkbox">
            </div>

        </div>
        <div class="col-12 text-center">
            <p class=" font-14 b mt-3">Equipment Description
            </p>
        </div>
        <div class="row">
            <table class="table table-bordered table-sm font-9">
                <thead>
                <tr>
                    <th class="text-xs">Sr#</th>
                    <th class="text-xs">Asset Code</th>
                    <th class="text-xs">Asset Description</th>
                    <th class="text-xs">Make</th>
                    <th class="text-xs">Model</th>
                    <th class="text-xs">Received By</th>
                    <th class="text-xs">Handed Over By</th>
                    <th class="text-xs">Function Check Value</th>
                    <th class="text-xs">Status Before Dispatch</th>
                    <th class="text-xs">Function Check Value</th>
                    <th class="text-xs">Status After Dispatch</th>
                    <th class="text-xs">Function Checked By</th>
                </tr>
                </thead>
                <tbody>

                @foreach($assets as $k=>$asset)
                    @php $assetdetails=\App\Models\Asset::find($asset)@endphp
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$assetdetails->code}}</td>
                        <td>{{$assetdetails->name}}</td>
                        <td>{{$assetdetails->make}}</td>
                        <td>{{$assetdetails->model}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
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