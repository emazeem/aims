<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master List of Equipments</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .font-custom{
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="col-12 font-style ">
        <p class="text-center p-0 m-0" style="margin-top: 10px">M/S AL-MEEZAN INDUSTRIAL METEROLOGY SERVICES</p>
        <p class="text-center p-0 m-0" style="margin-top: 10px">SUPPLY REGISTER</p>
        <p class="text-center p-0 m-0" style="margin-top: 10px">Al Meezan NTN No. 7322733-0</p>
        <p class="text-center p-0 m-0" style="margin-top: 10px">SALES TAX REG. NO. 3277876130888</p>
        <p class="text-center p-0 m-0" style="margin-top: 10px">UNDER SECTION 22(1) (A) OF SALES TAX (AMENDEMENT) ACT 1990</p>
        <div class="row">
            <table class="table table-stripped mt-4 table-sm table-bordered font-custom">
                    <tr>
                        <td colspan="8" style="border:1px solid white"></td>
                        <td><h5>{{date('F Y')}}</h5></td>
                        <td  style="border:1px solid white"></td>
                    </tr>
                    <tr>
                        <td>Sr.</td>
                        <td>Date</td>
                        <td>Invoice</td>
                        <td>NTN/FTN</td>
                        <td>Value Ex</td>
                        <td>ST 16%</td>
                        <td>Total</td>
                        <td>Challan</td>
                        <td>Name & Address of the</td>
                        <td></td>
                    </tr>
                    @foreach($entries as $key=>$entry)
                        <tr>
                            <td width="5">{{$key+1}}</td>
                            <td width="5">{{date('d-M-Y',strtotime($entry->invoice))}}</td>
                            <td width="5">{{$entry->invoice_no}}</td>
                            <td width="5">{{$entry->customers->ntn}}</td>
                            <td width="5">{{$entry->service_charges}}</td>
                            <td width="5">{{$entry->service_tax_amount}}</td>
                            <td width="5">{{$entry->service_charges+$entry->service_tax_amount}}</td>
                            <td width="5">{{($entry->service_tax_deducted!="At Source")?$entry->service_tax_amount:''}}</td>
                            <td width="20">{{$entry->customers->reg_name}}-{{$entry->customers->address}}</td>
                            <td width="5">{{($entry->service_tax_deducted=="At Source")?$entry->service_tax_deducted:''}}</td>
                        </tr>
                    @endforeach

                </table>
        </div>
    </div>

</div>
</body>
</html>