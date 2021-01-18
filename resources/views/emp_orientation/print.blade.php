<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employment Orientation</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .custom-top-border {
            border-top: 1px solid black;
        }

        .row {
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="col-12 font-style mt-2">

        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border">
                <p class="text-center b font-24" style="margin-top: 40px">
                    JOINING ORIENTATION
                </p>
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
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                Name
            </div>
            <div class="col-8 custom-bottom-border">
                {{$show->appraisal->fname.' '.$show->appraisal->lname}}
            </div>
            <div class="col-4">
                Employee No.
            </div>
            <div class="col-4 custom-bottom-border">
                EMP-{{$show->appraisal_id}}
            </div>
            <div class="col-12 mt-3">
                <p>The employee has been given orientation in following areas:</p>
                @php $areas=json_decode($show->o_area,true); @endphp
                @foreach($areas as $k=>$area)
                    <p class="text-capitalize"><input type="checkbox" checked> {{str_replace('-', ' ',$k)}}</p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12 pb-5 mb-5">
        <h6 class="font-weight-bold">Remarks :</h6>
        {{$show->remarks}}
    </div>

    <div class="col-6">
        <div class="row mt-5">
            <div class="col-3">Signature</div>
            <div class="col-6 custom-bottom-border">
                <img src="{{Storage::disk('local')->url('public/emp_joining_signature/'.$show->signature)}}" width="100" class="img-fluid">

            </div>
        </div>
        <div class="row">
            <div class="col-3">Position:</div>
            <div class="col-6 custom-bottom-border">
                {{$show->cnic}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">Date:</div>
            <div class="col-6 custom-bottom-border">
                {{date('d-m-Y')}}
            </div>
        </div>


    </div>
</div>
</body>
</html>