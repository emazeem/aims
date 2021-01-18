<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employment Contract</title>
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
                    JOINING REPORT
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
        </div>
        <div class="row">
            <div class="col-4">
                Designation
            </div>
            <div class="col-8 custom-bottom-border">

            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Date of Joining
            </div>
            <div class="col-4 custom-bottom-border">
                {{$show->joining->format('d-m-Y')}}
            </div>
            <div class="col-4">
                (DD/MM/YYYY)
            </div>
        </div>
    </div>
        <div class="col-12 mt-3">
            I hereby report for duty, with effect from
            <span class="px-5 custom-bottom-border">
            <span class="px-5">
                {{$show->joining->format('d-m-Y')}}
            </span>
            </span>
            (Date- DD/MM/YY)
        </div>
    <div class="col-12">

        <div class="mt-5">
            Signature:
            <span class="px-5 custom-bottom-border">
            <span class="px-5 custom-bottom-border">  </span></span>
        </div>
        <div class="col-12 mt-5 custom-top-border custom-bottom-border" style="padding: 1px"></div>
        <h4 class="font-weight-bold mt-5">HR Department</h4>
        <div class="row">
            <div class="col-3">
                Received on:
            </div>
            <div class="col-3 custom-bottom-border">
            </div>
            <div class="col-3">
                (DD/MM/YYYY)
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Entered into the rolls on:
            </div>
            <div class="col-3 custom-bottom-border">
            </div>
            <div class="col-2">
                (DD/MM/YYYY)
            </div>
            <div class="col-2">
                Employee ID:
            </div>
            <div class="col-2 custom-bottom-border">

            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-4">Name</div>
        <div class="col-8 custom-bottom-border">
            {{$show->hr->fname.' '.$show->hr->lname}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">Designation</div>
        <div class="col-8 custom-bottom-border">
            {{$show->hr->designations->name}}
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-2">Signature</div>
        <div class="col-2 custom-bottom-border">
            <img src="{{Storage::disk('local')->url('public/signature/'.$show->hr_user_id.'/'.$show->hr->signature)}}" width="100" class="img-fluid">
        </div>
    </div>

</div>
</body>
</html>






