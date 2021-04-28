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
    @if($level==1)
    <div class="row mt-4">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-money"></i> Chart of Account</h3>
        </div>
        <div class="col-12">
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#levels1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Accounting Level 1</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="{{($level==1)?'show':''}}" id="levels1">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('acc_level_one.update')}}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}"/>
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Title" autocomplete="off" value="{{old('title',$edit->title)}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div class="py-2">
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($level==2)
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#levels2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Accounting Level 2</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse {{($level==2)?'show':''}}" id="levels2">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('acc_level_two.update')}}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}"/>
                                <div class="form-group mt-md-4 row">

                                    <label for="level1" class="col-sm-2 control-label">level1</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level1" name="level1">
                                            <option value="" selected disabled>Select Level 1</option>
                                            @foreach($ones as $one)
                                                <option value="{{$one->id}}" {{($edit->code1==$one->id?'selected':'')}}>{{$one->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('level1'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Title" autocomplete="off" value="{{old('title',$edit->title)}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div class="py-2">
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    @if($level==3)
        <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#levels3" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Accounting Level 3</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse {{$level==3?'show':''}}" id="levels3">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('acc_level_three.update')}}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}"/>
                                <div class="form-group mt-md-4 row">
                                    <label for="level1of3" class="col-sm-2 control-label">Level 1</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level1of3" name="level1of3">
                                            <option value="" selected disabled>Select Level 1</option>
                                            @foreach($ones as $one)
                                                <option value="{{$one->id}}" {{($edit->code1==$one->id?'selected':'')}}>{{$one->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('level1of3'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level1of3') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="level2of3" class="col-sm-2 control-label">Level 2</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level2of3" name="level2of3">
                                            <option value="{{$edit->code2}}">{{\App\Models\AccLevelTwo::find($edit->code2)->title}}</option>
                                        </select>

                                        @if ($errors->has('level2of3'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level2of3') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Title" autocomplete="off" value="{{old('title',$edit->title)}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div class="py-2">
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    @if($level==4)
    <div class="row ">
        <div class="col-12">
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#levels4" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"> Chart of Account</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse {{$level==4?'show':''}}" id="levels4">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('acc_level_four.update')}}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}"/>
                                <div class="form-group mt-md-4 row">

                                    <label for="level1of4" class="col-sm-2 control-label">Level 1</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level1of4" name="level1of4">
                                            <option value="" selected disabled>Select Level 1</option>
                                            @foreach($ones as $one)
                                                <option value="{{$one->id}}" {{($edit->code1==$one->id?'selected':'')}}>{{$one->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('level1of4'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level1of4') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="level2of4" class="col-sm-2 control-label">Level 2</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level2of4" name="level2of4">
                                            <option value="{{$edit->code2}}">{{\App\Models\AccLevelTwo::find($edit->code2)->title}}</option>
                                        </select>

                                        @if ($errors->has('level2of4'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level2of4') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="level3of4" class="col-sm-2 control-label">Level 3</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level3of4" name="level3of4">
                                            <option value="{{$edit->code3}}">{{\App\Models\AccLevelThree::find($edit->code3)->title}}</option>
                                        </select>

                                        @if ($errors->has('level3of4'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level3of4') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Title" autocomplete="off" value="{{old('title',$edit->title)}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div class="py-2">
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script>
        $(document).ready(function () {
            $('select[name="level1of3"]').on('change', function() {
                var level1of3 = $(this).val();
                if(level1of3) {
                    $.ajax({
                        url: '/acc_level_three/get_level2/'+level1of3,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="level2of3"]').empty();
                            $('select[name="level2of3"]').append('<option disabled selected>Select Level 2</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level2of3"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="level2of3"]').empty();
                }
            });
            $('select[name="level1of4"]').on('change', function() {
                var level1of4 = $(this).val();
                if(level1of4) {
                    $.ajax({
                        url: '/acc_level_three/get_level2/'+level1of4,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="level2of4"]').empty();
                            $('select[name="level2of4"]').append('<option disabled selected>Select Level 2</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level2of4"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="level2of4"]').empty();
                }
            });
            $('select[name="level2of4"]').on('change', function() {
                var level2of4 = $(this).val();
                if(level2of4) {
                    $.ajax({
                        url: '/acc_level_three/get_level3/'+level2of4,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="level3of4"]').empty();
                            $('select[name="level3of4"]').append('<option disabled selected>Select Level 3</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level3of4"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="level3of4"]').empty();
                }
            });

        });
    </script>


@endsection