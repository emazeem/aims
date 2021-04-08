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
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/mytasks')}}">My Tasks</a></li>
            <li class="breadcrumb-item"><a href="{{URL::previous()}}">Task Detail</a></li>
        </ol>
        <h4><i class="fa fa-calculator"></i> Calculator</h4>

    </div>
    <input type="hidden" value="{{$parent->asset_id}}" name="asset">
    <input type="hidden" value="{{$parent->unit}}" name="unit">

    <div class="col-12">
        <form class="form-horizontal" action="{{route('vernier.calculator.data.entry.store')}}" method="post">
            @csrf
            <input type="hidden" value="{{$parent->id}}" name="parent_id">
            <input type="text" value="" id="mulitplying_factor" name="mulitplying_factor">
            <input type="text" value="" id="adding_factor" name="adding_factor">
            <input type="text" value="" id="ref_unit" name="ref_unit">
            <div class="form-group col-md-6">
                <label for="assets" class="control-label">Assets</label>
                <select class="form-control" id="assets" name="assets">
                    <option selected disabled>Assets</option>
                    @foreach($assets as $asset)
                        <option value="{{$asset->id}}">{{$asset->name}} ({{$asset->code}}) ({{$asset->range}})</option>
                    @endforeach
                </select>
                @if ($errors->has('assets'))
                    <span class="text-danger"><strong>{{ $errors->first('assets') }}</strong></span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="units" class=" control-label">Units</label>
                <select class="form-control " id="units" name="units">
                    <option selected disabled>Select Unit</option>
                </select>
                @if ($errors->has('units'))
                    <span class="text-danger"><strong>{{ $errors->first('units') }}</strong></span>
                @endif
            </div>

            <div class="row cal-inputs">
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Ref</td>
                        <td>X<sub>1</sub></td>
                        <td>X<sub>2</sub></td>
                        <td>X<sub>3</sub></td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="text" name="fixed_value[]" class="form-control"/>
                            @if ($errors->has('fixed_value'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('fixed_value') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x1[]" class="form-control"/>
                            @if ($errors->has('x1'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x1') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x2[]" class="form-control"/>
                            @if ($errors->has('x2'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x2') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x3[]" class="form-control "/>
                            @if ($errors->has('x3'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x3') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)"  id="addrow" class="btn btn-primary btn-sm text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>@if ($errors->has('uuc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('uuc') }}</strong>
                            </span>
                            @endif
                        </td>

                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {

            $('select[name="units"]').on('change', function () {
                var asset = $('#assets').val();
                var unit = $('#units').val();
                $.ajax({
                    url: '/units/check_both_units/' + unit+'/'+asset,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data['conversion']==true){

                            $('#adding_factor').val(data['unit']['factor_add']);
                            $('#mulitplying_factor').val(data['unit']['factor_multiply']);
                            $('#ref_unit').val(data['unit']['id']);
                        }else {
                            $('#adding_factor').val(0);
                            $('#mulitplying_factor').val(0);
                            $('#ref_unit').val('');
                        }
                    }
                });
            });
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
                            $.each(data['units'], function (key, value) {
                                $('select[name="units"]').append('<option value="' + value.id + '">' + value.unit + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="units"]').empty();
                }
            });
        });


        $(document).ready(function () {
            var counter = 0;
            $('#counter').val(counter);
            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control" id="f'+counter+'" name="fixed_value[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x1'+counter+'" name="x1[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x2'+counter+'" name="x2[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x3'+counter+'" name="x3[]"/></td>';
                cols += '<td><a href="javascript:void(0)" class="btn btn-danger btn-sm ibtnDel"><i class=" fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });


            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1;
            });

            $('.labs').on('click', function (e) {
                e.preventDefault();
                var lab = $(this).attr('data-id');
                $('#location').val(lab);
            });
        });

    </script>
@endsection