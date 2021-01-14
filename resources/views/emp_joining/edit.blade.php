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
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i>Edit Employee Joining</h3>
        </div>
        <div class="col-md-8 col-12">
            <form action="{{route('emp_joining.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="employee">Select Employee</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="employee" name="employee">
                                <option selected disabled="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{$edit->appraisal_id==$employee->id?'selected':''}}>{{$employee->appraisal->fname}} {{$employee->appraisal->lname}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('employee'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('employee') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="joining">Joining Date</label>
                        <input type="date" class="form-control" id="joining" name="joining" placeholder="joining"
                               autocomplete="off" value="{{old('joining',$edit->joining)}}">
                        @if ($errors->has('joining'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('joining') }}</strong>
                             </span>
                        @endif
                    </div>
                    <div class="form-group col-12">
                        <label for="signature" class="control-label">Signature</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="signature" id="signature">
                            <label class="custom-file-label" for="signature">Choose Signature</label>
                        </div>
                        @if ($errors->has('signature'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('signature') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="text-right my-3">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection