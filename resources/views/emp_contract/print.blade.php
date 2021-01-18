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

    <div class="col-12 font-style mt-2">

        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border">
                <p class="text-center b font-24" style="margin-top: 40px">
                    EMPLOYMENT CONTRACT
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
        <div class="row font-10">
            <h4>This is the Employment contract between <b>Al-Meezan Industrial Metrology Services (AIMS)</b> (hereinafter
            referred to as ‘Employer’) and	<span class="custom-bottom-border px-5">{{$show->appraisal->fname.' '.$show->appraisal->lname}}</span>	(hereinafter referred to as ‘Employee’)
                under the terms and conditions of employment below :</h4>
        </div>
        <div class="row">
            <ol type="1">
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Commencement
                            of Employment
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-4">
                                    Effective from
                                </div>
                                <div class="col-8 text-center custom-bottom-border">
                                    {{$show->commencement->format('d-M-Y')}}
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="checkbox"> until either party terminates the contract.
                            </div>
                            <div class="col-12">
                                <input type="checkbox"> for a fixed term contract for a period of	<span class="px-5 mx-3 custom-bottom-border"></span>	<i>* day(s) /week(s)/ month(s)/ year(s),
                                <br>
                                ending on</i> <span class="px-5 mx-3 custom-bottom-border"></span> .
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Probation Period
                        </div>
                        <div class="col-9">
                            <span class="pr-5">
                            <input type="checkbox" {{($show->probation_applicable==0)?'checked':''}}> No
                            </span>

                            <input type="checkbox" {{($show->probation_applicable==1)?'checked':''}}> Yes
                            <span class="px-5 custom-bottom-border">
                                @if($show->probation_period=='one-month')
                                    1
                                @elseif($show->probation_period=='two-months')
                                    2
                                @elseif($show->probation_period=='three-months')
                                    3
                                @elseif($show->probation_period=='six-months')
                                    6
                                @else
                                @endif
                            </span>
                            month(s)
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Position and Section Employed
                        </div>
                        <div class="col-9 custom-bottom-border">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Place of Work
                        </div>
                        <div class="col-9 custom-bottom-border">
                            {{$show->place_of_work}}
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Working Hours
                        </div>
                        <div class="col-9">
                            Fixed , at	<span class="px-5 custom-bottom-border">6</span>	days per week, 	<span class="px-5 custom-bottom-border">8</span>	hours per day
                            <br>
                            from 	<span class="px-5 custom-bottom-border">9</span>	*am	to	<span class="px-5 custom-bottom-border">5</span>	pm
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Wages
                            <p>(a) wage rate</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0">Total salary of Rs. <span class="px-5 mx-3 custom-bottom-border">{{$show->salary}}</span> per  /month;</p>
                            <p class="m-0">that includes the following allowance(s) :</p>
                            @php $allowances=explode(',',$show->allowances); @endphp
                            <p class="m-0"><input type="checkbox" {{(in_array('medical-allowances',$allowances))?'checked':''}}> Medical allowance</p>
                            <p class="m-0"><input type="checkbox" {{(in_array('travelling-allowances',$allowances))?'checked':''}}> Travelling allowance</p>

                        </div>
                        <div class="col-3 font-weight-bold">
                            <p>
                                (b) payment of
                                wages & wage
                            </p>
                        </div>
                        <div class="col-9">
                            <p class="m-0">The Employee is entitled to:</p>
                            <p class="m-0"><input type="checkbox"> statutory holidays as specified in the Employment Ordinance</p>
                            <p class="m-0"><input type="checkbox"> public holidays</p>
                            <p class="m-0"><input type="checkbox"> plus other holidays (please specify) <span class="mx-3 px-5 custom-bottom-border">  </span>	N/A</p>

                        </div>

                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Paid Annual Leave
                        </div>
                        <div class="col-9">
                            <p class=""> The Employee is entitled to paid annual leave according to the provisions of the Employment Ordinance (ranging from 7 to 14 days depending on the Employee’s length of service).</p>
                        </div>

                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Termination of
                            Employment
                            Contract
                        </div>
                        <div class="col-9">
                            <p class="">
                                A notice period of 	<span class="px-5 custom-bottom-border"> One </span>	Month or <br>
                                an equivalent amount of wages in lieu of notice (notice period not less than 7 days).<br>
                                During the probation period (if applicable) :<br>
                                -	within the first month : without notice or wages in lieu of notice<br>
                                -	 after the first month : a notice period of 	One	month(s)<br>
                                or an equivalent amount of wages in lieu of notice (notice period not less than 7 days).

                            </p>
                        </div>

                    </div>
                </li>
            </ol>
        </div>
        <div class="row">
            <div class="col-6">
                <h6 class="text-center font-weight-bold"> Signature of Employee</h6>

                <div class="row mt-5">
                    <div class="col-3">Name in full:</div>
                    <div class="col-6 custom-bottom-border">
                        {{$show->appraisal->fname}} {{$show->appraisal->lname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">CNIC:</div>
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
            <div class="col-6">
                <h6 class="text-center font-weight-bold"> Signature of Employer or Employer’s Representative</h6>

                <div class="row mt-5">
                    <div class="col-3">Name in full:</div>
                    <div class="col-6 custom-bottom-border">
                        {{$show->orientators->fname.' '.$show->orientators->lname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">Position held:</div>
                    <div class="col-6 custom-bottom-border">
                        {{$show->orientators->designations->name}}
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
    </div>
    <div class="row mt-5">
        <div class="col-8"></div>
        <div class="col-4">
            <div class="col-12 ml-5 p-3">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <span class="px-5 custom-top-border">Stamp of the Company</span>
        </div>
    </div>

</div>
</body>
</html>