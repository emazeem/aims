
<script>
    $(document).ready(function() {
        $('#gp_items').select2({
            placeholder: 'Select Assets'
        });
        $(document).on('click', '.gp-item-receive', function() {
            var id = $(this).attr('data-id');
            $('#gp_id').val(id);
            $('#gp-items-receiving').modal('show');
        });
        $(document).on('click', '.add-gate-pass', function() {
            var id = $(this).attr('data-id');
            $('#plan_id').val(id);
            $.ajax({
                "url": "{{route('gp.get.items')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                success: function(data)
                {
                    $('#add-gate-pass').modal('show');
                    $('#handed_over_to').empty();
                    $('#gp_items').empty();
                        $.each(data['assets'],function (i,v) {
                       $('#gp_items').append(
                            '<option value="'+v.id+'" selected>'+v.name+'-'+v.code+'</option> '
                       );
                    });
                    $.each(data['users'],function (i,v) {
                       $('#handed_over_to').append(
                            '<option value="'+v.id+'">'+v.fname+'-'+v.lname+'</option> '
                       );
                    });

                }
            });
        });
        $("#add-gate-pass-form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.add-gate-pass-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('gp.store.out')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add-gate-pass').modal('hide');
                        location.reload();
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

        $("#gp-items-receiving-form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.gp-receiving-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('gp.store.in')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#gp-items-receiving').modal('hide');
                        location.reload();
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
<div class="modal fade" id="add-gate-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Generate Gate Pass</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add-gate-pass-form">
                    @csrf
                    <input type="hidden" id="plan_id" name="plan_id">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="handed_over_to">Handed Over To</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="handed_over_to" name="handed_over_to">
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <label for="gp_items">Gate Pass Items</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="gp_items" multiple  style="width: 100%" name="gp_items[]">
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="date_out">Date OUT</label>
                            <input type="date" class="form-control" id="date_out" name="date_out">
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="time_out">Time OUT</label>
                            <input type="time" class="form-control" id="time_out" name="time_out">
                        </div>
                    </div>

            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-primary add-gate-pass-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="gp-items-receiving" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-chevron-down"></i> Gate Pass Receiving Back</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="gp-items-receiving-form">
                    @csrf
                    <input type="hidden" value="" name="gp_id" id="gp_id">
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <label for="date_in">Date IN</label>
                            <input type="date" class="form-control" id="date_in" name="date_in" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="time_in">Time IN</label>
                            <input type="time" class="form-control" id="time_in" name="time_in">
                        </div>
                    </div>

            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-primary gp-receiving-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
