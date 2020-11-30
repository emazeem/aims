@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Add Asset</h2>
        <a href="{{route('capabilities.store')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Parameters</a>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="{{route('assets.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('category') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="make" class="col-sm-2 control-label">Make</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="make" name="make" placeholder="Make" autocomplete="off" value="{{old('make')}}">
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
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="{{old('model')}}">
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
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="{{old('range')}}">
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
                        <input type="text" class="form-control" id="resolution" name="resolution" placeholder="Resolution" autocomplete="off" value="{{old('resolution')}}">
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
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="{{old('accuracy')}}">
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
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" autocomplete="off" value="{{old('code')}}">
                        @if ($errors->has('code'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('code') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="due" class="col-sm-2 control-label">Due Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="due" name="due" placeholder="" autocomplete="off" value="{{old('due')}}">
                        @if ($errors->has('due'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('due') }}</strong>
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
@endsection

