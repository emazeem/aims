@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Quotes Details</h1>
</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Range</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">

      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Range</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Created_at</th>
          <th>Updated_at</th>
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
                "url": "{{ route('quotes.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "range" },
                { "data": "price" },
                { "data": "quantity" },
                { "data": "createdat" },
                { "data": "updatedat" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
    } );
</script>

@endsection


