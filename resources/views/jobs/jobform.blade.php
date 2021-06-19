<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JN/{{date('Y')}}/{{$job->id}}</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }

    .font-md {
        font-size: 18px;
    }

    .font-sm {
        font-size: 13px;
    }

    .font-xs {
        font-size: 12px;
    }

</style>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-2">
            <button onclick="window.print()" id="printPageButton" class="btn btn-danger btn-sm float-right">Print</button>
        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="col-12 font-style mt-2 ">
        <div class="row custom-border">
            <div class="col-2 text-center">
                <img src="{{url('/img/AIMS.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 custom-border-left">
                <p class="text-center b font-24" style="margin-top: 10px">Calibration Job Form /<br>
                    Customer Contract Form</p>
            </div>
            <div class="col-3 row  font-9 p-0 custom-border-left">
                <p class="text-center font-sm col-12 my-1">DOC. # AIMS-BM-FRM-04,</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-sm col-12 my-2">Issue Date : 06-10-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-sm col-6 mt-2 mb-1">Issue # 01</p>
                <p class="text-center font-sm col-6 mt-2 mb-1 custom-border-left">Rev # 02</p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-12 font-style mt-2">

        <div class="row custom-border p-2">
            <div class="col-2 row my-1 font-sm">
                <div class="col-4">Job#:</div>
                <div class="col-8 custom-bottom-border text-center">{{$job->cid}}</div>
            </div>
            <div class="col-2 row my-1 font-sm ">
                <div class="col-4">Date:</div>
                <div class="col-8 custom-bottom-border  text-center">{{$job->created_at->format('d-m-Y')}}</div>
            </div>
            <div class="col-6 row my-1 font-sm ">
                <div class="col-4">Work order / Quotation #</div>
                <div class="col-8 custom-bottom-border  text-center">{{$job->quotes->approval_mode_details}}</div>
            </div>
            <div class="col-2 row my-1 font-sm ">
                <div class="col-4">Dated:</div>
                <div class="col-8 custom-bottom-border  text-center">{{date('d-m-Y',strtotime($job->quotes->approval_date))}}</div>
            </div>
            <div class="col-12 row my-1 font-sm ">
                <div class="col-2">Customer Name:</div>
                <div class="col-10 custom-bottom-border">{{$job->quotes->customers->reg_name}}</div>
            </div>
            <div class="col-12 row my-1 font-sm ">
                <div class="col-2">Address:</div>
                <div class="col-10 custom-bottom-border">{{$job->quotes->customers->address}}</div>
            </div>
            <div class="col-6 row my-1 font-sm ">
                <div class="col-4">Contact Person:</div>
                <div class="col-8 custom-bottom-border">{{$job->quotes->principal}}</div>
            </div>
            <div class="col-3 row my-1 font-sm ">
                <div class="col-5">Contact #:</div>
                <div class="col-7 custom-bottom-border">
                    @if($job->quotes->principal==$job->quotes->customers->prin_name_1)
                        {{$job->quotes->customers->prin_phone_1}}
                    @elseif($job->quotes->principal==$job->quotes->customers->prin_name_1)
                        {{$job->quotes->customers->prin_phone_2}}
                    @else
                        {{$job->quotes->customers->prin_phone_3}}
                    @endif
                </div>
            </div>
            <div class="col-3 row my-1 font-sm">
                <div class="col-4">Email :</div>
                <div class="col-8 custom-bottom-border">
                    @if($job->quotes->principal==$job->quotes->customers->prin_name_1)
                        {{$job->quotes->customers->prin_email_1}}
                    @elseif($job->quotes->principal==$job->quotes->customers->prin_name_1)
                        {{$job->quotes->customers->prin_email_2}}
                    @else
                        {{$job->quotes->customers->prin_email_3}}
                    @endif
                </div>
            </div>
            <div class="col-12 text-center">
                <p class=" font-14 b mt-3">Items received for calibration</p>
            </div>
            <table class="table table-bordered font-md">
                <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Item Description</th>
                    <th>Equipment ID/Sr #</th>
                    <th>Range / Model</th>
                    <th>Tentative return date</th>
                    <th>Accessories</th>
                    <th>Visual Inspection</th>
                </tr>
                </thead>
                <tbody>
                @php $i=1; @endphp
                @foreach($labjobs as $labjob)
                    <tr>
                        <td class="font-md">{{$i}}</td>
                        @php $i++; @endphp
                        <td class="font-md">{{\App\Models\QuoteItem::find($labjob->item_id)->capabilities->name}}</td>
                        <td class="font-md">{{$labjob->eq_id}}</td>
                        <td class="font-md">{{$labjob->model}}</td>
                        <td class="font-md">{{date('d-m-Y',strtotime($job->created_at)+($job->quotes->turnaround*24*3600))}}</td>
                        <td class="font-md">{{$labjob->accessories}}</td>
                        <td class="font-md">{{$labjob->visual_inspection}}</td>
                    </tr>
                @endforeach
                @foreach($sitejobs as $sitejob)
                    <tr>
                        <td class="font-md">{{$i}}</td>
                        @php $i++; @endphp
                        <td class="font-md">{{$sitejob->item->capabilities->name}}</td>
                        <td class="font-md">{{$sitejob->eq_id}}</td>
                        <td class="font-md">{{$sitejob->model}}</td>
                        <td class="font-md">{{date('d-m-Y',strtotime($job->created_at)+($job->quotes->turnaround*24*3600))}}</td>

                        <td class="font-md">{{$sitejob->accessories}}</td>
                        <td class="font-md">{{$sitejob->visual_inspection}}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>

            <div class="p-0 col-2 m-0"><input type="checkbox"> Urgent Job</div>
            <div class="p-0 col-3 m-0"><input type="checkbox" checked> Normal Job</div>
            <div class="p-0 col-4 m-0"><input type="checkbox"> Accredited Calibration</div>
            <div class="p-0 col-3 m-0"><input type="checkbox"> Non Accredited Calibration</div>
            <div class="p-0 col-5 m-0"><input type="checkbox" checked> Full Ranges of Items to be calibrated</div>
            <div class="p-0 col-7 m-0"><input type="checkbox"> Partial Ranges to be calibrated as negotiated.</div>
            <div class="p-0 col-5 m-0"><input type="checkbox" checked> Re-Calibration Interval of 12 months</div>
            <div class="p-0 col-7 m-0"><input type="checkbox"> Re-Calibration Interval of 6 months</div>
            <div class="p-0 col-5 m-0"><input type="checkbox"> Re-Calibration Interval of 3 months</div>
            <div class="p-0 col-7 m-0"><input type="checkbox" checked> No Re-Calibration Interval required.</div>
            <div class="p-0 col-5 m-0"><input type="checkbox"> Customer Preferred Cal Procedure</div>
            <div class="p-0 col-7 m-0"><input type="checkbox" checked> AIMS's Selected Cal Price</div>
            <div class="p-0 col-5 m-0"><input type="checkbox"> Statement of Conformity required</div>
            <div class="col-12 font-md">
                <p>
                    ( In case Customer chooses this option then Customer will provide detailed acceptance /
                    specification
                    limits for each
                    of the equipment above as a separate list.Then AIMS Cal Lab will provide conformity statement
                    according to the
                    decision rule defined by the AiMS CAL Lab.
                    If acceptance / specification limits are not provided by customer with in 2 days of signing this
                    contract then AIMS Cal Lab will not provide any Statement of Conformity. )
                </p>
            </div>
            <div class="p-0 col-5">
                <p class="font-md font-italic"><input type="checkbox" checked> Statement of Conformity Not required</p>
            </div>

            <p class="col-12 font-md b font-italic">Note:</p>
            <p class="col-12 font-md font-italic">
                Dear Customer, you are requested to collect your calibrated equipment within 30 days of the "Return
                Date" as per
                this Job Form. After that AIMS CAL Lab shall not be responsible for any damage / loss of above listed
                equipment. By
                signing you also agree with the terms and conditions mentioned below or on the reverse side of this
                Calibration Job
                Form.


            </p>

            <table class="table table-bordered">
                <thead>
                <tr class="font-md">
                    <th width="50%" class="text-center">Received for calibration by (AIMS Representative)</th>
                    <th width="50%" class="text-center">Customer Representative</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-md">
                        <div class="row py-3">
                            <div class="col-3">
                                Signature
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5" style="height: 50px">
                                <span class="text-right">
                                    <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="120" class="img-fluid">
                                </span>
                            </div>
                            <div class="col-3">
                                Name
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5">
                                <span class="text-right">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                            </div>
                            <div class="col-3">
                                Date
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5">
                                <span class="text-right">{{date('d-m-Y')}}</span>
                            </div>

                        </div>

                    </td>

                    <td class="font-md">
                        <div class="row py-3">
                            <div class="col-3">
                                Signature
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5" style="height: 50px">
                                <span class="text-right custom-bottom-border "></span>
                            </div>
                            <div class="col-3">
                                Name
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5">
                                <span class="text-right ">{{$job->quotes->principal}}</span>
                            </div>
                            <div class="col-3">
                                Date
                            </div>
                            <div class="col-8 text-center custom-bottom-border px-5">
                                <span class="text-right">{{date('d-m-Y')}}</span>
                            </div>

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <div class="col-12 text-center">
                <p class="font-md b mt-3">Terms and Conditions</p>
            </div>
            <div class="col-12">
                <p class="font-xs">1. On receipt of equipment, one copy of Calibration Job Form shall be handed over to
                    Customer Representative.<br>
                    2. In case the equipment is received through courier/mail, Calibration Job Form shall be dispatched
                    by
                    mail or through Fax to confirm
                    receipt of equipment.<br>
                    3. Same copy of Calibration Job Form/and or Authority Letter of company’s authorized personnel shall
                    be
                    collected from Customer by
                    hand or by mail, before handing over the equipment to Cusotmer Representative.<br>
                    4. Equipment Delivery by hand: In case the equipment is delivered by hand, Delivery Note shall be
                    duly
                    signed by Customer
                    Representative on receipt of equipment.<br>
                    5. Equipment Delivery by courier: In case the equipment is dispatched through courier, Delivery Note
                    shall be sent along with equipment.<br>
                    Customers are requested to send us Delivery Note duly signed on receipt of equipment.<br>
                    6. Dear customer, you are requested to collect your calibrated equipment within 30 days of the
                    "Return
                    Date" as per this Job Form. After
                    that AIMS Cal Lab shall not be responsible for any damage/loss of above listed equipment.
                </p>
            </div>
            <div class="col-12 text-center font-sm">
                <p class="custom-border">This document is the property of AIMS Cal Lab. It is not to be retransmitted,
                    printed or
                    copied without prior written permission of the company.</p>

            </div>
        </div>
    </div>

</body>
</html>