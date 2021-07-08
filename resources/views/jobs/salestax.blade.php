<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Tax Invoice {{$job->invoices->title}}</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
</style>
<body>
<button onclick="window.print()" id="printPageButton" class="btn btn-danger btn-sm float-right">Print</button>

<div class="container">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center">
                <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-10 custom-bottom-border text-right p-0">
                <p class="font-14 b py-0 my-0">SALES TAX INVOICE</p>
                <p class="font-11 py-0 my-0">NTN & GST # 7322733-0</p>
                <p class="font-11 py-0 my-0">STRN # 3277876130888</p>
                @if(\App\Models\Preference::find($job->quotes->customers->region)->name=='PRA')
                    <p class="font-11 py-0 my-0">AIMS PRA H.S Code - 9816</p>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 py-0 my-0">
                <p>Date of Issue <span class="custom-bottom-border px-md-5">
                        {{$job->invoices->created_at->format('d-m-Y')}}
                    </span></p>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4 text-right">
                <p>Invoice # <span class="custom-bottom-border px-md-5">{{$job->invoices->title}}</span></p>
            </div>


        </div>
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Bill / Invoice to:
                        </th>
                        <th>{{$job->quotes->customers->reg_name}}</th>
                    </tr>
                    <tr>
                        <th>NTN :</th>
                        <th>{{$job->quotes->customers->ntn}}</th>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{$job->quotes->customers->address}}</td>
                    </tr>

                    <tr>
                        <th>Contact Person</th>
                        <td>{{$job->quotes->principals->name}}</td>
                    </tr>
                    <tr>
                        <th>Tel / Fax No.:</th>
                        <td>{{$job->quotes->principals->phone}}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{$job->quotes->principals->email}}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Customer Ref. No.:<br>
                            (PO / SO / Quote)
                        </th>
                        <td>{{$job->quotes->approval_mode}}<br>{{$job->quotes->approval_mode_details}}</td>
                    </tr>
                    <tr>
                        <th>AIMS Ref. No.:</th>
                        <td>{{$job->cid}}</td>
                    </tr>
                    <tr>
                        <th>AIMS Contact:</th>
                        <td>{{auth()->user()->fname}} {{auth()->user()->lname}}</td>
                    </tr>
                    <tr>
                        <th>Tel./ Fax No.:</th>
                        <td>03060002467</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>acc.aimscal2021@gmail.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-6 text-right font-10 b">Currency:</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox" checked> PKR</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> AED</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> USD</div>
        </div>


        <div class="col-12 text-center">
            <p class=" font-14 b mt-3">Items received for calibration</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="text-center">
                <tr>
                    <th>Sr#</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>

                <tbody class="text-center">
                @php $i=1; $subtotal=0; $tax=0;@endphp
                @foreach($labitems as $labitem)
                    <tr>

                        <td class="font-11">{{$i}}</td>
                        <td class="font-11 text-left">Certification of {{$labitem->capabilities->name}}</td>
                        <td class="font-11">{{$labitem->quantity}}</td>
                        <td class="font-11">{{$labitem->price}}</td>
                        <td class="font-11">{{$labitem->price*$labitem->quantity}}</td>
                    </tr>
                    @php $i++;$subtotal=$subtotal+($labitem->quantity*$labitem->price); @endphp
                @endforeach
                <tr>
                    <th class="font-11 text-right" colspan="4">Total Service Charges</th>
                    <td class="font-11">{{$subtotal}}</td>
                </tr>

                <tr>
                    <th class="font-11 text-right" colspan="4">
                        @php $region=\App\Models\Preference::find($job->quotes->customers->region); @endphp
                        @if($region->name=='PRA')
                            {{$region->value}}% @php $tax=$region->value/100; @endphp
                        @endif

                        {{$region->name}} Tax on Services
                    </th>

                    <td class="font-11">{{($subtotal*$tax)}}</td>
                </tr>
                <tr>
                    <th class="font-11 text-right" colspan="4">Invoice Total</th>
                    <td class="font-11">{{($subtotal*$tax)+$subtotal}}</td>
                </tr>
                <tr>
                    <?php $total=($subtotal*$tax)+$subtotal;
                    $numberToWords = new \NumberToWords\NumberToWords();
                    $numberTransformer = $numberToWords->getNumberTransformer('en');
                    ?>
                        <th colspan="5"  class="text-capitalize text-left">Total In Words : {{$numberTransformer->toWords($total)}} Rupees Only </th>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="row py-3">
            <div class="col-6 text-right font-10 b">Payments Terms:</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> Cheque</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox" {{$job->quotes->customers->customer_type=='cash'?'checked':''}}> Cash</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox" {{$job->quotes->customers->customer_type=='credit'?'checked':''}}> Credit</div>
        </div>

        <div class="row">
            <div class="col-8">
                <p class="col-12 font-10 b">Note: Payable after completion of job</p>
                <p class="col-12 font-10 mt-4">Kindly issue cheque/cash or credit amount to:</p>
                <p class="col-12 font-10 ">AI-Meezan Industrial Metrology Services</p>
                <p class="col-12 font-10 b mt-4">Bank: Meezan Bank, Sabzazar Branch, Lahore, Pakistan</p>
                <p class="col-12 font-10 b">Account #:  0002560102439271</p>
                <p class="col-12 font-11 mt-4">Swift Code:  
                    <br>
                    <small>Kindly email the remittance advice to info@aimscal.com as soon as the money is transferred
                    </small>
            </div>
            <div class="col-4 text-center">
                <div class="col-12 text-left">
                    For AIMS:
                </div>
                <div class="row">

                    <div class="col-2"></div>
                    <div class="col-8 pt-5 mt-5 px-5 custom-bottom-border">
                        <img style="object-fit: cover" src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="120" class="img-fluid">
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="col-12 font-11">
                    Accounts Dept. AIMS<br>
                    Address: 58-B OPF Society, Lahore<br>
                    Tel. : +92 42 35324659<br>
                    Email: info@aimscal.com<br>
                    Website: www.aimscal.com
                </div>

            </div>

            </p>
        </div>
    </div>
</div>
</body>
</html>