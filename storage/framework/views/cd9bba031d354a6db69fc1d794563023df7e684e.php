
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>


    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover table-bordered table-sm">

                <tr>
                    <th>Session</th>
                    <td><?php echo e($job->jobs->quotes->name); ?></td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td><?php echo e($job->jobs->quotes->customers->reg_name); ?></td>
                </tr>
                <tr>
                    <th>Item Description</th>
                    <td><?php echo e(\App\Models\Capabilities::find($job->items->capability)->name); ?></td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td><?php echo e(\App\Models\Parameter::find($job->items->parameter)->name); ?></td>
                </tr>
                <tr>
                    <th>Equipment ID</th>
                    <td><?php echo e($job->eq_id); ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php echo e($job->model); ?></td>
                </tr>
                <tr>
                    <th>Visual Inspection</th>
                    <td><?php echo e($job->visual_inspection); ?></td>
                </tr>
            </table>
        </div>
    </div>



            <div class="col-12 border p-2">
                <div class=" d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="mt-3">Assign Task</h3>
                </div>

                <form class="form-horizontal" action="<?php echo e(route('tasks.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="<?php echo e($job->id); ?>" name="id">
                    <?php $today=date('Y-m-d',time()); ?>
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="start"
                                       min="<?php echo e($today); ?>" value="<?php echo e(old('start',$job->start    )); ?>" class="form-control">
                            </div>
                            <?php if($errors->has('start')): ?>
                                <span class="text-danger">
                                        <strong><?php echo e($errors->first('start')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="end"
                                       min="<?php echo e($today); ?>" value="<?php echo e(old('end',$job->end)); ?>" class="form-control">
                            </div>
                            <?php if($errors->has('end')): ?>
                                <span class="text-danger">
                                        <strong><?php echo e($errors->first('end')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user" class="col-sm-2 control-label">Select User</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="user" name="user">
                                    <option selected disabled>Select User</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>" <?php echo e(($job->assign_user==$user->id)?"selected":""); ?>><?php echo e($user->fname); ?> <?php echo e($user->lname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php if($errors->has('user')): ?>
                                <span class="text-danger">
                                        <strong><?php echo e($errors->first('user')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assets" class="col-sm-2 control-label">Select Assets</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" multiple id="assets" name="assets[]">
                                    <option disabled>Select Assets</option>
                                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option style="font-size: 11px" value="<?php echo e($asset->id); ?>" <?php echo e((in_array($asset->id,$job->assign_assets)?"selected":"")); ?>><?php echo e($asset->code); ?>-<?php echo e($asset->name); ?>-<?php echo e($asset->range); ?>-<?php echo e($asset->resolution); ?>-<?php echo e($asset->accuracy); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php if($errors->has('assets')): ?>
                                <span class="text-danger">
                                        <strong><?php echo e($errors->first('assets')); ?></strong>
                                    </span>
                            <?php endif; ?>
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



    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#assets').select2({
            placeholder: 'Select an option'
        });


    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/tasks/edit.blade.php ENDPATH**/ ?>