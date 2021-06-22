

<div class="modal fade" id="assign-lab-task" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-x-circle"></i> Assign Lab Task</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="assign_lab_task" method="post">
                        @csrf
                        <input type="hidden" value="" name="id" id="lab_task_id">
                        @php $today=date('Y-m-d',time()); @endphp
                        <div class="form-group row">
                            <label for="start" class="col-12 control-label">Start Date</label>
                            <div class="col-12">
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
                            <label for="end" class="col-12 control-label">End Date</label>
                            <div class="col-12">
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
                            <label for="user" class="col-12 control-label">Select User</label>
                            <div class="col-12">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control select-2-users" id="user" name="user"  style="width: 100%">
                                        <option selected disabled>--Select User</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assets" class="col-12 control-label">Select Assets</label>
                            <div class="col-12">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control select-2-asset" multiple id="assets" name="assets[]" style="width: 100%">
                                        <option disabled>Select Assets</option>
                                        @foreach(\App\Models\Asset::all() as $asset)
                                            <option style="font-size: 11px" value="{{$asset->id}}" {{--{{(in_array($asset->id,$sug)?"selected":"")}}--}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn lab-items-save-btn btn-primary btn-sm float-right"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
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




        $("#assign_lab_task").on('submit', (function (e) {
            e.preventDefault();
            var button = $('.lab-items-save-btn');
            var previous = $('.lab-items-save-btn').html();
            button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
            $.ajax({
                url: '{{route('tasks.store')}}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    button.attr('disabled', null).html(previous);
                    swal('success', data.success, 'success').then((value) => {
                        $('#assign-lab-task').modal('hide');
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

    });
</script>


{{--<div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
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
                            <input class="form-control " type="hidden" id="capability" name="capability" placeholder="capability" value="{{\App\Models\Capabilities::find($job->item->capability)->id}}" autocomplete="off"/>
                            <input class="form-control " placeholder="capability" value="{{\App\Models\Capabilities::find($job->item->capability)->name}}" autocomplete="off" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <label for="capability" class="col-12 text-xs control-label">Select Parameter</label>
                        <div class="form-check form-check-inline" style="width: 100%">
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
</div>--}}

<script>
    /*$('#assets').select2({
        placeholder: 'Select Assets'
    });
    $('#optassets').select2({
        placeholder: 'Select optional assets'
    });
*/
    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
</script>
