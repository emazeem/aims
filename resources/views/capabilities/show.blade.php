@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif

    <div class="row">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> Capability Details</h3>
            <span class="pull-right">
            <a href="" data-toggle="modal" data-target="#add_suggestion"><i class="fa fa-question"></i> Add Suggestion</a>
        </span>
        </div>
        <div class="col-12">

            <table class="table table-responsive-sm table-hover font-13" width="100%">

                <tr>
                    <th width="50%">Name</th>
                    <td width="50%">{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Range</th>
                    <td>{{$show->min_range.'-'.$show->max_range}}</td>
                </tr>
                @if($show->accredited_min_range)
                <tr>
                    <th>Accredit Range</th>
                    <td>{{$show->accredited_min_range.'-'.$show->accredited_max_range}}</td>

                </tr>
                @endif

                <tr>
                    <th>Price</th>
                    <td>{{$show->price}}</td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>{{$show->unit}}</td>
                </tr>
                <tr>
                    <th>Accuracy</th>
                    <td>{{$show->accuracy}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td class="text-capitalize">{{$show->location}}</td>
                </tr>
                <tr>
                    <th>Accredited</th>
                    <td class="text-capitalize font-weight-bold">{{$show->accredited}}</td>
                </tr>

                <tr>
                    <th>Remarks</th>
                    <td>{{$show->remarks}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>

        </div>

    </div>

    @if(count($suggestions)>0)
    <div class="col-12 table-responsive">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-question-circle"></i> Suggestions</h3>
        <table class="table table-hover table-bordered">
            <tr>
                <th>Capability</th>
                <th>Parameter</th>
                <th>Assets</th>
                <th>Action</th>
            </tr>
            @foreach($suggestions as $suggestion)
                <tr>
                    <td>{{\App\Models\Capabilities::find($suggestion->capabilities)->name}}</td>
                    <td>{{\App\Models\Parameter::find($suggestion->parameter)->name}}</td>
                    @php $assets=explode(',',$suggestion->optional_assets) @endphp
                    <td>
                        @foreach($assets as $asset)
                            <small class="badge badge-pill badge-danger">{{\App\Models\Asset::find($asset)->name}}
                                <b>( {{\App\Models\Asset::find($asset)->code}} )</b></small>
                            <br>
                        @endforeach
                    </td>
                    <td>
                        <form id="delete-suggestion" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$suggestion->id}}">
                            <a class="btn btn-outline-danger btn-sm delete" href="javascript:void(0)"><i
                                        class="fa fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
    <script type="text/javascript">
        $(document).ready(function () {
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
                                statusCode: {
                                    403: function () {
                                        swal("Failed", "Permission denied.", "error");
                                        return false;
                                    }
                                },
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_session">Suggestions</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_suggestion_form" method="post" action="{{url('suggestions/create')}}">
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
                        <div class="row mt-2">
                            <label for="optassets" class="col-12 text-xs control-label">Select Opt Assets</label>
                            <div class="form-check col-12">
                                <select class="form-control" id="optassets" name="optassets[]" multiple
                                        style="width: 100%;font-size: 10px">

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 text-right">
                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#assets').select2({
            placeholder: 'Select an option'
        });
        $('#optassets').select2({
            placeholder: 'Select optional assets'
        });
        $("select").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
    </script>

@endsection