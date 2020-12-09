
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <style>
        input[type='checkbox']{
            height: 25px;
            width: 25px;
        }
        .custom-label{
            font-size: 30px;
        }

    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Roles</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('roles.update')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($edit->id); ?>" name="id">
                <div class="form-group mt-md-4 row">
                    <label for="name" class="control-label col-12">Title
                        <input type="text" class="form-control col-12" id="name" name="name" placeholder="Title for Role"   value="<?php echo e($edit->name); ?>">
                    </label>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>

                <div class="form-group col-sm-6">
                    <ul style="list-style:none">
                        <?php $__currentLoopData = $menuus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($menu->parent_id==null): ?>
                                <div class="checkbox">
                                    <label class="custom-label"><input type="checkbox" value="<?php echo e($menu->slug); ?>" name="menu_arr[]" <?php echo e((in_array($menu->slug,$permissions))?"checked":""); ?>>
                                        <i class="fa fa-bars text-info ml-3"></i>
                                        <?php echo e($menu->name); ?>

                                    </label>
                                </div>
                                <?php $__currentLoopData = $menu->parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checkbox  ml-md-5 ml-3">
                                        <label class="custom-label"><input type="checkbox" value="<?php echo e($item->slug); ?>" name="menu_arr[]" <?php echo e((in_array($item->slug,$permissions))?"checked":""); ?>>
                                            <?php if($item->has_child==0): ?>
                                                <i class="fa fa-lock text-danger ml-3"></i>
                                            <?php else: ?>
                                                <i class="fa fa-bars text-info ml-3"></i>
                                            <?php endif; ?>
                                            <?php echo e($item->name); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/roles/edit.blade.php ENDPATH**/ ?>