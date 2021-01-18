@extends('layouts.master')
@section('content')

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h5 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Interview Appraisal
            </h5>

            <span class="float-right">
            <a href="{{route('interview_appraisal.print',[$show->id])}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
            </span>
        </div>
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered">

                <tr>
                    <th>Full Name</th>
                    <td>{{$show->fname}} {{$show->lname}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$show->age}}</td>
                </tr>
                <tr>
                    <th>Basic Qualification</th>
                    <td>{{$show->basic_qualification}}</td>
                </tr>
                <tr>
                    <th>Basic Qualification Duration</th>
                    <td>{{$show->basic_qualification_duration}} Years</td>
                </tr>
                <tr>
                    <th>Highest Qualification</th>
                    <td>{{$show->highest_qualification}}</td>
                </tr>
                <tr>
                    <th>Highest Qualification Duration</th>
                    <td>{{$show->highest_qualification_duration}} Years</td>
                </tr>
                <tr>
                    <th>BU for Candidate</th>
                    <td class="text-capitalize">{{str_replace('-', ' ', $show->bu_for_candidate)}} </td>
                </tr>
                <tr>
                    <th>Relevant Experience</th>
                    <td>{{$show->relevant_experience}} Years</td>
                </tr>
                <tr>
                    <th>Total Experience</th>
                    <td>{{$show->total_experience}} Years</td>
                </tr>
                <tr>
                    <th>Last Salary</th>
                    <td>{{$show->last_salary}} Rs.</td>
                </tr>
                <tr>
                    <th>Desired Salary</th>
                    <td>{{$show->desired_salary}} Rs.</td>
                </tr>
                <?php $traits=json_decode($show->personal_traits,true); ?>
                <tr>
                    <th>Personal Traits</th>
                    <td>
                        Education ({{$traits['education']}}/5)
                        <br>Computer Literacy ({{$traits['computer_literacy']}}/5)
                        <br>Intelligence ({{$traits['intelligence']}}/5)
                        <br>Experience Related to the job interviewed for ({{$traits['experience_related_to_the_job_interviewed_for']}}/5)
                        <br>Experience related to the other lines_of company business ({{$traits['experience_related_to_the_other_lines_of_company_business']}}/5)
                        <br>Job knowledge skills ({{$traits['job_knowledge_skills']}}/5)
                        <br>Personality ({{$traits['personality']}}/5)
                        <br>Communication skills ({{$traits['communication_skills']}}/5)
                        <br>Development potential motivation ({{$traits['development_potential_motivation']}}/5)
                        <br>Personal aptitude related to the job interviewed for ({{$traits['personal_aptitude_related_to_the_job_interviewed_for']}}/5)
                    </td>
                </tr>
                <tr>
                    <th>Suitable for other Department</th>
                    <td>{{$show->suitable_departments->name}}</td>
                </tr>
                <tr>
                    <th>Evaluator</th>
                    <td>{{$show->evaluators->fname}} {{$show->evaluators->lname}}</td>
                </tr>












                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection