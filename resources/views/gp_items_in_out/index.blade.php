@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light pb-1"><i class="feather icon-list"></i> All Designations</h3>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered bg-white table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
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
                    "url": "{{ route('designations.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "department_id" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {
            InitTable();
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/designations/edit')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#edit_designation').modal('toggle');
                        $('#editid').val(data.id);
                        $('#edit_department').val(data.department_id);
                        $('#editname').val(data.name);
                    }
                });
            });
            $("#add_designation_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('designations.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#add_designation').modal('hide');
                            InitTable();
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
            $("#edit_designation_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('designations.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#edit_designation').modal('toggle');
                            swal("Success", "designation updated successfully", "success");
                            InitTable();
                        }
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

        });

    </script>
    <div class="modal fade" id="add_designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Designation</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_designation_form">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="department" name="department">
                                        <option selected disabled="">Select department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12  float-left">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                            </div>
                        </div>

                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-primary " type="submit"><i class="feather icon-save"></i> Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-edit"></i>  Edit Designation</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_designation_form">
                        @csrf
                        <input type="hidden" name="id" id="editid">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control" id="edit_department" name="department" >
                                        <option selected disabled="">Select department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12  float-left">
                                <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="{{old('name')}}">
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><i class="feather icon-edit"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


