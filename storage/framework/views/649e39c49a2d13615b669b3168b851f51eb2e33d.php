
<?php $__env->startSection('content'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="border-bottom text-dark">Add Personnel</h2>

    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('users.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group mt-md-4 row">

                    <label for="fname" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="<?php echo e(old('fname')); ?>">
                        <?php if($errors->has('fname')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('fname')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="lname" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off" value="<?php echo e(old('lname')); ?>">
                        <?php if($errors->has('lname')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('lname')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="fathername" class="col-sm-2 control-label">Father Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fathername" name="fathername" placeholder="Father Name" value="<?php echo e(old('fathername')); ?>">
                        <?php if($errors->has('fathername')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('fathername')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">

                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="new-password" value="<?php echo e(old('email')); ?>">
                        <?php if($errors->has('email')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete = "new-password" value="<?php echo e(old('password')); ?>">
                        <?php if($errors->has('password')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('password')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">

                    <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  name="cnic" value="<?php echo e(old('cnic')); ?>">
                        <?php if($errors->has('cnic')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('cnic')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="phone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off" value="<?php echo e(old('phone')); ?>">
                        <?php if($errors->has('phone')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('phone')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" autocomplete="off" value="<?php echo e(old('dob')); ?>">
                        <?php if($errors->has('dob')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('dob')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="joining" class="col-sm-2 control-label">Joining Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="joining" name="joining" placeholder="Joining Date" autocomplete="off" value="<?php echo e(old('joining')); ?>">
                        <?php if($errors->has('joining')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('joining')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="department" name="department">
                                <option selected disabled="">Select Department</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->id); ?>" <?php echo e((collect(old('department'))->contains($department->id)) ? 'selected':''); ?> ><?php echo e($department->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('department')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('department')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-sm-2 control-label">Designation</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="designation" name="designation">
                                <option selected disabled="">Select Designation</option>
                            </select>
                        </div>
                        <?php if($errors->has('designation')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('designation')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="roles" name="roles">
                                <option selected disabled="">Select Roles</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e((collect(old('roles'))->contains($role->id)) ? 'selected':''); ?>><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('roles')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('roles')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" rows="5" id="address" name="address" placeholder="Address" autocomplete="off" ><?php echo e(old('address')); ?></textarea>
                        <?php if($errors->has('address')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('address')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 control-label">Upload CV</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cv" id="cv">
                            <label class="custom-file-label" for="cv">Choose CV</label>
                        </div>
                        <?php if($errors->has('cv')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('cv')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="input-group mb-3">

                </div>
                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script>
        $(":input").inputmask();

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();
                if(department) {
                    $.ajax({
                        url: '/users/fetch/designation/'+department,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="designation"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="designation"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="designation"]').empty();
                }
            });
        });


    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/users/create.blade.php ENDPATH**/ ?>