@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-users"></i> Personnel Details</h3>
        <a href="{{route('users.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm pull-right mt-2"><i class="fa fa-plus-circle"></i> Personnel</a>
        <a href="{{route('users.attendances')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right mt-2"><i class="fa fa-clock-o"></i> Attendances</a>
    </div>
  <div class="col-lg-12">

      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Department</th>
        <th>Designation</th>
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
          <th>Phone</th>
          <th>Department</th>
          <th>Designation</th>
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
                { "data": "phone" },
                { "data": "department" },
                { "data": "designation" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
        /*$('#example').DataTable({
            responsive: true
        });*/
    } );
</script>
@endsection


