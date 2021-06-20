@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {
            $('.opt-assets-select-2').select2({
                placeholder: 'Select Optional Assets'
            });
        });
    </script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light pb-1"><i class="feather icon-eye"></i> Capability Details</h3>
            <span class="float-right">
            <a href="" data-toggle="modal" data-target="#add_suggestion"><i class="fa fa-question"></i> Add Suggestion</a>
        </span>
        </div>
        <div class="col-12">

            <table class="table bg-white table-responsive-sm border-0 table-hover font-13" width="100%">

                <tr>
                    <th width="20%" >Name</th>
                    <td width="80%">{{$show->name}}</td>
                </tr>
                <tr>
                    <th >Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th >Range</th>
                    <td>{{$show->min_range.'-'.$show->max_range}}</td>
                </tr>
                @if($show->accredited=='yes')
                <tr>
                    <th >Accredit Range</th>
                    <td>{{$show->accredited_min_range.'-'.$show->accredited_max_range}}</td>

                </tr>
                @endif

                <tr>
                    <th >Price</th>
                    <td>{{$show->price}}</td>
                </tr>
                <tr>
                    <th >Unit</th>
                    <td>{{$show->units->unit}}</td>
                </tr>
                <tr>
                    <th >Accuracy</th>
                    <td>{{$show->accuracy}}</td>
                </tr>
                <tr>
                    <th >Location</th>
                    <td class="text-capitalize">{{$show->location}}</td>
                </tr>
                <tr>
                    <th >Accredited</th>
                    <td class="text-capitalize font-weight-bold">{{$show->accredited}}</td>
                </tr>

                <tr>
                    <th >Remarks</th>
                    <td>{{$show->remarks}}</td>
                </tr>

            </table>

        </div>
        @if(count($show->suggestions)>0)
            <div class="col-12 table-responsive">
                <h5 class="font-weight-light pb-1"><i class="feather icon-help-circle"></i> Suggestions</h5>
                <table class="table table-sm bg-white table-hover">
                    <tr>
                        <th>Assets</th>
                        <th>Opt. Assets</th>
                        <th>Action</th>
                    </tr>
                    @foreach($show->suggestions as $suggestion)
                        <tr>
                            <td>
                                <small class="badge ">
                                    {{$suggestion->assets->name}}

                                    ( {{$suggestion->assets->code}} )
                                </small>
                            </td>
                            <td>
                                @foreach(explode(',',$suggestion->optional_assets) as $asset)
                                    <small class="badge ">
                                        {{\App\Models\Asset::find($asset)->name}}
                                        <b>( {{\App\Models\Asset::find($asset)->code}} )</b></small>
                                @endforeach
                            </td>
                            <td>
                                <form id="delete-suggestion" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$suggestion->id}}">
                                    <a class="btn btn-outline-danger btn-sm delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>



    <script type="text/javascript">
        $(document).ready(function () {
            $("#add_suggestion_form").on('submit', (function (e) {
                e.preventDefault();
                var button = $('.suggestion-save-btn');
                var previous = $('.suggestion-save-btn').html();
                button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
                $.ajax({
                    url: '{{url('suggestions/create')}}',
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        button.attr('disabled', null).html(previous);
                        swal('success', data.success, 'success').then((value) => {
                            $('#add_suggestion').modal('hide');
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled', null).html(previous);
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));

            $('select[name="parameter"]').on('change', function () {
                var parameter = $(this).val();
                if (parameter) {
                    $.ajax({
                        url: '{{url('scheduling/tasks/respective-assets')}}/' + parameter,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="optassets[]"]').empty();
                            $.each(data, function (index, value) {
                                $('select[name="optassets[]"]').append('<option value="' + value.id + '">' + value.code + '-' + value.name + '</option>');
                            });
                            $('select[name="asset"]').empty();
                            $.each(data, function (index, value) {
                                $('select[name="asset"]').append('<option value="' + value.id + '">' + value.code + '-' + value.name + '</option>');
                            });

                        }
                    });
                } else {
                    $('select[name="optassets[]"]').empty();
                }
            });
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this suggestion?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var request_method = $("#delete-suggestion").attr("method");
                            var form_data = $("#delete-suggestion").serialize();

                            $.ajax({
                                url: "{{route('suggestions.delete')}}/",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                success: function (data) {

                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function () {
                                    swal("Failed", "Unable to delete.", "error");
                                },
                            });

                        }
                    });

            });
        });


    </script>
    <div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="edit_session"><i class="feather icon-plus-circle"></i> Suggestions</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_suggestion_form">
                        @csrf
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Capability</label>
                            <div class="form-group col-12">
                                <input class="form-control " type="hidden" id="capability" name="capability"
                                       placeholder="capability" value="{{$show->id}}" autocomplete="off"/> <input
                                        class="form-control " placeholder="capability" value="{{$show->name}}"
                                        autocomplete="off" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Select Parameter</label>
                            <div class="form-check col-12" style="width: 100%">
                                <select class="form-control" id="parameter" name="parameter">
                                    <option selected disabled="">Select Parameter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="asset" class="col-12 text-xs control-label">Select Asset</label>
                            <div class="form-check col-12" style="width: 100%">
                                <select class="form-control" id="asset" name="asset">
                                    <option selected disabled="disabled">--Select Asset</option>
                                    @foreach(\App\Models\Asset::all() as $asset)
                                        <option value="{{$asset->id}}">{{$asset->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <label for="optassets" class="col-12 text-xs control-label">Select Opt Assets</label>
                            <div class="form-check col-12">
                                <select class="form-control opt-assets-select-2" id="optassets" name="optassets[]" multiple
                                        style="width: 100%;font-size: 10px">

                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer p-2">

                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm suggestion-save-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection