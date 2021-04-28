@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Add Asset</h3>
            <span class="text-right ">
                 <a href="{{route('capabilities.store')}}" class="pull-right btn btn-sm btn-primary shadow-sm mt-2  "><i class="fa fa-plus-circle"></i> Add Parameters</a>
        </span>
        </div>
        <div class="col-12">

            <form class="form-horizontal" action="{{route('assets.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                               autocomplete="off" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="parameter">
                                <option selected disabled>Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        @if ($errors->has('parameter'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('parameter') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="make" class="col-sm-2 control-label">Make</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="make" name="make" placeholder="Make"
                               autocomplete="off" value="{{old('make')}}">
                        @if ($errors->has('make'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('make') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="model" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                               autocomplete="off" value="{{old('model')}}">
                        @if ($errors->has('model'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('model') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="range" class="col-sm-2 control-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range"
                               autocomplete="off" value="{{old('range')}}">
                        @if ($errors->has('range'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('range') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Resolution" class="col-sm-2 control-label">Resolution</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="resolution" name="resolution"
                               placeholder="Resolution" autocomplete="off" value="{{old('resolution')}}">
                        @if ($errors->has('resolution'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('resolution') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy"
                               autocomplete="off" value="{{old('accuracy')}}">
                        @if ($errors->has('accuracy'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('accuracy') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code"
                               autocomplete="off" value="{{old('code')}}">
                        @if ($errors->has('code'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('code') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="certificate" class="col-sm-2 control-label">Certificate #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="certificate" name="certificate"
                               placeholder="Certificate #" autocomplete="off" value="{{old('certificate')}}">
                        @if ($errors->has('certificate'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('certificate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="serial" class="col-sm-2 control-label">Serial #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #"
                               autocomplete="off" value="{{old('serial')}}">
                        @if ($errors->has('serial'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('serial') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="traceability" class="col-sm-2 control-label">Traceability </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="traceability" name="traceability"
                               placeholder="Traceability"
                               autocomplete="off" value="{{old('traceability')}}">
                        @if ($errors->has('traceability'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('traceability') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="location" name="location">
                                <option selected disabled>Select Location</option>
                                <option value="lab1">Lab 1</option>
                                <option value="lab2">Lab 2</option>
                                <option value="lab2">Lab 3</option>
                            </select>
                        </div>
                        @if ($errors->has('location'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('location') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="calibration" class="col-sm-2 control-label">Calibration Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="calibration" name="calibration" placeholder=""
                               autocomplete="off"
                               value="{{old('calibration')}}">
                        @if ($errors->has('calibration'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('calibration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="commissioned" class="col-sm-2 control-label">Commissioned Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="commissioned" name="commissioned" placeholder=""
                               autocomplete="off"
                               value="{{old('commissioned')}}">
                        @if ($errors->has('commissioned'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('commissioned') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="interval" class="col-sm-2 control-label">Select Interval</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="interval" name="interval">
                                <option selected disabled>Select Interval</option>
                                <option value="1">One Year</option>
                                <option value="2">Two Years</option>
                                <option value="3">Three Years</option>
                            </select>
                        </div>
                        @if ($errors->has('interval'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('interval') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="status" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="0">Available</option>
                                <option value="1">Assigned</option>
                            </select>
                        </div>
                        @if ($errors->has('status'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('status') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="cv">Image (opt)</label>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('image') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="other_parameter" class="col-sm-2 control-label">Other Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="other_parameter" name="other_parameter[]" multiple>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('other_parameter'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('other_parameter') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#other_parameter').select2({
            placeholder: 'Select Other Parameters'
        });
    </script>
@endsection

