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
        <h4><i class="fa fa-calculator"></i>Incubator Calculator</h4>

    </div>
    <input type="hidden" value="{{$parent->asset_id}}" name="asset">
    <input type="hidden" value="{{$parent->unit}}" name="unit">

    <div class="col-12">
        <form class="form-horizontal" action="{{route('incubator.calculator.data.entry.store')}}" method="post">
            @csrf
            <input type="hidden" value="{{$parent->id}}" name="parent_id">
            <input type="hidden" value="" id="mulitplying_factor" name="mulitplying_factor">
            <input type="hidden" value="" id="adding_factor" name="adding_factor">
            <input type="hidden" value="" id="ref_unit" name="ref_unit">
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
            <div class="form-group col-md-12 channels" style="display: none">

                <label for="channels" class="col-2 control-label">Select Channels</label>
                <div class="col-10">
                    <select class="form-control" id="channels" name="channels" required>
                        <option value="" selected disabled>Select Channels</option>
                        @for($k=1;$k<=10;$k++)
                            <option value="{{$k}}">Channel # {{$k}}</option>
                        @endfor

                    </select>
                    @if ($errors->has('channels'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('channels') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="row cal-inputs">
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>X<sub>1</sub></td>
                        <td>X<sub>2</sub></td>
                        <td>X<sub>3</sub></td>
                        <td>Set Value</td>
                        <td>UUC Indication</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
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
                            <input type="text" name="set_value[]" class="form-control "/>
                            @if ($errors->has('set_value'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('set_value') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="uuc_indication[]" class="form-control "/>
                            @if ($errors->has('uuc_indication'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('uuc_indication') }}</strong>
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
            <div class='col-12'>
                <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
        <form class="form-horizontal row" action="{{route('incubator.calculator.data.entry.store')}}" method="post">
            @csrf
            <input type="hidden" value="{{$parent->id}}" name="parent_id">
            <div class="form-group col-3">
                <label for="uuc_readings" class="col-12 control-label">UUC Readings</label>
                <input type="text" class="form-control" id="uuc_readings" name="uuc_readings" placeholder="UUC Readings" autocomplete="off" value="{{old('uuc_readings')}}">
                @if ($errors->has('uuc_readings'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('uuc_readings') }}</strong>
                      </span>
                @endif
            </div>
            <div class="col-9"></div>
            <div class="form-group col-2">
                <label for="channel_1" class="col-12 control-label">Channel 1</label>
                <input type="text" class="form-control" id="channel_1" name="channel_1" placeholder="Channel 1" autocomplete="off" value="{{old('channel_1')}}">
                @if ($errors->has('channel_1'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_1') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
                <label for="channel_2" class="col-12 control-label">Channel 2</label>
                <input type="text" class="form-control" id="channel_2" name="channel_2" placeholder="Channel 2" autocomplete="off" value="{{old('channel_2')}}">
                @if ($errors->has('channel_2'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_2') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
                <label for="channel_3" class="col-12 control-label">Channel 3</label>
                <input type="text" class="form-control" id="channel_3" name="channel_3" placeholder="Channel 3" autocomplete="off" value="{{old('channel_3')}}">
                @if ($errors->has('channel_3'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_3') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
                <label for="channel_4" class="col-12 control-label">Channel 4</label>
                <input type="text" class="form-control" id="channel_4" name="channel_4" placeholder="Channel 4" autocomplete="off" value="{{old('channel_4')}}">
                @if ($errors->has('channel_4'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_4') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
                <label for="channel_5" class="col-12 control-label">Channel 5</label>
                <input type="text" class="form-control" id="channel_5" name="channel_5" placeholder="Channel 5" autocomplete="off" value="{{old('channel_5')}}">
                @if ($errors->has('channel_5'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_5') }}</strong>
                      </span>
                @endif
            </div>
            <div class="col-2"></div>
            <div class="form-group col-2">
                <label for="channel_6" class="col-12 control-label">Channel 6</label>
                <input type="text" class="form-control" id="channel_6" name="channel_6" placeholder="Channel 6" autocomplete="off" value="{{old('channel_6')}}">
                @if ($errors->has('channel_6'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_6') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
                <label for="channel_7" class="col-12 control-label">Channel 7</label>
                <input type="text" class="form-control" id="channel_7" name="channel_7" placeholder="Channel 7" autocomplete="off" value="{{old('channel_7')}}">
                @if ($errors->has('channel_7'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_7') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group col-2">
                <label for="channel_8" class="col-12 control-label">Channel 8</label>
                <input type="text" class="form-control" id="channel_8" name="channel_8" placeholder="Channel 8" autocomplete="off" value="{{old('channel_8')}}">
                @if ($errors->has('channel_8'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_8') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group col-2">
                <label for="channel_9" class="col-12 control-label">Channel 9</label>
                <input type="text" class="form-control" id="channel_9" name="channel_9" placeholder="Channel 9" autocomplete="off" value="{{old('channel_9')}}">
                @if ($errors->has('channel_9'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_9') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group col-2">
                <label for="channel_10" class="col-12 control-label">Channel 10</label>
                <input type="text" class="form-control" id="channel_10" name="channel_10" placeholder="Channel 10" autocomplete="off" value="{{old('channel_10')}}">
                @if ($errors->has('channel_10'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('channel_10') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-2">
            </div>
            <div class='col-12'>
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
                            if (data['show_channels']==true){
                                $('.channels').show();
                            }else {
                                $('.channels').hide();
                            }
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

            $('select[name="fixed"]').on('change', function () {
                var fixed = $(this).val();
                if (fixed == 'UUC') {
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "UUC");
                    $('#left').text('Values observed on UUC');
                    $('#right').text('Values observed on Reference');
                }
                if (fixed == 'Ref') {
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "Reference");
                    $('#left').text('Values observed on Reference');
                    $('#right').text('Values observed on UUC');
                }
            });
        });


        $(document).ready(function () {
            var counter = 0;
            $('#counter').val(counter);
            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control" id="x1'+counter+'" name="x1[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x2'+counter+'" name="x2[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x3'+counter+'" name="x3[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="set_value'+counter+'" name="set_value[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="uuc_indication'+counter+'" name="uuc_indication[]"/></td>';
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