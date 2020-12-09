
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('message')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <?php if(session('failed')): ?>
        <script>
            $( document ).ready(function() {
                swal("Failed", "<?php echo e(session('failed')); ?>", "error");
            });

        </script>
    <?php endif; ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo e($show->name); ?></h1>

    </div>

    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover font-13">
            <tr>
                    <th>Name</th>
                    <td><?php echo e($show->name); ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo e($show->description); ?></td>
                </tr>
                <tr>
                    <th>Uncertainties</th>
                    <td>
                        <?php $__currentLoopData = explode(',',$show->uncertainties); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uncertainty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge badge-danger h3">
                                <?php echo e(\App\Models\Uncertainty::where('slug',$uncertainty)->first()->name); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>


            </table>
        </div>
    </div>
    <div class="modal fade" id="edit_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Column</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_columns_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="row">
                            <div class="form-group col-9">
                                <input type="text" class="form-control" id="edit-column" name="column" placeholder="Column" autocomplete="off" value="">
                            </div>
                            <div class="col-3 text-right">
                                <button class="btn btn-primary" type="submit">Update</button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/procedures/show.blade.php ENDPATH**/ ?>