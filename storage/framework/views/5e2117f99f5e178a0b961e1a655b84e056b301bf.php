
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Capabilities & Quote</h1>
        <a href="<?php echo e(route('capabilities.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Parameters</a>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('pendings.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($id); ?>" name="na_id">
                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name',$edit->not_available)); ?>">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($parameter->id); ?>"><?php echo e($parameter->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                        <?php if($errors->has('category')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('category')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="range" class="col-sm-2 control-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="<?php echo e(old('range')); ?>">
                        <?php if($errors->has('range')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('range')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" autocomplete="off" value="<?php echo e(old('unit')); ?>">
                        <?php if($errors->has('unit')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('unit')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="<?php echo e(old('accuracy')); ?>">
                        <?php if($errors->has('accuracy')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('accuracy')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="<?php echo e(old('price')); ?>">
                        <?php if($errors->has('price')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('price')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="location" name="location">
                                <option selected disabled>Select Location</option>
                                <option value="site">site</option>
                                <option value="lab">lab</option>

                            </select>
                        </div>
                        <?php if($errors->has('location')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('location')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="procedure" class="col-sm-2 control-label">Procedure</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="procedure" name="procedure">
                                <option selected disabled>Select Procedure</option>
                                <?php $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($procedure->id); ?>"><?php echo e($procedure->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('procedure')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('procedure')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="<?php echo e(old('remarks')); ?>">
                        <?php if($errors->has('remarks')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('remarks')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 form-check">
                    <div class="text-right">
                        <input type="checkbox" class="form-check-input"  name="accredited" id="accredited">
                        <label class="form-check-label" for="accredited">Accredited</label>
                    </div>
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/pendings/create.blade.php ENDPATH**/ ?>