
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('message')); ?>', "success");
            });
        </script>
    <?php endif; ?>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Staff Details</h2>
    </div>

    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover font-13">
                <tr>
                    <th>First Name</th>
                    <td><?php echo e($show->fname); ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo e($show->lname); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($show->email); ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo e($show->phone); ?></td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td><?php echo e($show->father_name); ?></td>
                </tr>
                <tr>
                    <th>CNIC</th>
                    <td><?php echo e($show->cnic); ?></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td><?php echo e($show->departments->name); ?></td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td><?php echo e($show->designations->name); ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo e($show->roles->name); ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo e($show->address); ?></td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->created_at))); ?></td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->updated_at))); ?></td>
                </tr>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/users/show.blade.php ENDPATH**/ ?>