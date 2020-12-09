
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Edit Asset</h2>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(url('/assets/update/'.$edit->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name',$edit->name)); ?>">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="parameter" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="parameter" name="parameter">
                                <option selected disabled>Select Parameter</option>
                                <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($parameter->id); ?>" <?php echo e(($edit->parameter==$parameter->id)?"selected":""); ?>><?php echo e($parameter->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                        <?php if($errors->has('parameter')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('parameter')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="make" class="col-sm-2 control-label">Make</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="make" name="make" placeholder="Make" autocomplete="off" value="<?php echo e(old('make',$edit->make)); ?>">
                        <?php if($errors->has('make')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('make')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="model" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="<?php echo e(old('model',$edit->model)); ?>">
                        <?php if($errors->has('model')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('model')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="range" class="col-sm-2 control-label">Range</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="range" name="range" placeholder="Range" autocomplete="off" value="<?php echo e(old('range',$edit->range)); ?>">
                        <?php if($errors->has('range')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('range')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="Resolution" class="col-sm-2 control-label">Resolution</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="resolution" name="resolution" placeholder="Resolution" autocomplete="off" value="<?php echo e(old('resolution',$edit->resolution)); ?>">
                        <?php if($errors->has('resolution')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('resolution')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="accuracy" name="accuracy" placeholder="Accuracy" autocomplete="off" value="<?php echo e(old('accuracy',$edit->accuracy)); ?>">
                        <?php if($errors->has('accuracy')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('accuracy')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" autocomplete="off" value="<?php echo e(old('code',$edit->code)); ?>">
                        <?php if($errors->has('code')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('code')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="certificate" class="col-sm-2 control-label">Certificate #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="certificate" name="certificate"
                               placeholder="Certificate #" autocomplete="off" value="<?php echo e(old('certificate',$edit->certificate_no)); ?>">
                        <?php if($errors->has('certificate')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('certificate')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="serial" class="col-sm-2 control-label">Serial #</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #"
                               autocomplete="off" value="<?php echo e(old('serial',$edit->serial_no)); ?>">
                        <?php if($errors->has('serial')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('serial')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="traceability" class="col-sm-2 control-label">Traceability </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="traceability" name="traceability" placeholder="Traceability"
                               autocomplete="off" value="<?php echo e(old('traceability',$edit->traceability)); ?>">
                        <?php if($errors->has('traceability')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('traceability')); ?></strong>
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
                                <option value="lab1" <?php echo e(($edit->location=="lab1")?'selected':''); ?>>Lab 1</option>
                                <option value="lab2" <?php echo e(($edit->location=="lab2")?'selected':''); ?>>Lab 2</option>
                                <option value="lab3" <?php echo e(($edit->location=="lab3")?'selected':''); ?>>Lab 3</option>
                            </select>
                        </div>
                        <?php if($errors->has('location')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('location')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>



                <div class="form-group mt-md-4 row">
                    <label for="calibration" class="col-sm-2 control-label">Calibration Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="calibration" name="calibration" placeholder="" autocomplete="off"
                               value="<?php echo e(old('calibration',$edit->calibration)); ?>">
                        <?php if($errors->has('calibration')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('calibration')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="commissioned" class="col-sm-2 control-label">Commissioned Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="commissioned" name="commissioned" placeholder="" autocomplete="off"
                               value="<?php echo e(old('commissioned',$edit->commissioned)); ?>">
                        <?php if($errors->has('commissioned')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('commissioned')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="due" class="col-sm-2 control-label">Due Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="due" name="due" placeholder="" autocomplete="off"
                               value="<?php echo e(old('due',$edit->due)); ?>">
                        <?php if($errors->has('due')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('due')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="status" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="0" <?php echo e(($edit->code==0)?'selected':''); ?>>Available</option>
                                <option value="1" <?php echo e(($edit->code==1)?'selected':''); ?>>Assigned</option>
                            </select>
                        </div>
                        <?php if($errors->has('status')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('status')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="cv">Image (opt)</label>
                        </div>
                        <?php if($errors->has('image')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('image')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>





                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/assets/edit.blade.php ENDPATH**/ ?>