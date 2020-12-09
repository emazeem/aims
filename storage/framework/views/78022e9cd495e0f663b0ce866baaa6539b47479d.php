
<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h2 class="border-bottom text-dark">All Uncertainties</h2>

    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_uncertainty"><i class="fas fa-plus"></i> Uncertainty</button>
</div>

<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
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
                "url": "<?php echo e(route('uncertainties.fetch')); ?>",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "<?php echo e(csrf_token()); ?>"}
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "<?php echo e(url('/uncertainties/edit')); ?>",
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
                        swal("Failed", "Permission deneid for this action." , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#edit_uncertainty').modal('toggle');
                    $('#editid').val(data.id);
                    $('#editname').val(data.name);

                },
                error: function(){},
            });
        });


        $("#add_uncertainty_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('uncertainties.store')); ?>",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                statusCode: {
                    403: function() {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied" , "error");
                        return false;
                    }
                },
                success: function(data)
                {
                    $('#add_uncertainty').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $("#edit_uncertainty_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('uncertainties.update')); ?>",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#edit_uncertainty').modal('toggle');
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));

    });

</script>


<div class="modal fade" id="add_uncertainty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Uncertainty</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_uncertainty_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-3">
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

<div class="modal fade" id="edit_uncertainty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit department</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_uncertainty_form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" autofocus="autofocus" id="editname" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/uncertainty.blade.php ENDPATH**/ ?>