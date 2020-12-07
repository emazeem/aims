<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request Review Form</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>
<div class="container">
    <div class="row font-style mt-2">
        <div class="col-2 text-center custom-border">
            <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
        </div>
        <div class="col-7 border-left-right-0 custom-border">
            <p class="text-center b font-24" style="margin-top: 10px">Contract Review Sheet <br>for Calibration Job</p>
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
        <div class="col-3 row my-1 font-11 ">
            <div class="col-3">Inquiry#:</div>
            <div class="col-9 custom-bottom-border  text-center" >{{$quotes->id}}</div>
        </div>
        <div class="col-4 row my-1 font-11 ">
            <div class="col-5">Inquiry Date:</div>
            <div class="col-7 custom-bottom-border  text-center" >{{date('d-m-y',strtotime($quotes->created_at))}}</div>
        </div>
        <div class="col-5 row my-1 font-11 ">
            <div class="col-5">Mode of Inquiry # </div>
            <div class="col-7 custom-bottom-border  text-center" >{{date('d-m-y',strtotime($quotes->created_at))}}</div>
        </div>
        <div class="col-6 row my-1 font-11 ">
            <div class="col-3">Contact #: </div>
            <div class="col-9 custom-bottom-border  text-center" >{{$quotes->customers->reg_name}}</div>
        </div>
        <div class="col-6 row my-1 font-11 ">
            <div class="col-2"> Email : </div>
            <div class="col-10 custom-bottom-border  text-center" >
                @if($quotes->principal==$quotes->customers->prin_name_1)
                    {{$quotes->customers->prin_email_1}}
                @elseif($quotes->principal==$quotes->customers->prin_name_2)
                    {{$quotes->customers->prin_email_2}}
                @else
                    {{$quotes->customers->prin_email_3}}
                @endif
            </div>
        </div>

    </div>
    <div class="row text-center custom-border ">
        <p class="col-12 font-14 my-2 b">Scope of Work</p>
    </div>
    <div class="row">

        <div class="col-12 mt-2"><p class="font-11"><input type="checkbox"> Equipment List provided by customer</p>
        </div>
        <div class="col-12"><p class="font-11"><input type="checkbox"> Equipment not covered by AIMS Capability List;
            </p></div>
    </div>
    <div class="row custom-border">
        <p class="font-12 col-12 my-2 b">Job Requirement Review by Lab Department</p>
        @foreach($listed as $list)
            <div class="font-11 col-12"><li>{{$list->not_available}}</li></div>
        @endforeach

        <div class="col-6"><p class="font-11"><input type="checkbox" checked> Technical and manpower resources available.</p>
        </div>
        <div class="col-6"><p class="font-11"><input type="checkbox" checked> AIMS's Selected Cal Procedure.</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox" checked> Subcontracting of the job required.</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox" checked> Subcontractor Details</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox" checked> Time/Schedule available for job execution</p></div>
        <div class="col-12 my-1 mb-4 font-11 ">Remarks#:<span class="custom-bottom-border " style="padding-left: 90%"></span></div>
    </div>
    <div class="row custom-border mt-3">
        <p class="font-12 col-12 my-2 b">Non listed items not covered by AIMS</p>
        @foreach($nonlisted as $list)
            <div class="font-11 col-12"><li>{{$list->not_available}}</li></div>
        @endforeach

        <div class="col-6"><p class="font-11"><input type="checkbox"> Technical and manpower resources available.</p>
        </div>
        <div class="col-6"><p class="font-11"><input type="checkbox"> AIMS's Selected Cal Procedure.</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox"> Subcontracting of the job required.</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox"> Subcontractor Details</p></div>
        <div class="col-6"><p class="font-11"><input type="checkbox"> Time/Schedule available for job execution</p>
        </div>
        <div class="col-12 my-1 mb-4 font-11 ">Remarks#:<span class="custom-bottom-border " style="padding-left: 90%"></span></div>
    </div>

    <div class="row mt-3">
        <div class="col-4 py-2 custom-border border-right-0">
            Review closed on
            <div class="custom-bottom-border ">
                {{date('d-m-y',strtotime($quotes->created_at))}}
            </div>
        </div>
        <div class="col-4 py-2 custom-border border-right-0">
            Closed by
            <div class="custom-bottom-border ">
                Technical Manager
            </div>
        </div>
        <div class="col-4 py-2  custom-border">
            Signature <span class="custom-bottom-border " style="padding-left: 60%"></span>
        </div>
    </div>

    <div class="row my-3 text-center custom-border">
        <span class="col-12 font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission on the company</span>
    </div>
</div>
</body>
</html>