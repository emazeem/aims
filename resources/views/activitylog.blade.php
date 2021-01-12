@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">

        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-list"></i> Activity Log</h3>
    </div>
  <div class="col-lg-12">
    <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

        <thead>
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Record Id</th>
            <th>Section</th>
            <th>Performed By</th>
            <th>Details</th>
            <th>On</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Record Id</th>
            <th>Section</th>
            <th>Performed By</th>
            <th>Details</th>
            <th>On</th>
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
                "url": "{{ route('activitylog.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "description" },
                { "data": "subject_id" },
                { "data": "subject_type" },
                { "data": "causer_id" },
                { "data": "properties" },
                { "data": "created_at" },
            ]
        });
    }
    $(document).ready(function() {
        InitTable();
    });
</script>
@endsection
