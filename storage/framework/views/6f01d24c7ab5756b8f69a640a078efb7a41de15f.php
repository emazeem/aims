
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <h2 class="border-bottom text-dark">Edit Asset Groups</h2>
    <form action="<?php echo e(route('assets.groups.update')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($assetGroup->id); ?>"/>
        <div class="row">
            <div class="col-12 mb-1">
                <div class="form-check form-check-inline" style="width: 100%">
                    <select class="form-control" id="parameter" name="parameter">
                        <option selected disabled="">Select Parameter</option>
                        <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($parameter->id); ?>" <?php echo e(($assetGroup->parameter==$parameter->id)?'selected':''); ?>><?php echo e($parameter->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-12 float-left">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name',$assetGroup->name)); ?>">
            </div>
            <div class="form-group col-12">
                <div class="form-check form-check-inline col-12" style="width:100%;">
                    <select class="form-control" multiple id="assets" name="assets[]" style="width:100%;">
                        <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($asset->id); ?>" <?php echo e((in_array($asset->id,$assigned_assets)?'selected':'')); ?>><?php echo e($asset->code); ?>-<?php echo e($asset->name); ?>-<?php echo e($asset->range); ?>

                                -<?php echo e($asset->resolution); ?>-<?php echo e($asset->accuracy); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
    <script>
        $('#assets').select2({
            placeholder: 'Select/Search Assets'
        });

        $("#add_asset_group_form").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('assets.groups.store')); ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                statusCode: {
                    403: function () {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied", "error");
                        return false;
                    }
                },
                success: function (data) {
                    swal('success', data.success, 'success').then((value) => {
                        location.reload();
                    });

                },
                error: function (xhr, status, error) {
                    var error = '';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error += item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/assets_groups/edit.blade.php ENDPATH**/ ?>