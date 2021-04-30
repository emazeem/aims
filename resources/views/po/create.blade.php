@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Add PO</h3>
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#add_scopeofsupply"><i class="fa fa-plus-circle"></i> Scope Of Supply</button>

        </div>

            @foreach($indents->indent_items as $indent)
            <div class="col-6">
                <form class="form-horizontal row" action="{{route('po.items.store')}}" method="post">
                @csrf
                <input type="hidden" value="{{$id}}" name="id" id="id">
                <input type="hidden" value="{{$indent->id}}" name="indentitem_id" id="indentitem_id">
                <div class="form-group col-12">
                    <label for="description" class="control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"
                               autocomplete="off" >{{old('description',$indent->item_description)}}</textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="qty" class="control-label">QTY</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="qty" name="qty" placeholder="QTY"
                               autocomplete="off" value="{{old('qty',$indent->qty)}}">
                        @if ($errors->has('qty'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('qty') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="price" class="control-label">Price</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price"
                               autocomplete="off" value="{{old('price')}}">
                        @if ($errors->has('price'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('price') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Save</button>
                </div>
            </form>
            </div>
            @endforeach
    </div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#other_parameter').select2({
            placeholder: 'Select Other Parameters'
        });

        $(document).ready(function () {
            $("#add_scope_of_supply").on('submit',(function(e) {
                e.preventDefault();
                $('button').attr('disabled',true);
                $.ajax({
                    url: "{{route('scope.of.supply.store')}}",
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
                        $('button').attr('disabled',false);
                        swal('success',data.success,'success').then((value) => {
                            $('#add_department').modal('hide');
                            InitTable();
                        });

                    },
                    error: function(xhr)
                    {
                        $('button').attr('disabled',false);
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



    <div class="modal fade" id="add_scopeofsupply" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Scope Of Supply</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times-circle"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_scope_of_supply">
                        @csrf
                        <div class="row">

                            <div class="form-group col-12  float-left">
                                <label for="name">Scope of Supply</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Scope of Supply" autocomplete="off" value="{{old('name')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light p-2">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection

