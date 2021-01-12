@extends('layouts.master')
@section('content')
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<div class="row">

    <div class="col-12">
        <h3 class="border-bottom pull-left"><i class="fa fa-tasks"></i> All Uncertainties</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2" data-toggle="modal" data-target="#add_uncertainty"><i class="fa fa-plus-circle"></i> Uncertainty</button>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Formula</th>
        <th>Distribution</th>
        <th>Coefficient of<br> Sensitivity</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Formula</th>
          <th>Distribution</th>
          <th>Coefficient of<br> Sensitivity</th>
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
                "url": "{{ route('uncertainties.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "formula" },
                { "data": "distribution" },
                { "data": "coefficient_of_sensitivity" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/uncertainties/edit')}}",
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
                        swal("Failed", "Permission deneid for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_uncertainty').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);
                    $('#editdistribution').val(data.distribution);
                    $('#editcoefficient_of_sensitivity').val(data.coefficient_of_sensitivity);
                    $('#editformula').val(data.formula);
                    //CKEDITOR.instances['editformula'].setData(data.formula);

                },
                error: function(){},
            });
        });


        $("#add_uncertainty_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('uncertainties.store')}}",
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
                    $('#add_uncertainty').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_uncertainty_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('uncertainties.update')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#edit_uncertainty').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
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


<div class="modal fade" id="add_uncertainty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Uncertainty</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_uncertainty_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12  float-left">
                            <textarea rows="5" class="form-control" id="formula" name="formula" placeholder="Formula" autocomplete="off">{{old('formula')}}</textarea>
                        </div>
                        <div class="form-group col-12  float-left">
                            <input type="text" class="form-control" id="distribution" name="distribution" placeholder="Distribution" autocomplete="off" value="{{old('distribution')}}">
                        </div>
                        <div class="form-group col-12  float-left">
                            <select class="form-control" id="coefficient_of_sensitivity" name="coefficient_of_sensitivity">
                                <option selected disabled="">Select coefficient of sensitivity</option>
                                <option value="--" >--</option>
                                <option value="1" selected>1</option>
                            </select>
                        </div>


                        <div class="col-3">
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

<div class="modal fade" id="edit_uncertainty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-refresh"></i> Edit Uncertainty</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_uncertainty_form">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="form-group col-12 float-left">
                            <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-12  float-left">
                            <textarea rows="5" class="form-control" id="editformula" name="editformula" placeholder="Formula"></textarea>
                        </div>
                        <div class="form-group col-12  float-left">
                            <input type="text" class="form-control" id="editdistribution" name="distribution" placeholder="Distribution" autocomplete="off" value="{{old('distribution')}}">
                        </div>
                        <div class="form-group col-12  float-left">
                            <select class="form-control" id="editcoefficient_of_sensitivity" name="coefficient_of_sensitivity">
                                <option selected disabled="">Select coefficient of sensitivity</option>
                                <option value="--" >--</option>
                                <option value="1" selected>1</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
{{--    <script>
        CKEDITOR.replace( 'formula', {
  //          extraPlugins: 'ckeditor_wiris'
        });
        CKEDITOR.replace( 'editformula', {
  //          extraPlugins: 'ckeditor_wiris'
        });

    </script>
    --}}
@endsection


