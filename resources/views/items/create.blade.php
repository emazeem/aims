@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {

            $("#add_na_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('items.store')}}",
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

                        if(!data.errors)
                        {

                            swal("Success", "Added successfully", "success");
                            $('#add_na').modal('hide');
                            location.reload();
                            InitTable();
                        }
                    },
                    error: function()
                    {
                        swal("Failed", "Fields Required. Try again.", "error");
                    }
                });
            }));



            $('select[name="capability"]').append('<option disabled selected>Select Respective Parameter</option>');
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

                            $('select[name="capability"]').append('<option disabled selected>Select Respective Parameter</option>');
                            $.each(data, function(key, value) {
                                $('select[name="capability"]').append('<option value="'+ value +'">'+ key +'</option>');
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
        });
    </script>
    <div class="row pb-3">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
            <h1 class="h3 border-bottom"><i class="fa fa-plus-circle"></i> Add Items</h1>
            <a class="btn btn-danger btn-sm" data-toggle="modal" href="#" data-target="#add_na">
                <i class="fa fa-times"></i> Not Listed
            </a>
        </div>
        <div class="col-12">

            <form class="form-horizontal" action="{{route('items.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group  row">
                    <label for="session" class="col-sm-2 control-label">Quote</label>
                    <div class="col-sm-10">
                        <input type="hidden" value="{{$session->id}}" name="session_id">
                        <input type="text" class="form-control" id="session" name="session" placeholder="" autocomplete="off" value="QTN/{{date('y',strtotime($session->created_at))}}/{{$session->id}}" disabled>
                        @if ($errors->has('session'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('session') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="customer" class="col-sm-2 control-label">Customer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="customer" autocomplete="off" value="{{$session->customers->reg_name}}" disabled>
                        @if ($errors->has('customer'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('customer') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="parameter" name="parameter">
                                <option selected disabled>Select Parameter</option>
                                @foreach($parameters as $parameter)
                                    <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('parameter'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('parameter') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capability" class="col-sm-2 control-label">Capability & Price List</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="capability" name="capability">

                            </select>
                        </div>
                        @if ($errors->has('capability'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('capability') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>


                <div class="form-group  row">
                    <label for="range" class="col-sm-2 control-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="{{old('range')}}">
                        @if ($errors->has('range'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('range') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group  row">
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                        @if ($errors->has('price'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('price') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="location" name="location">
                                <option selected disabled>Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>
                            </select>
                        </div>
                        @if ($errors->has('location'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('location') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="accredited" class="col-sm-2 control-label">Accredited</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="accredited" name="accredited">
                                <option selected disabled>Select for Accredited</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        @if ($errors->has('accredited'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('accredited') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group  row">
                    <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" autocomplete="off" value="{{old('quantity',1)}}">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('quantity') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="modal fade" id="add_na" tabindex="-1" role="dialog" aria-labelledby="add_na" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_na">Add Misc.</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_na_form">
                        @csrf
                        <input type="hidden" value="{{$session->id}}" name="session_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Put capability name (not listed)" autocomplete="off" value="{{old('name')}}">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="quantity" autocomplete="off" value="{{old('quantity')}}">
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection

