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
      <tbody>

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
                        $('#edit_min_range').val(data.min_range);
                        $('#edit_acc_min_range').val(data.accredited_min_range);
                        $('#edit_max_range').val(data.max_range);
                        $('#edit_acc_max_range').val(data.accredited_max_range);
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

    } );
</script>

    <div class="modal fade" id="add_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Capabilities</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
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
                                <select class="form-control" id="category" name="category">
                                    <option selected disabled>Select Parameter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-6 p-1 m-0">
                            <label for="procedure" class=" control-label">Procedure</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="procedure" name="procedure">
                                    <option selected disabled>Select Procedure</option>
                                    @foreach($procedures as $procedure)
                                        <option value="{{$procedure->id}}">{{$procedure->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <label for="unit" class=" control-label">Unit</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="unit" name="unit">
                                    <option selected disabled>Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                    @endforeach
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
                        <div class="col-6 p-1 m-0 form-check pt-5">
                            <label class="ml-md-3" for="accredited">
                                <input type="checkbox" class=" form-check-input"  name="accredited" id="accredited">
                                Accredited
                            </label>
                            <button type="submit" class="btn cap-save-btn btn-primary float-right"><i class="fa fa-save"></i> Save</button>

                        </div>
                    </form>
                 </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_capabilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-refresh"></i> Update Capabilities</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
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
                                <select class="form-control" id="editparameter" name="category">
                                    <option selected disabled>Select Parameter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-6 p-1 m-0">
                            <label for="procedure" class=" control-label">Procedure</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="editprocedure" name="procedure">
                                    <option selected disabled>Select Procedure</option>
                                    @foreach($procedures as $procedure)
                                        <option value="{{$procedure->id}}">{{$procedure->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <label for="unit" class=" control-label">Unit</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="editunit" name="unit">
                                    <option selected disabled>Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                    @endforeach
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
                        <div class="col-6 p-1 m-0 form-check pt-5">
                            <label class="ml-md-3" for="accredited">
                            <input type="checkbox" class=" form-check-input"  name="accredited" id="editaccredited">
                                    Accredited
                            </label>
                            <button type="submit" class="btn cap-update-btn btn-primary float-right"><i class="fa fa-refresh"></i> Update</button>

                        </div>
                    </form>

                </div>
                </div>
            </div>
        </div>
    </div>

@endsection


