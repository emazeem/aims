
<?php $__env->startSection('content'); ?>
    <div class="row">
        <h2 class="border-bottom text-dark">All Assets</h2>

        <div class="col-12 mb-4">


            <a href="<?php echo e(route('assets.create')); ?>" class="btn float-right mt-1 btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Assets</a>
            <a href="<?php echo e(route('parameters')); ?>" class="btn float-right mt-1 mx-1 btn-sm btn-success shadow-sm"><i class="fas fa-eye"></i> Parameters</a>
            <button type="button" class="btn btn-sm btn-primary float-right mt-1 shadow-sm" data-toggle="modal" data-target="#add_column"><i class="fas fa-plus"></i> Add Specific Column</button>

        </div>

    </div>
<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parameter</th>
        <th>Status</th>
        <th>Code</th>
        <th>Make</th>
        <th>Model</th>
        <th>Range</th>
        <th>Resolution</th>
        <th>Accuracy</th>
        <th>Due Date</th>
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
          <th>Status</th>
          <th>Code</th>
          <th>Make</th>
          <th>Model</th>
          <th>Range</th>
          <th>Resolution</th>
          <th>Accuracy</th>
          <th>Due Date</th>
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
                "url": "<?php echo e(route('assets.fetch')); ?>",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "<?php echo e(csrf_token()); ?>"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "parameter" },
                { "data": "status" },
                { "data": "code" },
                { "data": "make" },
                { "data": "model" },
                { "data": "range" },
                { "data": "resolution" },
                { "data": "accuracy" },
                { "data": "due" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();
    });

</script>

    <script>
        $(document).ready(function() {
            $("#add_columns_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('columns.store')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {

                        $('#add_column').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function(xhr, status, error)
                    {

                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));
            $("#edit_columns_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('columns.update')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {

                        $('#edit_column').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function(xhr, status, error)
                    {

                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }

                });
            }));

            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "<?php echo e(url('/columns/edit')); ?>",
                    type: "POST",
                    data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#edit_column').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit-column').val(data.column);
                    },
                    error: function(){},
                });
            });

        });
    </script>
    <div class="modal fade" id="add_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Column</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_columns_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="" name="procedure">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="assets" name="assets[]" style="width: 100%" multiple>
                                <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($asset->id); ?>"><?php echo e($asset->name); ?> <?php echo e($asset->code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-10">
                                <input type="text" class="form-control" id="column" name="column" placeholder="Column" autocomplete="off" value="">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#assets').select2({
            placeholder: 'Select an option'
        });


    </script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/assets/index.blade.php ENDPATH**/ ?>