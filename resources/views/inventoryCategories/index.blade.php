@extends('layouts.master')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif
<!-- Table start -->

<div class="col-12">
    <div class="col-12">
        <h3 class="pull-left pb-1"><i class="fa fa-list"></i> Inventory Categories</h3>
        <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2" data-toggle="modal" data-target="#inventory_categories"><i class="fa fa-plus-circle"></i> Inventory Categories</button>
    </div>
            <table id="example" class="table table-bordered table-hover display nowrap" width="100%">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>
</div>

<!-- Table end -->

<!--Modal --><div class="modal fade" id="inventory_categories" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Inventory Category</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{route('inventory.category.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">

                  <div class="form-group">
                    <label>Category Name</label>
                      <input type="text" class="form-control" id="edit_category_name" name="category_name" placeholder="Category Name" autocomplete="off" value="{{ old('category_name') }}" require >
                      <span class="text-red">
                                <strong class="category_name"></strong>
                      </span>
                      @if ($errors->has('category_name'))
                            <span class="text-red">
                                <strong>{{ $errors->first('category_name') }}</strong>
                            </span>
                        @endif
                  </div>
                       
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="edit_status" class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="status"></strong>
                            </span>
                        </div> 
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        
                </div>
              
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>

<script type="text/javascript">
    function InitTable() {
        $('#example').DataTable({
            responsive: true,
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,
            "order": [[0, 'asc']],
            "pageLength": 25,
            "ajax":{
                "url": "{{ route('inventory.category.fetch') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "category_name" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });
    }
$( document ).ready(function() {
  InitTable();
    $(document).on('click', '.edit', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            "url": "{{route('inventory.category.edit')}}",
            type: "POST",
            data: {'id': id,_token: '{{csrf_token()}}'},
            dataType : "json",
            success: function(data)
            {
                $('#inventory_categories').modal('toggle');
                $('#edit_id').val(data.id);
                $('#edit_category_name').val(data.category_name);
                $('#edit_status').val(data.status);
            }
        });
    });

});
</script>
@endsection