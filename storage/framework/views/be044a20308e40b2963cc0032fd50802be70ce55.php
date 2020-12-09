
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Items</h1>

    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(url('/items/update/'.$edit->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group mt-md-4 row">
                    <label for="session" class="col-sm-2 control-label">Session</label>
                    <div class="col-sm-10">
                        <input type="hidden" value="<?php echo e($session->id); ?>" name="session_id">
                        <input type="text" class="form-control" id="session" name="session" placeholder="session" autocomplete="off" value="<?php echo e($session->name); ?>" disabled>
                        <?php if($errors->has('session')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('session')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="customer" class="col-sm-2 control-label">Customer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="customer" autocomplete="off" value="<?php echo e($session->customers->reg_name); ?>" disabled>
                        <?php if($errors->has('customer')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('customer')); ?></strong>
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
                <div class="form-group row">
                    <label for="capability" class="col-sm-2 control-label">Capability & Price List</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="capability" name="capability">

                            </select>
                        </div>
                        <?php if($errors->has('capability')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('capability')); ?></strong>
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
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" autocomplete="off" value="<?php echo e(old('price',$edit->price)); ?>">
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
                                <option value="site" <?php echo e(($edit->location=="site")?"selected":""); ?>>site</option>
                                <option value="lab" <?php echo e(($edit->location=="lab")?"selected":""); ?>>lab</option>
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
                    <label for="accredited" class="col-sm-2 control-label">Accredited</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="accredited" name="accredited">
                                <option selected disabled>Select for Accredited</option>
                                <option value="yes" <?php echo e(($edit->accredited=="yes")?"selected":""); ?>>Yes</option>
                                <option value="no" <?php echo e(($edit->accredited=="no")?"selected":""); ?>>No</option>
                            </select>
                        </div>
                        <?php if($errors->has('accredited')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('accredited')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" autocomplete="off" value="<?php echo e(old('quantity',$edit->quantity)); ?>">
                        <?php if($errors->has('quantity')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('quantity')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo e(url('/sessions')); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="capability"]').append('<option selected value="<?php echo e($edit->capability); ?>"><?php echo e($edit->capabilities->name); ?></option>');
            $('select[name="parameter"]').on('change', function() {
                $('#price').val('');
                $('#range').val('');
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '/items/select-capabilities/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="capability"]').empty();

                            $('select[name="capability"]').append('<option disabled selected>Select Respective Parameter</option>');
                            $.each(data, function(key, value) {
                                $('select[name="capability"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="capability"]').empty();
                }
            });

            $('select[name="capability"]').on('change', function() {
                var capability = $(this).val();
                if(capability) {
                    $.ajax({
                        url: '/items/select-price/'+capability,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#price').val(data.price);
                            $('#range').val(data.range);
                            $('#location').val(data.location);
                            $('#accredited').val(data.accredited);
                        }
                    });
                }else{
                    $('select[name="capability"]').empty();
                }
            });
        });

    </script>
    <div class="modal fade" id="add_na" tabindex="-1" role="dialog" aria-labelledby="add_na" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_na">Add Misc.</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_na_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($session->id); ?>" name="session_id">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Put capability name (not listed)" autocomplete="off" value="<?php echo e(old('name')); ?>">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/items/edit.blade.php ENDPATH**/ ?>