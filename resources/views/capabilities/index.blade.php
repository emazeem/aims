@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-users"></i> Capabilities & Prices</h3>
        <span class="text-right ">
                <a  class="btn float-right btn-sm btn-primary mt-2 shadow-sm" href="#" data-toggle="modal" data-target="#add_capabilities"><i class="fa fa-plus"></i> Capabilities & Prices</a>
            <a href="{{route('parameters')}}" class="btn mt-2 float-right mx-1 btn-sm btn-success shadow-sm"><i class="fa fa-eye"></i> Parameters</a>

        </span>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parameter</th>
        <th>Range</th>
        <th>Price</th>
        <th>Unit</th>
        <th>Location</th>
        <th>Accredited</th>
        <th>Procedure</th>
        <th>Calculator</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">

      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Parameter</th>
          <th>Range</th>
          <th>Price</th>
          <th>Unit</th>
          <th>Location</th>
          <th>Accredited</th>
          <th>Procedure</th>
          <th>Calculator</th>
          <th>Action</th>
      </tr>
      </tfoot>
    </table>

  </div>
</div>
<script>

    function InitTable() {
        $(".loading").fadeIn();

        $('#example').DataTable({
            responsive: true,
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,

            "order": [[0, 'asc']],
            "pageLength": 25,
            "ajax":{
                "url": "{{ route('capabilities.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "parameter" },
                { "data": "range" },
                { "data": "price" },
                { "data": "unit" },
                { "data": "location" },
                { "data": "accredited" },
                { "data": "procedure" },
                { "data": "calculator" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('/capabilities/edit')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#edit_capabilities').modal('toggle');
                        $('#editid').val(data.id);
                        $('#editname').val(data.name);
                        $('#editparameter').val(data.parameter);
                        $('#editprocedure').val(data.procedure);
                        $('#editrange').val(data.range);
                        $('#editunit').val(data.unit);
                        $('#editaccuracy').val(data.accuracy);
                        $('#editcalculator').val(data.calculator);
                        $('#editprice').val(data.price);
                        $('#editremarks').val(data.remarks);
                        $('#editlocation').val(data.location);
                        if(data.accredited=='yes'){
                            $("#editaccredited").prop('checked', true);
                        }else {

                        }
                        //Populating Form Data to Edit Ends
                    },
                    error: function(){},
                });
            });

        $(document).on('click', '.delete', function(e)
        {
            swal({
                title: "Are you sure to delete this capability?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        var token= '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#form"+id).attr("method");
                        var form_data = $("#form"+id).serialize();

                        $.ajax({
                            url: "{{route('capabilities.delete')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            statusCode: {
                                403: function() {
                                    swal("Failed", "Permission denied." , "error");
                                    return false;
                                }
                            },
                            success: function(data)
                            {
                                swal('success',data.success,'success').then((value) => {
                                    $("#example").DataTable().ajax.reload(null,false);
                                });

                            },
                            error: function(data){
                                swal("Failed", data.error , "error");
                            },
                        });

                    }
                });

        });

        $("#add_capabilities_form").on('submit',(function(e) {

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
                    swal('success',data.success,'success').then((value) => {
                        $('#add_capabilities').modal('hide');
                        $("#example").DataTable().ajax.reload(null,false);

                    });

                },
                error: function(xhr)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });

                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_capabilities_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('capabilities.update')}}",
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
                    swal('success',data.success,'success').then((value) => {
                        $('#edit_capabilities').modal('hide');
                        $("#example").DataTable().ajax.reload(null,false);
                        //InitTable();
                    });

                },
                error: function(xhr)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));

    } );
</script>

    <div class="modal fade" id="add_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Capabilities</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_capabilities_form">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 control-label">Parameter</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="category" name="category">
                                        <option selected disabled>Select Parameter</option>
                                        @foreach($parameters as $parameter)
                                            <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="procedure" class="col-sm-2 control-label">Procedure</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="procedure" name="procedure">
                                        <option selected disabled>Select Procedure</option>
                                        @foreach($procedures as $procedure)
                                            <option value="{{$procedure->id}}">{{$procedure->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="calculator" class="col-sm-2 control-label">Calculator</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="calculator" name="calculator">
                                        <option selected disabled>Select Calculator</option>
                                        @foreach($calculators as $calculator)
                                            <option value="{{$calculator->slug}}">{{$calculator->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="range" class="col-sm-2 control-label">Range</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="{{old('range')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="unit" name="unit">
                                        <option selected disabled>Select Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="{{old('accuracy')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
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
                            </div>
                        </div>

                        <div class="col-12 form-check">
                            <div class="text-right">
                                <input type="checkbox" class="form-check-input"  name="accredited" id="accredited">
                                <label class="form-check-label" for="accredited">Accredited</label>
                            </div>
                        </div>
                        </div>
                <div class="modal-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default bg-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Capabilities</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_capabilities_form">
                        @csrf
                        <input type="hidden" value="" id="editid" name="id">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 control-label">Parameter</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="editparameter" name="category">
                                        <option selected disabled>Select Parameter</option>
                                        @foreach($parameters as $parameter)
                                            <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="procedure" class="col-sm-2 control-label">Procedure</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="editprocedure" name="procedure">
                                        <option selected disabled>Select Procedure</option>
                                        @foreach($procedures as $procedure)
                                            <option value="{{$procedure->id}}">{{$procedure->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="calculator" class="col-sm-2 control-label">Calculator</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="editcalculator" name="calculator">
                                        <option selected disabled>Select Calculator</option>
                                        @foreach($calculators as $calculator)
                                            <option value="{{$calculator->slug}}">{{$calculator->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="range" class="col-sm-2 control-label">Range</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editrange" name="range" placeholder="Range" autocomplete="off" value="{{old('range')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="editunit" name="unit">
                                        <option selected disabled>Select Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editaccuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="{{old('accuracy')}}">
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editprice" name="price" placeholder="Price" autocomplete="off" value="{{old('price')}}">
                            </div>
                        </div>
                        <div class="form-group mt-md-4 row">
                            <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editremarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="editlocation" name="location">
                                        <option selected disabled>Select Location</option>
                                        <option value="site">site</option>
                                        <option value="lab">lab</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 form-check">
                            <div class="text-right">
                                <input type="checkbox" class="form-check-input"  name="accredited" id="editaccredited">
                                <label class="form-check-label" for="accredited">Accredited</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default bg-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection


