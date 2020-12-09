
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>

    <?php if(Session::has('failed')): ?>
        <script>
            $(document).ready(function () {
                swal("Sorry!", '<?php echo e(Session('failed')); ?>', "error");
            });
        </script>
    <?php endif; ?>



    <div class="row pb-3">
        <div class=" d-sm-flex align-items-center justify-content-between mb-4 col-12">
            <h1 class="h3 mb-0 text-gray-800">Assign Task</h1>
            <a href="" data-toggle="modal" data-target="#add_suggestion" class="pull-right"><i class="fa fa-question"></i> Add Suggestion</a>
        </div>
        <div class="col-12">
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <th>Quotes</th>
                    <td><?php echo e($job->jobs->quote_id); ?></td>
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


            <div class="col-12 p-2 border">
                <div class=" d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="">Assign Task</h3>
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
                                       min="<?php echo e($today); ?>" value="<?php echo e(old('start')); ?>" class="form-control">
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
                                       min="<?php echo e($today); ?>" value="<?php echo e(old('end')); ?>" class="form-control">
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
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->fname); ?> <?php echo e($user->lname); ?></option>
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
                                        <option style="font-size: 11px" value="<?php echo e($asset->id); ?>" <?php echo e((in_array($asset->id,$sug)?"selected":"")); ?>><?php echo e($asset->code); ?>-<?php echo e($asset->name); ?>-<?php echo e($asset->range); ?>-<?php echo e($asset->resolution); ?>-<?php echo e($asset->accuracy); ?></option>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '<?php echo e(url('scheduling/tasks/respective-assets')); ?>/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="optassets[]"]').empty();
                            $.each(data, function(index, value) {
                                $('select[name="optassets[]"]').append('<option value="'+ value.id +'">'+ value.code +'-'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                     $('select[name="optassets[]"]').empty();
                }
            });
        });


    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_session">Suggestions</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_suggestion_form" method="post" action="<?php echo e(url('scheduling/tasks/add/suggestion')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="jobid" value="<?php echo e($job->id); ?>">
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Capability</label>
                                <div class="form-group col-12">
                                    <input class="form-control " type="hidden" id="capability" name="capability" placeholder="capability" value="<?php echo e(\App\Models\Capabilities::find($job->items->capability)->id); ?>" autocomplete="off"/>                                   <input class="form-control " placeholder="capability" value="<?php echo e(\App\Models\Capabilities::find($job->items->capability)->name); ?>" autocomplete="off" readonly/>
                                </div>
                        </div>
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Select Parameter</label>
                            <div class="form-check col-12" style="width: 100%">
                                <select class="form-control" id="parameter" name="parameter">
                                    <option selected disabled="">Select Parameter</option>
                                    <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($parameter->id); ?>"><?php echo e($parameter->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="optassets" class="col-12 text-xs control-label">Select Opt Assets</label>
                            <div class="form-check col-12">
                                <select class="form-control select2" id="optassets" name="optassets[]" multiple style="width: 100%;font-size: 10px" ></select>
                            </div>
                        </div>

                        <div class="col-sm-2 text-right">
                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#assets').select2({
            placeholder: 'Select/Search Assets'
        });
        $('#optassets').select2({
            placeholder: 'Select optional assets'
        });

        $("select").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/tasks/create.blade.php ENDPATH**/ ?>