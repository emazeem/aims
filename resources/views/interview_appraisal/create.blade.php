@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="border-bottom "><i class="fa fa-plus-circle"></i> Add Interview Appraisal</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('interview_appraisal.store')}}" method="post">
            @csrf
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{old('fname')}}">
                        @if ($errors->has('fname'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('fname') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off" value="{{old('lname')}}">
                        @if ($errors->has('lname'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('lname') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="age" class="col-sm-2 control-label">Age</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" autocomplete="off" value="{{old('age')}}">
                        @if ($errors->has('age'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('age') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label for="basic_qualification" class="col-sm-2 control-label">Basic Qualification</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic_qualification" name="basic_qualification" placeholder="Basic Qualification" autocomplete="off" value="{{old('basic_qualification')}}">
                        @if ($errors->has('basic_qualification'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('basic_qualification') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label for="basic_qualification_duration" class="col-sm-2 control-label">Basic Qualification Duration</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic_qualification_duration" name="basic_qualification_duration" placeholder="Basic Qualification Duration" autocomplete="off" value="{{old('basic_qualification_duration')}}">
                        @if ($errors->has('basic_qualification_duration'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('basic_qualification_duration') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="highest_qualification" class="col-sm-2 control-label">Highest Qualification</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="highest_qualification" name="highest_qualification" placeholder="Highest Qualification" autocomplete="off" value="{{old('highest_qualification')}}">
                        @if ($errors->has('highest_qualification'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('highest_qualification') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="highest_qualification_duration" class="col-sm-2 control-label">Highest Qualification Duration</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="highest_qualification_duration" name="highest_qualification_duration" placeholder="Highest Qualification Duration" autocomplete="off" value="{{old('highest_qualification_duration')}}">
                        @if ($errors->has('highest_qualification_duration'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('highest_qualification_duration') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>



                <div class="form-group row">
                    <label for="relevant_experience" class="col-sm-2 control-label">Relevant Experience</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="relevant_experience" name="relevant_experience" placeholder="Relevant Experience" autocomplete="off" value="{{old('relevant_experience')}}">
                        @if ($errors->has('relevant_experience'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('relevant_experience') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total_experience" class="col-sm-2 control-label">Total Experience</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="total_experience" name="total_experience" placeholder="Total Experience" autocomplete="off" value="{{old('total_experience')}}">
                        @if ($errors->has('total_experience'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('total_experience') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_salary" class="col-sm-2 control-label">Last Salary</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="last_salary" name="last_salary" placeholder="Last Salary" autocomplete="off" value="{{old('last_salary')}}">
                        @if ($errors->has('last_salary'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('last_salary') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desired_salary" class="col-sm-2 control-label">Desired Salary</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="desired_salary" name="desired_salary" placeholder="Desired Salary" autocomplete="off" value="{{old('desired_salary')}}">
                        @if ($errors->has('desired_salary'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('desired_salary') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>




                <div class="form-group  row">
                    <label for="bu_for_candidate" class="col-sm-2 control-label">BU for Candidate</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="bu_for_candidate" name="bu_for_candidate">
                            <option value="" selected disabled>Select BU For Candidate</option>
                            <option value="calibration-services">Calibration-Services</option>
                            <option value="consultancy-services">Consultancy-Services</option>
                            <option value="ndt-services">NDT-Services</option>
                            <option value="electrical-and-instrumental-and-supplies-installation-and-testing-services">Electrical-And-Instrumental-And-Supplies-Installation-And-Testing-Services</option>
                            <option value="general-trading">General-Trading</option>
                        </select>

                        @if ($errors->has('bu_for_candidate'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('bu_for_candidate') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="suitability_for_other_department" class="col-sm-2 control-label">Suitability for other Department</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="suitability_for_other_department" name="suitability_for_other_department">
                            <option value="" selected disabled>Select Suitability For Other Department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('suitability_for_other_department'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('suitability_for_other_department') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <h6>Personal Traits</h6>
                <table class="table table-bordered table-sm table-hover">
                    <tr>
                        <td>
                            <label for="education" class="control-label">Education</label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="education" name="education">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('education'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('education') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="computer_literacy" class="control-label">Computer Literacy</label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="computer_literacy" name="computer_literacy">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('computer_literacy'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('computer_literacy') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="intelligence" class="control-label">Intelligence</label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="intelligence" name="intelligence">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('intelligence'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('intelligence') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="experience_related_to_the_job_interviewed_for" class="control-label">Experience Related to the Job Interviewed For</label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="experience_related_to_the_job_interviewed_for" name="experience_related_to_the_job_interviewed_for">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('experience_related_to_the_job_interviewed_for'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('experience_related_to_the_job_interviewed_for') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="experience_related_to_the_other_lines_of_company_business" class="control-label">
                                Experience Related to the other lines of company business
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="experience_related_to_the_other_lines_of_company_business" name="experience_related_to_the_other_lines_of_company_business">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('experience_related_to_the_other_lines_of_company_business'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('experience_related_to_the_other_lines_of_company_business') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="job_knowledge_skills" class="control-label">
                                Job Knowledge Skills
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="job_knowledge_skills" name="job_knowledge_skills">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('job_knowledge_skills'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('job_knowledge_skills') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="personality" class="control-label">
                                Personality
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="personality" name="personality">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('personality'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('personality') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="communication_skills" class="control-label">
                                Communication Skills
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="communication_skills" name="communication_skills">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('communication_skills'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('communication_skills') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="development_potential_motivation" class="control-label">
                                Development Potential/Motivation
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="development_potential_motivation" name="development_potential_motivation">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('development_potential_motivation'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('development_potential_motivation') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="personal_aptitude_related_to_the_job_interviewed_for" class="control-label">
                                Personal Aptitude Related to the Job Interviewed For
                            </label>
                        </td>
                        <td>
                            <select class="form-control text-xs" id="personal_aptitude_related_to_the_job_interviewed_for" name="personal_aptitude_related_to_the_job_interviewed_for">
                                <option value="" selected disabled>Select Grade</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @if ($errors->has('personal_aptitude_related_to_the_job_interviewed_for'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('personal_aptitude_related_to_the_job_interviewed_for') }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="mt-5 pt-3 col-12 text-right">
                    <a href="{!! url(''); !!}" class="btn btn-primary"><i class="feather icon-x-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection