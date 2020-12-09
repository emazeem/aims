
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <style>
        input[type='checkbox'] {
            height: 15px;
            width: 25px;
        }

        .custom-label {
            font-size: 30px;
        }

        .left-space {
            margin-left: 20px;
        }

        .left-space-2 {
            margin-left: 40px;
        }

    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="border-bottom text-dark">Manage & Sort Menus</h2>

        <span class="border p-2 m-2"><i class="fa fa-sort"></i> Range 0-<?php echo e(count($mens)-1); ?></span>
    </div>

    <div class="row pb-3">
        <div class="col-12">


            <form class="form-horizontal" action="<?php echo e(route('menus.manage.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php $i=1; ?>
                <div class="row">
                <?php $__currentLoopData = $mens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $men): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group col-md-3 col-6 border border-dark p-2">
                        <label for="index<?php echo e($i); ?>" class="float-left"><?php echo e($men->name); ?></label>
                        <br>
                        <input type="number" class="form-control float-right col-4" id="index<?php echo e($i); ?>" name="menu[]" placeholder="" value="<?php echo e($men->position); ?>" required>

                    </div>
                <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $men): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group col-md-3 col-6 border border-dark p-2">
                        <label for="index<?php echo e($i); ?>" class="float-left"><?php echo e($men->name); ?></label>
                        <br>
                        <input type="number" class="form-control float-right col-4" id="index<?php echo e($i); ?>" name="menu[]" placeholder="" value="<?php echo e($men->position); ?>" required>

                    </div>
                <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/manage-menus.blade.php ENDPATH**/ ?>