<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AIMS-QT-{{date('y')}}-{{$session->id}} {{$session->customers->reg_name}}</title>
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
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" width="150" class="img-fluid p-1">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 40px">QUOTATION</p>
            </div>
            <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-BM-FRM-04</p>
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


        <div class="col-12 text-center">
            <p class=" font-14 b my-4">AL-MEEZAN INDUSTRIAL METROLOGY SERVICES     (AIMS)</p>
        </div>
        <div class="row py-3">
            <div class="col-3 font-11 b">Document Type:</div>
            <div class="col-3 font-11 b"><input type="checkbox" checked> Calibration Services Offer</div>
            <div class="col-3 font-11 b"><input type="checkbox"> Offer for Sale of Equipment</div>
            <div class="col-3 font-11 b"><input type="checkbox"> Training Offer</div>
            <div class="col-3 font-11 b"></div>
            <div class="col-3 font-11 b"><input type="checkbox"> Consultancy Offer</div>
            <div class="col-5 font-11 b"><input type="checkbox"> Other:<span class="custom-bottom-border " style="padding-left: 300px"></span></div>
        </div>

        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="2">Requested By (Customer):</th>
                    <th colspan="2">Reviewed By:</th>
                    <th colspan="2">Prepared By:</th>
                    <th width="100">Revision #</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-11 b">Customer Principal Contact Person</td>
                    <td class="font-11 b">Sign</td>
                    <td class="font-11 b">AIMS Management</td>
                    <td class="font-11 b">Sign</td>
                    <td class="font-11 b">AIMS Customer Service Dept</td>
                    <td class="font-11 b">Sign</td>
                    <td class="font-11 b text-center"></td>
                </tr>
                <tr>
                    <td class="font-11">{{$session->principal}}</td>
                    <td class="font-11"></td>
                    <td class="font-11">{{$session->users->fname}} {{$session->users->lname}}</td>
                    <td class="font-11"></td>
                    <td class="font-11">{{auth()->user()->fname}} {{auth()->user()->lname}}</td>
                    <td class="font-11"></td>
                    <td class="font-11 text-center">1</td>
                </tr>
                </tbody>
            </table>

            <p class="font-12 b">Table of Contents</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="10%" class="text-center font-12">Sr#</th>
                    <th width="80%" class="text-center font-12">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-11 text-center">1</td>
                    <td class="font-10">Information form</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">2</td>
                    <td class="font-10">Place of Service Provision</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">3</td>
                    <td class="font-10">Scope of Service Provision</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">4</td>
                    <td class="font-10">Remarks</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">5</td>
                    <td class="font-10">Provision by AIMS</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">6</td>
                    <td class="font-10">Provision by Customer</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">7</td>
                    <td class="font-10">Price Proposal</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">8</td>
                    <td class="font-10">Terms and Conditions</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">9</td>
                    <td class="font-10">Bank Information</td>
                </tr>
                <tr>
                    <td class="font-11 text-center">10</td>
                    <td class="font-10">Validity</td>
                </tr>

                </tbody>
            </table>
            <p class="font-12 col-12 b"><span class="mr-5">1</span>  INFORMATION FORM:</p>

            <div class="col-2 font-10 ">To:</div>
            <div class="col-10  font-10 custom-bottom-border"><p class="col-8  p-0 m-0 float-left">{{$session->customers->reg_name}}</p><p class="col-1 p-0 m-0 float-left">Attention;</p><p class="col-3 p-0 m-0 text-right float-left">{{$session->principal}}</p></div>
            <div class="col-2 font-10 ">Address:</div>
            <div class="col-10 font-10  custom-bottom-border">{{$session->customers->address}}</div>
            <div class="col-2 font-10 ">Phone:</div>
            <div class="col-10  font-10 custom-bottom-border">
                @if($session->principal==$session->customers->prin_name_1)
                    {{$session->customers->prin_phone_1}}
                @elseif($session->principal==$session->customers->prin_name_2)
                    {{$session->customers->prin_phone_2}}
                @else
                    {{$session->customers->prin_phone_3}}
                @endif
            </div>
            <div class="col-2 font-10 ">Email</div>
            <div class="col-10  font-10 custom-bottom-border">
                @if($session->principal==$session->customers->prin_name_1)
                    {{$session->customers->prin_email_1}}
                @elseif($session->principal==$session->customers->prin_name_2)
                    {{$session->customers->prin_email_2}}
                @else
                    {{$session->customers->prin_email_3}}
                @endif
            </div>


            <div class="col-12 font-10  mt-5"></div>
            <div class="col-2 font-10 ">From:</div>
            <div class="col-10  font-10 custom-bottom-border">{{auth()->user()->fname}} {{auth()->user()->lname}}</div>
            <div class="col-2 font-10 ">Phone:</div>
            <div class="col-10 font-10  custom-bottom-border">{{auth()->user()->phone}}</div>
            <div class="col-2 font-10 ">Quote#:</div>
            <div class="col-10 font-10  custom-bottom-border">{{auth()->user()->id}}</div>
            <div class="col-2 font-10 ">Rev#:</div>
            <div class="col-10  font-10 custom-bottom-border">1</div>
            <div class="col-12 font-10  mt-5"></div>
            <div class="col-12 font-10  mt-5"></div>
            <div class="col-3 font-10">Subject /Description:</div>
            <div class="col-9 text-center font-10"> <span><b>Calibration of Test, measurement and diagnostic equipment</b></span></div>
            <div class="col-12 mt-3 font-10">Dear {{$session->principal}},</div>
            <p class="col-12 mt-3 font-10">Please find below our competitive proposal for the calibration of your
                instruments. We hope our offer will be in line with your requirement. Would you require
                further information/clarification please revert back to undersigned.
            </p>
        </div>
        {{--<h1 style="page-break-after:always;"></h1>--}}
        <div class="row">
            <div class="col-12 "></div>
            <p class="font-12 col-12 b mt-1"><span class="mr-5">2</span>  PLACE OF SERVICE PROVISION:</p>
            <div class="col-12"></div>


            @php
                $checktypes=\App\Models\Item::where('quote_id',$session->id)->get();
                    $totalrecords=$checktypes->count();
                    $incrementforsite=0;
                    $incrementforlab=0;
                    foreach($checktypes as $checktype){
                        if ($checktype->location=='lab'){
                            $incrementforlab++;
                        }
                        if ($checktype->location=='site'){
                            $incrementforsite++;
                        }
                    }
                    $type=null;
                    if ($incrementforlab==$totalrecords){
                        $type.="LAB";
                    }
                    else if ($incrementforsite==$totalrecords){
                        $type.="SITE";
                    }
                    else{
                        $type.='SPLIT';
                    }
            @endphp

            <p class="font-10 line-height col-7"><span class="ml-5 pl-2">2.1 - AIMS Calibration Lab in Lahore</span>.<input type="checkbox" {{($type=="LAB")?"checked":""}} class="float-right"></p>

            <div class="col-12"></div>
            <p class="font-10 line-height col-7"><span class="ml-5 pl-2">2.2 - Customer premises as per given address.</span><input type="checkbox" {{($type=="SITE")?"checked":""}} class="float-right"></p>
            <div class="col-12"></div>

            <p class="font-10 line-height col-7"><span class="ml-5 pl-2">2.3 - Partially at site and partially in AIMS Lab.</span><input type="checkbox" {{($type=="SPLIT")?"checked":""}} class="float-right"></p>
            <div class="col-12"></div>

            <p class="font-12  mt-1 col-12 b"><span class="mr-5">3</span>  SCOPE OF SERVICE PROVISION:</p>

            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">3.1 - Calibration and Certification of instruments/equipments as per below table.
