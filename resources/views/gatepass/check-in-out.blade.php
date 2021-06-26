
<script>
    $(document).ready(function() {
        $('#gp_items').select2({
            placeholder: 'Select Assets'
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
                            '<option value="'+v.id+'">'+v.name+'-'+v.code+'</option> '
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
                url: "{{route('gp.store')}}",
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
