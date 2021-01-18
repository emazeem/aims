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
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Edit Orientation Joining</h3>
        </div>
        <div class="col-md-8 col-12">
            <form action="{{route('emp_orientation.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="employee">Select Employee</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="employee" name="employee">
                                <option selected disabled="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{($edit->appraisal_id==$employee->id)?'selected':''}}>{{$employee->appraisal->fname}} {{$employee->appraisal->lname}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('employee'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('employee') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="orientor">Select Orientor</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="orientor" name="orientor">
                                <option selected disabled="">Select Orientor</option>
                                @foreach($orientors as $orientor)
                                    <option value="{{$orientor->id}}" {{($edit->orientator==$orientor->id)?'selected':''}}>{{$orientor->fname}} {{$orientor->lname}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('orientor'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('orientor') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="remarks">Select remarks</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <textarea type="text" class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks">{{old('remarks',$edit->remarks)}}</textarea>
                             @if ($errors->has('remarks'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('remarks') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <label>
                            <span class="text-lg">Orientation Areas.</span>
                        </label>

                        <table class="table table-bordered table-sm table-hover bg-white">
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="introduction-to-key-personnel" name="introduction-to-key-personnel">
                                    </div>
                                </td>
                                <td>
                                    <label for="introduction-to-key-personnel">
                                        <span class="text-lg">Introduction to Key Personnel.</span>
                                        @if ($errors->has('introduction-to-key-personnel'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('introduction-to-key-personnel') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="facility-and-operations-familiarization" name="facility-and-operations-familiarization">
                                    </div>
                                </td>
                                <td>
                                    <label for="facility-and-operations-familiarization">
                                        <span class="text-lg">Facility and Operations Familiarization.</span>
                                        @if ($errors->has('facility-and-operations-familiarization'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('facility-and-operations-familiarization') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="review-of-safety-regulations" name="review-of-safety-regulations">
                                    </div>
                                </td>
                                <td>
                                    <label for="review-of-safety-regulations">
                                        <span class="text-lg">Review of Safety Regulations.</span>
                                        @if ($errors->has('review-of-safety-regulations'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('review-of-safety-regulations') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="disciplinary-instructions" name="disciplinary-instructions">
                                    </div>
                                </td>
                                <td>
                                    <label for="disciplinary-instructions">
                                        <span class="text-lg">Disciplinary Instructions.</span>
                                        @if ($errors->has('disciplinary-instructions'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('disciplinary-instructions') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="conduct-with-clients-and-colleagues" name="conduct-with-clients-and-colleagues">
                                    </div>
                                </td>
                                <td>
                                    <label for="conduct-with-clients-and-colleagues">
                                        <span class="text-lg">Conduct with Clients and Colleagues.</span>
                                        @if ($errors->has('conduct-with-clients-and-colleagues'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('conduct-with-clients-and-colleagues') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="company-organization-chart" name="company-organization-chart">
                                    </div>
                                </td>
                                <td>
                                    <label for="company-organization-chart">
                                        <span class="text-lg">Company's Organization Chart.</span>
                                        @if ($errors->has('company-organization-chart'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('company-organization-chart') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="function-of-different-departments" name="function-of-different-departments">
                                    </div>
                                </td>
                                <td>
                                    <label for="function-of-different-departments">
                                        <span class="text-lg">Function of Different Departments.</span>
                                        @if ($errors->has('function-of-different-departments'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('function-of-different-departments') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="individual-responsibility-and-understanding-of-quality-policy" name="individual-responsibility-and-understanding-of-quality-policy">
                                    </div>
                                </td>
                                <td>
                                    <label for="individual-responsibility-and-understanding-of-quality-policy">
                                        <span class="text-lg">Individual Responsibility and Understanding of Quality Policy.</span>
                                        @if ($errors->has('individual-responsibility-and-understanding-of-quality-policy'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('individual-responsibility-and-understanding-of-quality-policy') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="companys-quality-assurance-manual-and-AIMS-standard-or-procedures" name="companys-quality-assurance-manual-and-AIMS-standard-or-procedures">
                                    </div>
                                </td>
                                <td>
                                    <label for="companys-quality-assurance-manual-and-AIMS-standard-or-procedures">
                                        <span class="text-lg">Company's Quality Assurance Manual and AIMS's Standard / Procedures.</span>
                                        @if ($errors->has('companys-quality-assurance-manual-and-AIMS-standard-or-procedures'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('companys-quality-assurance-manual-and-AIMS-standard-or-procedures') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" checked id="contractual-obligations-of-personnel" name="contractual-obligations-of-personnel">
                                    </div>
                                </td>
                                <td>
                                    <label for="contractual-obligations-of-personnel">
                                        <span class="text-lg">Contractual Obligations of Personnel.</span>
                                        @if ($errors->has('contractual-obligations-of-personnel'))
                                            <span class="text-danger"><br>
                                                <strong>{{ $errors->first('contractual-obligations-of-personnel') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </td>
                            </tr>




                        </table>

                    </div>

                </div>
                <div class="text-right my-3">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

