
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
            <h2>Add Items for Job</h2>
            <form method="post" action="<?php echo e(route('jobs.manage.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($id); ?>" id="quote_id" name="id">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($item->id,$assigned_items)): ?>
                    <div class="form-check">
                        <input type="checkbox" name="items[]" value="<?php echo e($item->id); ?>" class="form-check-input" id="items">
                        <label class="form-check-label text-lg ml-2" for="items"><?php echo e($item->capabilities->name); ?></label>
                    </div>
                        <?php else: ?>
                        <div class="form-check">
                            <input type="checkbox" name="items[]" value="<?php echo e($item->id); ?>" class="form-check-input" id="items" disabled checked>
                            <label class="form-check-label text-lg ml-2 text-muted" for="items"><?php echo e($item->capabilities->name); ?></label>
                        </div>
                    <?php endif; ?>
                        <?php if($errors->has('items')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('items')); ?></strong>
                      </span>
                        <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
        <!--
        <div class="col-md-6 col-12">
            <table class="table table-striped bg-white table-sm table-bordered mt-2">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($item->id,$assigned_items)): ?>
                        <tr>
                            <td><?php echo e($item->capabilities->name); ?></td>
                            <td>
                                <form method="post" action="<?php echo e(route('jobs.manage.delete')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="quote_id" value="<?php echo e($item->quote_id); ?>">
                                    <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        -->
    </div>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/manage/create.blade.php ENDPATH**/ ?>