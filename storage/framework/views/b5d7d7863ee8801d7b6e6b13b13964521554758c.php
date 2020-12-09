
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <script>
            $(document).ready(function () {
                swal("Error!", '<?php echo e(Session('error')); ?>', "error");
            });
        </script>
    <?php endif; ?>

    <div class="row pb-3">


        <div class="row">
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">
                Job # <span class="font-weight-light text-dark"><?php echo e($id); ?></span>
            </h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Charges : <span class="font-weight-light text-dark"><?php echo e($service_charges); ?></span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Customer : <span class="font-weight-light text-dark"><?php echo e($job->quotes->customers->reg_name); ?></span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax Type : <span class="font-weight-light text-dark"><?php echo e($job->quotes->customers->region); ?></span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax : <span class="font-weight-light text-dark"><?php echo e($tax); ?> %</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Income Tax Percent : <span class="font-weight-light text-dark">3 %</span></h5>
        </div>
        <div class="col-12 mt-5">
            <h1 class="h3 mb-3">Add Invoice Ledger Details</h1>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="<?php echo e(route('invoicing_ledger.store')); ?>" method="post"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($id); ?>">
                <input type="hidden" name="customer" value="<?php echo e($job->quotes->customer_id); ?>">
                <input type="hidden" name="service_charges" value="<?php echo e($service_charges); ?>">
                <input type="hidden" name="service_tax_type" value="<?php echo e($job->quotes->customers->region); ?>">
                <input type="hidden" name="service_tax_percent" value="<?php echo e($tax); ?>">
                <input type="hidden" name="income_tax_percent" value="3">
                <div class="form-group row">
                    <label for="tax_deducted_by" class="col-sm-3 control-label">Tax Deducted</label>
                    <select class="form-control col-md-9" id="tax_deducted_by" name="tax_deducted_by">
                        <option selected disabled>Deducted by</option>
                        <option value="0">Income Tax by AIMS + Service Tax by AIMS</option>
                        <option value="1">Income Tax at Source + Service Tax at Source</option>
                        <option value="2">Income Tax at Source + Service Tax by AIMS</option>
                    </select>
                    <?php if($errors->has('tax_deducted_by')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('tax_deducted_by')); ?></strong></span>
                    <?php endif; ?>
                </div>

                <div class="form-group  row">
                    <label for="confirmed_by_name" class="col-sm-3 control-label">Confirmed by : Name</label>
                    <input type="text" class="form-control col-md-9" id="confirmed_by_name" name="confirmed_by_name"
                           placeholder="Name" autocomplete="off" value="<?php echo e(old('confirmed_by_name')); ?>">
                    <?php if($errors->has('confirmed_by_name')): ?>
                        <span class="text-danger">
                          <strong><?php echo e($errors->first('confirmed_by_name')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label for="confirmed_by_phone" class="col-sm-3 control-label">Confirmed By : Phone</label>

                    <input type="text" class="form-control col-md-9" id="confirmed_by_phone" name="confirmed_by_phone"
                           placeholder="Phone" autocomplete="off" value="<?php echo e(old('confirmed_by_phone')); ?>">
                    <?php if($errors->has('confirmed_by_phone')): ?>
                        <span class="text-danger">
                          <strong><?php echo e($errors->first('confirmed_by_phone')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label for="acc_name" class="col-sm-3 control-label">Account Name</label>
                    <input type="text" class="form-control col-md-9" id="acc_name" name="acc_name" placeholder="Name"
                           autocomplete="off" value="<?php echo e(old('acc_name',$customer->acc_name)); ?>">
                    <?php if($errors->has('acc_name')): ?>
                        <span class="text-danger">
                          <strong><?php echo e($errors->first('acc_name')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <?php
                $phones=explode('-',$customer->acc_phone);

                ?>
                <div class="form-group row">
                    <label for="acc_phone_1" class="col-sm-3 control-label">Account Phone 1</label>
                    <input type="text" class="form-control col-md-9" id="acc_phone_1" name="acc_phone_1" placeholder="Phone" autocomplete="off" value="<?php echo e(old('acc_phone_1',$phones[0])); ?>">
                    <?php if($errors->has('acc_phone_1')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('acc_phone_1')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label for="acc_phone_2" class="col-sm-3 control-label">Account Phone 2 (opt.)</label>
                    <input type="text" class="form-control col-md-9" id="acc_phone_2" name="acc_phone_2" placeholder="Phone (opt.)" autocomplete="off" value="<?php echo e(old('acc_phone_2',($customer->acc_phone)?$phones[1]:"")); ?>">
                    <?php if($errors->has('acc_phone_2')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('acc_phone_2')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label for="acc_email" class="col-sm-3 control-label">Account Email</label>
                    <input type="text" class="form-control col-md-9" id="acc_email" name="acc_email" placeholder="Email" autocomplete="off" value="<?php echo e(old('acc_email',$customer->acc_email)); ?>">
                    <?php if($errors->has('acc_email')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('acc_email')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </form>
        </div>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/invoicingledger/create.blade.php ENDPATH**/ ?>