
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
            <h2>Job Detail</h2>
        </div>
        <div class="col-12">
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <td><?php echo e($job->id); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                    <?php if($job->status==0): ?>
                            <span class="badge badge-primary">Pending</span>
                    <?php else: ?>
                            <span class="badge badge-primary">Complete</span>
                    <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Quote ID</th>
                    <td><?php echo e($job->quote_id); ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                        <?php if($labjobs->count()>0 and $sitejobs->count()==0): ?>
                        LAB
                        <?php elseif($labjobs->count()==0 and $sitejobs->count()>0): ?>
                        SITE
                        <?php else: ?>
                            LAB+SITE
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td><?php echo e($job->quotes->customers->reg_name); ?></td>
                </tr>
                <tr>
                    <th>Turnaround</th>
                    <td><?php echo e($job->quotes->turnaround); ?></td>
                </tr>
                <tr>
                    <th>Mode</th>
                    <td><?php echo e($job->quotes->mode); ?></td>
                </tr>
            </table>
        </div>

        <?php if($labjobs): ?>

            <div class="col-12">
                <h4>Lab Detail</h4>
                <table class="table table-hover table-bordered table-responsive table-sm">

                    <thead>
                    <tr>
                        <th class="text-center">Quote ID</th>
                        <th>Equipment ID</th>
                        <th>Serial</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Accessories</th>
                        <th>Visual Inspection</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Started At</th>
                        <th>Ended At</th>
                        <th>Assign User</th>
                        <th>Assign Assets</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sr=0; ?>
                    <?php $__currentLoopData = $labjobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $labjob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $sr++ ?>
                            <td  class="text-center">
                                Item <?php echo e($sr); ?> of <?php echo e(count($labjobs)+count($sitejobs)); ?><br>
                                <a href="<?php echo e(url('jobs/print/jobtag/lab/'.$sr.'/'.$labjob->id)); ?>" class="btn"><i class="fas fa-qrcode text-danger fa-2x"></i></a>
                            </td>
                            <td><?php if($labjob->eq_id): ?><?php echo e($labjob->eq_id); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->serial): ?><?php echo e($labjob->serial); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->make): ?><?php echo e($labjob->make); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->model): ?><?php echo e($labjob->model); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->accessories): ?><?php echo e($labjob->accessories); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->visual_inspection): ?><?php echo e($labjob->visual_inspection); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->start): ?><?php echo e($labjob->start); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->end): ?><?php echo e($labjob->end); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->started_at): ?><?php echo e($labjob->started_at); ?><?php else: ?> ---<?php endif; ?></td>
                            <td><?php if($labjob->ended_at): ?><?php echo e($labjob->ended_at); ?><?php else: ?> ---<?php endif; ?></td>
                            <td>
                                <?php if($labjob->assign_user): ?>
                                    <?php echo e(\App\Models\User::find($labjob->assign_user)->fname); ?><?php echo e(\App\Models\User::find($labjob->assign_user)->lname); ?>

                                <?php endif; ?>

                            </td>
                            <?php $assets=explode(',',$labjob->assign_assets) ?>
                            <td>
                                <?php if($labjob->assign_assets): ?>
                                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-dark"><?php echo e(\App\Models\Asset::find($asset)->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($labjob->status==0): ?>
                                    <span class="badge badge-danger">Awaiting store entry</span>
                                <?php elseif($labjob->status==1): ?>
                                    <span class="badge badge-primary">Awaiting to Assign</span>
                                <?php elseif($labjob->status==2): ?>
                                    <span class="badge badge-success">Awaiting for Calibration</span>
                                <?php endif; ?>
                                <br>
                                    <span class="text-center col-12">
                                        <a href="#" data-id="<?php echo e($labjob->id); ?>" data-type="lab" class="btn scan btn-primary mt-1 btn-sm"><i class="fa fa-plus"></i> Scan</a>
                                    </span>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        <?php endif; ?>
        <?php if(count($sitejobs)>0): ?>
            <div class="col-12">
                <h4>Site Detail</h4>
            </div>
            <table class="table table-hover font-13 table-bordered">

                <thead>
                <tr>
                    <th>Quote ID</th>
                    <th>Equipment ID</th>
                    <th>Model</th>
                    <th>Visual Inspection</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Started At</th>
                    <th>Ended At</th>
                    <th>Assign Assets</th>
                    <th>Assign User</th>
                    <th>Status</th>
                </tr>
                </thead>
                <?php $__currentLoopData = $sitejobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitejob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tbody>
                    <tr>
                        <td><?php echo e($sitejob->jobs->quote_id); ?></td>
                        <td><?php echo e($sitejob->eq_id); ?></td>
                        <td><?php echo e($sitejob->model); ?></td>
                        <td><?php echo e($sitejob->visual_inspection); ?></td>
                        <td><?php echo e($sitejob->start); ?></td>
                        <td><?php echo e($sitejob->end); ?></td>
                        <td><?php echo e($sitejob->started_at); ?></td>
                        <td><?php echo e($sitejob->ended_at); ?></td>
                        <td><?php echo e($sitejob->assign_assets); ?></td>
                        <td><?php echo e($sitejob->assign_user); ?></td>
                        <td><?php echo e($sitejob->status); ?></td>
                    </tr>
                    </tbody>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>

            <?php $__currentLoopData = $sitejobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitejob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h4>All Assets</h4>
                <?php $all_assets=explode(',',$sitejob->group_assets); ?>


                <?php if(isset($sitejob->group_assets)): ?>
                <?php $__currentLoopData = $all_assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                        <li><?php echo e(\App\Models\Asset::find($asset)->name); ?> ( <?php echo e(\App\Models\Asset::find($asset)->code); ?> )</li>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <h4>All Users</h4>

                <?php $all_users=explode(',',$sitejob->group_users); ?>
                <?php if(isset($sitejob->group_users)): ?>

                <?php $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                        <li><?php echo e(\App\Models\User::find($user)->fname); ?> <?php echo e(\App\Models\User::find($user)->lname); ?></li>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>
                <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>


    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.scan', function () {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $('#scan_id').val(id);
                $('#scan_type').val(type);
                $('#scan').modal('toggle');
                $('#scan').on('shown.bs.modal', function () {
                    $('#scan_url').focus();
                });
            });
            $('#scan_url').change(function () {
                setTimeout(function() {
                    //var data = JSON.stringify( $('#scan_form').serializeArray() );
                    var data = $("#scan_form").serializeArray();
                    var type=null;
                    var id=null;
                    var url=null;
                    $.each(data, function(i, fields){
                        if (fields.name=='type'){
                            type=fields.value;
                        }
                        if (fields.name=='id'){
                            id=fields.value;
                        }
                        if (fields.name=='url'){
                            url=fields.value;
                        }
                        //console.log(fields.name + ":" + fields.value + " ");
                    });

                    window.location.href='https://'+url+'/'+type+'/'+id;
                }, 2000);
            });
            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('checkin.store')); ?>",
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
                            swal('success',data.success,'success').then((value) => {
                                location.reload();
                            });

                        }
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    },
                });
            }));
        });
    </script>
    <div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Scan your Equipment</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="scan_form">
                        <?php echo csrf_field(); ?>
                        <input type="text" value="" name="type" id="scan_type" class="form-control" hidden>
                        <input type="text" value="" name="id" id="scan_id" class="form-control" hidden>
                        <input type="text" value="" class="form-control" id="scan_url" name="url">
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/jobs/show.blade.php ENDPATH**/ ?>