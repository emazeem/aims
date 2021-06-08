@extends('layouts.master')
@section('content')

<div class="row">

    <div class="col-12">
        <h3 class="float-left font-weight-light"><i class="feather icon-alert-circle"></i> No Facility Items</h3>

    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>Item</th>
        <th>Quote</th>
        <th>Customer</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>Item</th>
          <th>Quote</th>
          <th>Customer</th>
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
                "url": "{{ route('nofacility.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "item"},
                { "data": "quote"},
                { "data": "customer"},
            ]
        });

    }
    $(document).ready(function() {
        InitTable();
    });

</script>

@endsection


