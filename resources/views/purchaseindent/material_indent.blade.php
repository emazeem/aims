<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Material Indent</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="col-12 font-style mt-2">
        <div class="row" style="margin-left: 2px">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" class="pl-2 pt-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24 mt-4" style="margin-top: 10px">MATERIAL INDENT FORM</p>
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
        <table class="table table-bordered mt-3">
            <tr>
                <td colspan="3">Location / Project No: {{$indent->location}}</td>
                <td colspan="3" class="text-capitalize">Indent No : {{$indent->id}}</td>
                <td colspan="3">Indent Type : {{$indent->indent_type}} Purchase</td>
            </tr>
            <tr>
                <td colspan="3">Indenter: {{$indent->indenter->fname}} {{$indent->indenter->lname}}</td>
                <td colspan="3">Chargeable to : {{$indent->departments->name}}</td>
                <td colspan="3">Indent Date : {{date('d-M-Y',strtotime($indent->created_at))}}</td>
            </tr>
            <tr>
                <td colspan="3">Department: {{$indent->departments->name}}</td>
                <td colspan="3">Deliver to : {{$indent->location}}</td>
                <td colspan="3">Required Date : {{date('d-M-Y',strtotime($indent->required))}}</td>
            </tr>
            <tr>
                <th>Sr# </th>
                <th>Item Code </th>
                <th>Item Description </th>
                <th>Ref Do. </th>
                <th>Unit </th>
                <th>Last 6 months consumption </th>
                <th>Current Stock </th>
                <th>Qty </th>
                <th>Purpose /Location of use </th>
            </tr>
            @foreach($indent->indent_items as $key=> $item)
            <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->item_code}}</td>
                    <td>{{$item->item_description}}</td>
                    <td>{{$item->ref_code}}</td>
                    <td>{{$item->unit}}</td>
                    <td>{{$item->last_six_months_consumption}}</td>
                    <td>{{$item->current_stock}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->purpose}}</td>
            </tr>
            @endforeach
            <tr>
                <td class="p-3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="p-3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="mt-4">
                <td></td>
                <th class="font-italic " colspan="3">Prepared by (Indenter)</th>
                <th class="font-italic" colspan="3">Checked by</th>
                <th class="font-italic" colspan="3">Approved by</th>
            </tr>
            <tr>
                <th>Signature</th>
                <td colspan="3"></td>
                <td colspan="3"></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <th>Name</th>
                <td colspan="3">{{$indent->indenter->fname}} {{$indent->indenter->lname}}</td>
                <td colspan="3">{{$indent->checkedBy->fname}} {{$indent->checkedBy->lname}}</td>
                <td colspan="3">{{$indent->approvedBy->fname}} {{$indent->approvedBy->lname}}</td>
            </tr>
            <tr>
                <th>Position</th>
                <td colspan="3">{{($indent->status>)$indent->indenter->departments->name}}</td>
                <td colspan="3">{{$indent->checkedBy->departments->name}}</td>
                <td colspan="3">{{$indent->approvedBy->departments->name}}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td colspan="3">{{date('d-M-Y',strtotime($indent->updated_at))}}</td>
                <td colspan="3">{{date('d-M-Y',strtotime($indent->updated_at))}}</td>
                <td colspan="3">{{date('d-M-Y',strtotime($indent->updated_at))}}</td>
            </tr>

            <tr>
                <td colspan="100%">Distribution , procurement store</td>
            </tr>
        </table>
        <table class="table table-bordered mt-3">
            <tr>
                <td colspan="100%" class="text-center">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission of the company.</td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>