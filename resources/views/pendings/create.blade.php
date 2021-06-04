@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
        <h1 class="h3 mb-0 border-bottom"><i class="fa fa-user-plus"></i> Add Capabilities & Quote</h1>
        <a href="{{route('capabilities.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Parameters</a>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="{{route('pendings.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$id}}" name="na_id">
                <div class="form-group  row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name',$edit->not_available)}}">
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
                                    <option value="{{$parameter->id}}" {{$edit->parameter==$parameter->id?'selected':''}}>{{$parameter->name}}</option>
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
                <div class="form-group  row">
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
                <div class="form-group row">
                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="unit" name="unit">
                                <option selected disabled>Select Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('unit'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('unit') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
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
                <div class="form-group  row">
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                        @if ($errors->has('price'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('price') }}</strong>
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
                                <option value="site">site</option>
                                <option value="lab">lab</option>

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
                    <label for="procedure" class="col-sm-2 control-label">Procedure</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="procedure" name="procedure">
                                <option selected disabled>Select Procedure</option>
                                @foreach($procedures as $procedure)
                                    <option value="{{$procedure->id}}">{{$procedure->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('procedure'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('procedure') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                        @if ($errors->has('remarks'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('remarks') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="col-12 form-check">
                    <div class="text-right">
                        <input type="checkbox" class="form-check-input"  name="accredited" id="accredited">
                        <label class="form-check-label" for="accredited">Accredited</label>
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

