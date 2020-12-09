
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Capabilities & Prices</h1>

        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add_parameter"><i class="fas fa-plus"></i> Parameter</button>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('capabilities.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger">
                          <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 control-label">Parameter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Parameter</option>
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
                        $('select[name="pay_way"]').append('<option value="120 days">120 days</option>');
                    }
                    $.each(data, function(key, value) {

                    });
                }else{
                    $('select[name="pay_way"]').empty();
                }
            });
        });
        $(document).ready(function() {
            $("#add_parameter_form").on('submit',(function(e) {

                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('parameters.store')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#add_parameter').modal('toggle');
                            swal("Success", "Parameter added successfully", "success");
                            InitTable();
                        }
                    },
                    error: function()
                    {
                        swal("Failed", "Fields Required. Try again.", "error");
                    }
                });
            }));

        });

    </script>
<?php $__env->stopSection(); ?>

<div class="modal fade" id="add_parameter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Parameter</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_parameter_form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-9  float-left">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-3">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/capabilities/create.blade.php ENDPATH**/ ?>