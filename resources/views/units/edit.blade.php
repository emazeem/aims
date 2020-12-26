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
            <h3 class="border-bottom "><i class="fa fa-pencil"></i> Edit Units</h3>
            <a href="{{route('units.create')}}" class="btn btn-primary pull-right btn-sm">
                <span class="fa fa-plus-circle"></span> Add Unit
            </a>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('units.update')}}" method="post">

                @csrf

                <div class="form-group mt-md-4 row">

                    <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="parameter" name="parameter">
                            <option value="" selected disabled>Select Parameter</option>
                            @foreach($parameters as $parameter)
                                <option value="{{$parameter->id}}" {{($edit->parameter==$parameter->id)?'selected':''}}>{{$parameter->name}}</option>

                            @endforeach
                        </select>

                        @if ($errors->has('parameter'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('parameter') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" autocomplete="off" value="{{ old('unit',$edit->unit) }}" >
                        @if ($errors->has('unit'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('unit') }}</strong>
                      </span>
                        @endif
                        <div class="py-2">
                            <span id="previous"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-3 col-12 text-right">
                    <a href="{!! url(''); !!}" class="btn btn-primary"><i class="fa fa-times-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '/units/fetch/previous_units/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#previous').empty();
                            $.each(data, function(key, value) {
                                $('#previous').append('<a href="/units/edit/'+ value.id +'" class="btn btn-primary btn-sm">'+ value.unit +'</a>');
                            });
                        }
                    });
                }
                else{
                    $('#previous').empty();
                }
            });
        });


    </script>
@endsection