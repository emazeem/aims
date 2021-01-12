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
            <h3 class="border-bottom "><i class="fa fa-refresh"></i> Edit Employee Contract</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('emp_contract.update')}}" method="post">
            @csrf
                <input type="hidden" value="{{$edit->id}}" name="id">
                <div class="form-group  row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="name" name="name">
                            <option value="" selected disabled>Select Name</option>
                            @foreach($appraisals as $appraisal)
                                <option value="{{$appraisal->id}}" {{($edit->appraisal_id==$appraisal->id)?'selected':''}}>{{$appraisal->fname}} {{$appraisal->lname}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>


                <div class="form-group  row">
                    <label for="termination_period" class="col-sm-2 control-label">Termination Period</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="termination_period" name="termination_period">
                            <option value="" selected disabled>Select Termination Period</option>
                            <option value="one-year" {{($edit->termination_period=='one-year')?'selected':''}}>One-year</option>
                            <option value="two-years" {{($edit->termination_period=='two-years')?'selected':''}}>Two-years</option>
                            <option value="three-years" {{($edit->termination_period=='three-years')?'selected':''}}>Three-years</option>
                        </select>

                        @if ($errors->has('termination_period'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('termination_period') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="probation_applicable" class="col-sm-2 control-label">Probation Applicable</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="probation_applicable" name="probation_applicable">
                            <option value="" selected disabled>Select Probation Applicable</option>
                            <option value="1"{{($edit->probation_applicable=='1')?'selected':''}}>Yes</option>
                            <option value="0" {{($edit->probation_applicable=='0')?'selected':''}}>No</option>
                        </select>

                        @if ($errors->has('probation_applicable'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('probation_applicable') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="probation_period" class="col-sm-2 control-label">Probation Period</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="probation_period" name="probation_period">
                            <option value="" selected disabled>Select Probation Period</option>
                            <option value="15-days" {{($edit->probation_period=='15-days')?'selected':''}}>15-days</option>
                            <option value="one-month" {{($edit->probation_period=='one-month')?'selected':''}}>One-month</option>
                            <option value="two-months" {{($edit->probation_period=='two-months')?'selected':''}}>Two-months</option>
                            <option value="three-months" {{($edit->probation_period=='three-months')?'selected':''}}>Three-months</option>
                            <option value="six-months" {{($edit->probation_period=='six-months')?'selected':''}}>Six-months</option>
                        </select>

                        @if ($errors->has('probation_period'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('probation_period') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="designations" class="col-sm-2 control-label">Designations</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="designations" name="designations">
                            <option value="" selected disabled>Select Designations</option>
                            @foreach($designations as $designation)
                                <option value="{{$designation->id}}" {{($edit->designations==$designation->id)?'selected':''}}>{{$designation->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('designations'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('designations') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>


                <div class="form-group  row">
                    <label for="place_of_work" class="col-sm-2 control-label">Place of Work</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="place_of_work" name="place_of_work" placeholder="Place of Work" autocomplete="off" value="{{old('place_of_work',$edit->place_of_work)}}">
                        @if ($errors->has('place_of_work'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('place_of_work') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="salary" class="col-sm-2 control-label">Salary</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" autocomplete="off" value="{{old('salary',$edit->salary)}}">
                        @if ($errors->has('salary'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('salary') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group  row">
                    <label for="allowances" class="col-sm-2 control-label">Allowances</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="allowances" name="allowances">
                            <option value="" selected disabled>Select Allowances</option>
                            <option value="na" {{($edit->allowances=='na')?'selected':''}}>NA</option>
                            <option value="medical-allowances" {{($edit->allowances=='medical-allowances')?'selected':''}}>Medical-Allowances</option>
                            <option value="travelling-allowances" {{($edit->allowances=='travelling-allowances')?'selected':''}}>Travelling-Allowances</option>
                        </select>

                        @if ($errors->has('allowances'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('allowances') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  name="cnic" value="{{old('cnic',$edit->cnic)}}">
                        @if ($errors->has('cnic'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('cnic') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="commencement" class="col-sm-2 control-label">Commencement Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="commencement" name="commencement" placeholder="commencement" autocomplete="off" value="{{old('commencement',$edit->commencement)}}">
                        @if ($errors->has('commencement'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('commencement') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>

                <div class="mt-5 pt-3 col-12 text-right">
                    <a href="{!! url(''); !!}" class="btn btn-primary"><i class="fa fa-times-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>

    </div>


@endsection