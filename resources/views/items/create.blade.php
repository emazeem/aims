
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif

    <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            $(".select-2-capability").select2();
            $(".select-2-parameter").select2();
            $(".select-2-unit").select2();
            $('select[name="capability"]').append('<option disabled selected>--Select Capability</option>');
            $('.check-accreditation').on('click', function() {
                var min=$('#min_range').val();
                var max=$('#max_range').val();
                var cap=$('#capability').val();
                if (!min){
                    alert('Please Enter Min Range');
                }else if (!max) {
                    alert('Please Enter Max Range');
                }else if (!cap){
                    alert('Please Select Capability');
                }
                else {
                    $.ajax({
                        url: '/items/compare-ranges/'+min+'/'+max+'/'+cap,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="capability"]').empty();

                            $('select[name="capability"]').append('<option disabled selected>--Select Capability</option>');
                            $.each(data['capabilities'], function(key, value) {
                                $('select[name="capability"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[name="unit"]').empty();

                            $('select[name="unit"]').append('<option disabled selected>--Select Unit of Measure</option>');
                            $.each(data['unit'], function(key, value) {
                                $('select[name="unit"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });

                        }
                    });
                }
            });
            $('select[name="parameter"]').on('change', function() {
                $('#price').val('');
                $('#range').val('');
                $('.accredit-div').empty();
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '/items/select-capabilities/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="capability"]').empty();

                            $('select[name="capability"]').append('<option disabled selected>--Select Capability</option>');
                            $.each(data['capabilities'], function(key, value) {
                                $('select[name="capability"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[name="unit"]').empty();

                            $('select[name="unit"]').append('<option disabled selected>--Select Unit of Measure</option>');
                            $.each(data['unit'], function(key, value) {
                                $('select[name="unit"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });

                        }
                    });
                }else{
                    $('select[name="capability"]').empty();
                }
            });
            $('select[name="capability"]').on('change', function() {
                var capability = $(this).val();

                if(capability) {

                    $.ajax({
                        url: '/items/select-price/'+capability,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#price').val(data.price);
                            $('#min_range').val(data.min_range);
                            $('#max_range').val(data.max_range);
                            $('#location').val(data.location);
                            $('#accredited').val(data.accredited);
                            $('#unit').val(data.unit);
                            if (data.accredited=='yes'){
                                $('.accredit-div').append(
                                    '<label class="control-label col-12 text-info">Accredit Range is '+data.accredited_min_range+'~'+data.accredited_max_range+' '+data['unit_name']+' </label>'
                                );
                            }else {
                                $('.accredit-div').empty();
                            }
                        }
                    });
                }else{
                    $('select[name="capability"]').empty();
                }
            });

            $("#add-items").on('submit',(function(e) {
                e.preventDefault();
                var button=$('.items-save-btn');
                var previous=$('.items-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
                var url='';
                if ($('#edit_item_id').val()){
                    url="{{route('items.update')}}";

                } else {
                    url="{{route('items.store')}}";
                }
                $.ajax({
                    url:url ,
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            InitTable();
                            $('#edit_item_id').val('');
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

    <hr>
    <div class="row bg-white pb-3">
        <div class="my-4 col-12">
            <h3 class="float-left pb-1 font-weight-light"><i class="feather icon-plus-circle"></i> Add Items</h3>
            <button class="btn float-right btn-danger btn-sm" data-toggle="modal" data-target="#add_na">
                <i class="fa fa-times"></i> Not Listed
            </button>

        </div>

        <div class="col-12">

            <form class="form-horizontal row" id="add-items">
                @csrf
                <div class="form-group accredit-div col-12">

                </div>
                <input type="hidden" value="{{$show->id}}" name="quote_id" id="id">
                <input type="hidden" value="" name="edit_id" id="edit_item_id">
                <div class="form-group col-4">
                    <label for="parameter" class="col-12 control-label">Parameter</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="select-2-parameter form-control form-control-lg" id="parameter" name="parameter">
                                <option selected disabled>--Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group col-4">
                    <label for="capability" class="col-12 control-label">Capability </label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-capability" style="width: 100%" id="capability" name="capability">

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="unit" class="col-12 control-label">Unit</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control select-2-unit" id="unit" name="unit">
                                <option selected disabled>--Select Unit of measure</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group  col-6">
                    <label for="range" class="col-12 control-label">Min. Range</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="min_range" name="range[]" placeholder="Min Range" autocomplete="off">
                    </div>
                </div>
                <div class="form-group  col-6">
                    <label for="range" class="col-12 control-label">Max. Range</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="max_range" name="range[]" placeholder="Max Range" autocomplete="off">
                    </div>
                </div>
                <div class="col-12 text-right">
                    <input type="button" class="btn btn-sm check-accreditation" value="Check Accreditation">
                </div>
                <div class="form-group  col-3">
                    <label for="price" class="col-12 control-label">Price</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="location" class="col-12 control-label">Location</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="location" name="location">
                                <option selected disabled>--Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="accredited" class="col-12 control-label">Accredited</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="accredited" name="accredited">
                                <option selected disabled>--Select for Accredited</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group col-3">
                    <label for="quantity" class="col-12 control-label">Quantity</label>
                    <div class="col-12">
                        <input type="text" class="form-control text-right" id="quantity" name="quantity" placeholder="Quantity" autocomplete="off" value="{{old('quantity',1)}}">
                    </div>
                </div>
                <div class="form-group col-12">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm float-right items-save-btn"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

