@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light "><i class="feather icon-plus-circle"></i> Add Units</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" id="add_unit_form" method="post">
            @csrf

                <div class="form-group mt-md-4 row">

                    <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="parameter" name="parameter">
                            <option value="" selected disabled>Select Parameter</option>
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


                <div class="form-group row">
                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" autocomplete="off" value="{{old('unit')}}">
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
                <div class="form-group mt-md-4 row">

                    <label for="primary" class="col-sm-2 control-label">Primary</label>
                    <div class="col-sm-10">
                        <select class="form-control text-xs" id="primary" name="primary">
                            <option value="" selected >Select Primary_</option>
                        </select>
                        @if ($errors->has('primary'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('primary') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="factor_add" class="col-sm-2 control-label">Factor Add</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="factor_add" name="factor_add" placeholder="Factor Add" autocomplete="off" value="{{old('factor_add',0)}}">
                        @if ($errors->has('factor_add'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('factor_add') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="factor_multiply" class="col-sm-2 control-label">Factor Multiply</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="factor_add" name="factor_multiply" placeholder="Factor Multiply" autocomplete="off" value="{{old('factor_multiply',1)}}">
                        @if ($errors->has('factor_multiply'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('factor_multiply') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mt-5 pt-3 col-12 text-right">
                    <a href="{!! url('units'); !!}" class="btn btn-light border"><i class="fa fa-times-circle"></i> Cancel</a>
                    <button type="submit" class="unit-save-btn btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
                            $.each(data['previous'], function(key, value) {
                                if (value.primary_==null){
                                    $('#previous').append('<a href="/units/edit/'+ value.id +'" class="btn btn-warning btn-sm">'+ value.unit +'</a>');
                                }else{
                                    $('#previous').append('<a href="/units/edit/'+ value.id +'" class="btn btn-primary btn-sm">'+ value.unit +'</a>');
                                }
                            });
                            $('#primary').empty();
                            $('#primary').append('<option value="" selected>None</option>');
                            $.each(data['primary'], function(key, value) {
                                $('#primary').append('<option value="'+value.id+'">'+ value.unit +'</option>');

                            });

                        }
                    });
                }
                else{
                    $('#previous').empty();
                }
            });

            $("#add_unit_form").on('submit',(function(e) {
                var button=$('.unit-save-btn');
                var previous=$('.unit-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                e.preventDefault();
                $.ajax({
                    url: "{{route('units.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success', data.success, 'success').then((value) => {
                            window.location.href='{{URL::previous()}}'
                        });
                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        if (xhr.responseJSON.error){
                            swal("Failed", xhr.responseJSON.error, "error").then((value) => {

                            });
                        }else {
                            var error='';
                            $.each(xhr.responseJSON.errors, function (key, item) {
                                error+=item;
                            });
                            swal("Failed", error, "error");
                        }
                    }
                });
            }));
        });


    </script>
@endsection