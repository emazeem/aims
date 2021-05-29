 <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receivable Aging</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-10 border-left-0 custom-border" >
                <h1 class="text-center b mt-4 text-capitalize">
                    Receivable Aging
                </h1>
            </div>
        </div>
        <div class="row mt-4">
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-info text-light">
                <tr>
                    <td>Customer</td>
                    <td>Invoice</td>
                    <td>0-30 Days</td>
                    <td>31-60 Days</td>
                    <td>61-90 Days</td>
                    <td>90+ Days</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $datum)
                    @php $invoices_amount=0;$received_amount=0; @endphp
                    <tr>
                        <td>
                            {{$datum['customer_name']}}<br>
                            <b>{{$datum['customer_acc_code']}}</b>
                        </td>
                        <td>
                            @foreach($datum['invoices'] as $invoice)
                                @php $total=0; @endphp
                                <a href="{{url('vouchers/show/'.$invoice->parent->id)}}">
                                    {{$invoice->parent->invoices->title}}-
                                </a>
                                <br>
                                @php $receiving=0; @endphp
                                @foreach($invoice->parent->invtopay as $invoices)
                                    @foreach(\App\Models\Journal::find($invoices->receipt_id)->details as $detail)
                                        @if(substr($detail->acc_code,0,5)==10103)
                                            @php $receiving=$receiving+$detail->cr; $received_amount=$received_amount+$detail->cr @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                                @php $invoices_amount=$invoices_amount+$invoice->dr @endphp
                            @endforeach
                        </td>
                        <td>
                            @foreach($datum['invoices'] as $invoice)
                                @php
                                    $start=\Carbon\Carbon::now();
                                    $difference = $start->diffInDays($invoice->parent->date);
                                @endphp
                                @if($difference>0 and $difference<=30)

                                    @php $receiving=0; @endphp
                                    @foreach($invoice->parent->invtopay as $invoices)
                                        @foreach(\App\Models\Journal::find($invoices->receipt_id)->details as $detail)
                                            @if(substr($detail->acc_code,0,5)==10103)

                                                @php $receiving=$receiving+$detail->cr; @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{$invoice->dr-$receiving}}

                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($datum['invoices'] as $invoice)
                                @php
                                    $start=\Carbon\Carbon::now();
                                    $difference = $start->diffInDays($invoice->parent->date);
                                @endphp
                                @if($difference>30 and $difference<=60)
                                {{--    <b>{{$invoice->dr}}</b>
                                --}}
                                    @php $receiving=0; @endphp
                                    @foreach($invoice->parent->invtopay as $invoices)
                                        @foreach(\App\Models\Journal::find($invoices->receipt_id)->details as $detail)
                                            @if(substr($detail->acc_code,0,5)==10103)
                                                @php $receiving=$receiving+$detail->cr; @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{$invoice->dr-$receiving}}
                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($datum['invoices'] as $invoice)
                                @php
                                    $start=\Carbon\Carbon::now();
                                    $difference = $start->diffInDays($invoice->parent->date);
                                @endphp
                                @if($difference>60 and $difference<=90)

                                    @php $receiving=0; @endphp
                                    @foreach($invoice->parent->invtopay as $invoices)
                                        @foreach(\App\Models\Journal::find($invoices->receipt_id)->details as $detail)
                                            @if(substr($detail->acc_code,0,5)==10103)

                                                @php $receiving=$receiving+$detail->cr; @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{$invoice->dr-$receiving}}


                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($datum['invoices'] as $invoice)
                                @php
                                    $start=\Carbon\Carbon::now();
                                    $difference = $start->diffInDays($invoice->parent->date);
                                @endphp
                                @if($difference>90)

                                @php $receiving=0; @endphp
                                    @foreach($invoice->parent->invtopay as $invoices)
                                        @foreach(\App\Models\Journal::find($invoices->receipt_id)->details as $detail)
                                            @if(substr($detail->acc_code,0,5)==10103)

                                                @php $receiving=$receiving+$detail->cr; @endphp
                                            @endif
                                        @endforeach
                                    @endforeach

                                    {{$invoice->dr-$receiving}}

                                @endif
                                <br>
                            @endforeach
                        </td>

                        <td>{{$invoices_amount-$received_amount}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>