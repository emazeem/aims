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
        <h3 class="border-bottom"><i class="fa fa-tasks"></i> Calculator</h3>
    </div>
    <div class="col-12 mt-5">
        <form class="form-horizontal" action="{{route('data_entry.create')}}" method="post">
            @csrf
            <input type="hidden" value="{{$show->id}}" name="jobtypeid">
            <input type="hidden" value="{{$location}}" name="jobtype">
            <input type="hidden" value="{{$show->item->capabilities->procedure}}" name="procedure">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="assets" class=" control-label">Assets</label>
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
                <div class="form-group col-md-6">
                    <label for="start_temp" class="col-md-12 col-12 control-label">Start Temperature</label>
                    <input type="text" class="form-control col-md-12 col-12" id="start_temp" name="start_temp"
                           placeholder="Start Temperature" autocomplete="off" value="{{old('start_temp',($dataentry)?$dataentry->start_temp : null)}}">
                    @if ($errors->has('start_temp'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('start_temp') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="end_temp" class="col-md-12 col-12 control-label">End Temperature</label>
                    <input type="text" class="form-control col-md-12 col-12" id="end_temp" name="end_temp"
                           placeholder="End Temperature" autocomplete="off" value="{{old('end_temp',($dataentry)?$dataentry->end_temp : null)}}">
                    @if ($errors->has('end_temp'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('end_temp') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="start_humidity" class="col-md-12 col-12 control-label">Start Humidity</label>
                    <input type="text" class="form-control col-md-12 col-12" id="start_humidity" name="start_humidity"
                           placeholder="Start Humidity" autocomplete="off" value="{{old('start_humidity',($dataentry)?$dataentry->start_humidity : null)}}">
                    @if ($errors->has('start_humidity'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('start_humidity') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="end_humidity" class="col-12 control-label">End Humidity</label>
                    <input type="text" class="form-control col-12" id="end_humidity" name="end_humidity"
                           placeholder="End Humidity" autocomplete="off" value="{{old('end_humidity',($dataentry)?$dataentry->end_humidity : null)}}">
                    @if ($errors->has('end_humidity'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('end_humidity') }}</strong>
                            </span>
                    @endif
                </div>


                <div class="form-group col-md-6">
                    <label for="uuc_resolution" class="col-12 control-label">UUC Resolution</label>
                    <input type="text" class="form-control col-12" id="uuc_resolution" name="uuc_resolution"
                           placeholder="UUC Resolution" autocomplete="off" value="{{old('uuc_resolution',$show->resolution)}}">
                    @if ($errors->has('uncertainty'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('uuc_resolution') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="accuracy" class="col-12 control-label">Accuracy of UUC</label>
                    <input type="text" class="form-control col-md-12" id="accuracy" name="accuracy"
                           placeholder="Accuracy of UUC" autocomplete="off" value="{{old('accuracy',$show->accuracy)}}">
                    @if ($errors->has('accuracy'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('accuracy') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="range" class="col-12 control-label">Range of UUC</label>
                    <input type="text" class="form-control col-12" id="range" name="range"
                           placeholder="Range of UUC" autocomplete="off" value="{{old('range',$show->range)}}">
                    @if ($errors->has('range'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('range') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="location" class="col-12 control-label">Location of UUC</label>
                    <input type="text" class="form-control col-12" id="location" name="location"
                           placeholder="Location of UUC" autocomplete="off" value="{{old('location',($dataentry)?$dataentry->location : null)}}">
                    @if ($errors->has('location'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="before_offset" class="col-12 control-label">Offset of UUC (Before
                        Adjustment)</label>
                    <input type="text" class="form-control col-12" id="before_offset" name="before_offset"
                           placeholder="Offset" autocomplete="off" value="0">
                    @if ($errors->has('before_offset'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('before_offset') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="after_offset" class=" col-12 control-label">Offset of UUC (After Adjustment)</label>
                    <input type="text" class="form-control  col-12" id="after_offset" name="after_offset"
                           placeholder="Offset" autocomplete="off" value="0">
                    @if ($errors->has('after_offset'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('after_offset') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group col-md-12 mt-3">
                <label for="fixed" class="col-sm-3 control-label">Single / Fixed Value</label>
                <select class="form-control col-md-9" id="fixed" name="fixed">
                    <option selected disabled>Single / Fixed Value</option>
                    <option value="UUC">UUC</option>
                    <option value="Ref">Ref Std</option>
                </select>
                @if ($errors->has('fixed'))
                    <span class="text-danger"><strong>{{ $errors->first('fixed') }}</strong></span>
                @endif
            </div>
            <div class="row cal-inputs" style="display: none">
                <div class="col-md-3 col-12">
                    <h6 id="left"></h6>
                </div>
                <div class="col-md-9 col-12">
                    <h6 id="right"></h6>
                </div>
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Fixed Value</td>
                        <td>X<sub>1</sub></td>
                        <td>X<sub>2</sub></td>
                        <td>X<sub>3</sub></td>
                        <td>X<sub>4</sub></td>
                        <td>X<sub>5</sub></td>
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
                            <input type="text" name="x4[]" class="form-control "/>
                            @if ($errors->has('x4'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x4') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x5[]" class="form-control "/>
                            @if ($errors->has('x5'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x5') }}</strong>
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
                <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {

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

            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control" name="fixed_value[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x1[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x2[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x3[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x4[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x5[]"/></td>';
                cols += '<td><a href="javascript:void(0)" class="btn btn-danger btn-sm ibtnDel"><i class=" fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });


            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1
            });


        });

    </script>
@endsection