
<?php $__env->startSection('content'); ?>
    <?php
        $user=auth()->user();
    ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <script>
            $( document ).ready(function() {
                swal("Failed", "<?php echo e(session('error')); ?>", "error");
            });

        </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="border-bottom text-dark pb-2">Change Password</h2>
        </div>
        <div class="col-md-4 col-12"></div>
        <div class="col-md-4 mt-4 col-12">
            <div class="text-center">
            </div>
            <form class="form-horizontal" action="<?php echo e(route('change-password')); ?>" method="post" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="oldpassword" class="text-xs control-label">Old Password</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                               placeholder="Old Password">
                        <?php if($errors->has('oldpassword')): ?>
                            <span class="text-danger text-xs">
                              <strong><?php echo e($errors->first('oldpassword')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="newpassword" class="text-xs control-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="New Password">
                        <?php if($errors->has('password')): ?>
                            <span class="text-danger text-xs">
                              <strong><?php echo e($errors->first('password')); ?></strong>
                          </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="text-xs control-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm Password">
                    <?php if($errors->has('password_confirmation')): ?>
                        <span class="text-danger text-xs">
                              <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                          </span>
                    <?php endif; ?>
                </div>
                <input type="submit" class="btn btn-warning btn-block">
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/changepassword.blade.php ENDPATH**/ ?>