@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Edit Asset</h2>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="{{url('/assets/update/'.$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name',$edit->name)}}">
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
                            <select class="form-control" id="parameter" name="parameter">
                                <option selected disabled>Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}" {{($edit->parameter==$parameter->id)?"selected":""}}>{{$parameter->name}}</option>
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
                <div class="form-group mt-md-4 row">
                    <label for="make" class="col-sm-2 control-label">Make</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="make" name="make" placeholder="Make" autocomplete="off" value="{{old('make',$edit->make)}}">
                        @if ($errors->has('make'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('make') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="model" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="{{old('model',$edit->model)}}">
                        @if ($errors->has('model'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('model') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="range" class="col-sm-2 control-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="{{old('range',$edit->range)}}">
                        @if ($errors->has('range'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('range') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="Resolution" class="col-sm-2 control-label">Resolution</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="resolution" name="resolution" placeholder="Resolution" autocomplete="off" value="{{old('resolution',$edit->resolution)}}">
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
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="{{old('accuracy',$edit->accuracy)}}">
                        @if ($errors->has('accuracy'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('accuracy') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" autocomplete="off" value="{{old('code',$edit->code)}}">
                        @if ($errors->has('code'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('code') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="certificate" class="col-sm-2 control-label">Certificate #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="certificate" name="certificate"
                               placeholder="Certificate #" autocomplete="off" value="{{old('certificate',$edit->certificate_no)}}">
                        @if ($errors->has('certificate'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('certificate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="serial" class="col-sm-2 control-label">Serial #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #"
                               autocomplete="off" value="{{old('serial',$edit->serial_no)}}">
                        @if ($errors->has('serial'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('serial') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="traceability" class="col-sm-2 control-label">Traceability </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="traceability" name="traceability" placeholder="Traceability"
                               autocomplete="off" value="{{old('traceability',$edit->traceability)}}">
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
                                <option value="lab1" {{($edit->location=="lab1")?'selected':''}}>Lab 1</option>
                                <option value="lab2" {{($edit->location=="lab2")?'selected':''}}>Lab 2</option>
                                <option value="lab3" {{($edit->location=="lab3")?'selected':''}}>Lab 3</option>
                            </select>
                        </div>
                        @if ($errors->has('location'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('location') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>



                <div class="form-group mt-md-4 row">
                    <label for="calibration" class="col-sm-2 control-label">Calibration Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="calibration" name="calibration" placeholder="" autocomplete="off"
                               value="{{old('calibration',$edit->calibration)}}">
                        @if ($errors->has('calibration'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('calibration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="commissioned" class="col-sm-2 control-label">Commissioned Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="commissioned" name="commissioned" placeholder="" autocomplete="off"
                               value="{{old('commissioned',$edit->commissioned)}}">
                        @if ($errors->has('commissioned'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('commissioned') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="due" class="col-sm-2 control-label">Due Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="due" name="due" placeholder="" autocomplete="off"
                               value="{{old('due',$edit->due)}}">
                        @if ($errors->has('due'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('due') }}</strong>
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
                                <option value="0" {{($edit->code==0)?'selected':''}}>Available</option>
                                <option value="1" {{($edit->code==1)?'selected':''}}>Assigned</option>
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





                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

