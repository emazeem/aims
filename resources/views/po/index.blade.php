@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-tasks"></i> All Purchase Orders</h3>
        <span class="text-right ">
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right add"><i class="fa fa-plus-circle"></i> Generate PO</button>
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

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{route('po.edit')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                beforeSend : function()
                {
                    $(".loading").fadeIn();
                },
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Permission deneid for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#generate_po').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#purchase_indent').val(data.indent_id);
                    $('#delivery_term').val(data.delivery_term);
                    $('#payment_term').val(data.payment_term);
                    $('#currency').val(data.currency);
                },
                error: function(){},
            });
        });
        $(document).on('click', '.add', function() {
            $('#generate_po').modal('toggle');
            $('#edit_id').val('');
        });

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
                    <input type="hidden" value="" name="edit_id" id="edit_id">
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
                    <div class="col-12 mb-1">
                        <label for="payment_term">Select Payment Term</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="payment_term" name="payment_term" style="width: 100%">
                                <option selected disabled="">Select Payment Term</option>
                                <option value="30-days-from-invoice">30 days from INVOICE by VENDOR</option>
                                <option value="against-delivery">Payment against delivery of goods/services</option>
                                <option value="20-advance-80-against-delivery">20% Advance + 80% Against Delivery</option>
                                <option value="50-advance-50-against-delivery">50% Advance + 50% Against Delivery</option>
                                <option value="100-advance">100% Advance</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="currency">Select Currency</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="currency" name="currency" style="width: 100%">
                                <option selected disabled="">Select Currency</option>
                                <option value="dollar">Dollar</option>
                                <option value="aed">AED</option>
                                <option value="pkr">PKR</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="delivery_term" class="control-label">Delivery Terms</label>
                        <div class="control-group">
                            <input type="text" class="form-control" name="delivery_term" id="delivery_term" placeholder="Delivery Terms"
                            value="As per in Quotation # ">
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


