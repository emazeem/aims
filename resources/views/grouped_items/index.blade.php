<script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#add_multi_parameter_form").on('submit',(function(e) {

            var button=$('.multi-add-btn');
            var previous=$('.mutli-add-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            e.preventDefault();
            $.ajax({
                url: "{{route('items.store_multi')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    $('#add_multi_parameter_form').modal('hide');
                    swal('success', data.success, 'success').then((value) => {
                        InitTable();
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
        $("#edit_multi_parameter_form").on('submit',(function(e) {

            var button=$('.multi-edit-btn');
            var previous=$('.multi-edit-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            e.preventDefault();
            $.ajax({
                url: "{{route('items.update_multi')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    $('#edit_multi_parameter_form').modal('hide');
                    swal('success', data.success, 'success').then((value) => {
                        InitTable();
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

        $('select[id="multi-capability"]').on('change', function () {
            var multicapability = $(this).val();
            if (multicapability) {

                $.ajax({
                    url: '/items/select-multi-detail/' + multicapability,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#multi-price').val(data['price']);
                        $('#multi-location').val(data['location']);
                        $('#multi-accredited').val(data['accredited']);
                        $('#multi-quantity').val(1);

                    }
                });
            } else {
                $('select[name="capability"]').empty();
            }
        });
        $('select[id="edit-multi-capability"]').on('change', function () {
            var multicapability = $(this).val();
            if (multicapability) {

                $.ajax({
                    url: '/items/select-multi-detail/' + multicapability,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#edit-multi-price').val(data['price']);
                        $('#edit-multi-location').val(data['location']);
                        $('#edit-multi-accredited').val(data['accredited']);
                        $('#edit-multi-quantity').val(1);

                    }
                });
            } else {

            }
        });

    });
</script>

<div class="modal fade" id="add_multi" tabindex="-1" role="dialog" aria-labelledby="add_multi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="add_multi"><i class="feather icon-plus-circle"></i> Add Multi Parameter Items</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_multi_parameter_form">
                    @csrf

                    <input type="hidden" value="{{$show->id}}" name="quote_id">
                    <input type="hidden" value="14" name="parameter">
                    <div class="row">
                        <div class="col-12">
                            <label for="multi-capability" class="control-label">Grouped Capability</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control " id="multi-capability" name="capability">
                                    @foreach(\App\Models\Capabilities::all()->where('is_group',1) as $capability)
                                        <option value="{{$capability->id}}">{{$capability->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <label for="price" class="control-label">Price</label>
                            <input type="text" class="form-control" id="multi-price" name="price" placeholder="Price"
                                   autocomplete="off" value="{{old('price')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="multi-location" class="control-label">Location</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="multi-location" name="location">
                                    <option selected disabled>--Select Location</option>
                                    <option value="site">site</option>
                                    <option value="lab">lab</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-12">
                            <label for="multi-accredited" class="control-label">Accredited</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="multi-accredited" name="accredited">
                                    <option selected disabled>--Select for Accredited</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-12">
                            <label for="quantity">Qty</label>
                            <input type="number" class="form-control" id="multi-quantity" name="quantity" placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-0 p-2">
                <button class="btn btn-primary btn-sm multi-add-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_multi" tabindex="-1" role="dialog" aria-labelledby="add_multi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="add_multi"><i class="feather icon-edit"></i> Edit Multi Parameter Items</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_multi_parameter_form">
                    @csrf

                    <input type="hidden" value="" name="edit_multi_id" id="edit_multi_id">
                    <div class="row">
                        <div class="col-12">
                            <label for="multi-capability" class="control-label">Grouped Capability</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control " id="edit-multi-capability" name="capability">
                                    @foreach(\App\Models\Capabilities::all()->where('is_group',1) as $capability)
                                        <option value="{{$capability->id}}">{{$capability->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <label for="price" class="control-label">Price</label>
                            <input type="text" class="form-control" id="edit-multi-price" name="price" placeholder="Price"
                                   autocomplete="off" value="{{old('price')}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="multi-location" class="control-label">Location</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit-multi-location" name="location">
                                    <option selected disabled>--Select Location</option>
                                    <option value="site">site</option>
                                    <option value="lab">lab</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-12">
                            <label for="multi-accredited" class="control-label">Accredited</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit-multi-accredited" name="accredited">
                                    <option selected disabled>--Select for Accredited</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-12">
                            <label for="quantity">Qty</label>
                            <input type="number" class="form-control" id="edit-multi-quantity" name="quantity" placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-0 p-2">
                <button class="btn btn-primary btn-sm multi-edit-btn" type="submit"><i class="fa fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

