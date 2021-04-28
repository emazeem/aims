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
        <div class="col-12">

            <form class="form-horizontal row" action="{{route('vendors.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-6">
                    <label for="attention_to" class="control-label">attention_to</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="attention_to" name="attention_to" placeholder="attention_to"
                               autocomplete="off" value="{{old('attention_to')}}">
                        @if ($errors->has('attention_to'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('attention_to') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="attention_person" class="control-label">attention_person</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="attention_person" name="attention_person" placeholder="attention_person"
                               autocomplete="off" value="{{old('attention_person')}}">
                        @if ($errors->has('attention_person'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('attention_person') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="category" class="control-label">Category</label>
                    <div class="col-12">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                <option value="scope-1">Scope # 01</option>
                                <option value="scope-2">Scope # 02</option>
                                <option value="scope-3">Scope # 03</option>
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('category') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="scope_of_supply" class="col-sm-2 control-label">Scope Of Supply</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="scope_of_supply" name="scope_of_supply">
                                <option selected disabled>Select Scope Of Supply</option>

                            </select>
                        </div>
                        @if ($errors->has('scope_of_supply'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('scope_of_supply') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="approval_basis" class="col-sm-2 control-label">Approval Basis</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="approval_basis" name="approval_basis">
                                <option selected disabled>Select Approval Basis</option>
                                <option value="email">Email</option>
                            </select>
                        </div>
                        @if ($errors->has('approval_basis'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('approval_basis') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 control-label">Select Status</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="status" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        @if ($errors->has('status'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('status') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry_date" class="col-sm-2 control-label">Expiry_Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="expiry_date"
                               autocomplete="off" value="{{old('expiry_date')}}">
                        @if ($errors->has('expiry_date'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('expiry_date') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>


                <!-- /.box-body -->
                <div class="bg-white">
                    <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i> Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
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

