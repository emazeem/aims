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
                @if($spectrophotometer==false)
                <div class="form-group col-md-6">
                    <label for="uuc_resolution" class="col-12 control-label">UUC Resolution</label>
                    <input type="text" class="form-control col-12" id="uuc_resolution" name="uuc_resolution"
                           placeholder="UUC Resolution" autocomplete="off" value="{{old('uuc_resolution',$show->resolution)}}">
                    @if ($errors->has('uuc_resolution'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('uuc_resolution') }}</strong>
                    </span>
                    @endif
                </div>

                @else
                    <div class="form-group col-md-6">
                        <label for="t_uuc_resolution" class="col-12 control-label">Transmittance UUC Resolution</label>
                        <input type="text" class="form-control col-12" id="t_uuc_resolution" name="t_uuc_resolution"
                               placeholder="Transmittance UUC Resolution" autocomplete="off" value="{{old('t_uuc_resolution',$show->resolution)}}">
                        @if ($errors->has('t_uuc_resolution'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_uuc_resolution') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_uuc_resolution" class="col-12 control-label">Absorbance UUC Resolution</label>
                        <input type="text" class="form-control col-12" id="a_uuc_resolution" name="a_uuc_resolution"
                               placeholder="Absorbance UUC Resolution" autocomplete="off" value="{{old('a_uuc_resolution',$show->resolution)}}">
                        @if ($errors->has('a_uuc_resolution'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_uuc_resolution') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_uuc_resolution" class="col-12 control-label">Wavelength UUC Resolution</label>
                        <input type="text" class="form-control col-12" id="w_uuc_resolution" name="w_uuc_resolution"
                               placeholder="Wavelength UUC Resolution" autocomplete="off" value="{{old('w_uuc_resolution',$show->resolution)}}">
                        @if ($errors->has('w_uuc_resolution'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_uuc_resolution') }}</strong>
                    </span>
                        @endif
                    </div>

                @endif
                @if($spectrophotometer==false)

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

                @else
                    <div class="form-group col-md-6">
                        <label for="t_range" class="col-12 control-label">Transmittance Range of UUC (Min)</label>
                        <input type="text" class="form-control col-12" id="t_range" name="t_range[]"
                               placeholder="Transmittance Range of UUC" autocomplete="off" value="{{old('t_range')}}">
                        @if ($errors->has('t_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="t_range" class="col-12 control-label">Transmittance Range of UUC (Max)</label>
                        <input type="text" class="form-control col-12" id="t_range" name="t_range[]"
                               placeholder="Transmittance Range of UUC" autocomplete="off" value="{{old('t_range')}}">
                        @if ($errors->has('t_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_range" class="col-12 control-label">Absorbance Range of UUC (Min)</label>
                        <input type="text" class="form-control col-12" id="a_range" name="a_range[]"
                               placeholder="Absorbance Range of UUC" autocomplete="off" value="{{old('a_range')}}">
                        @if ($errors->has('a_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_range" class="col-12 control-label">Absorbance Range of UUC (Max)</label>
                        <input type="text" class="form-control col-12" id="a_range" name="a_range[]"
                               placeholder="Absorbance Range of UUC" autocomplete="off" value="{{old('a_range')}}">
                        @if ($errors->has('a_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_range" class="col-12 control-label">Wavelength Range of UUC (Min)</label>
                        <input type="text" class="form-control col-12" id="w_range" name="w_range[]"
                               placeholder="Wavelength Range of UUC" autocomplete="off" value="{{old('w_range')}}">
                        @if ($errors->has('w_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_range" class="col-12 control-label">Wavelength Range of UUC (Max)</label>
                        <input type="text" class="form-control col-12" id="w_range" name="w_range[]"
                               placeholder="Wavelength Range of UUC" autocomplete="off" value="{{old('w_range')}}">
                        @if ($errors->has('w_range'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_range') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="t_noise" class="col-12 control-label">Transmittance Photometery Noise</label>
                        <input type="text" class="form-control col-12" id="t_noise" name="t_noise"
                               placeholder="Transmittance Photometery Noise" autocomplete="off" value="{{old('t_noise')}}">
                        @if ($errors->has('t_noise'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_noise') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_noise" class="col-12 control-label">Absorbance Photometery Noise</label>
                        <input type="text" class="form-control col-12" id="a_noise" name="a_noise"
                               placeholder="Absorbance Photometery Noise" autocomplete="off" value="{{old('a_noise')}}">
                        @if ($errors->has('a_noise'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_noise') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_noise" class="col-12 control-label">Wavelength Photometery Noise</label>
                        <input type="text" class="form-control col-12" id="w_noise" name="w_noise"
                               placeholder="Wavelength Photometery Noise" autocomplete="off" value="{{old('w_noise')}}">
                        @if ($errors->has('w_noise'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_noise') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="t_reproducability" class="col-12 control-label">Transmittance Photometery Reproducability</label>
                        <input type="text" class="form-control col-12" id="t_reproducability" name="t_reproducability"
                               placeholder="Transmittance Photometery Reproducability" autocomplete="off" value="{{old('t_reproducability')}}">
                        @if ($errors->has('t_reproducability'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_reproducability') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_reproducability" class="col-12 control-label">Absorbance Photometery Reproducability</label>
                        <input type="text" class="form-control col-12" id="a_reproducability" name="a_reproducability"
                               placeholder="Absorbance Photometery Reproducability" autocomplete="off" value="{{old('a_reproducability')}}">
                        @if ($errors->has('a_reproducability'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_reproducability') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_reproducability" class="col-12 control-label">Wavelength Photometery Reproducability</label>
                        <input type="text" class="form-control col-12" id="w_reproducability" name="w_reproducability"
                               placeholder="Wavelength Photometery Reproducability" autocomplete="off" value="{{old('w_reproducability')}}">
                        @if ($errors->has('w_reproducability'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_reproducability') }}</strong>
                    </span>
                        @endif
                    </div>


                    <div class="form-group col-md-6">
                        <label for="t_stablitity" class="col-12 control-label">Transmittance Photometery Stability</label>
                        <input type="text" class="form-control col-12" id="t_stablitity" name="t_stablitity"
                               placeholder="Transmittance Photometery Stability" autocomplete="off" value="{{old('t_stablitity')}}">
                        @if ($errors->has('t_stablitity'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_stablitity') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_stablitity" class="col-12 control-label">Absorbance Photometery Stability</label>
                        <input type="text" class="form-control col-12" id="a_stablitity" name="a_stablitity"
                               placeholder="Absorbance Photometery Stability" autocomplete="off" value="{{old('a_stablitity')}}">
                        @if ($errors->has('a_stablitity'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_stablitity') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_stablitity" class="col-12 control-label">Wavelength Photometery Stability</label>
                        <input type="text" class="form-control col-12" id="w_stablitity" name="w_stablitity"
                               placeholder="Wavelength Photometery Stability" autocomplete="off" value="{{old('w_stablitity')}}">
                        @if ($errors->has('w_stablitity'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_stablitity') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="t_baseline_flateness" class="col-12 control-label">Transmittance Baseline Flateness</label>
                        <input type="text" class="form-control col-12" id="t_baseline_flateness" name="t_baseline_flateness"
                               placeholder="Transmittance Baseline Flateness" autocomplete="off" value="{{old('t_baseline_flateness')}}">
                        @if ($errors->has('t_baseline_flateness'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('t_baseline_flateness') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="a_baseline_flateness" class="col-12 control-label">Absorbance Baseline Flateness</label>
                        <input type="text" class="form-control col-12" id="a_baseline_flateness" name="a_baseline_flateness"
                               placeholder="Absorbance Baseline Flateness" autocomplete="off" value="{{old('a_baseline_flateness')}}">
                        @if ($errors->has('a_baseline_flateness'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('a_baseline_flateness') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_baseline_flateness" class="col-12 control-label">Wavelength Baseline Flateness</label>
                        <input type="text" class="form-control col-12" id="w_baseline_flateness" name="w_baseline_flateness"
                               placeholder="Wavelength Baseline Flateness" autocomplete="off" value="{{old('w_baseline_flateness')}}">
                        @if ($errors->has('w_baseline_flateness'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('w_baseline_flateness') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accuracy" class="col-12 control-label">Transmittance Accuracy of UUC</label>
                        <input type="text" class="form-control col-12" id="accuracy" name="accuracy[]"
                               placeholder="Transmittance Accuracy of UUC" autocomplete="off" value="{{old('accuracy')}}">
                        @if ($errors->has('accuracy'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('accuracy') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="accuracy" class="col-12 control-label">Absorbance Accuracy of UUC</label>
                        <input type="text" class="form-control col-12" id="accuracy" name="accuracy[]"
                               placeholder="Absorbance Accuracy of UUC" autocomplete="off" value="{{old('accuracy')}}">
                        @if ($errors->has('accuracy'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('accuracy') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="w_accuracy_uuc" class="col-12 control-label">Wavelength Accuracy of UUC</label>
                        <input type="text" class="form-control col-12" id="accuracy" name="accuracy[]"
                               placeholder="Wavelength Accuracy of UUC" autocomplete="off" value="{{old('accuracy')}}">
                        @if ($errors->has('accuracy'))
                            <span class="text-danger">
                        <strong>{{ $errors->first('accuracy') }}</strong>
                    </span>
                        @endif
                    </div>



                @endif
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

                <div class="form-group col-md-6">
                    <label for="assets" class="control-label">Balance Asset</label>
                    <select class="form-control" id="balance_id" name="balance_id">
                        <option selected disabled>Assets</option>
                        @foreach($assets as $asset)
                            <option value="{{$asset->id}}">{{$asset->name}} ({{$asset->code}}) ({{$asset->range}})</option>
                        @endforeach
                    </select>
                    @if ($errors->has('balance_id'))
                        <span class="text-danger"><strong>{{ $errors->first('balance_id') }}</strong></span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="assets" class="control-label">Temp Asset</label>
                    <select class="form-control" id="temp_id" name="temp_id">
                        <option selected disabled>Assets</option>
                        @foreach($assets as $asset)
                            <option value="{{$asset->id}}">{{$asset->name}} ({{$asset->code}}) ({{$asset->range}})</option>
                        @endforeach
                    </select>
                    @if ($errors->has('temp_id'))
                        <span class="text-danger"><strong>{{ $errors->first('temp_id') }}</strong></span>
                    @endif
                </div>

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
            @if($show->item->capabilities->calculator=='vernier-caliper-calculator' or $show->item->capabilities->calculator=='micrometer-calculator' or $show->item->capabilities->calculator=='dial-gauge-calculator' )
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="uuc_type" class="control-label">Type of UUC</label>
                        <select class="form-control" id="uuc_type" name="uuc_type">
                            <option selected disabled>Type of UUC</option>
                            <option value="analogue">Analogue</option>
                            <option value="digital">Digital</option>
                        </select>
                        @if ($errors->has('uuc_type'))
                            <span class="text-danger"><strong>{{ $errors->first('uuc_type') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="uuc_temp" class="col-12 control-label">UUC Temperature (Start)</label>
                        <input type="text" class="form-control col-12" id="uuc_temp" name="uuc_temp[]" placeholder="UUC Temperature (Start)"
                               autocomplete="off" value="{{old('uuc_temp')}}">
                        @if ($errors->has('uuc_temp'))<span class="text-danger">
                            <strong>{{ $errors->first('uuc_temp') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="uuc_temp" class="col-12 control-label">UUC Temperature (End)</label>
                        <input type="text" class="form-control col-12" id="uuc_temp" name="uuc_temp[]" placeholder="UUC Temperature (End)"
                               autocomplete="off" value="{{old('uuc_temp')}}">
                        @if ($errors->has('uuc_temp'))<span class="text-danger">
                            <strong>{{ $errors->first('uuc_temp') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ref_temp" class="col-12 control-label">Ref Temperature (Start)</label>
                        <input type="text" class="form-control col-12" id="ref_temp" name="ref_temp[]" placeholder="Ref Temperature (Start)"
                               autocomplete="off" value="{{old('ref_temp')}}">
                        @if ($errors->has('ref_temp'))<span class="text-danger">
                            <strong>{{ $errors->first('ref_temp') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ref_temp" class="col-12 control-label">Ref Temperature (End)</label>
                        <input type="text" class="form-control col-12" id="ref_temp" name="ref_temp[]" placeholder="Ref Temperature (End)"
                               autocomplete="off" value="{{old('ref_temp')}}">
                        @if ($errors->has('ref_temp'))<span class="text-danger">
                            <strong>{{ $errors->first('ref_temp') }}</strong>
                        </span>
                        @endif
                    </div>
                    @if($show->item->capabilities->calculator=='vernier-caliper-calculator')
                    <div class="form-group col-md-12"> Parallelism of Measuring Faces:(30mm Guage Placed in faces)</div>
                    <div class="form-group col-md-6">
                        <label for="anti_parallelism" class="col-12 control-label"> Near Vernier Scale Jaw</label>
                        <input type="text" class="form-control col-12" id="anti_parallelism" name="anti_parallelism[]" placeholder="Anti Parallelism"
                               autocomplete="off" value="{{old('anti_parallelism')}}">
                        @if ($errors->has('anti_parallelism'))<span class="text-danger">
                            <strong>{{ $errors->first('anti_parallelism') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="anti_parallelism" class="col-12 control-label"> In b/w VS & Center</label>
                        <input type="text" class="form-control col-12" id="anti_parallelism" name="anti_parallelism[]" placeholder="Anti Parallelism"
                               autocomplete="off" value="{{old('anti_parallelism')}}">
                        @if ($errors->has('anti_parallelism'))<span class="text-danger">
                            <strong>{{ $errors->first('anti_parallelism') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="anti_parallelism" class="col-12 control-label"> Center</label>
                        <input type="text" class="form-control col-12" id="anti_parallelism" name="anti_parallelism[]" placeholder="Anti Parallelism"
                               autocomplete="off" value="{{old('anti_parallelism')}}">
                        @if ($errors->has('anti_parallelism'))<span class="text-danger">
                            <strong>{{ $errors->first('anti_parallelism') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="anti_parallelism" class="col-12 control-label"> In b/w Fixed Jaw & Center</label>
                        <input type="text" class="form-control col-12" id="anti_parallelism" name="anti_parallelism[]" placeholder="Anti Parallelism"
                               autocomplete="off" value="{{old('anti_parallelism')}}">
                        @if ($errors->has('anti_parallelism'))<span class="text-danger">
                            <strong>{{ $errors->first('anti_parallelism') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="anti_parallelism" class="col-12 control-label"> Near Fixed Jaw</label>
                        <input type="text" class="form-control col-12" id="anti_parallelism" name="anti_parallelism[]" placeholder="Anti Parallelism"
                               autocomplete="off" value="{{old('anti_parallelism')}}">
                        @if ($errors->has('anti_parallelism'))<span class="text-danger">
                            <strong>{{ $errors->first('anti_parallelism') }}</strong>
                        </span>
                        @endif
                    </div>
                        @endif
                    @if($show->item->capabilities->calculator=='micrometer-calculator')
                    <div class="form-group col-md-12"> Parallelism of Measuring Faces:</div>
                    <div class="form-group col-md-6">
                        <label for="p_anvil" class="col-12 control-label"> Parallelism anvil</label>
                        <input type="text" class="form-control col-12" id="p_anvil" name="p_anvil" placeholder="Parallelism anvil"
                               autocomplete="off" value="{{old('p_anvil')}}">
                        @if ($errors->has('p_anvil'))<span class="text-danger">
                            <strong>{{ $errors->first('p_anvil') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="p_spindle" class="col-12 control-label"> Parallelism spindle</label>
                        <input type="text" class="form-control col-12" id="p_spindle" name="p_spindle" placeholder="Parallelism _spindle"
                               autocomplete="off" value="{{old('p_spindle')}}">
                        @if ($errors->has('p_spindle'))<span class="text-danger">
                            <strong>{{ $errors->first('p_spindle') }}</strong>
                        </span>
                        @endif
                    </div>
                        <div class="form-group col-md-12"> Flatness of Measuring Faces:</div>
                    <div class="form-group col-md-6">
                        <label for="f_anvil" class="col-12 control-label">Flatness anvil</label>
                        <input type="text" class="form-control col-12" id="f_anvil" name="f_anvil" placeholder="Flatness _anvil"
                               autocomplete="off" value="{{old('f_anvil')}}">
                        @if ($errors->has('f_anvil'))<span class="text-danger">
                            <strong>{{ $errors->first('f_anvil') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="f_spindle" class="col-12 control-label"> Flatness _spindle</label>
                        <input type="text" class="form-control col-12" id="p_spindle" name="f_spindle" placeholder="Flatness spindle"
                               autocomplete="off" value="{{old('f_spindle')}}">
                        @if ($errors->has('f_spindle'))<span class="text-danger">
                            <strong>{{ $errors->first('f_spindle') }}</strong>
                        </span>
                        @endif
                    </div>

                    @endif



</div>
<div class="row">

    <div class="form-group col-md-6">
        <label for="zero_err" class="col-12 control-label">Zero Check (before adjustment)</label>
        <input type="text" class="form-control col-12" id="zero_err" name="zero_err[]" placeholder="Zero Check (before adjustment)"
               autocomplete="off" value="{{old('zero_err')}}">
        @if ($errors->has('zero_err'))
            <span class="text-danger">
            <strong>{{ $errors->first('zero_err') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="zero_err" class="col-12 control-label">Zero Check (after adjustment)</label>
        <input type="text" class="form-control col-12" id="zero_err" name="zero_err[]" placeholder="Zero Check (after adjustment)"
               autocomplete="off" value="{{old('zero_err')}}">
        @if ($errors->has('zero_err'))
            <span class="text-danger">
            <strong>{{ $errors->first('zero_err') }}</strong>
        </span>
        @endif
    </div>
</div>
                @if($show->item->capabilities->calculator=='dial-gauge-calculator')
                    DIAL GAUGE ENTRY
                @endif
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