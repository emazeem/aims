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
    <style>
        .form-group{
            margin: 0;
            padding: 2px;
        }
    </style>
    <div class="col-12">
        <ol class="breadcrumb col-12">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/mytasks')}}">My Tasks</a></li>
            <li class="breadcrumb-item"><a href="{{url('/mytasks')}}">Task Detail</a></li>
        </ol>
        <h3><i class="fa fa-calculator"></i> Calculator Entries</h3>
    </div>
    <div class="col-12">
        <form class="form-horizontal" action="{{route('calculator.data.entry.store')}}" method="post">
            @csrf
            <input type="hidden" value="{{$show->id}}" name="jobtypeid">
            {{--<input type="hidden" value="" id="mulitplying_factor" name="mulitplying_factor">
            <input type="hidden" value="" id="adding_factor" name="adding_factor">
            <input type="hidden" value="" id="ref_unit" name="ref_unit">
            --}}

            <div class="row">
{{--                <div class="form-group col-md-6">
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
                </div>--}}

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

                @if($show->item->capabilities->calculator=='balance-calculator' or $show->item->capabilities->calculator=='volume-calculator')
                <div class="form-group col-md-6">
                    <label for="start_atmospheric_pressure" class="col-md-12 col-12 control-label">Start Atmospheric
                        Pressure</label>
                    <input type="text" class="form-control col-md-12 col-12" id="start_atmospheric_pressure"
                           name="start_atmospheric_pressure"
                           placeholder="Start Atmospheric Pressure" autocomplete="off"
                           value="{{old('start_atmospheric_pressure',($dataentry)?$dataentry->start_atmospheric_pressure : null)}}">
                    @if ($errors->has('start_atmospheric_pressure'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('start_atmospheric_pressure') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="end_atmospheric_pressure" class="col-12 control-label">End Atmospheric Pressure</label>
                    <input type="text" class="form-control col-12" id="end_atmospheric_pressure"
                           name="end_atmospheric_pressure"
                           placeholder="End Atmospheric Pressure" autocomplete="off"
                           value="{{old('end_atmospheric_pressure',($dataentry)?$dataentry->end_atmospheric_pressure : null)}}">
                    @if ($errors->has('end_atmospheric_pressure'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('end_atmospheric_pressure') }}</strong>
                            </span>
                    @endif
                </div>
                @endif

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
                @php if ($show->range){$range=explode(',',$show->range);}else{$range=[null,null];} @endphp
                <div class="form-group col-md-6">
                    <label for="range" class="col-12 control-label">Range of UUC (Min)</label>
                    <input type="text" class="form-control col-12" id="range" name="range[]"
                           placeholder="Range of UUC" autocomplete="off" value="{{old('range',$range[0])}}">
                    @if ($errors->has('range'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('range') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="range" class="col-12 control-label">Range of UUC (Max)</label>
                    <input type="text" class="form-control col-12" id="range" name="range[]"
                           placeholder="Range of UUC" autocomplete="off" value="{{old('range',$range[1])}}">
                    @if ($errors->has('range'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('range') }}</strong>
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
                <div class="form-group col-12">
                    <label for="location" class="col-12 control-label">Location of UUC</label>
                    <input type="text" class="form-control col-12" id="location" name="location"
                           placeholder="Location of UUC" autocomplete="off"
                           value="{{old('location',($dataentry)?$dataentry->location : null)}}">
                    <div class="col-12 mt-2 text-right p-0 m-0">
                        @foreach($labs as $lab)
                            <button data-id="{{$lab->name}}" class="btn btn-light border btn-sm labs">{{$lab->name}}</button>
                        @endforeach
                    </div>
                    @if ($errors->has('location'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @if($show->item->capabilities->calculator=='balance-calculator')
                <div class="form-group col-12">
                    <div class="control-label">Pan Position Check for Balance Under Calibration Check with Ref. Std. > or = 33 % of Max Range</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="weight" class="col-12 control-label">Weight</label>
                    <input type="text" class="form-control col-12" id="weight" name="weight" placeholder="Weight"
                           autocomplete="off" value="{{old('weight')}}">
                    @if ($errors->has('weight'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('weight') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="center" class="col-12 control-label">Center</label>
                    <input type="text" class="form-control col-12" id="center" name="center[]" placeholder="Center"
                           autocomplete="off" value="{{old('center')}}">
                    @if ($errors->has('center'))
                        <span class="text-danger">
            <strong>{{ $errors->first('center') }}</strong>
        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="front" class="col-12 control-label">Front</label>
                    <input type="text" class="form-control col-12" id="front" name="front" placeholder="Front" autocomplete="off" value="{{old('front')}}">
                    @if ($errors->has('front'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('front') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="rare" class="col-12 control-label">Rare</label>
                    <input type="text" class="form-control col-12" id="rare" name="rare" placeholder="Rare"
                           autocomplete="off" value="{{old('rare')}}">
                    @if ($errors->has('rare'))
                        <span class="text-danger">
            <strong>{{ $errors->first('rare') }}</strong>
        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="left" class="col-12 control-label">Left</label>
                    <input type="text" class="form-control col-12" id="left" name="left" placeholder="Left"
                           autocomplete="off" value="{{old('left')}}">
                    @if ($errors->has('left'))
                        <span class="text-danger">
            <strong>{{ $errors->first('left') }}</strong>
        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="right" class="col-12 control-label">Right</label>
                    <input type="text" class="form-control col-12" id="right" name="right" placeholder="Right"
                           autocomplete="off" value="{{old('right')}}">
                    @if ($errors->has('right'))
                        <span class="text-danger">
            <strong>{{ $errors->first('right') }}</strong>
        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="center" class="col-12 control-label">Center</label>
                    <input type="text" class="form-control col-12" id="center" name="center[]" placeholder="Center"
                           autocomplete="off" value="{{old('center')}}">
                    @if ($errors->has('center'))
                        <span class="text-danger">
            <strong>{{ $errors->first('center') }}</strong>
        </span>
                    @endif
                </div>
                <label for="repeatability" class="col-12 control-label">Repeatability Measurement Observations: Ref Mass > or = 50% to Max (where possible)</label>
                <div class="row">

                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div class="form-group col-md-2 col-6">
                    <input type="text" class="form-control col-12" id="repeatability" name="repeatability[]" placeholder="Repeatability" autocomplete="off" value="{{old('repeatability')}}">
                </div>
                <div>
                    <label for="repeatability" class="col-12 control-label">Temperature Difference between ref mass & weighing pan (C)</label>

                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="uuc1" name="uuc1" placeholder="uuc1" autocomplete="off" value="{{old('uuc1')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="uuc2" name="uuc2" placeholder="uuc2" autocomplete="off" value="{{old('uuc2')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="uuc3" name="uuc3" placeholder="uuc3" autocomplete="off" value="{{old('uuc3')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="ref1" name="ref1" placeholder="ref1" autocomplete="off" value="{{old('ref1')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="ref2" name="ref2" placeholder="ref2" autocomplete="off" value="{{old('ref2')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="ref3" name="ref3" placeholder="ref3" autocomplete="off" value="{{old('ref3')}}">
                    </div>

                </div>
                @if ($errors->has('repeatability'))
                    <span class="text-danger">
            <strong>{{ $errors->first('repeatability') }}</strong>
        </span>
                @endif

            @endif
            @if($show->item->capabilities->calculator=='volume-calculator')
                <div class="form-group col-md-12">
                    <label for="tolerance" class="col-md-12 col-12 control-label">Tolerance</label>
                    <input type="text" class="form-control col-md-12 col-12" id="tolerance" name="tolerance"
                           placeholder="Tolerance" autocomplete="off" value="{{old('tolerance')}}">
                    @if ($errors->has('tolerance'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('tolerance') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    <label for="class" class=" control-label">Class</label>
                    <select class="form-control " id="class" name="class">
                        <option selected disabled>Select class</option>
                        <option value="a">Class A</option>
                        <option value="b">Class B</option>
                        <option value="c">Class C (Unclassified)</option>
                    </select>
                    @if ($errors->has('class'))
                        <span class="text-danger"><strong>{{ $errors->first('class') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    <label for="class" class="control-label">Balance Calibration Check with Traceable Std. Masses</label>
                </div>

                <div class="form-group col-md-12">
                    <label for="balance_id" class="col-md-12 col-12 control-label">Balance ID</label>
                    <input type="text" class="form-control col-md-12 col-12" id="balance_id" name="balance_id"
                           placeholder="Balance ID" autocomplete="off" value="{{old('balance_id')}}">
                    @if ($errors->has('balance_id'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('balance_id') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <label for="balance_values" class="col-md-12 col-12 control-label">Balance Values</label>

                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="balance_values" name="balance_values[]" placeholder="Balance Values" autocomplete="off" value="{{old('balance_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="balance_values" name="balance_values[]" placeholder="Balance Values" autocomplete="off" value="{{old('balance_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="balance_values" name="balance_values[]" placeholder="Balance Values" autocomplete="off" value="{{old('balance_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="balance_values" name="balance_values[]" placeholder="Balance Values" autocomplete="off" value="{{old('balance_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="balance_values" name="balance_values[]" placeholder="Balance Values" autocomplete="off" value="{{old('balance_values')}}">
                    </div>

                    @if ($errors->has('balance_values'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('balance_values') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-12">
                    <label for="class" class="control-label">Temperature of Water used for Calibration</label>
                </div>

                <div class="form-group col-md-12">
                    <label for="temp_id" class="col-md-12 col-12 control-label">Temp_ ID</label>
                    <input type="text" class="form-control col-md-12 col-12" id="temp_id" name="temp_id"
                           placeholder="Temp_ ID" autocomplete="off" value="{{old('temp_id')}}">
                    @if ($errors->has('temp_id'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('temp_id') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <label for="temp_values" class="col-md-12 col-12 control-label">Temp_ Values</label>

                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="temp_values" name="temp_values[]" placeholder="Temp Values" autocomplete="off" value="{{old('temp_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="temp_values" name="temp_values[]" placeholder="Temp Values" autocomplete="off" value="{{old('temp_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="temp_values" name="temp_values[]" placeholder="Temp Values" autocomplete="off" value="{{old('temp_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="temp_values" name="temp_values[]" placeholder="Temp Values" autocomplete="off" value="{{old('temp_values')}}">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <input type="text" class="form-control col-12" id="temp_values" name="temp_values[]" placeholder="Temp Values" autocomplete="off" value="{{old('temp_values')}}">
                    </div>
                    @if ($errors->has('temp_values'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('temp_values') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
            <div class="row">
                <div class="col-12 p-2">
                    <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
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
            $('.labs').on('click', function (e) {
                e.preventDefault();
                var lab = $(this).attr('data-id');
                $('#location').val(lab);
            });
        });

    </script>
@endsection