@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-tasks"></i> All Purchase Orders</h3>
        <span class="text-right ">
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#generate_po"><i class="fa fa-plus-circle"></i> Generate PO</button>
        </span>
    </div>
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>PO #</th>
        <th>Indent ID</th>
          <th>Date</th>
        <th>Created By</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">

      </tbody>
      <tfoot>
      <tr>

          <th>PO #</th>
          <th>Indent ID</th>
          <th>Date</th>
          <th>Created By</th>
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
                "url": "{{ route('po.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "indent_id" },
                { "data": "date" },
                { "data": "created_by" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
    });
</script>
<div class="modal fade" id="generate_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Generate PO</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle"></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('po.store')}}">
                    @csrf
                    <div class="col-12 mb-1">
                        <label for="purchase_indent">Select Purchase Indent</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="purchase_indent" name="purchase_indent" style="width: 100%">
                                <option selected disabled="">Select Purchase Indent</option>
                                @foreach(\App\Models\Purchaseindent::all() as $item)
                                    <option value="{{$item->id}}">Purchase Indent # {{$item->id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-light p-2">
                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection


