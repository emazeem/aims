
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('message')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <h2 class="float-left"><?php echo e($show->id); ?>'s Detail</h2>

            
            <a class="btn btn-primary float-right" href="<?php echo e(url('/jobs/manage/create/'.$show->id)); ?>">
                <i class='fa fa-plus'></i> Create Jobs
            </a>


            <table class="table table-striped bg-white table-sm table-bordered mt-2">
                <tr>
                    <td><b>Quote #</b></td>
                    <td><?php echo e($show->id); ?></td>
                </tr>
                <tr>
                    <td><b>Jobs Created</b></td>
                    <td><?php echo e($jobs->count()); ?></td>
                </tr>

                <tr>
                    <td><b>Customer</b></td>
                    <td><?php echo e($show->customers->reg_name); ?></td>
                </tr>
                <tr>
                    <td><b><?php echo e($show->name); ?> Jobs</b></td>
                    <td><?php echo e($jobs->count()); ?></td>
                </tr>
                <?php if(count($jobs)>0): ?>
                <tr>
                    <td><b>All Jobs (<?php echo e(count($jobs)); ?>)</b></td>
                    <td>
                        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="btn btn-sm btn-outline-danger delete" href="javascript:void(0);" data-id="<?php echo e($job->id); ?>">JOB # <?php echo e($job->id); ?> <i class="fa fa-trash"></i></a>
                            <form id="delete_job" class="float-left mr-1">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($job->id); ?>">
                            </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Created on</b></td>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->created_at))); ?></td>
                </tr>
                <tr>
                    <td><b>Updated on</b></td>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->updated_at))); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal fade" id="create_jobs" tabindex="-1" role="dialog" aria-labelledby="create_jobs" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit_session">Create Jobs</h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_jobs">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="" id="quote_id" name="id">

                        <div class="group-checkbox"></div>


                </div>
                <div class="modal-footer">
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.create-jobs', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "<?php echo e(url('/jobs/manage/get_items')); ?>",
                    type: "POST",
                    data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#create_jobs').modal('toggle');
                        $('#quote_id').val(id);
                        $.each(data, function(key, value) {
                            //$('select[name="items"]').append('<option value="'+value.id+'">'+value.capability+'</option>');
                        });
                    },
                    error: function(){},
                });
            });
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this job?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '<?php echo e(csrf_token()); ?>';
                            e.preventDefault();
                            $.ajax({
                                url: "<?php echo e(route('jobs.manage.delete')); ?>",
                                type: "POST",
                                dataType: "JSON",
                                data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal('success',data.success,'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function(data){
                                    swal("Failed", data.error , "error");
                                },
                            });

                        }
                    });

            });
        });
    </script>

<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/manage/show.blade.php ENDPATH**/ ?>