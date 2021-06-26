<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$gp->cid}}</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<style>

    @media print {
        #printPageButton {
            display: none;
        }
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
    }
</style>
<body>

<button onclick="window.print()" id="printPageButton" class="btn btn-danger btn-sm float-right">Print</button>
<div class="container">

    <div class="row">
        <div class="col-2 text-center custom-border">
            <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
        </div>
        <div class="col-7 border-left-right-0 custom-border" >
            <h4 class="text-center mt-4">Gate Pass for Equipment Out / In / Function Check / Status (AIMS Cal Lab)</h4>
        </div>
        <div class="col-3 custom-border font-9 p-0">
            <p class="text-center font-11 col-12 my-1">DOC. # AIMS-TM-FRM-30</p>
            <div class="col-12 custom-bottom-border"></div>
            <p class="text-center font-11 col-12 my-2">Issue Date : 06-10-2020</p>
            <div class="col-12 custom-bottom-border"></div>
            <p class="text-center font-11 col-12 mt-2 mb-1">
                Issue # 01
                <span class="px-4">|</span>
                Rev # 02
            </p>
        </div>

        <div class="col-12 d-flex justify-content-between pt-3">
            <p class="float-left "><b>Purpose :</b> <span class="custom-bottom-border">Calibration</span></p>
            <p class="float-left "><b>Date Out :</b> <span class="custom-bottom-border">{{$gp->out->format('d-m-Y')}}</span></p>
            <p class="float-left "><b>Received By :</b> <span class="custom-bottom-border">{{$gp->outreceivedby->fname.' '.$gp->outreceivedby->lname}}</span></p>
            <p class="float-left "><b>Time Out :</b> <span class="custom-bottom-border">{{$gp->out->format('h:i A')}}</span></p>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <p class="float-left "><b>Job # :</b> <span class="custom-bottom-border">{{$gp->plan->jobs->cid}}</span></p>
            <p class="float-left "><b>Customer :</b> <span class="custom-bottom-border">{{$gp->plan->jobs->quotes->customers->reg_name}}</span></p>
            <p class="float-left "><b>Handed Over By :</b> <span class="custom-bottom-border">{{$gp->outreceivedfrom->fname.' '.$gp->outreceivedfrom->lname}}</span></p>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <p class="float-left"><b>Returnable</b> <input type="checkbox" checked></p>
            <p class="float-left"><b>Non-Returnable</b> <input type="checkbox"></p>
            <p class="float-left"><b>Date In :</b> <span class="custom-bottom-border">{{$gp->in->format('d-m-Y')}}</span></p>
            <p class="float-left"><b>Received Back By :</b> <span class="custom-bottom-border">{{$gp->inreceivedby->fname.' '.$gp->inreceivedby->lname}}</span></p>
            <p class="float-left"><b>Time In :</b> <span class="custom-bottom-border">{{$gp->in->format('h:i A')}}</span></p>
        </div>
    </div>
    <div class="col-12 text-center">
        <h4>Equipment Description</h4>
    </div>
    <div class="row">
        <table class="table table-bordered table-sm font-9">
            <thead>
            <tr>
                <th class="text-xs" rowspan="2">Sr#</th>
                <th class="text-xs" rowspan="2">Equipment Description</th>
                <th class="text-xs" rowspan="2">Equipment ID # <br>/ Sr #</th>

                <th class="text-xs" colspan="3">Equipment Out</th>
                <th class="text-xs" colspan="3">Equipment In</th>
            </tr>
            <tr>
                <th class="text-xs">Function Check Value</th>
                <th class="text-xs">Status</th>
                <th class="text-xs">Handed Checked By</th>
                <th class="text-xs">Function Check Value</th>
                <th class="text-xs">Status</th>
                <th class="text-xs">Handed Checked By</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gp->gpitems as $k=>$asset)
                @php $assetdetails=\App\Models\Asset::find($asset->item_id)@endphp
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$assetdetails->name}}</td>
                    <td>{{$assetdetails->code}}</td>
                    <td>{{$asset->out_fcv}}</td>
                    <td>{{$asset->out_status}}</td>
                    <td>{{$asset->fcbout->fname.' '.$asset->fcbout->lname}}</td>
                    <td>{{$asset->in_fcv}}</td>
                    <td>{{$asset->in_status}}</td>
                    <td>{{$asset->fcbin->fname.' '.$asset->fcbin->lname}}</td>
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