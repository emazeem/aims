
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
                location.reload();
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Task Details</h1>
        <a href="<?php echo e(route('calculator',[$location,$show->id])); ?>" class="btn btn-success"><i class="fa fa-calculator"></i> Calculator</a>
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
                            <b>Started at : </b><?php echo e(date('d M, y h:i A',strtotime($show->started_at))); ?>

                        <?php else: ?>
                            <i class="badge badge-success">Completed</i>

                            <br>
                            <b>Started at : </b><?php echo e(date('d M, y h:i A',strtotime($show->started_at))); ?>

                        <br>
                            <b>Ended at : </b><?php echo e(date('d M, y h:i A',strtotime($show->ended_at))); ?>


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
            </div>
        </div>
    </div>

    <?php if($dataentries): ?>
    <div class="col-12 table-responsive">
        <b>Location :</b>
        <?php if($dataentries->job_type==0): ?>
            Lab
        <?php else: ?>
            Site
        <?php endif; ?>
        <br>
        <b>Fixed Value : </b>
        <?php if($dataentries->fixed_type=='UUC'): ?>
            Reference Standard
        <?php else: ?>
            UUC
        <?php endif; ?>
        <br>
        <b>Unit : </b>
        <?php echo e(\App\Models\Unit::find($dataentries->unit)->unit); ?>

        <br>
        <span class="mb-3">
            <a href="<?php echo e(route('mytasks.print_worksheet',[$location,$show->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Worksheet</a>
            <a href="<?php echo e(route('mytasks.print_certificate',[$location,$show->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Certificate</a>
            <a href="<?php echo e(route('mytasks.print_uncertainty',[$location,$show->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Uncertainty</a>
        </span>
        <table class="table table-hover table-bordered">

            <tr>
                <th>Fixed Value</th>
                <th>Repeated Values</th>
            </tr>
            <?php $__currentLoopData = $dataentries->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataentry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>

                <td>
                    <?php echo e($dataentry->fixed_value); ?>

                </td>
                <th>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x1); ?></span>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x2); ?></span>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x3); ?></span>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x4); ?></span>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x5); ?></span>
                    <span class="badge badge-dark p-2"><?php echo e($dataentry->x6); ?></span>
                </th>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/mytask/show.blade.php ENDPATH**/ ?>