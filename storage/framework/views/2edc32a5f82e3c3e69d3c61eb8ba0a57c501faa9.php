
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
                location.reload();
            });
        </script>
    <?php endif; ?>
    <div class="row pb-3">
        <div class="col-12 text-right">

            <h5>
                <?php if($show->status==6 or $show->status==5): ?>
                    <?php if($show->certificate): ?>
                        Certificate # <?php echo e($show->certificate); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </h5>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-sm table-hover">
                <tr>
                    <th>ID</th>
                    <td><?php echo e($show->id); ?></td>
                </tr>
                <tr>
                    <th>Capability</th>
                    <td><?php echo e($show->items->capabilities->name); ?></td>
                </tr>
                <tr>
                    <th>Procedure</th>
                    <td><?php echo e($show->items->capabilities->procedures->name); ?></td>
                </tr>

                <tr>
                    <th>Equipment ID</th>
                    <td><?php echo e($show->eq_id); ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php echo e($show->model); ?></td>
                </tr>

                <tr>
                    <th>Start</th>
                    <td><?php echo e($show->start); ?></td>
                </tr>
                <tr>
                    <th>End</th>
                    <td><?php echo e($show->end); ?></td>
                </tr>
                <?php if($show->assign_assets): ?>
                <tr>
                    <th>Assign Assets</th>
                    <td>
                        <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($asset->name); ?> <b><?php echo e($asset->code); ?></b>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th>Visual Inspection</th>
                    <td><?php echo e($show->visual_inspection); ?></td>
                </tr>
                <?php if($show->accessories): ?>
                <tr>
                    <th>Accessories</th>
                    <td><?php echo e($show->accessories); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if($show->status==2): ?>
                            <i class="badge badge-danger">Pending</i>
                        <?php elseif($show->status==3): ?>
                            <i class="badge badge-primary">In Progress</i>
                            <br>
                            <b>Started at : </b><?php echo e(date('d m y h:i A',strtotime($show->started_at))); ?>

                        <?php else: ?>
                            <i class="badge badge-success">Completed</i>

                            <br>
                            <b>Started at : </b><?php echo e(date('d m y h:i A',strtotime($show->started_at))); ?>

                        <br>
                            <b>Ended at : </b><?php echo e(date('d m y h:i A',strtotime($show->ended_at))); ?>


                        <?php endif; ?>
                    </td>
                </tr>

            </table>
        </div>
        <div class="col-12 text-right">
            <?php if($show->status==2): ?>
                <form method="post" action="<?php echo e(route('mytasks.start')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                    <input type="hidden" name="location" value="<?php echo e($location); ?>">
                    <button class="btn btn-success float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</button>
                </form>
            <?php endif; ?>
            <?php if($show->status==3): ?>
                <form method="post" action="<?php echo e(route('mytasks.end')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="location" value="<?php echo e($location); ?>">
                    <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                    <button class="btn btn-danger float-right" type="submit"><i class="fa fa-hourglass-start" aria-hidden="true"></i> End</button>
                </form>
            <?php endif; ?>

            <?php if($show->status==4 && $location==0): ?>
                <form method="post" action="<?php echo e(route('getcertificate')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="location" value="<?php echo e($location); ?>">
                    <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
                </form>
            <?php endif; ?>
            <?php if($show->status==5 && $location==1): ?>
                <form method="post" action="<?php echo e(route('getcertificate')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="location" value="<?php echo e($location); ?>">
                    <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Certificate</button>
                </form>
            <?php endif; ?>

            <?php if($show->status==4 && $location==1): ?>
                <a href="#" data-id="<?php echo e($show->id); ?>" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i> Add Detail</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                $('#add_id').val(id);
                $('#add_details').modal('toggle');
            });
            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('checkin.storesite')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#add_details').modal('toggle');
                            swal("Success", "Item checked in successfully", "success");
                            location.reload();

                        }
                    },
                    error: function(e)
                    {
                        swal("Failed", "Fields Required. Try again.", "error");

                    }
                });
            }));
        });
    </script>
    <div class="modal fade" id="add_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_details_form">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" value="" id="add_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="OK">
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
    <div class="col-12">
        <form class="form-horizontal" action="<?php echo e(route('calculate')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" value="<?php echo e($show->items->capabilities->procedure); ?>" name="procedure">
            <div class="form-group row">
                <label for="assets" class="col-sm-2 control-label">Assets</label>
                <select class="form-control col-md-10" id="assets" name="assets">
                    <option selected disabled>Assets</option>
                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($asset->id); ?>"><?php echo e($asset->name); ?> (<?php echo e($asset->code); ?>) (<?php echo e($asset->range); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('assets')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('assets')); ?></strong></span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="units" class="col-sm-2 control-label">Units</label>
                <select class="form-control col-md-10" id="units" name="units">
                    <option selected disabled>Select Unit</option>
                </select>
                <?php if($errors->has('units')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('units')); ?></strong></span>
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="uuc_resolution" class="col-2 control-label">UUC Resolution</label>
                <input type="text" class="form-control col-10" id="uuc_resolution" name="uuc_resolution" placeholder="UUC Resolution" autocomplete="off" value="<?php echo e(old('uuc_resolution')); ?>">
                    <?php if($errors->has('uncertainty')): ?>
                        <span class="text-danger">
                                <strong><?php echo e($errors->first('uuc_resolution')); ?></strong>
                            </span>
                    <?php endif; ?>

            </div>
            <div class="form-group row">
                <label for="offset" class="col-2 control-label">Offset of UUC</label>
                <input type="text" class="form-control col-10" id="offset" name="offset" placeholder="Offset" autocomplete="off" value="0">
                    <?php if($errors->has('offset')): ?>
                        <span class="text-danger">
                                <strong><?php echo e($errors->first('offset')); ?></strong>
                            </span>
                    <?php endif; ?>

            </div>



            <div class="form-group row">
                <label for="fixed" class="col-sm-2 control-label">Single / Fixed Value</label>
                <select class="form-control col-md-10" id="fixed" name="fixed">
                    <option selected disabled>Single / Fixed Value</option>
                    <option value="UUC">UUC</option>
                    <option value="Ref">Ref Std</option>
                </select>
                <?php if($errors->has('fixed')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('fixed')); ?></strong></span>
                <?php endif; ?>
            </div>
            <div class="row cal-inputs" style="display: none">
                <div class="col-2">
                    <h5 id="left"></h5>
                </div>
                <div class="col-10">
                    <h5 id="right"></h5>
                </div>
                <div class="form-group col-2">

                    <label for="fixed_value" class="control-label"></label>
                    <input type="text" class="form-control" id="fixed_value" name="fixed_value" placeholder="" autocomplete="off" value="<?php echo e(old('fixed_value')); ?>">
                    <?php if($errors->has('fixed_value')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('fixed_value')); ?></strong></span>
                    <?php endif; ?>
                </div>

                <div class="form-group col-2">
                    <label for="x1" class="control-label">X<sub>1</sub></label>
                    <input type="text" class="form-control" id="x1" name="x1" placeholder="X1" autocomplete="off" value="<?php echo e(old('x1')); ?>">
                    <?php if($errors->has('x1')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('x1')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group col-2">
                    <label for="x2" class="control-label">X<sub>2</sub></label>
                    <input type="text" class="form-control" id="x2" name="x2" placeholder="x2" autocomplete="off" value="<?php echo e(old('x2')); ?>">
                    <?php if($errors->has('x2')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('x1')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group col-2">
                    <label for="x3" class="control-label">X<sub>3</sub></label>
                    <input type="text" class="form-control" id="x3" name="x3" placeholder="x3" autocomplete="off" value="<?php echo e(old('x3')); ?>">
                    <?php if($errors->has('x3')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('x3')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group col-2">
                    <label for="x4" class="control-label">X<sub>4</sub></label>
                    <input type="text" class="form-control" id="x4" name="x4" placeholder="x4" autocomplete="off" value="<?php echo e(old('x4')); ?>">
                    <?php if($errors->has('x4')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('x4')); ?></strong></span>
                    <?php endif; ?>
                </div>
                <div class="form-group col-2">
                    <label for="x5" class="control-label">X<sub>5</sub></label>
                    <input type="text" class="form-control" id="x5" name="x5" placeholder="x5" autocomplete="off" value="<?php echo e(old('x5')); ?>">
                    <?php if($errors->has('x5')): ?>
                        <span class="text-danger"><strong><?php echo e($errors->first('x5')); ?></strong></span>
                    <?php endif; ?>
                </div>

            </div>
            <div class="box-footer">
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {

            $('select[name="assets"]').on('change', function () {
                var parameter = $(this).val();
                if (parameter) {
                    $.ajax({
                        url: '/units/units_of_assets/' + parameter,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="units"]').empty();

                            $('select[name="units"]').append('<option disabled selected>Select Respective Units</option>');
                            $.each(data, function (key, value) {
                                $('select[name="units"]').append('<option value="' + value.id + '">' +value.unit + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="units"]').empty();
                }
            });
            $('select[name="fixed"]').on('change', function () {
                var fixed = $(this).val();
                if (fixed=='UUC'){
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "UUC");
                    $('#left').text('Values observed on UUC');
                    $('#right').text('Values observed on Reference');
                }
                if (fixed=='Ref'){
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "Reference");
                    $('#left').text('Values observed on Reference');
                    $('#right').text('Values observed on UUC');
                }
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/mytask/calculator.blade.php ENDPATH**/ ?>