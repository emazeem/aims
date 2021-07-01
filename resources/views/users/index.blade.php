@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
<div class="row">
    <div class="col-12">
        <h3 class="float-left pb-1 font-weight-light"><i class="feather icon-users"></i> Personnel</h3>
        <a href="{{route('users.create')}}" class="btn btn-sm btn-primary shadow-sm float-right mt-2"><i class="fa fa-plus-circle"></i> Personnel</a>
        <a href="{{route('users.attendances')}}" class="btn btn-sm btn-success shadow-sm float-right mt-2"><i class="fa fa-clock-o"></i> Attendances</a>
        <a href="{{route('users.list.of.employees')}}" class="btn btn-sm btn-warning shadow-sm float-right mt-2"><i class="fa fa-tasks"></i> List of Employees</a>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Auth Parameters</th>
        <th>Action</th>
      </tr>

      </thead>
      <tbody>

      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Auth Parameters</th>
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
                "url": "{{ route('users.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "department" },
                { "data": "designation" },
                { "data": "auth_parameters" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
        $('.authorization-parameter-select-2').select2();
        $(document).on('click','.add_authorization_btn',function () {
            var id = $(this).attr('data-id');
            $('#user_id').val(id);
            $('#add_authorization_modal').modal('show');
        });
        $('#add_authorization_form').on('submit',function (e) {
            e.preventDefault();
            var button = $('.authorization-save-btn');
            var previous = $('.authorization-save-btn').html();
            button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
            $.ajax({
                url: '{{route('authorization.store')}}',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    button.attr('disabled', null).html(previous);
                    swal('success', data.success, 'success').then((value) => {
                        $('#add_authorization_modal').modal('hide');
                        $("#example").DataTable().ajax.reload(null, false);
                    });
                },
                error: function (xhr) {
                    button.attr('disabled', null).html(previous);
                    var error = '';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error += item;
                    });
                    swal("Failed", error, "error");
                }
            });
        });

        $(document).on('click','.delete-authorization-parameter', function (e) {
            swal({
                title: "Are you sure to delete this authorization parameter of this user?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        e.preventDefault();
                        var id = $(this).attr('data-id');
                        var user_id = $(this).attr('data-user-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        $.ajax({
                            url: "{{route('authorization.destroy')}}",
                            type: 'DELETE',
                            dataType: "JSON",
                            data: {'id': id,'user_id':user_id, _token: token},
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    $("#example").DataTable().ajax.reload(null, false);
                                });
                            },
                            error: function () {
                                swal("Failed", "Unable to delete.", "error");
                            },
                        });

                    }
                });

        });
    });
</script>
    <div class="modal fade" id="add_authorization_modal" tabindex="-1" role="dialog" aria-labelledby="edit_session"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="edit_session"><i class="feather icon-plus-circle"></i>
                        User vs Parameter Authorization</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_authorization_form">
                        @csrf
                        <input class="form-control" type="hidden" id="user_id" name="user_id">
                        <div class="row">
                            <label for="authorization_parameter" class="col-12 text-xs control-label">Select Parameters</label>
                            <div class="form-check col-12" style="width: 100%">
                                <select class="form-control authorization-parameter-select-2" style="width: 100%" multiple id="authorization_parameter" name="authorization_parameter[]">
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm authorization-save-btn float-right my-2" type="submit"><i
                                    class="feather icon-save"></i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


