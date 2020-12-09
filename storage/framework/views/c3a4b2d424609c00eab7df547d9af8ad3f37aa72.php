
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <script>
            $( document ).ready(function() {
                swal("Success", "<?php echo e(session('success')); ?>", "success");
            });

        </script>
    <?php endif; ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Expense Category or Subcategory</h3>
        </div>
        <form class="form-horizontal" action="<?php echo e(route('expenses_categories.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="box-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="site" class="col-sm-3 control-label">Select Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="category_id" name="category_id" >
                                    <option value="" selected disabled>Select Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('name')): ?>
                                    <span class="text-danger">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category / Subcategory name" autocomplete="off" value="<?php echo e(old('pagename')); ?>" require >
                                <?php if($errors->has('name')): ?>
                                    <span class="text-danger">
                              <strong><?php echo e($errors->first('name')); ?></strong>
                          </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="<?php echo url('');; ?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/expensecategory/create.blade.php ENDPATH**/ ?>