</span>.</p>
            <p class="font-12  mt-1 col-12 b"><span class="mr-5">4</span>  REMARKS:</p>

            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">4.1 - Any other necessary information required to be stated here.
</span>.</p>

            <p class="font-12  mt-1 col-12 b"><span class="mr-5">5</span>  PROVISION BY AIMS:</p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">5.1 - AIMS will execute calibration of required items in safe and sound manner as per agreed schedule.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">5.2 - AIMS will provide traceability of calibration in calibration certficates.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">5.3 - AIMS will schedule the job on first come first serve basis.</span></p>

        </div>
        <div class="row ">
            <p class="font-12  mt-1 col-12 b"><span class="mr-5">6</span>  PROVISION BY CUSTOMER:</p>

            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.1 - To raise Purchase Request and issue Purchase Order/Work Order in the name of AIMS.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.2 - To confirm serviceability status of the items before shipping or inviting AIMS team.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.3 - To confirm job schedule before sending items to AIMS.
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.4 - To arrange delivery of items to AIMS Cal Lab in Lahore and pick up upon completion of Job.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.5 - In case of courier of customer property, AIMS will not be responsible for any loss/damage in transportation.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.6 - To arrange boarding/loading, security passes/permits for AIMS team for site job.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">6.7 - To arrange payment as per given payment terms and conditions.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2  py-1">6.8 - To sign visit sign work sheet / time sheet of AIMS in order to confirm completion of site Job.</span></p>
            <p class="font-12  mt-1 col-12 float-left b"><span class="mr-5">7</span>  PRICE PROPOSAL:</p>
            <p class="font-12 text-right col-12 b float-right">Date : <span class="custom-bottom-border">{{date('d-m-Y',time())}}</span></p>
        </div>
        <div class="row py-3">
            <div class="col-2 font-10 b">Currency:</div>
            <div class="col-3 font-10 b"><input type="checkbox" checked> Pak Rupees (Rs)	</div>
            <div class="col-4 font-10 b"><input type="checkbox"> Arab Emirates Dirham (AED)</div>
            <div class="col-3 font-10 b"><input type="checkbox"> Dollar ($)</div>
        </div>
        <div class="row py-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Description</th>
                    <th>Parameter</th>
                    <th>Range</th>
                    <th>Accredited</th>
                    <th>Location</th>
                    <th>Charges</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>

                @php $i=1; $subtotal=0; $tax=0;@endphp
                @foreach($session->items as $quote)
                    <tr>

                        <td class="font-11">{{$i}}</td>
                        <td class="font-11">

                            @if($quote->not_available)
                                {{$quote->not_available}}
                            @else
                                {{$quote->capabilities->name}}</td>
                            @endif

                        <td class="font-11">
                            @if($quote->not_available)
                                ---
                            @else
                                {{$quote->parameters->name}}
                            @endif

                        </td>
                        <td class="font-11">{{$quote->range}}</td>
                        <td class="font-11">{{$quote->accredited}}</td>
                        <td class="font-11">{{$quote->location}}</td>
                        <td class="font-11">{{$quote->price}}</td>
                        <td class="font-11">{{$quote->quantity}}</td>
                        <td class="font-11">{{$quote->quantity*$quote->price}}</td>
                    </tr>
                    @php $i++;$subtotal=$subtotal+($quote->quantity*$quote->price); @endphp

                @endforeach

                <tr>
                    <th colspan="8">Total Service Charges</th>
                    <th colspan="2">{{$subtotal}}</th>
                </tr>
                <tr>
                    <th colspan="8">Punjab Revenue Authority Tax  ({{$session->customers->region}})</th>
                    <th colspan="2">
                        @if($session->customers->region="PRA")
                            16% @php $tax=16/100; @endphp
                        @elseif($session->customers->region="SRB")
                            13% @php $tax=13/100; @endphp
                        @elseif($session->customers->region="KPRA")
                            15% @php $tax=15/100; @endphp
                        @elseif($session->customers->region="BRA")
                            15% @php $tax=15/100; @endphp
                        @elseif($session->customers->region="IRD")
                            16% @php $tax=16/100; @endphp
                        @endif
                    </th>
                </tr>
                <tr>
                    <?php $total=($subtotal*$tax)+$subtotal; ?>
                    <th colspan="8"  class="text-capitalize">Total ( {{$total}} )</th>
                    <th colspan="2">{{($subtotal*$tax)+$subtotal}}</th>
                </tr>
                </tbody>
            </table>
            <p class="font-12  mt-1 col-12 b"><span class="mr-5">8</span> TERMS & CONDITIONS:</p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.1 -	Price basis is Ex works Pakistan unless otherwise mentioned anywhere in the body of this quote.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.2 -	AIMS prices are applicable for the quoted quantities, in case of any variation, AIMS reserve the rights to change unit prices.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.3 -	For each non-calibrateable item sent by customer, AIMS will charge @ 25% of calibration charges for wasted manhours. Additionally for site job transportation will be charges as per actual.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.4 - Terms of payment:</span></p>
            <div class="ml-5">

                <p class="ml-5 font-10 col-12 pl-2"><input type="checkbox" {{($session->customers->customer_type=="cash" and $session->customers->pay_terms=="advance")?"checked":""}}> Cash/cheque advance  before starting job.</p>
                <p class="ml-5 font-10 col-12 pl-2"><input type="checkbox" {{($session->customers->customer_type=="cash" and $session->customers->pay_terms=="against delivery")?"checked":""}}> Cash/cheque against delivery of calibration certificates.</p>

                <p class="ml-5 col-12 font-10 pl-2"><input type="checkbox" {{($session->customers->customer_type=="credit" and $session->customers->pay_terms=="15 days")?"checked":""}}> 15 days from invoice date.</p>
                <p class="ml-5 col-12 font-10 pl-2"><input type="checkbox" {{($session->customers->customer_type=="credit" and $session->customers->pay_terms=="30 days")?"checked":""}}> 30 days from invoice date.</p>
                <p class="ml-5 col-12 font-10 pl-2"><input type="checkbox" {{($session->customers->customer_type=="credit" and $session->customers->pay_terms=="60 days")?"checked":""}}> 60 days from invoice date.</p>
                <p class="ml-5 col-12 font-10 pl-2"><input type="checkbox" {{($session->customers->customer_type=="credit" and $session->customers->pay_terms=="120 days")?"checked":""}}> 120 days from invoice date.</p>

            </div>


            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.5 -	In case of Bank Transfer to AIMS account, any bank charges  will be borne by customer.</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">8.6 -	Cancellation of order after receipt of your confirmed PO and return of goods are not accepted.</span></p>
            <p class="font-12  mt-1 col-12 b"><span class="mr-5">9</span> BANK DETAILS:</p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">Account Title:			AI-Meezan Industrial Metrology Services</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">Bank: 			Meezan Bank,   Sabzazaar Branch</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">Account #:  			0256 0102439271</span></p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">IBAN :  			PK97 MEZN 0002 5601 0243 9271</span></p>

            <p class="font-12  mt-1 col-12 b"><span class="mr-5">10</span> VALIDITY:</p>
            <p class="font-10 line-height col-12"><span class="ml-5 pl-2">10.1 - This quotation is valid thirty (60) calendar days from the date of this offer.</span></p>
            <div class="col-7 ">
                <p class="font-11 line-height col-12 b mt-4">Al- Meezan Industrial Meterology Services</p>
                <p class="font-11 line-height col-12 b "><span class="custom-bottom-border">Date :  {{date('d-m-Y',time())}}</span></p>
            </div>
            <div class="col-4 mb-5 text-right">
                <img src="{{url('/img/AIMS.png')}}" width="150" class="img-fluid ">
            </div>
        </div>
    </div>
</div>
</body>
</html>