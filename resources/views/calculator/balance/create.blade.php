{{--i am saving balance data entries in general data entries table because it have same fields as was in balance data entries--}}
@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif
    <div class="col-12">
        <h3 class="border-bottom"><i class="fa fa-tasks"></i> Balance Calculator</h3>
    </div>
    <div class="col-12 ">
        <form class="form-horizontal" {{--action="{{route('balance.calculator.data.entry.store')}}"--}} id="add_details_form" method="post">
            @csrf
            <input type="text" value="{{$parent->id}}" name="parent_id">
            <input type="text" value="" id="mulitplying_factor" name="mulitplying_factor">
            <input type="text" value="" id="adding_factor" name="adding_factor">
            <input type="text" value="" id="ref_unit" name="ref_unit">
            <input type="text" value="{{$assets}}" id="assets" name="assets">
            <input type="text" value="{{$units}}" id="units" name="units">
            <div class="form-group col-md-6">
                <label for="nominal_mass" class="control-label">Nominal Masses</label>
                <select class="form-control" id="nominal_mass" name="nominal_mass[]" multiple>
                    @foreach($nominal_masses as $mass)
                        <option value="{{$mass->id}}">{{$mass->ref}} </option>
                    @endforeach
                </select>
                @if ($errors->has('nominal_mass'))
                    <span class="text-danger"><strong>{{ $errors->first('nominal_mass') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label for="x1" class="col-sm-3 control-label">X<sub>1</sub> ( Load)</label>
                <input type="text" class="form-control col-md-9" id="x1" name="x1" placeholder="X1" autocomplete="off"
                       value="{{old('x1')}}">
                @if ($errors->has('x1'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('x1') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="x2" class="col-sm-3 control-label">X<sub>2</sub> (No Load)</label>
                <input type="text" class="form-control col-md-9" id="x2" name="x2" placeholder="X2" autocomplete="off"
                       value="{{old('x2')}}">
                @if ($errors->has('x2'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('x2') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="x3" class="col-sm-3 control-label">X<sub>3</sub> (No Load)</label>
                <input type="text" class="form-control col-md-9" id="x3" name="x3" placeholder="X3" autocomplete="off"
                       value="{{old('x3')}}">
                @if ($errors->has('x3'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('x3') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="x4" class="col-sm-3 control-label">X<sub>4</sub> (No Load)</label>
                <input type="text" class="form-control col-md-9" id="x4" name="x4" placeholder="X4" autocomplete="off"
                       value="{{old('x4')}}">
                @if ($errors->has('x4'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('x4') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row col-12">
                <a href="{{ URL::previous() }}" class="btn btn-light border pull-left"><i class="fa fa-times"></i>
                    Cancel</a>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#nominal_mass').select2({
            placeholder: 'Select Nominal Masses'
        });
    </script>

    <script>
        $(document).ready(function () {
            /*var asset = $('#assets').val();
            var unit = $('#units').val();
            $.ajax({
                url: '/units/check_both_units/' + unit + '/' + asset,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data['conversion'] == true) {

                        $('#adding_factor').val(data['unit']['factor_add']);
                        $('#mulitplying_factor').val(data['unit']['factor_multiply']);
                        $('#ref_unit').val(data['unit']['id']);
                    } else {
                        $('#adding_factor').val(0);
                        $('#mulitplying_factor').val(0);
                        $('#ref_unit').val('');
                    }
                }
            });*/

            $('select[name="assets"]').on('change', function () {
                var parameter = $(this).val();
                if (parameter) {
                    $.ajax({
                        url: '/units/units_of_assets/' + parameter,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="units"]').empty();
                            $('select[name="units"]').append('<option disabled selected>Select Respective Units</option>');
                            $.each(data, function (key, value) {
                                $('select[name="units"]').append('<option value="' + value.id + '">' + value.unit + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="units"]').empty();
                }
            });
            $("#add_details_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('balance.calculator.data.entry.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        swal("Success", data.success, "success");
                    },
                    error: function (e) {
                        swal("Failed", "Fields Required. Try again.", "error");

                    }
                });
            }));

        });
    </script>
@endsection
