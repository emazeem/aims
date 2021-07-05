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
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row ">
        <div class="col-12">
            <h3 class="font-weight-light"><i class="fa fa-money"></i> Chart of Account</h3>

            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#levels4" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"> <i class="fa fa-plus-circle"></i> Chart of Account</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="levels4">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" id="add_level_form" method="post">
                                @csrf

                                <div class="form-group mt-md-4 row">

                                    <label for="level1of4" class="col-sm-2 control-label">Level 1</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level1of4" name="level1of4">
                                            <option value="" selected disabled>Select Level 1</option>
                                            @foreach($ones as $one)
                                                <option value="{{$one->id}}">{{$one->title}}</option>
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
                                            <option value="" selected disabled>Select Level 2</option>
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
                                            <option value="" selected disabled>Select Level 3</option>
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
                                               placeholder="Title" autocomplete="off" value="{{old('title')}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div>
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="opening_balance" class="col-sm-2 control-label">Opening Balance</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="opening_balance" name="opening_balance"
                                               placeholder="Opening Balance" autocomplete="off" value="{{old('opening_balance')}}">
                                        @if ($errors->has('opening_balance'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('opening_balance') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary acc-save-btn"><i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('select[name="level1of4"]').on('change', function() {
                var level1of4 = $(this).val();
                if(level1of4) {
                    $.ajax({
                        url: '/acc_level_three/get_level2/'+level1of4,
                        type: "GET",
                        dataType: "json",
                        beforeSend : function() {
                            $(".loader-gif").fadeIn();
                        },

                        success:function(data) {
                            $(".loader-gif").hide();
                            $('select[name="level2of4"]').empty();
                            $('select[name="level2of4"]').append('<option disabled selected>Select Level 2</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level2of4"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $(".loader-gif").hide();
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
                        beforeSend : function() {
                            $(".loader-gif").fadeIn();
                        },
                        success:function(data) {
                            $(".loader-gif").hide();
                            $('select[name="level3of4"]').empty();
                            $('select[name="level3of4"]').append('<option disabled selected>Select Level 3</option>');
                            $.each(data, function(key, value) {
                                $('select[name="level3of4"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $(".loader-gif").hide();
                    $('select[name="level3of4"]').empty();
                }
            });

            $("#add_level_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$('.acc-save-btn');
                var previous=$('.acc-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
                $.ajax({
                    url: "{{route('acc_level_four.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            //
                        });
                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
        });
    </script>
@endsection