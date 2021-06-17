<div class="modal fade" id="add_capabilities" tabindex="-1" role="dialog" aria-labelledby="addCapabilityModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="addCapabilityModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Capabilities</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_capabilities_form" class="form-horizontal row">
                    @csrf
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_name" class="control-label">Enter Name of Capability</label>
                        <input type="text" class="form-control" id="add_name" name="add_name" placeholder="Enter Name of Capability">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_parameter" class="control-label">Parameter</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-capability" style="width: 100%" id="add_parameter" name="add_parameter">
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 p-1 m-0">
                        <label for="add_procedure" class=" control-label">Procedure</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-procedure" style="width: 100%" id="add_procedure" name="add_procedure">
                                @foreach($procedures as $procedure)
                                    <option value="{{$procedure->id}}">{{$procedure->name}}-{{$procedure->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_min_range" class=" control-label">Min Range</label>
                        <input type="text" class="form-control" id="add_min_range" name="add_min_range" placeholder="Min Range" autocomplete="off"  value="0">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_max_range" class=" control-label">Max Range</label>
                        <input type="text" class="form-control" id="add_max_range" name="add_max_range" placeholder="Max Range" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_acc_min_range" class=" control-label">Accredited Min Range</label>
                        <input type="text" class="form-control" id="add_acc_min_range" name="add_acc_min_range" placeholder="Accredited Min Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_acc_max_range" class=" control-label">Accredited Max Range</label>
                        <input type="text" class="form-control" id="add_acc_max_range" name="add_acc_max_range" placeholder="Accredited Max Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_calculator" class=" control-label">Calculator</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="add_calculator" name="add_calculator">
                                @foreach($calculators as $calculator)
                                    <option value="{{$calculator->slug}}">{{$calculator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_unit" class=" control-label">Unit</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="add_unit" name="add_unit">
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_accuracy" class=" control-label">Accuracy</label>
                        <input type="text" class="form-control" id="add_accuracy" name="add_accuracy" placeholder="Accuracy">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_price" class=" control-label">Price</label>
                        <input type="text" class="form-control" id="add_price" name="add_price" placeholder="Price">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_remarks" class=" control-label">Remarks</label>
                        <input type="text" class="form-control" id="add_remarks" name="add_remarks" placeholder="Remarks">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_location" class=" control-label">Location</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="add_location" name="add_location">
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    {{--<div class="col-6 p-1 m-0 form-check">
                        <div class="checkbox float-right checkbox-fill d-inline">
                            <input type="checkbox" name="add_accredited" id="add_accredited">
                            <label class="cr" for="add_accredited">Accredited</label>
                        </div>
                    </div>
                    --}}
                    <div class="form-group col-6 p-1 m-0">
                        <label for="add_accredited" class=" control-label">Accredited</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="add_accredited" name="add_accredited">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn cap-save-btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {

        $(".select-2-capability").select2();
        $(".select-2-procedure").select2();

        $("#add_capabilities_form").on('submit',(function(e) {
            var button=$('.cap-save-btn');
            var previous=$('.cap-save-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            e.preventDefault();
            $.ajax({
                url: "{{route('capabilities.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                statusCode: {
                    401: function () {
                        swal("Failed", "This unit is not under this parameter", "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_capabilities').modal('hide');
                        $("#example").DataTable().ajax.reload(null,false);
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

        $('select[name="add_parameter"]').on('change', function() {
            var parameter = $('#add_parameter').val();
            if(parameter) {
                $.ajax({
                    url: '/units/fetch/previous_units/'+parameter,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#add_unit').empty();
                        $.each(data['previous'], function(key, value) {
                            $('#add_unit').append('<option value="'+value.id+'">'+ value.unit +'</option>');
                        });
                    }
                });
            }
            else{
                $('#add_unit').empty();
                $('#add_unit').append('<option disabled selected>--Select Unit</option>');
            }
        });
        $(document).on('click','.add-capability-modal',function (e) {
            e.preventDefault();
            $('#add_name').val('');
            $('#add_parameter').prepend('<option disabled selected>--Select Parameter</option>');
            $('#add_procedure').prepend('<option disabled selected>--Select Procedure</option>');
            $('#add_min_range').val('');
            $('#add_acc_min_range').val('');
            $('#add_max_range').val('');
            $('#add_acc_max_range').val('');

            $('#add_calculator').prepend('<option disabled selected>--Select Calculator</option>');
            $('#add_unit').empty();
            $('#add_unit').append('<option disabled selected>--Select Unit</option>');
            $('#add_accuracy').val('');
            $('#add_price').val('');
            $('#add_remarks').val('');
            $('#add_location').prepend('<option disabled selected>--Select Location</option>');
            $('#add_accredited').prepend('<option selected disabled>--Select Accredited</option>');


            $('#add_capabilities_form')[0].reset();
            $('#add_capabilities').modal('show');
        });
    });
</script>