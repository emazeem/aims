@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif
    <div class="box box-info">
        <h2 class="border-bottom text-dark mb-5">Edit Intermediate Checks</h2>
        <form class="form-horizontal" action="{{route('intermediate-checks.update')}}" method="post">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}">
            <input type="hidden" class="form-control" id="equipment_under_test" name="equipment_under_test" placeholder="equipment_under_test" autocomplete="off" value="{{$edit->equipment_under_test_id}}">
            <div class="form-group row">
                <label for="equipment_under_test" class="col-sm-2 control-label">Equipment Under Test</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="equipment_under_test" name="" disabled>
                            @foreach($assets as $asset)
                                <option value="{{$asset->id}}" {{($asset->id==$edit->equipment_under_test_id)?'selected':''}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}
                                    -{{$asset->resolution}}-{{$asset->accuracy}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('equipment_under_test'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('equipment_under_test') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="check_reference" class="col-sm-2 control-label">Check Reference</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="check_reference" name="check_reference" {{($available)?'disabled':''}}>
                            @foreach($assets as $asset)
                                <option value="{{$asset->id}}" {{($asset->id==$edit->check_reference_id)?'selected':''}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}
                                    -{{$asset->resolution}}-{{$asset->accuracy}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('check_reference'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('check_reference') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="reference_value" class="col-sm-2 control-label">Reference Value</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <input type="text" class="form-control" id="reference_value" name="reference_value" {{($available)?'disabled':''}} placeholder="Reference Value" autocomplete="off" value="{{old('reference_value',$edit->reference_value)}}">
                    </div>
                    @if ($errors->has('reference_value'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('reference_value') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group mt-md-4 row">
                <label for="measured_value" class="col-sm-2 control-label pt-4">Measured Value</label>
                <div class="col-10 p-4">
                    <div class="row">
                        @foreach(explode(',',$edit->measured_value) as $item)
                            <input type="text" class="form-control col-4 mt-2" id="measured_value" name="measured_value[]" placeholder="Measured Value" autocomplete="off" value="{{old('measured_value',$item)}}">
                        @endforeach
                    </div>
                    @if ($errors->has('measured_value'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('measured_value') }}</strong>
                      </span>
                    @endif
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer col-12 text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->
@endsection