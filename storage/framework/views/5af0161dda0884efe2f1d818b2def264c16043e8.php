
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Add Customer</h2>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('customers.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group mt-md-4 row">

                    <label for="name" class="col-sm-2 control-label">Registered Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Registered Name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>


                </div>
                <div class="form-group row">

                    <label for="ntn" class="col-sm-2 control-label">NTN / FTN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ntn" name="ntn" placeholder="NTN / FTN" autocomplete="off" value="<?php echo e(old('ntn')); ?>">
                        <?php if($errors->has('ntn')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('ntn')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 control-label">Physical Address</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" rows="5" id="address" name="address" placeholder="Physical Address" autocomplete="off" ><?php echo e(old('address')); ?></textarea>
                        <?php if($errors->has('address')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('address')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="region" class="col-sm-2 control-label">Select Region</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="region" name="region">
                                <option selected disabled="">Select Region</option>
                                <option value="PRA" <?php echo e((collect(old('region'))->contains('PRA')) ? 'selected':''); ?> >Punjab-PRA</option>
                                <option value="SRB" <?php echo e((collect(old('region'))->contains('SRB')) ? 'selected':''); ?> >Sindh-SRB</option>
                                <option value="KPRA" <?php echo e((collect(old('region'))->contains('KPRA')) ? 'selected':''); ?> >KPK-KPRA</option>
                                <option value="BRA" <?php echo e((collect(old('region'))->contains('BRA')) ? 'selected':''); ?> >Balochistan-BRA</option>
                                <option value="IRD" <?php echo e((collect(old('region'))->contains('IRD')) ? 'selected':''); ?> >AJK-IRD</option>
                            </select>
                        </div>
                        <?php if($errors->has('pay_type')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('pay_type')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pay_type" class="col-sm-2 control-label">Payment Type</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="pay_type" name="pay_type">
                                <option selected disabled="">Select Payment Type</option>
                                <option value="cash" <?php echo e((collect(old('pay_type'))->contains('cash')) ? 'selected':''); ?> >Cash</option>
                                <option value="credit" <?php echo e((collect(old('pay_type'))->contains('credit')) ? 'selected':''); ?>>Credit</option>
                            </select>
                        </div>
                        <?php if($errors->has('pay_type')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('pay_type')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pay_way" class="col-sm-2 control-label">Payment Way</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="pay_way" name="pay_way">
                                <option selected disabled="">Select Payment Way</option>

                            </select>
                        </div>
                        <?php if($errors->has('pay_way')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('pay_way')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 col-12 bg-white border">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_name_1" placeholder="Name" autocomplete="off" value="<?php echo e(old('prin_name_1')); ?>">
                                <?php if($errors->has('prin_name_1')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_name_1')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_phone_1" placeholder="Phone" autocomplete="off" value="<?php echo e(old('prin_phone_1')); ?>">
                                <?php if($errors->has('prin_phone_1')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_phone_1')); ?></strong>
                      </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_email_1" placeholder="Email" autocomplete="off" value="<?php echo e(old('prin_email_1')); ?>">
                                <?php if($errors->has('prin_email_1')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_email_1')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>


                        </div>
                        <div class="col-md-4 col-12 bg-white border">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_name_2" placeholder="Name" autocomplete="off" value="<?php echo e(old('prin_name_2')); ?>">
                                <?php if($errors->has('prin_name_2')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_name_2')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_phone_2" placeholder="Phone" autocomplete="off" value="<?php echo e(old('prin_phone_2')); ?>">
                                <?php if($errors->has('prin_phone_2')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_phone_2')); ?></strong>
                      </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_email_2" placeholder="Email" autocomplete="off" value="<?php echo e(old('prin_email_2')); ?>">
                                <?php if($errors->has('prin_email_2')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_email_2')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>


                        </div>
                        <div class="col-md-4 col-12 bg-white border">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_name_3" placeholder="Name" autocomplete="off" value="<?php echo e(old('prin_name_3')); ?>">
                                <?php if($errors->has('prin_name_3')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_name_3')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_phone_3" placeholder="Phone" autocomplete="off" value="<?php echo e(old('prin_phone_3')); ?>">
                                <?php if($errors->has('prin_phone_3')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_phone_3')); ?></strong>
                      </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="principal" name="prin_email_3" placeholder="Email" autocomplete="off" value="<?php echo e(old('prin_email_3')); ?>">
                                <?php if($errors->has('prin_email_3')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('prin_email_3')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>


                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 col-12 bg-white border ">
                            <label for="purchase" class="col-form-label">Purchase Contact</label>

                            <div class="form-group">
                                <input type="text" class="form-control" id="purchase" name="pur_name" placeholder="Name" autocomplete="off" value="<?php echo e(old('pur_name')); ?>">
                                <?php if($errors->has('pur_name')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('pur_name')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="purchase" name="pur_phone_1" placeholder="Phone" autocomplete="off" value="<?php echo e(old('pur_phone_1')); ?>">
                                <?php if($errors->has('pur_phone_1')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('pur_phone_1')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="purchase" name="pur_phone_2" placeholder="Phone (opt)" autocomplete="off" value="<?php echo e(old('pur_phone_2')); ?>">
                                <?php if($errors->has('pur_phone_2')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('pur_phone_2')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="purchase" name="pur_email" placeholder="Email" autocomplete="off" value="<?php echo e(old('pur_email')); ?>">
                                <?php if($errors->has('pur_email')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('pur_email')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-md-6 col-12 bg-white border">
                            <label for="account" class="col-form-label">Accounts Payable</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="account" name="acc_name" placeholder="Name" autocomplete="off" value="<?php echo e(old('acc_name')); ?>">
                                <?php if($errors->has('acc_name')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('acc_name')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="account" name="acc_phone_1" placeholder="Phone" autocomplete="off" value="<?php echo e(old('acc_phone_1')); ?>">
                                <?php if($errors->has('acc_phone_1')): ?>
                                    <span class="text-danger">
            <strong><?php echo e($errors->first('acc_phone_1')); ?></strong>
        </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="account" name="acc_phone_2" placeholder="Phone (opt.)" autocomplete="off" value="<?php echo e(old('acc_phone_2')); ?>">
                                <?php if($errors->has('acc_phone_2')): ?>
                                    <span class="text-danger">
            <strong><?php echo e($errors->first('acc_phone_2')); ?></strong>
        </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="account" name="acc_email" placeholder="Email" autocomplete="off" value="<?php echo e(old('acc_email')); ?>">
                                <?php if($errors->has('acc_email')): ?>
                                    <span class="text-danger">
                          <strong><?php echo e($errors->first('acc_email')); ?></strong>
                      </span>
                                <?php endif; ?>

                            </div>


                        </div>

                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="pay_type"]').on('change', function() {
                var type = $(this).val();
                if(type) {
                    $('select[name="pay_way"]').empty();
                    if (type=='cash'){
                        $('select[name="pay_way"]').append('<option value="advance">Advance</option>');
                        $('select[name="pay_way"]').append('<option value="against delivery">Against Delivery</option>');
                    }
                    if (type=='credit'){
                        $('select[name="pay_way"]').append('<option value="15 days" >15 days</option>');
                        $('select[name="pay_way"]').append('<option value="30 days">30 days</option>');
                        $('select[name="pay_way"]').append('<option value="60 days">60 days</option>');
                        $('select[name="pay_way"]').append('<option value="120 days">120 days</option>');
                    }
                    $.each(data, function(key, value) {

                    });
                }else{
                    $('select[name="pay_way"]').empty();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/customers/create.blade.php ENDPATH**/ ?>