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
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" class="pl-2 pt-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24 " style="margin-top: 10px">MATERIAL INDENT FORM</p>
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
                <td colspan="3">Location / Project No: </td>
                <td colspan="3">Indent No :</td>
                <td colspan="3">Indent Type : </td>
            </tr>
            <tr>
                <td colspan="3">Indent: </td>
                <td colspan="3">Chargeable to :</td>
                <td colspan="3">Indent Date : </td>
            </tr>
            <tr>
                <td colspan="3">Department: </td>
                <td colspan="3">Deliver to :</td>
                <td colspan="3">Required Date : </td>
            </tr>
            <tr>
                <td>Sr# </td>
                <td>Item Description </td>
                <td>Ref Do. </td>
                <td>Unit </td>
                <td>Last 6 months consumption </td>
                <td>Current Stock </td>
                <td>Qty </td>
                <td>Purpose /Location of use </td>
            </tr>
            @foreach($items as $key=> $item)
            <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->item_code}}</td>
                    <td>{{$item->item_description}}</td>
                    <td>{{$item->ref_code}}</td>
                    <td>{{$item->unit}}</td>
                    <td>{{$item->last_six_months_consumption}}</td>
                    <td>{{$item->current_stock}}</td>
                    <td>{{$item->qty}}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td colspan="3">Prepared by (Indenter)</td>
                <td colspan="3">Checked by</td>
                <td colspan="3">Approved by</td>
            </tr>
            <tr>
                <td>Signature</td>
                <td colspan="3"></td>
                <td colspan="3"></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>Name</td>

                <td colspan="3"></td>
                <td colspan="3"></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>Position</td>

                <td colspan="3"></td>
                <td colspan="3"></td>
                <td colspan="3"></td>
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