<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Checkout Item</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="item_checkout_form">
                    @csrf
                    <input type="hidden" value="" name="gp_id" id="gp_id_checkout">
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <label for="asset">Asset</label>
                            <input type="text" class="form-control" id="out_asset" name="asset" placeholder="Asset" readonly>
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="out_fcv">Out Function Check Value</label>
                            <input type="text" class="form-control" id="out_fcv" name="out_fcv" placeholder="Out Function Check Value">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="out_status">Out Status</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="out_status" name="out_status">
                                    <option selected disabled="disabled">--Select Out Status</option>
                                    <option value="ok">OK</option>
                                    <option value="not-ok">NOT-OK</option>
                                </select>
                            </div>
                        </div>

                    </div>

            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-primary check-out-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Check-In Item</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="item_checkin_form">
                    @csrf
                    <input type="hidden" value="" name="gp_id" id="gp_id_checkin">
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <label for="asset">Asset</label>
                            <input type="text" class="form-control" id="in_asset" name="asset" placeholder="Asset" readonly>
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="in_fcv">In Function Check Value</label>
                            <input type="text" class="form-control" id="in_fcv" name="in_fcv" placeholder="In Function Check Value">
                        </div>

                        <div class="col-12 mb-1">
                            <label for="in_status">In Status</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="in_status" name="in_status">
                                    <option selected disabled="disabled">--Select In Status</option>
                                    <option value="ok">OK</option>
                                    <option value="not-ok">NOT-OK</option>
                                </select>
                            </div>
                        </div>

                    </div>

            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-primary check-in-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(document).on('click', '.checkout-item', function() {
            var id = $(this).attr('data-id');
            var asset = $(this).attr('data-asset');
            $('#gp_id_checkout').val(id);
            $('#out_asset').val(asset);
            $('#checkout').modal('show');
        });
        $(document).on('click', '.checkin-item', function() {
            var id = $(this).attr('data-id');
            var asset = $(this).attr('data-asset');
            $('#gp_id_checkin').val(id);
            $('#in_asset').val(asset);
            $('#checkin').modal('show');
        });

        $("#item_checkout_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.check-out-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('gp.items.out')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#checkout').modal('hide');
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
        $("#item_checkin_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.check-in-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('gp.items.in')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#checkin').modal('hide');
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
