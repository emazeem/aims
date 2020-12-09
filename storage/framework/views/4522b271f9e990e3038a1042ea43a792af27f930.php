
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
            <h3 class="box-title">Add Units</h3>
        </div>
        <form class="form-horizontal" action="<?php echo e(route('units.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="box-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="parameter" class="col-sm-3 control-label">Select Parameter</label>
                            <div class="col-sm-9">
                                <select class="form-control text-xs" id="parameter" name="parameter" >
                                    <option value="" selected disabled>Select Paraemter</option>
                                    <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($parameter->id); ?>"><?php echo e($parameter->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('parameter')): ?>
                                    <span class="text-danger">
                                        <strong><?php echo e($errors->first('parameter')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="unit" class="col-sm-3 control-label">Unit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-xs" id="unit" name="unit" placeholder="Unit" autocomplete="off" value="<?php echo e(old('unit')); ?>" require >
                                <?php if($errors->has('unit')): ?>
                                    <span class="text-danger">
                              <strong><?php echo e($errors->first('unit')); ?></strong>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/units/create.blade.php ENDPATH**/ ?>