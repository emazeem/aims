<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('#assets').select2({
        placeholder: 'Select assets'
    });
    $('#user').select2({
        placeholder: 'Select users'
    });
</script>
<script>
    $(document).ready(function () {

        $(document).on('click', '.assign-site', function() {
            var id = $(this).attr('data-id');
            $('#assign_site_job').modal('toggle');
            $('#job_id').val(id);
        });

        $("#assign_site_job_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('tasks.siteassignjobs')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
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
<div class="modal fade" id="assign_site_job" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_session">Assign Site Job</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="assign_site_job_form" method="post">
                    @csrf
                    <input type="hidden" value="" name="id" id="job_id">
                    @php $today=date('Y-m-d',time()); @endphp
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="start"
                                       min="{{$today}}" value="{{old('start')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="end"
                                       min="{{$today}}" value="{{old('end')}}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user" class="col-sm-2 control-label">Select User</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" >
                                <select class="form-control" id="user" name="user[]" multiple style="width: 382px">
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assets" class="col-sm-2 control-label">Select Assets</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" >
                                <select class="form-control" multiple id="assets" name="assets[]" style="width: 385px;">
                                    <option disabled>Select Assets</option>
                                    @foreach(\App\Models\Asset::all() as $asset)
                                        <option value="{{$asset->id}}">{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Save">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>