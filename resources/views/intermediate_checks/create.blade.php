@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="row col-12">
        <h3 class="border-bottom mb-5"><i class="fa fa-tasks"></i> Add Intermediate Checks</h3>
        <form class="form-horizontal" action="{{route('intermediate-checks.store')}}" method="post">
            @csrf
            <input type="hidden" class="form-control" id="equipment_under_test" name="equipment_under_test" placeholder="equipment_under_test" autocomplete="off" value="{{$id}}">
            <div class="form-group row">
                <label for="equipment_under_test" class="col-sm-2 control-label">Equipment Under Test</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="equipment_under_test" name="" disabled>
                            @foreach($assets as $asset)
                                <option value="{{$asset->id}}" {{($asset->id==$id)?'selected':''}} >{{$asset->code}}-{{$asset->name}}-{{$asset->range}}
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
                    @if($available)
                        <input type="hidden" class="form-control" id="check_reference" name="check_reference"  placeholder="check_reference" autocomplete="off" value="{{$available->check_reference_id}}">
                        <input type="text" class="form-control" id="check_reference" name="check_reference"  placeholder="check_reference" autocomplete="off" {{($available)?'disabled':''}} value="{{\App\Models\Asset::find($available->check_reference_id)->code.' '.\App\Models\Asset::find($available->check_reference_id)->name.'-'.\App\Models\Asset::find($available->check_reference_id)->code.'-'.\App\Models\Asset::find($available->check_reference_id)->resolution.'-'.\App\Models\Asset::find($available->check_reference_id)->accuracy}}" >
                    @else
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="check_reference" name="check_reference">
                            @foreach($assets as $asset)
                                <option value="{{$asset->id}}">{{$asset->code}}-{{$asset->name}}-{{$asset->range}}
                                    -{{$asset->resolution}}-{{$asset->accuracy}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
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
                        @if($available)
                            <input type="hidden" class="form-control" id="reference_value" name="reference_value"  placeholder="Reference Value" autocomplete="off" value="{{$available->reference_value}}">
                            <input type="text" class="form-control" id="reference_value" name="reference_value"  placeholder="Reference Value" autocomplete="off" value="{{old('reference_value',($available)?$available->reference_value:'')}}" {{($available)?'disabled':''}}>
                        @else
                            <input type="text" class="form-control" id="reference_value" name="reference_value"  placeholder="Reference Value" autocomplete="off" value="{{old('reference_value')}}">
                        @endif
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
                        @for($i=0;$i<$checks ;$i++)
                            <input type="text" class="form-control col-4 mt-2" id="measured_value" name="measured_value[]" placeholder="Measured Value" autocomplete="off" value="{{old('measured_value')}}">
                        @endfor
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
                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

@endsection