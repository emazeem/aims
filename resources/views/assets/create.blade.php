@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
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
            <h3 class="pull-left pb-1"><i class="fa fa-plus-circle"></i> Add Asset</h3>
        </div>
        <form class="form-horizontal row" id="add_asset_form" action="" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group col-6">
                <label for="name" class="col-12 control-label">Name</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                           autocomplete="off" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="parameter" class="col-12 control-label">Parameter</label>
                <div class="col-12">
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

            <div class="form-group col-6">
                <label for="make" class="col-12 control-label">Make</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="make" name="make" placeholder="Make"
                           autocomplete="off" value="{{old('make')}}">
                    @if ($errors->has('make'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('make') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="model" class="col-12 control-label">Model</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                           autocomplete="off" value="{{old('model')}}">
                    @if ($errors->has('model'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('model') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="range" class="col-12 control-label">Range</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="range" name="range" placeholder="Range"
                           autocomplete="off" value="{{old('range')}}">
                    @if ($errors->has('range'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('range') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="Resolution" class="col-12 control-label">Resolution</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="resolution" name="resolution"
                           placeholder="Resolution" autocomplete="off" value="{{old('resolution')}}">
                    @if ($errors->has('resolution'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('resolution') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="accuracy" class="col-12 control-label">Accuracy</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy"
                           autocomplete="off" value="{{old('accuracy')}}">
                    @if ($errors->has('accuracy'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('accuracy') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="code" class="col-12 control-label">Code</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="code" name="code" placeholder="Code"
                           autocomplete="off" value="{{old('code')}}">
                    @if ($errors->has('code'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('code') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="certificate" class="col-12 control-label">Certificate #</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="certificate" name="certificate"
                           placeholder="Certificate #" autocomplete="off" value="{{old('certificate')}}">
                    @if ($errors->has('certificate'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('certificate') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="serial" class="col-12 control-label">Serial #</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #"
                           autocomplete="off" value="{{old('serial')}}">
                    @if ($errors->has('serial'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('serial') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="traceability" class="col-12 control-label">Traceability </label>
                <div class="col-12">
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
            <div class="form-group col-6">
                <label for="location" class="col-12 control-label">Location</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="location" name="location">
                            <option selected disabled>Select Location</option>
                            <option value="lab1">Lab 1</option>
                            <option value="lab2">Lab 2</option>
                            <option value="lab2">Lab 3</option>
                            <option value="lab4">Lab 4</option>
                        </select>
                    </div>
                    @if ($errors->has('location'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('location') }}</strong>
                      </span>
                    @endif
                </div>
            </div>


            <div class="form-group col-6">
                <label for="calibration" class="col-12 control-label">Calibration Date</label>
                <div class="col-12">
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
            <div class="form-group col-6">
                <label for="commissioned" class="col-12 control-label">Commissioned Date</label>
                <div class="col-12">
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

            <div class="form-group col-6">
                <label for="interval" class="col-12 control-label">Select Interval</label>
                <div class="col-12">
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
            <div class="form-group col-6">
                <label for="status" class="col-12 control-label">Status</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="status" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="0">Available</option>
                            <option value="1">Assigned</option>
                            <option value="2">Out of Order</option>
                            <option value="3">Sent for Calibration</option>
                        </select>
                    </div>
                    @if ($errors->has('status'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('status') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-6">
                <label for="image" class="col-12 control-label">Image</label>
                <div class="col-12">
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
            <div class="form-group col-6">
                <label for="other_parameter" class="col-12 control-label">Other Parameter</label>
                <div class="col-12">
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
            <div class="col-12 my-2">
                <button type="submit" class="btn btn-success float-right btn-sm "><i class="feather icon-plus-circle"></i> Add</button>
                <a href="{{ URL::previous() }}" class="btn btn-light border btn-sm pull-right"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#other_parameter').select2({
                placeholder: 'Select Other Parameters'
            });
            $("#add_asset_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('assets.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#add_designation').modal('hide');
                            InitTable();
                        });

                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));

        });
    </script>
@endsection

