@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $( document ).ready(function() {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Units</h3>
        </div>
        <form class="form-horizontal" action="{{route('units.store')}}" method="post">
            @csrf
            <div class="box-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="parameter" class="col-sm-3 control-label">Select Parameter</label>
                            <div class="col-sm-9">
                                <select class="form-control text-xs" id="parameter" name="parameter" >
                                    <option value="" selected disabled>Select Paraemter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parameter'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('parameter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="unit" class="col-sm-3 control-label">Unit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-xs" id="unit" name="unit" placeholder="Unit" autocomplete="off" value="{{ old('unit') }}" require >
                                @if ($errors->has('unit'))
                                    <span class="text-danger">
                              <strong>{{ $errors->first('unit') }}</strong>
                          </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{!! url(''); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

@endsection