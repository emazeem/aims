<div class="modal fade" id="add_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Capabilities</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_capabilities_form" class="form-horizontal row">
                    @csrf
                    <div class="form-group col-6 p-1 m-0">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="category" class="control-label">Parameter</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-capability" style="width: 100%" id="category" name="category">
                                <option selected disabled>Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 p-1 m-0">
                        <label for="procedure" class=" control-label">Procedure</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-procedure" style="width: 100%" id="procedure" name="procedure">
                                <option selected disabled>Select Procedure</option>
                                @foreach($procedures as $procedure)
                                    <option value="{{$procedure->id}}">{{$procedure->name}}-{{$procedure->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="min_range" class=" control-label">Min Range</label>
                        <input type="text" class="form-control" id="min_range" name="min_range" placeholder="Min Range" autocomplete="off"  value="0">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="max_range" class=" control-label">Max Range</label>
                        <input type="text" class="form-control" id="max_range" name="max_range" placeholder="Max Range" autocomplete="off">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="acc_min_range" class=" control-label">Accredited Min Range</label>
                        <input type="text" class="form-control" id="acc_min_range" name="acc_min_range" placeholder="Accredited Min Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="acc_max_range" class=" control-label">Accredited Max Range</label>
                        <input type="text" class="form-control" id="acc_max_range" name="acc_max_range" placeholder="Accredited Max Range">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="calculator" class=" control-label">Calculator</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="calculator" name="calculator">
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
                            <select class="form-control" id="unit" name="unit">
                                <option disabled selected>--Select Unit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="accuracy" class=" control-label">Accuracy</label>
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="{{old('accuracy')}}">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="price" class=" control-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="remarks" class=" control-label">Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                    </div>
                    <div class="form-group col-6 p-1 m-0">
                        <label for="location" class=" control-label">Location</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="location" name="location">
                                <option selected disabled>Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-6 p-1 m-0 form-check">
                        <div class="checkbox float-right checkbox-fill d-inline">
                            <input type="checkbox" name="accredited" value="" id="accredited">
                            <label class="cr" for="accredited">Accredited</label>
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
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied" , "error");
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
        $('select[name="category"]').on('change', function() {
            var parameter = $(this).val();
            if(parameter) {
                $.ajax({
                    url: '/units/fetch/previous_units/'+parameter,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#unit').empty();
                        $('#unit').append('<option disabled selected>--Select Unit</option>');
                        $.each(data['previous'], function(key, value) {
                            $('#unit').append('<option value="'+value.id+'">'+ value.unit +'</option>');
                        });
                    }
                });
            }
            else{
                $('#unit').empty();
                $('#unit').append('<option disabled selected>--Select Unit</option>');
            }
        });
    });
</script>