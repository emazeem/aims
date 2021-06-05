<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request Review Form</title>
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
    <div class="row font-style mt-2">
        <div class="col-2 text-center custom-border">
            <img src="{{url('/img/AIMS.png')}}" width="150" class="img-fluid p-1">
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
            <div class="col-4">Inquiry#:</div>
            <div class="col-8 custom-bottom-border" >{{'INQ/'.date('y',strtotime($quotes->created_at)).'/'.$quotes->id}}</div>
        </div>
        <div class="col-4 row my-1 font-11 ">
            <div class="col-5">Inquiry Date:</div>
            <div class="col-7 custom-bottom-border " >{{date('d-m-Y',strtotime($quotes->created_at))}}</div>
        </div>
        <div class="col-5 row my-1 font-11 ">
            <div class="col-5">Mode of Inquiry # </div>
            <div class="col-7 custom-bottom-border " >{{date('d-m-Y',strtotime($quotes->created_at))}}</div>
        </div>
        <div class="col-6 row my-1 font-11 ">
            <div class="col-3">Contact #: </div>
            <div class="col-9 custom-bottom-border" >{{$quotes->customers->reg_name}}</div>
        </div>
        <div class="col-6 row my-1 font-11 ">
            <div class="col-2"> Email : </div>
            <div class="col-10 custom-bottom-border " >
                @php $principals=explode(',',$quotes->customers->prin_name);$pemails=explode(',',$quotes->customers->prin_email); @endphp
                @if($quotes->principal==$principals[0])
                    {{$pemails[0]}}
                @elseif($quotes->principal==$principals[1])
                    {{$pemails[1]}}
                @else
                    {{$pemails[2]}}
                @endif
            </div>
        </div>
    </div>
    <div class="row text-center custom-border ">
        <p class="col-12 font-14 my-2 b">Scope of Work</p>
    </div>
    <div class="row">
        <div class="col-12 mt-2"><p class="font-11"><input type="checkbox" checked> Equipment List provided by customer</p></div>
        <div class="col-12"><p class="font-11"><input type="checkbox" checked> Equipment not covered by AIMS Capability List;</p></div>
    </div>
    <div class="row custom-border">
        <p class="font-12 col-12 my-2 b">Non-Listed Items</p>
        <table class="table table-bordered m-2">
            <thead>
            <tr>
                <th>Item</th>
                <th>Ref Std</th>
                <th>Cal Procedure</th>
                <th>Cal Schedule</th>
                <th>Subcontractor</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($items as $item)
                <?php
                        if ($item->rf_checks){
                            $checks=$item->rf_checks;
                            $checks=explode(',',$checks);
                        }else{
                            $checks=[0,0,0];
                        }
                ?>
                <tr>
                    <td class="text-left">{{($item->not_available)?$item->not_available:$item->capabilities->name}}</td>
                    <td><input type="checkbox" {{($item->status==2)?'checked':''}} {{($checks[0]==1)?'checked':''}}></td>
                    <td><input type="checkbox"{{($item->status==2)?'checked':''}} {{($checks[1]==1)?'checked':''}}></td>
                    <td><input type="checkbox" {{($item->status==2)?'checked':''}} {{($checks[2]==1)?'checked':''}}></td>
                    <td><input type="checkbox" {{($item->status==2)?'checked':''}} {{($checks[2]==1)?'checked':''}}></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col-4 py-2 custom-border border-right-0">
            Review closed on
            <span class="custom-bottom-border px-3 ">
                {{date('d-m-Y',strtotime($quotes->created_at))}}
            </span>
        </div>
        <div class="col-4 py-2 custom-border border-right-0">
            Closed by
            <span class="custom-bottom-border px-3">
                Technical Manager
            </span>
        </div>
        <div class="col-4 py-2 custom-border">
            Signature <span class="custom-bottom-border px-3">
                <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="120" class="img-fluid">

            </span>
        </div>
    </div>
    <div class="row my-3 text-center custom-border">
        <span class="col-12 font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission on the company</span>
    </div>
</div>
</body>
</html>