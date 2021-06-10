
<div class="modal fade" id="edit_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="hidden" value="" id="editid" name="id">
                    <div class="form-group col-6 p-1 m-0">
                        <label for="editname" class=" control-label">Name</label>
                        <input type="text" class="form-control" id="editname" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="category" class=" control-label">Parameter</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-parameter" id="editparameter" style="width: 100%" name="category">
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 p-1 m-0">
                        <label for="procedure" class=" control-label">Procedure</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-procedure"  style="width: 100%" id="editprocedure" name="procedure">
                                @foreach($procedures as $procedure)
                                    <option value="{{$procedure->id}}">{{$procedure->name}}-{{$procedure->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6 p-1 m-0">
                        <label for="min_range" class=" control-label">Min Range</label>
                        <input type="text" class="form-control" id="edit_min_range" name="min_range" placeholder="Min Range" autocomplete="off"  value="0">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="max_range" class=" control-label">Max Range</label>
                        <input type="text" class="form-control" id="edit_max_range" name="max_range" placeholder="Max Range" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="acc_min_range" class=" control-label">Accredited Min Range</label>
                        <input type="text" class="form-control" id="edit_acc_min_range" name="acc_min_range" placeholder="Accredited Min Range" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="acc_max_range" class=" control-label">Accredited Max Range</label>
                        <input type="text" class="form-control" id="edit_acc_max_range" name="acc_max_range" placeholder="Accredited Max Range" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="calculator" class=" control-label">Calculator</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="editcalculator" name="calculator">
                                <option selected disabled>Select Calculator</option>
                                @foreach($calculators as $calculator)
                                    <option value="{{$calculator->slug}}">{{$calculator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6 p-1 m-0">
                        <label for="unit" class=" control-label">Unit</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="editunit" name="unit">

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="accuracy" class=" control-label">Accuracy</label>
                        <input type="text" class="form-control" id="editaccuracy" name="accuracy" placeholder="Accuracy" autocomplete="off">
                    </div>
                    <div class="form-group  col-6 p-1 m-0">
                        <label for="price" class=" control-label">Price</label>
                        <input type="text" class="form-control" id="editprice" name="price" placeholder="Price" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="remarks" class=" control-label">Remarks</label>
                        <input type="text" class="form-control" id="editremarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="location" class=" control-label">Location</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="editlocation" name="location">
                                <option selected disabled>Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-6 p-1 m-0 form-check">
                        <div class="checkbox float-right checkbox-fill d-inline">
                            <input type="checkbox" name="accredited" value="" id="editaccredited">
                            <label class="cr" for="editaccredited">Accredited</label>
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
        $(".select-2-parameter").select2();
        $(".select-2-procedure").select2();
        $('#editparameter').on('change', function() {
            var parameter = $(this).val();
            if(parameter) {
                $.ajax({
                    url: '/units/fetch/previous_units/'+parameter,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#editunit').empty();
                        $('#editunit').append('<option disabled >--Select Units</option>');
                        $.each(data['previous'], function(key, value) {
                            $('#editunit').append('<option value="'+value.id+'">'+ value.unit +'</option>');
                        });
                    }
                });
            }
            else{
                $('#editunit').empty();
                $('#editunit').append('<option disabled selected>--Select Unit</option>');
            }
        });
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{url('/capabilities/edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                statusCode: {
                    403: function() {
                        swal("Failed", "Permission denied for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_capabilities').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);
                    $('#editparameter').val(data.parameter).trigger('change');
                    $('#editprocedure').val(data.procedure).trigger('change');
                    $('#edit_min_range').val(data.min_range);
                    $('#edit_acc_min_range').val(data.accredited_min_range);
                    $('#edit_max_range').val(data.max_range);
                    $('#edit_acc_max_range').val(data.accredited_max_range);

                    $('#editaccuracy').val(data.accuracy);
                    $('#editcalculator').val(data.calculator);
                    $('#editprice').val(data.price);
                    $('#editremarks').val(data.remarks);
                    $('#editlocation').val(data.location);
                    if(data.accredited=='yes'){
                        $("#editaccredited").prop('checked', true);
                    }else {
                        $("#editaccredited").prop('checked', false);
                    }

                    $('#editunit').empty();
                    $('#editunit').append('<option disabled>--Select Units</option>');
                    $.each(data['units'], function(key, value) {
                        var selection = data.unit == value.id ? 'selected' : '';
                        $('#editunit').append('<option value="'+value.id+'" '+selection+'>'+ value.unit +'</option>');
                    });
                    $('#editunit').val(data.unit);
                    //Populating Form Data to Edit Ends
                },
                error: function(){},
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
                        $('#edit_capabilities').modal('hide');
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

    });
</script>
