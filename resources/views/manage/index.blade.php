@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">


    <h2 class="border-bottom text-dark">Manage Jobs</h2>

</div>

@if(Session::has('success'))
    <script>
        $(document).ready(function () {
            swal("Done!", '{{Session('success')}}', "success");
        });
    </script>
@endif

@if(Session::has('failed'))
    <script>
        $(document).ready(function () {
            swal("Sorry!", '{{Session('failed')}}', "error");
        });
    </script>
@endif

<div class="row">
  <div class="col-lg-12">
    <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Customer</th>
        <th>Turnaround</th>
        <th>Total Items</th>
          <th>Jobs</th>
        <th>Type</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Customer</th>
          <th>Turnaround</th>
          <th>Total Items</th>
          <th>Jobs</th>
          <th>Type</th>
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
            "order": [[0, 'desc']],
            "pageLength": 25,
            "ajax":{
                "url": "{{ route('jobs.manage.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "customer" },
                { "data": "turnaround" },
                { "data": "total" },
                { "data": "jobs" },
                { "data": "type" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
    });

</script>

@endsection