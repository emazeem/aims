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
        .font-10 {
            font-size: 14px;
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
                    INTERVIEW APRAISAL FORM
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
        <div class="row">
            <div class="col-3 font-10 ">Name</div>
            <div class="col-4  font-10 custom-bottom-border">{{$show->fname.''.$show->lname}}</div>
            <div class="col-1 font-10 ">Age</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->age}}</div>
            <div class="col-1  font-10">Years</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Basic Qualification</div>
            <div class="col-4  font-10 custom-bottom-border">{{$show->basic_qualification}}</div>
            <div class="col-1 font-10 ">Age</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->basic_qualification_duration}}</div>
            <div class="col-1  font-10">Years</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Highest Qualification</div>
            <div class="col-4  font-10 custom-bottom-border">{{$show->highest_qualification}}</div>
            <div class="col-1 font-10 ">Age</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->highest_qualification_duration}}</div>
            <div class="col-1  font-10">Years</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">BU/BSD for which interviewed</div>
            <div class="col-4  font-10 custom-bottom-border">
                <span class="text-capitalize">{{str_replace('-', ' ', $show->bu_for_candidate)}} </span>

            </div>
            <div class="col-1 font-10 ">Date</div>
            <div class="col-2  font-10 custom-bottom-border">{{date('d-m-Y',strtotime($show->created_at))}}</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Relevant Experience</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->relevant_experience}}</div>
            <div class="col-1  font-10">Years</div>
            <div class="col-2 font-10 ">Total Experience</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->total_experience}}</div>
            <div class="col-1  font-10">Years</div>
        </div>
        <div class="row">
            <div class="col-3 font-10 ">Present / Last salary Rs.</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->last_salary}}</div>
            <div class="col-1 font-10 "></div>
            <div class="col-2 font-10 ">Desired Salary Rs.</div>
            <div class="col-2  font-10 custom-bottom-border">{{$show->desired_salary}}</div>
        </div>
        <div class="row">
            <ol type="A">
                <li>
                    <h6>PROFESSIONAL ABILITY IN RELATION TO THE JOB:</h6>
                    <small>(Give a score of 0 to 5)</small>
                    <table class="table table-bordered" style="width: 900px;">
                        <tr>
                            <td colspan="2">PERSONAL TRAITS</td>
                            <td>GRADING</td>
                        </tr>
                        @php
                            $personal_traits=json_decode($show->personal_traits,true);
                            $k=1;
                            $total=0;
                        @endphp
                        @foreach($personal_traits as $key=>$personal_trait)
                            <tr>
                                <td>{{$k}}</td>
                                <td class="text-capitalize">{{str_replace('_', ' ', $key)}}</td>
                                <td class="text-center">{{$personal_trait}}</td>
                            </tr>
                            @php
                                $k++;
                            $total=$total+$personal_trait;
                            @endphp
                        @endforeach
                    </table>
                </li>
                <li>
                    GRADING:
                    <table class="table table-bordered ">
                        <tr>
                            <td class="text-center">41 - 50</td>
                            <td>Outstanding</td>
                            <td class="text-center">
                                @if($total<50 and $total>40)
                                    ✔
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">31 - 40</td>
                            <td>Above Average</td>
                            <td class="text-center">
                                @if($total<40 and $total>30)
                                    ✔
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">21 - 30</td>
                            <td>Average</td>
                            <td class="text-center">
                                @if($total<30 and $total>20)
                                    ✔
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">11 - 20</td>
                            <td>Below Average</td>
                            <td class="text-center">
                                @if($total<20 and $total>10)
                                    ✔
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">0 - 11</td>
                            <td>Poor</td>
                            <td class="text-center">
                                @if($total<20 and $total>10)
                                    ✔
                                @endif
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    OVERALL EVALUATION IN RELATION TO JOB INTERVIEWED FOR:
                    <p class="col-12 p-5"></p>
                </li>
                <li>
                    SUITABILITY FOR ANY OTHER DEPARTMENT
                    <p>{{$show->suitable_departments->name}}</p>
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="col-2 font-10 ">Signature</div>
                        <div class="col-3  font-10 custom-bottom-border">
                            <img src="{{Storage::disk('local')->url('public/signature/'.$show->evaluator.'/'.$show->evaluators->signature)}}" width="100" class="img-fluid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="col-2 font-10 ">Name</div>
                        <div class="col-3  font-10 custom-bottom-border">
                            {{$show->evaluators->fname.' '.$show->evaluators->lname}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="col-2 font-10 ">Position</div>
                        <div class="col-3  font-10 custom-bottom-border">
                            {{$show->evaluators->designations->name}}
                        </div>
                    </div>
                </li>


            </ol>
        </div>


    </div>
</div>
</body>
</html>