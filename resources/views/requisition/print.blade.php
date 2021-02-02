<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HR Requirement</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .font-10{
            font-size: 14px;
        }
        .row{
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
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 40px">HUMAN RESOURCE REQUIREMENT</p>
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
        <div class="row">
            <div class="col-4 font-10 ">Person required against Designation</div>
            <div class="col-8  font-10 custom-bottom-border">{{$show->designation->name}}</div>
        </div>
        <div class="row">
            <div class="col-4 font-10 ">Reasons for requirement</div>
            <div class="col-8  font-10 custom-bottom-border">{{$show->reason}}</div>
        </div>
        <div class="row">
            <div class="col-12  font-10 custom-bottom-border">`</div>
        </div>
        <div class="row">
            <div class="col-12  font-10 custom-bottom-border">`</div>
        </div>
        <div class="row">
            <div class="col-4 font-10 ">Qualification/Experience Required</div>
            <div class="col-8  font-10 custom-bottom-border">{{$show->qualification}}</div>
        </div>

        <div class="row">
            <div class="col-4 font-10 "></div>
            <div class="col-8  font-10 custom-bottom-border">`</div>
        </div>

        <div class="row">
            <div class="col-4 font-10 ">Special Skills (If any)</div>
            <div class="col-8  font-10 custom-bottom-border">{{$show->special_skills}}</div>
        </div>
        <div class="row">
            <div class="col-2 font-10 ">Initiated by</div>
            <div class="col-2 font-10 custom-bottom-border">
                {{$show->initiated_user->fname}} {{$show->initiated_user->lname}}
            </div>
            <div class="col-2 font-10 ">Initiated on</div>
            <div class="col-2 font-10 custom-bottom-border">
                {{date('d-m-Y ',strtotime($show->created_at))}}
            </div>
            <div class="col-1 font-10 ">Department</div>
            <div class="col-3 font-10 custom-bottom-border">
                {{$show->initiated_user->departments->name}}
            </div>
        </div>
        <div class="row">
            <div class="col-2 font-10 ">Time Frame</div>
            <div class="col-2 font-10 custom-bottom-border">
                {{ucfirst(str_replace('-', ' ', $show->time_frame))}}
            </div>
        </div>
        <div class="row">
            <h5 class="font-weight-bold">For HRD Review:</h5>
        </div>
        <div class="row">
            <div class="col-12"><input type="checkbox" {{$show->hrd_review=='internal-re-adjustment'?'checked':''}}> Internal Re-adjustment</div>
        </div>
        <div class="row">

        <div class="col-12"><input type="checkbox"  {{$show->hrd_review=='new-hiring'?'checked':''}}> New Hiring</div>
        </div>
        <div class="row">

        <div class="col-12"><input type="checkbox"  {{$show->hrd_review=='rejection'?'checked':''}}> Rejection</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Reviewed / Approved By:</div>
            <div class="col-4 font-10 custom-bottom-border">
                {{$show->approved_by}}
            </div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Remarks:</div>
            <div class="col-9 font-10 custom-bottom-border">
                {{$show->remarks}}
            </div>
        </div>

    </div>
</div>
</body>
</html>