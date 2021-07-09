<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Application Form</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .custom-top-border{
            border-top: 1px solid black;
        }
        .row {
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="col-12 font-style mt-2 p-0 m-0">

        <div class="row  p-0 m-0">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 p-0 m-0 border-left-right-0 custom-border">
                <p class="text-center b font-24" style="margin-top: 40px">
                    LEAVE APPLICATION FORM
                </p>
            </div>
            <div class="col-3 row  p-0 m-0 custom-border font-9 p-0">
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
    <div class="col-12 ">
        <p class="font-weight-bold  p-0 m-0 mt-5">For Applicant Use:</p>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>Employ Name</th>
                    <th>Employ No.</th>
                    <th>Department</th>
                    <th>Section</th>
                </tr>
                <tr>
                    <th class="font-weight-normal">{{$show->users->fname.' '.$show->users->lname}}</th>
                    <th class="font-weight-normal">{{$show->users->cid}}</th>
                    <th class="font-weight-normal">{{$show->users->departments->name}}</th>
                    <th class="font-weight-normal">{{$show->users->designations->name}}</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-4 row">

                <div class="col-6  font-weight-bold">
                    Nature of Leave:
                </div>
                <div class="col-5 custom-bottom-border text-capitalize">
                    {{str_replace('-',' ',$show->nature->name)}}
                </div>
            </div>
            <div class="col-8 row">
                <div class="col-3">
                    Annual <input type="checkbox" {{($show->nature_of_leave=='annual-leaves')?'checked':''}}>

                </div>
                <div class="col-3">
                    Casual	<input type="checkbox"  {{($show->nature_of_leave=='casual-leaves')?'checked':''}}>

                </div>
                <div class="col-3">
                    Medical	<input type="checkbox"  {{($show->nature_of_leave=='medical-leaves')?'checked':''}}>
                </div>
                <div class="col-3">
                    Earned <input type="checkbox">
                </div>
            </div>
        </div>
    </div>
    <?php
    $fdate = $show->from;
    $tdate = $show->to;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');

    ?>

    <div class="col-12 row p-4">
        <div class="col-12 p-0 m-0">
            <div class="font-weight-bold">Leave Schedule:</div>
        </div>
        <div class="col-4 row">
            <div class="col-6 b">From:</div>
            <div class="col-5 custom-bottom-border">{{$show->from->format('d-m-Y')}}</div>
        </div>
        <div class="col-4 row">
            <div class="col-6 b">To:</div>
            <div class="col-5 custom-bottom-border">{{$show->to->format('d-m-Y')}}</div>
        </div>
        <div class="col-4 row">
            <div class="col-7 ">Total No of Leave Days</div>
            <div class="col-5 custom-bottom-border">{{$days+1}}</div>
        </div>
    </div>
    <div class="col-12 p-0">
        <p class="font-weight-bold"> Reason for Leave:</p>
    </div>
    <div class="col-12 custom-bottom-border p-0">
        {{$show->reason}}
    </div>
    <div class="col-12 row">


        <div class="col-6">
            <div class="col-12 font-weight-bold p-0" >Leave Address and Contact:</div>
            <div class="col-12 custom-bottom-border">
                {{$show->address_contact}}
            </div>

        </div>

        <div class="col-6 row">
            <div class="col-12 font-weight-bold">
                Leave Balance Available:
            </div>
            <div class="col-6">
                Annual Leave
            </div>
            <div class="col-6 text-center  custom-bottom-border">
                {{$show->child}}
            </div>
            <div class="col-6">
                Casual Leave
            </div>
            <div class="col-6 text-center  custom-bottom-border">
                {{$show->child}}

            </div>
            <div class="col-6">
                Medical Leave
            </div>
            <div class="col-6  text-center custom-bottom-border">
                {{$show->child}}
            </div>
            <div class="col-6">
                Earned Leave
            </div>
            <div class="col-6 custom-bottom-border">

            </div>
        </div>

        <div class="col-12 text-center mt-5">
            <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="140" class="img-fluid mb-3 border-bottom pb-3 border-dark mx-5">
            <br>
            Applicant Signature / Date
        </div>

    </div>
    <div class="col-12 ">

        <p class="font-weight-bold m-0">Approval Hierarchy:</p>
        <p class="font-weight-bold m-0">Recommendation by Department Head:</p>
        <div class="row">
            <div class="col-4">
                Recommended <input type="checkbox" {{$show->status==2?'checked':''}} {{$show->status==4?'checked':''}} >
            </div>
            <div class="col-4">
                Not Recommended <input type="checkbox"  {{$show->status==1?'checked':''}} >
            </div>

        </div>
        <table class="table table-bordered">
            <tr>
                <td>Name</td>
                <td>Signature</td>
                <td>Date</td>
                <td>Remarks</td>
            </tr>
            <tr>
                <td>{{$show->head->fname.' '.$show->head->lname}}</td>
                <td>
                    <img src="{{Storage::disk('local')->url('public/signature/'.$show->head_id.'/'.$show->head->signature)}}"   class="img-fluid" width="100">
                </td>
                <td>{{$show->head_recommendation_date}}</td>
                <td>{{$show->head_remarks}}</td>
            </tr>
        </table>
        <p class="font-weight-bold m-0">Recommendation by Department Head:</p>
        <div class="row">
            <div class="col-4">
                Recommended <input type="checkbox"  {{$show->status==4?'checked':''}}>
            </div>
            <div class="col-4">
                Not Recommended <input type="checkbox"  {{$show->status==3?'checked':''}}>
            </div>

        </div>
        <table class="table table-bordered">
            <tr>
                <td>Name</td>
                <td>Signature</td>
                <td>Date</td>
                <td>Remarks</td>
            </tr>
            <tr>
                <td>{{$show->ceo->fname.' '.$show->ceo->lname}}</td>
                <td>
                    <img src="{{Storage::disk('local')->url('public/signature/'.$show->ceo_id.'/'.$show->ceo->signature)}}"   class="img-fluid" width="100">
                </td>
                <td>{{$show->ceo_recommendation_date}}</td>
                <td>{{$show->ceo_remarks}}</td>

            </tr>
        </table>
        <p class="font-weight-bold m-0">Admin Record:</p>
        <div class="row">
            <div class="col-6 row">
                <div class="col-3">
                    To
                </div>
                <div class="col-9 custom-bottom-border">
                    {{$show->users->fname.' '.$show->users->lname}}
                </div>
            </div>
            <div class="col-6 row p-0 m-0">
                <div class="col-3">
                    Employ No.
                </div>
                <div class="col-9 custom-bottom-border">
                    {{$show->users->cid}}
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 row p-0 m-0">
        <div class="col-5 p-0 m-0">
            Reference is made to your leave application dated:
        </div>
        <div class="col-7 row p-0 m-0">
            @php $from=str_split($show->from->format('d-m-Y'));  @endphp
            @foreach($from as $item)
                @if($item=='-')

                    <div class="col-1 py-1 text-center my-1">

                        {{$item}}
                    </div>
                @else
                    <div class="col-1 p-1 text-center border border-dark mr-1">
                        {{$item}}
                    </div>
                    @endif

            @endforeach
        </div>
    </div>

    <div class="col-12 p-0 m-0">
        <div class="row p-0 m-0">
            <div class="col-4 p-0 m-0">
                You have been granted:
            </div>
            <div class="col-8 row">
                <div class="col-3">
                    Annual <input type="checkbox" {{($show->nature_of_leave=='annual-leaves')?'checked':''}}>

                </div>
                <div class="col-3">
                    Casual	<input type="checkbox"  {{($show->nature_of_leave=='casual-leaves')?'checked':''}}>

                </div>
                <div class="col-3">
                    Medical	<input type="checkbox"  {{($show->nature_of_leave=='medical-leaves')?'checked':''}}>
                </div>
                <div class="col-3">
                    Earned <input type="checkbox">
                </div>
            </div>
        </div>
        <div class="col-12 row py-4">
            <div class="col-3 row">
                <div class="col-4">From </div>
                <div class="col-7 custom-bottom-border">{{$show->from->format('d-m-Y')}}</div>
            </div>
            <div class="col-3 row">
                <div class="col-4">To </div>
                <div class="col-7 custom-bottom-border">{{$show->to->format('d-m-Y')}}</div>
            </div>
            <div class="col-6 row">
                The balance of this leave at your credit after this leave is
                <span class="px-5 custom-bottom-border"></span>
            </div>
        </div>
        <div class="col-12 p-0 m-0">
            You have not been allowed leave from <span class="px-5 custom-bottom-border">{{$show->from->format('d-m-Y')}}</span> To <span class="px-5 custom-bottom-border">{{$show->to->format('d-m-Y')}}</span>
        </div>
        <div class="row p-0 m-0">
            <div class='col-2 p-0 m-0'>
                for the reason:
            </div>
            <div class="col-10 custom-bottom-border p-0 m-0">
                {{$show->admin_remarks}}
            </div>
        </div>
        <div class="row p-0 m-0 pb-4">
            <div class='col-4 p-0 m-0'>
                <div class="row p-0 m-0">
                    <div class="col-6 p-0 m-0">
                        Dated:
                    </div>
                    <div class="col-6 p-0 m-0 custom-bottom-border">
                        {{$show->admin_recommendation_date->format('d-m-Y')}}
                    </div>
                </div>
            </div>
            <div class="col-4 p-0 m-0"></div>
            <div class="col-4 p-0 m-0">
                <div class="row p-0 m-0">
                    <div class="col-6 p-0 m-0">
                        Incharge Admin/HR
                    </div>
                    <div class="col-6 p-0 m-0 custom-bottom-border">
                        <img src="{{Storage::disk('local')->url('public/signature/'.$show->admin_id.'/'.$show->admin->signature)}}"   class="img-fluid" width="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>