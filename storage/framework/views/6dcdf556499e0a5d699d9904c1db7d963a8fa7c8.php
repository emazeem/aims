
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <h2>Add Procedure</h2>
            <form id="add_procedure_form">
                <?php echo csrf_field(); ?>

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-2 control-label">
                        <h6 class="font-italic">Name of Procedure</h6>
                    </label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                               autocomplete="off" value="<?php echo e(old('name')); ?>">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-2 control-label">
                        <h6 class="font-italic">Short Description</h6>
                    </label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Short Description of Procedure"
                               autocomplete="off" value="<?php echo e(old('description')); ?>">
                        <?php if($errors->has('description')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('description')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>

                <h5 class="font-italic">Select Uncertainties of Procedure</h5>
                <table class="table table-bordered table-sm table-striped">
                    <?php $__currentLoopData = $uncertainties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uncertainty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center">
                                <div class="checkbox mt-2">
                                    <input type="checkbox" id="<?php echo e($uncertainty->slug); ?>" value="<?php echo e($uncertainty->slug); ?>" name="uncertainties[]">
                                </div>
                            </td>
                            <td>
                                <label for="<?php echo e($uncertainty->slug); ?>">
                                    <span class="text-lg"><?php echo e($uncertainty->name); ?></span>
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

                <?php if($errors->has('uncertainties')): ?>
                    <span class="text-danger">
                          <strong><?php echo e($errors->first('uncertainties')); ?></strong>
                      </span>
                <?php endif; ?>
                <div class="col-12 mt-2 text-right">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#add_procedure_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('procedures.store')); ?>",
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

    </script>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/procedures/create.blade.php ENDPATH**/ ?>