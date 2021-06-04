
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif

    <script type="text/javascript">

        $(document).ready(function() {

            $('select[name="capability"]').append('<option disabled selected>--Select Capability</option>');

            $('select[name="parameter"]').on('change', function() {
                $('#price').val('');
                $('#range').val('');
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

                            $('select[name="unit"]').append('<option disabled selected>--Select Unit</option>');
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
                            $('#range').val(data.range);
                            $('#location').val(data.location);
                            $('#accredited').val(data.accredited);
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
        <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
            <h3 class="pull-left pb-1"><i class="fa fa-plus-circle"></i> Add Items</h3>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_na">
                <i class="fa fa-times"></i> Not Listed
            </button>

        </div>
        <div class="col-12">

            <form class="form-horizontal row" id="add-items">
                @csrf
                <input type="hidden" value="{{$show->id}}" name="quote_id" id="id">
                <input type="hidden" value="" name="edit_id" id="edit_item_id">
                <div class="form-group col-6">
                    <label for="parameter" class="col-12 control-label">Parameter</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control " id="parameter" name="parameter">
                                <option selected disabled>--Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="capability" class="col-12 control-label">Capability </label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="capability" name="capability">

                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group  col-6">
                    <label for="range" class="col-12 control-label">Range</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="{{old('range')}}">

                    </div>
                </div>
                <div class="form-group  col-6">
                    <label for="price" class="col-12 control-label">Price</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                    </div>
                </div>
                <div class="form-group col-6">
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
                <div class="form-group col-6">
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
                <div class="form-group col-6">
                    <label for="unit" class="col-12 control-label">Unit</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="unit" name="unit">
                                <option selected disabled>--Select Unit of measure</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="quantity" class="col-12 control-label">Quantity</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" autocomplete="off" value="{{old('quantity',1)}}">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm float-right items-save-btn"><i class="fa fa-save"></i> Save</button>
                </div>

            </form>
        </div>
    </div>

