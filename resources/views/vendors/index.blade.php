@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-tasks"></i> All Vendors and Suppliers</h3>
        <span class="text-right ">
                <a href="{{route('vendors.create')}}" class="btn float-right mt-1 btn-sm btn-primary shadow-sm"><i class="fa fa-plus-circle"></i> Vendor / Supplier</a>
        </span>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Reg #</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Category</th>
        <th>Scope of Supply</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Reg #</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Category</th>
          <th>Scope of Supply</th>
          <th>Status</th>
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
                "url": "{{ route('vendors.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "reg_no" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "category" },
                { "data": "scope_of_supply" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
    });

</script>
@endsection


