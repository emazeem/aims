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
                        $("#example").DataTable().ajax.reload(null, false);
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
                    url: '{{url('capabilities/respective-assets')}}/' + parameter,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="assets[]"]').empty();
                        $.each(data, function (index, value) {
                            $('select[name="assets[]"]').append('<option value="' + value.id + '">' + value.code + '-' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="assets[]"]').empty();
            }
        });
        $(document).on('click', '.delete-suggestions', function (e) {
            swal({
                title: "Are you sure to delete this suggestion?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        e.preventDefault();
                        var id = $(this).attr('data-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#suggestionform"+id).attr("method");
                        var form_data = $("#suggestionform" + id).serialize();
                        $.ajax({
                            url: "{{route('suggestions.delete')}}/",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            success: function (data) {

                                swal('success', data.success, 'success').then((value) => {
                                    $("#example").DataTable().ajax.reload(null, false);
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
                <h5 class="modal-title font-weight-light" id="edit_session"><i class="feather icon-plus-circle"></i>
                    Suggestions</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_suggestion_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <input class="form-control" type="hidden" id="suggestion_capability" name="capability">
                            <input class="form-control" type="hidden" id="suggestion_parameter" name="parameter">
                        </div>
                    </div>
                    <div class="row">
                        <label for="suggestion_capability_value" class="col-12 text-xs control-label">Capability</label>
                        <div class="form-group col-12">
                            <input class="form-control" type="text" id="suggestion_capability_value" name="suggestion_capability_value" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="suggestion_assets" class="col-12 text-xs control-label">Select Assets</label>
                        <div class="form-check col-12" style="width: 100%">
                            <select class="form-control opt-assets-select-2" style="width: 100%" multiple id="suggestion_assets" name="assets[]">

                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer p-2">
                <div class="col-12 text-right">
                    <button class="btn btn-primary btn-sm suggestion-save-btn" type="submit"><i
                                class="feather icon-save"></i> Save
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
