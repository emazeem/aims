<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PST</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="col-12 font-style ">
        <h6 class="text-center p-0 m-0">M/S AL-MEEZAN INDUSTRIAL METEROLOGY SERVICES</h6>
        <h6 class="text-center p-0 m-0">SUPPLY REGISTER</h6>
        <h6 class="text-center p-0 m-0">Al Meezan NTN No. 7322733-0</h6>
        <h6 class="text-center p-0 m-0">SALES TAX REG. NO. 3277876130888</h6>
        <h6 class="text-center p-0 m-0">UNDER SECTION 22(1) (A) OF SALES TAX (AMENDEMENT) ACT 1990</h6>
        <h5 class="m-0 p-0">{{$month}}</h5>

        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-info text-light">
                <tr>
                    <th>Sr.</th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>NTN/FTN</th>
                    <th>Value Ex</th>
                    <th>ST 16%</th>
                    <th>Total</th>
                    <th>Challan</th>
                    <th>Name & Address of the</th>
                    <th></th>
                </tr>

                </thead>
                <tbody>
                @foreach($invoices as $k=>$invoice)
                    @php $charges=0;$pra=0; @endphp
                    @foreach($invoice->details as $detail)
                        @if(substr($detail->acc_code,0,5)==10103)
                            @php $charges=$detail->dr; $customer=\App\Models\Customer::where('acc_code',$detail->acc_code)->first();@endphp
                        @endif
                        @if($detail->acc_code==20101001)
                            @php $pra=$detail->cr; @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                        <td>{{$invoice->invoices->title }}</td>
                        <td>{{$customer->ntn}}</td>
                        <td class="text-right">{{number_format($charges-$pra)}}</td>
                        <td class="text-right">{{number_format($pra)}}</td>
                        <td class="text-right">{{number_format($charges)}}</td>
                        <td class="text-right">
                            @if($customer->tax_case!=2)
                                {{number_format($pra)}}
                            @endif
                        </td>
                        <td>{{$customer->reg_name}}</td>
                        <td>
                            @if($customer->tax_case==2)
                                At Source
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>