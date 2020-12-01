@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
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



    <div class="row pb-3">
        <div class=" d-sm-flex align-items-center justify-content-between mb-4 col-12">
            <h1 class="h3 mb-0 text-gray-800">Assign Task</h1>
            <a href="" data-toggle="modal" data-target="#add_suggestion" class="pull-right"><i class="fa fa-question"></i> Add Suggestion</a>
        </div>
        <div class="col-12">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Quotes</th>
                    <td>{{$job->jobs->quote_id}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$job->jobs->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Item Description</th>
                    <td>{{\App\Models\Capabilities::find($job->items->capability)->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{\App\Models\Parameter::find($job->items->parameter)->name}}</td>
                </tr>
                <tr>
                    <th>Equipment ID</th>
                    <td>{{$job->eq_id}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$job->model}}</td>
                </tr>
                <tr>
                    <th>Visual Inspection</th>
                    <td>{{$job->visual_inspection}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="border">
        <div class="border">
            <div class="col-12 p-2">

                <form class="form-horizontal" action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$job->id}}" name="id">
                    @php $today=date('Y-m-d',time()); @endphp
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="start"
                                       min="{{$today}}" value="{{old('start')}}" class="form-control">
                            </div>
                            @if ($errors->has('start'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="end"
                                       min="{{$today}}" value="{{old('end')}}" class="form-control">
                            </div>
                            @if ($errors->has('end'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user" class="col-sm-2 control-label">Select User</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="user" name="user">
                                    <option selected disabled>Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('user'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assets" class="col-sm-2 control-label">Select Assets</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" multiple id="assets" name="assets[]">
                                    <option disabled>Select Assets</option>
                                    @foreach($assets as $asset)
                                        <option style="font-size: 11px" value="{{$asset->id}}" {{(in_array($asset->id,$sug)?"selected":"")}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('assets'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('assets') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '{{url('scheduling/tasks/respective-assets')}}/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="optassets[]"]').empty();
                            $.each(data, function(index, value) {
                                $('select[name="optassets[]"]').append('<option value="'+ value.id +'">'+ value.code +'-'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                     $('select[name="optassets[]"]').empty();
                }
            });
        });


    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_session">Suggestions</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_suggestion_form" method="post" action="{{url('scheduling/tasks/add/suggestion')}}">
                        @csrf
                        <input type="hidden" name="jobid" value="{{$job->id}}">
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Capability</label>
                                <div class="form-group col-12">
                                    <input class="form-control " type="hidden" id="capability" name="capability" placeholder="capability" value="{{\App\Models\Capabilities::find($job->items->capability)->id}}" autocomplete="off"/>                                   <input class="form-control " placeholder="capability" value="{{\App\Models\Capabilities::find($job->items->capability)->name}}" autocomplete="off" readonly/>
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
                                <select class="form-control select2" id="optassets" name="optassets[]" multiple style="width: 100%;font-size: 10px" ></select>
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
            placeholder: 'Select/Search Assets'
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
@endsection

