
<div class="modal fade" id="edit_capabilities_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-refresh-cw"></i> Update Capabilities</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_capabilities_form" class="form-horizontal row">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_name" class=" control-label">Enter Name of Capability</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Name">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_parameter" class=" control-label">Parameter</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-parameter-edit" id="edit_parameter" style="width: 100%" name="edit_parameter">
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 p-1 m-0">
                        <label for="edit_procedure" class=" control-label">Procedure</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-procedure-edit"  style="width: 100%" id="edit_procedure" name="edit_procedure">
                                @foreach($procedures as $procedure)
                                    <option value="{{$procedure->id}}">{{$procedure->name}}-{{$procedure->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_min_range" class=" control-label">Min Range</label>
                        <input type="text" class="form-control" id="edit_min_range" name="edit_min_range" placeholder="Min Range"  value="0">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_max_range" class=" control-label">Max Range</label>
                        <input type="text" class="form-control" id="edit_max_range" name="edit_max_range" placeholder="Max Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_acc_min_range" class=" control-label">Accredited Min Range</label>
                        <input type="text" class="form-control" id="edit_acc_min_range" name="edit_acc_min_range" placeholder="Accredited Min Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_acc_max_range" class=" control-label">Accredited Max Range</label>
                        <input type="text" class="form-control" id="edit_acc_max_range" name="edit_acc_max_range" placeholder="Accredited Max Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_calculator" class=" control-label">Calculator</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="edit_calculator" name="edit_calculator">
                                <option selected disabled>Select Calculator</option>
                                @foreach($calculators as $calculator)
                                    <option value="{{$calculator->slug}}">{{$calculator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_unit" class=" control-label">Unit</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="edit_unit" name="edit_unit">

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_accuracy" class=" control-label">Accuracy</label>
                        <input type="text" class="form-control" id="edit_accuracy" name="edit_accuracy" placeholder="Accuracy" autocomplete="off">
                    </div>
                    <div class="form-group  col-6 p-1 m-0">
                        <label for="edit_price" class=" control-label">Price</label>
                        <input type="text" class="form-control" id="edit_price" name="edit_price" placeholder="Price" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_remarks" class=" control-label">Remarks</label>
                        <input type="text" class="form-control" id="edit_remarks" name="edit_remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="edit_location" class=" control-label">Location</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="edit_location" name="edit_location">
                                <option selected disabled>Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-6 p-1 m-0 form-check">
                        <div class="checkbox float-right checkbox-fill d-inline">
                            <input type="checkbox" name="edit_accredited" id="edit_accredited">
                            <label class="cr" for="edit_accredited">Accredited</label>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn cap-update-btn btn-primary"><i class="feather icon-refresh-cw"></i> Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.edit', function() {
            $('#edit_name').val('');
            $('#edit_parameter').prepend('<option disabled selected>--Select Parameter</option>');
            $('#edit_procedure').prepend('<option disabled selected>--Select Procedure</option>');
            $('#edit_min_range').val('');
            $('#edit_acc_min_range').val('');
            $('#edit_max_range').val('');
            $('#edit_acc_max_range').val('');
            $('#edit_calculator').prepend('<option disabled selected>--Select Calculator</option>');
            $('#edit_unit').empty();
            $('#edit_unit').append('<option disabled selected>--Select Unit</option>');
            $('#edit_accuracy').val('');
            $('#edit_price').val('');
            $('#edit_remarks').val('');
            $('#edit_location').prepend('<option disabled selected>--Select Location</option>');
            $('#edit_accredited').val('');
            $('#edit_accredited').prop('checked', false);
            $('#edit_capabilities_form')[0].reset();

            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('capabilities/edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                success: function(data)
                {
                    $.each(data['units'], function(key, value) {
                        $('#edit_unit').append('<option value="'+value.id+'" >'+ value.unit +'</option>');
                    });
                    $('#edit_capabilities_modal').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    //$('#edit_parameter').val(data.parameter).trigger('change');
                    $('#edit_parameter').find("option[value='"+data.parameter+"']").attr("selected","selected");
                    $('#edit_procedure').val(data.procedure).trigger('change');
                    $('#edit_min_range').val(data.min_range);
                    $('#edit_acc_min_range').val(data.accredited_min_range);
                    $('#edit_max_range').val(data.max_range);
                    $('#edit_acc_max_range').val(data.accredited_max_range);
                    $('#edit_accuracy').val(data.accuracy);
                    $('#edit_calculator').val(data.calculator);
                    $('#edit_price').val(data.price);
                    $('#edit_remarks').val(data.remarks);
                    $('#edit_location').val(data.location);
                    if(data.accredited=='yes'){
                        $("#edit_accredited").prop('checked', true);
                    }else {
                        $("#edit_accredited").prop('checked', false);
                    }
                    $('#edit_unit').empty();
                    $('#edit_unit').append('<option disabled selected>--Select Units</option>');
                    $.each(data['units'], function(key, value) {
                        $('#edit_unit').append('<option value="'+value.id+'">'+ value.unit +'</option>');
                    });

                    //$(".select-2-parameter-edit").select2();
                    $(".select-2-procedure-edit").select2();
                    $('#edit_unit').val(data.unit).trigger('change');
                    //Populating Form Data to Edit Ends
                },
            });
        });
        $("#edit_capabilities_form").on('submit',(function(e) {
            var button=$('.cap-update-btn');
            var previous=$('.cap-update-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            e.preventDefault();
            $.ajax({
                url: "{{route('capabilities.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#edit_capabilities_modal').modal('hide');
                        $("#example").DataTable().ajax.reload(null,false);
                        //InitTable();
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
        $('#edit_parameter').on('change', function() {
            var parameter = $(this).val();
            if(parameter) {
                $.ajax({
                    url: '/units/fetch/previous_units/'+parameter,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#edit_unit').empty();
                        $('#edit_unit').append('<option disabled selected>--Select Units</option>');
                        $.each(data['previous'], function(key, value) {
                            $('#edit_unit').append('<option value="'+value.id+'">'+ value.unit +'</option>');
                        });
                    }
                });
            }
            else{
                $('#edit_unit').empty();
                $('#edit_unit').append('<option disabled selected>--Select Unit</option>');
            }
        });
    });
</script>
