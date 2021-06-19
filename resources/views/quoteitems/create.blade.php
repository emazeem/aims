@if(Session::has('success'))
    <script>
        $(document).ready(function () {
            swal("Done!", '{{Session('success')}}', "success");
        });
    </script>
@endif
<style>
    .alert{
        border-radius: 0;
        padding-bottom: 0;
    }
</style>
<script type="text/javascript">
    'use strict';
    $(document).ready(function () {
        $(".select-2-capability").select2();
        $(".select-2-parameter").select2();
        $(".select-2-unit").select2();

        $('select[name="single_capability"]').append('<option disabled selected>--Select Capability</option>');

        $('.check-accreditation').on('click', function () {
            var min = $('#single_min_range').val();
            var max = $('#single_max_range').val();
            var cap = $('#single_capability').val();
            if (!min) {
                alert('Please Enter Min Range');
            } else if (!max) {
                alert('Please Enter Max Range');
            } else if (!cap) {
                alert('Please Select Capability');
            }
            else {
                $.ajax({
                    url: '/items/compare-ranges/' + min + '/' + max + '/' + cap,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.success){
                            swal('Success', data.success, 'success');
                        }else {
                            swal('Failed!', data.error, 'error');
                        }
                    },
                    error: function (data) {
                    },

                });
            }
        });

        $('select[name="single_parameter"]').on('change', function () {
            $('#single_price').val('');
            $('#single_range').val('');
            $('.accredit-div').empty();
            var parameter = $(this).val();
            if (parameter) {
                $.ajax({
                    url: '/items/select-capabilities/' + parameter,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="single_capability"]').empty();

                        $('select[name="single_capability"]').append('<option disabled selected>--Select Capability</option>');
                        $.each(data['capabilities'], function (key, value) {
                            $('select[name="single_capability"]').append('<option value="' + value.id + '">' + value.name +' > '+ value.max_range + '</option>');
                        });
                        $('select[name="single_unit"]').empty();

                        $('select[name="single_unit"]').append('<option disabled selected>--Select Unit of Measure</option>');
                        $.each(data['unit'], function (key, value) {
                            $('select[name="single_unit"]').append('<option value="' + value + '">' + key + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="single_capability"]').empty();
                $('select[name="single_unit"]').empty();
            }
        });
        $('select[name="single_capability"]').on('change', function () {
            var capability = $(this).val();

            if (capability) {

                $.ajax({
                    url: '/items/select-price/' + capability,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#single_price').val(data.price);
                        $('#single_min_range').val(data.min_range);
                        $('#single_max_range').val(data.max_range);
                        $('#single_location').val(data.location);
                        $('#single_accredited').val(data.accredited);
                        $('#single_unit').val(data.unit).trigger('change');
                        if (data.accredited == 'yes') {
                            $('.accredit-div').empty();
                            $('.accredit-div').append(
                                '<label class="control-label col-12 text-info">Accredit Range is ' + data.accredited_min_range + '~' + data.accredited_max_range + ' ' + data['unit_name'] + ' </label>'
                            );
                        } else {
                            $('.accredit-div').empty();
                        }
                    }
                });
            } else {
                $('select[name="single_capability"]').empty();
            }
        });

        $("#add-items").on('submit', (function (e) {
            e.preventDefault();
            var button = $('.items-save-btn');
            var previous = $('.items-save-btn').html();
            button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            $.ajax({
                url: "{{route('items.store')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    button.attr('disabled', null).html(previous);
                    swal('success', data.success, 'success').then((value) => {
                        InitTable();
                        $('#edit_item_id').val('');
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
        $("#edit-items").on('submit', (function (e) {
            e.preventDefault();
            var button = $('.items-save-btn');
            var previous = $('.items-save-btn').html();
            button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            $.ajax({
                url: "{{route('items.update')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    button.attr('disabled', null).html(previous);
                    swal('success', data.success, 'success').then((value) => {
                        InitTable();
                        $('#edit_item_id').val('');
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


        $(document).on('click', '.edit', function (e) {
            e.preventDefault();
            $('#add-items').fadeOut();
            $('#edit-items').fadeIn();
            $('#show-add-items-card').fadeIn();
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('/items/edit')}}",
                type: "POST",
                data: {'id': id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {



                    $('#single_edit_capability').empty();
                    $('#single_edit_unit').empty();

                    $('#single_edit_capability').append('<option disabled selected>--Select Capability</option>');
                    $.each(data['capabilities'], function (key, value) {
                        $('#single_edit_capability').append('<option value="' + value.id + '">' + value.name +' > '+ value.max_range + '</option>');
                    });

                    $('#single_edit_unit').append('<option disabled selected>--Select Unit of Measure</option>');
                    $.each(data['units'], function (key, value) {

                        $('#single_edit_unit').append('<option value="' + value.id + '" selected>' + value.unit +'</option>');
                    });
                    $('#edit_single_item_id').val(data.id);
                    $('#single_edit_parameter').val(data.parameter);

                    //$('#single_edit_capability').val(data.capability);
                    $("#single_edit_capability option[value="+data.capability+"]").attr('selected', 'selected');


                    $('#single_edit_unit').val(data.unit);
                    $('#single_edit_capability').val(data.capability);

                    $('#single_edit_min_range').val(data['min_range']);
                    $('#single_edit_max_range').val(data['max_range']);
                    $('#single_edit_price').val(data.price);
                    $('#single_edit_location').val(data.location);
                    $('#single_edit_accredited').val(data.accredited);
                    $('#single_edit_quantity').val(data.quantity);
                },
            });
        });
        $(document).on('click','#show-add-items-card',function () {
            $('#show-add-items-card').fadeOut();
            $('#edit-items').fadeOut();
            $('#add-items').fadeIn();
        });
    });

</script>

<hr>
<h5 id="show-add-items-card" style="display: none;cursor: pointer">Show Add Items Card</h5>
<div class="row bg-white pb-3">
    <div class="my-4 col-12">
        <button class="btn float-right btn-success btn-sm" data-toggle="modal" data-target="#add_nofacility_items">
            <i class="feather icon-plus-circle"></i> Add No Facility Items
        </button>
        <button class="btn float-right btn-danger btn-sm" data-toggle="modal" data-target="#add_na">
            <i class="feather icon-more-horizontal"></i> Not Listed
        </button>
        <button class="btn float-right btn-success btn-sm" data-toggle="modal" data-target="#add_multi">
            <i class="feather icon-plus-circle"></i> Add Multi Parameter
        </button>

    </div>

    <div class="col-12">
        <div class="form-group accredit-div col-12">

        </div>

        <form class="form-horizontal row" id="add-items">
            @csrf
            <div class="col-12 alert alert-info">
                <h3 class="h3 font-weight-light">
                    <i class="feather icon-plus-circle"></i> Add Items
                </h3>
            </div>

            <input type="hidden" value="{{$show->id}}" name="single_quote_id" id="single_quote_id">
            <div class="form-group col-4">
                <label for="single_parameter" class="col-12 control-label">Parameter</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="select-2-parameter form-control form-control-lg" id="single_parameter" name="single_parameter">
                            <option selected disabled>--Select Parameter</option>
                            @foreach($parameters as $parameter)
                                <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group col-4">
                <label for="single_capability" class="col-12 control-label">Capability </label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control select-2-capability" style="width: 100%" id="single_capability" name="single_capability">
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group col-4">
                <label for="single_unit" class="col-12 control-label">Unit</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control select-2-unit" id="single_unit" name="single_unit">
                            <option selected disabled>--Select Unit of Measure</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group  col-6">
                <label for="single_min_range" class="col-12 control-label">Min. Range</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_min_range" name="single_range[]" placeholder="Min Range"
                           autocomplete="off">
                </div>
            </div>
            <div class="form-group  col-6">
                <label for="single_max_range" class="col-12 control-label">Max. Range</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_max_range" name="single_range[]" placeholder="Max Range">
                </div>
            </div>
            <div class="col-12 text-right">
                <p class="check-accreditation" style="cursor: pointer">Compare Ranges</p>
            </div>
            <div class="form-group  col-3">
                <label for="single_price" class="col-12 control-label">Price</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_price" name="single_price" placeholder="Price">
                </div>
            </div>
            <div class="form-group col-3">
                <label for="single_location" class="col-12 control-label">Location</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="single_location" name="single_location">
                            <option selected disabled>--Select Location</option>
                            <option value="site">site</option>
                            <option value="lab">lab</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="single_accredited" class="col-12 control-label">Accredited</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="single_accredited" name="single_accredited">
                            <option selected disabled>--Select for Accredited</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group col-3">
                <label for="single_quantity" class="col-12 control-label">Quantity</label>
                <div class="col-12">
                    <input type="text" class="form-control text-right" id="single_quantity" name="single_quantity"
                           placeholder="Quantity" value="1">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm float-right items-save-btn"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
        <form class="form-horizontal row" id="edit-items" style="display: none">
            <div class="col-12 alert alert-info">
               <h3 class="h3 font-weight-light">
                   <i class="feather icon-refresh-cw"></i> Update Items
               </h3>
            </div>

            @csrf

            <input type="hidden" value="" name="edit_single_item_id" id="edit_single_item_id">
            <input type="hidden" value="{{$show->id}}" name="single_quote_id" id="single_quote_id">

            <div class="form-group col-4">
                <label for="single_edit_parameter" class="col-12 control-label">Parameter </label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" style="width: 100%" id="single_edit_parameter" name="single_edit_parameter">
                            <option selected disabled>--Select Parameter</option>
                            @foreach($parameters as $parameter)
                                <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-4">
                <label for="single_edit_capability" class="col-12 control-label">Capability </label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" style="width: 100%" id="single_edit_capability" name="single_edit_capability">
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group col-4">
                <label for="single_edit_unit" class="col-12 control-label">Unit</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="single_edit_unit" name="single_edit_unit">
                            <option selected disabled>--Select Unit of Measure</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group  col-6">
                <label for="single_edit_min_range" class="col-12 control-label">Min. Range</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_edit_min_range" name="single_edit_range[]" placeholder="Min Range"
                           autocomplete="off">
                </div>
            </div>
            <div class="form-group  col-6">
                <label for="single_edit_max_range" class="col-12 control-label">Max. Range</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_edit_max_range" name="single_edit_range[]" placeholder="Max Range">
                </div>
            </div>
            <div class="col-12 text-right">
                <p class="check-accreditation" style="cursor: pointer">Compare Ranges</p>
            </div>
            <div class="form-group  col-3">
                <label for="single_edit_price" class="col-12 control-label">Price</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="single_edit_price" name="single_edit_price" placeholder="Price">
                </div>
            </div>
            <div class="form-group col-3">
                <label for="single_edit_location" class="col-12 control-label">Location</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="single_edit_location" name="single_edit_location">
                            <option selected disabled>--Select Location</option>
                            <option value="site">site</option>
                            <option value="lab">lab</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="single_edit_accredited" class="col-12 control-label">Accredited</label>
                <div class="col-12">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="single_edit_accredited" name="single_edit_accredited">
                            <option selected disabled>--Select for Accredited</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group col-3">
                <label for="single_edit_quantity" class="col-12 control-label">Quantity</label>
                <div class="col-12">
                    <input type="text" class="form-control text-right" id="single_edit_quantity" name="single_edit_quantity"
                           placeholder="Quantity" value="1">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm float-right items-save-btn"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

