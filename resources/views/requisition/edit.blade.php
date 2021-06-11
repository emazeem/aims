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
            <h3 class="border-bottom "><i class="fa fa-plus-circle"></i> Edit Requisitions</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('requisition.update')}}" method="post">
            @csrf
                <input type="hidden" id="id" name="id" value="{{$edit->id}}">

                <div class="form-group  row">

                    <label for="req_designations" class="col-sm-2 control-label">Person required against Designation</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="req_designations" name="req_designations">
                            <option value="" selected disabled>Select Requisition Designations</option>
                            @foreach($designations as $designation)
                                <option value="{{$designation->id}}" {{($designation->id=$edit->requisition_designation)?'selected':''}}>{{$designation->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('req_designations'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('req_designations') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="reason" class="col-sm-2 control-label">Reasons for requirement</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="reason" name="reason" placeholder="Reasons for requirement" autocomplete="off">{{old('reason',$edit->reason)}}</textarea>
                        @if ($errors->has('reason'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('reason') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="qualification" class="col-sm-2 control-label">Qualification/Experience Required</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification/Experience Required" autocomplete="off" value="{{old('qualification',$edit->qualification)}}">
                        @if ($errors->has('qualification'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('qualification') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label for="special_skills" class="col-sm-2 control-label">Special Skills (if any)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="special_skills" name="special_skills" placeholder="Special Skills (if any)" autocomplete="off" value="{{old('special_skills',$edit->special_skills)}}">
                        @if ($errors->has('special_skills'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('special_skills') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>

                <div class="form-group  row">
                    <label for="hrd_review" class="col-sm-2 control-label">HRD Review</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="hrd_review" name="hrd_review">
                            <option value="" selected disabled>Select HRD Review</option>
                            <option value="internal-re-adjustment" {{($edit->hrd_review=='internal-re-adjustment')?'selected':''}}>Internal-Re-Adjustment</option>
                            <option value="new-hiring" {{($edit->hrd_review=='new-hiring')?'selected':''}}>New-Hiring</option>
                            <option value="rejection" {{($edit->hrd_review=='rejection')?'selected':''}}>Rejection</option>
                        </select>

                        @if ($errors->has('hrd_review'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('hrd_review') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="time_frame" class="col-sm-2 control-label">Time Frame</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="time_frame" name="time_frame">
                            <option value="" selected disabled>Select Time Frame</option>
                            <option value="one-week" {{($edit->time_frame=='one-week')?'selected':''}}>One-week</option>
                            <option value="two-week" {{($edit->time_frame=='two-week')?'selected':''}}>Two-week</option>
                            <option value="three-week" {{($edit->time_frame=='three-week')?'selected':''}}>Three-week</option>
                            <option value="four-week" {{($edit->time_frame=='four-week')?'selected':''}}>Four-week</option>
                            <option value="five-week" {{($edit->time_frame=='five-week')?'selected':''}}>Five-week</option>
                            <option value="six-week" {{($edit->time_frame=='six-week')?'selected':''}}>Six-week</option>
                            <option value="seven-week" {{($edit->time_frame=='seven-week')?'selected':''}}>Seven-week</option>
                            <option value="eight-week" {{($edit->time_frame=='eight-week')?'selected':''}}>Eight-week</option>
                        </select>

                        @if ($errors->has('time_frame'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('time_frame') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off">{{old('remarks',$edit->remarks)}}</textarea>
                        @if ($errors->has('remarks'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('remarks') }}</strong>
                      </span>
                        @endif

                    </div>
                </div>



                <div class="mt-5 pt-3 col-12 text-right">
                    <a href="{!! url(''); !!}" class="btn btn-primary"><i class="feather icon-x-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection