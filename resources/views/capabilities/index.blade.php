@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h3 mb-0 text-gray-800 float-left">Capabilities & Prices</h1>


            <a href="{{route('capabilities.create')}}" class="btn float-right btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Capabilities & Prices</a>
            <a href="{{route('parameters')}}" class="btn float-right mx-1 btn-sm btn-success shadow-sm"><i class="fas fa-eye"></i> Parameters</a>
        </div>

    </div>
<div class="row">
  <div class="col-lg-12">
    <table id="example" class="table table-bordered table-striped table-sm display nowrap" cellspacing="0" width="100%">
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


