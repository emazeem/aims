
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('message')); ?>', "success");
            });
        </script>
    <?php endif; ?>

    <div class="row">
        <h2 class="border-bottom text-dark">Customer Details</h2>
        <div class="col-12 mb-4">

            <div class="text-md-right">
                <a href="" class="btn btn-sm btn-success shadow-sm mt-1"><i class="fas fa-eye"></i> Customer Ledger</a>
                <a href="" class="btn btn-sm btn-success shadow-sm mt-1"><i class="fas fa-eye"></i> Receivable Aging Ledger</a>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover font-13">
                <tr>
                    <th>Registration Name</th>
                    <td><?php echo e($show->reg_name); ?></td>
                </tr>
                <tr>
                    <th>NTN/FTN</th>
                    <td><?php echo e($show->ntn); ?></td>
                </tr>
                <tr>
                    <th>Physical Address</th>
                    <td><?php echo e($show->address); ?></td>
                </tr>
                <tr>
                    <th>Customer Type</th>
                    <td><?php echo e($show->customer_type); ?></td>
                </tr>
                <tr>
                    <th>Payment Terms</th>
                    <td><?php echo e($show->pay_terms); ?></td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td><?php echo e($show->region); ?></td>
                </tr>

                <tr>
                    <th>01-Principal Name</th>
                    <td><?php echo e($show->prin_name_1); ?></td>
                </tr>
                <tr>
                    <th>01-Principal Email</th>
                    <td><?php echo e($show->prin_email_1); ?></td>
                </tr>
                <tr>
                    <th>01-Principal Phone</th>
                    <td><?php echo e($show->prin_phone_1); ?></td>
                </tr>
                <?php if($show->prin_name_2): ?>
                    <tr>
                        <th>02-Principal Name</th>
                        <td><?php echo e($show->prin_name_2); ?></td>
                    </tr>
                    <tr>
                        <th>02-Principal Email</th>
                        <td><?php echo e($show->prin_email_2); ?></td>
                    </tr>
                    <tr>
                        <th>02-Principal Phone</th>
                        <td><?php echo e($show->prin_phone_2); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($show->prin_name_3): ?>
                    <tr>
                        <th>03-Principal Name</th>
                        <td><?php echo e($show->prin_name_3); ?></td>
                    </tr>
                    <tr>
                        <th>03-Principal Email</th>
                        <td><?php echo e($show->prin_email_3); ?></td>
                    </tr>
                    <tr>
                        <th>03-Principal Phone</th>
                        <td><?php echo e($show->prin_phone_3); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if($show->pur_name): ?>
                    <tr>
                        <th>Purchase Name</th>
                        <td><?php echo e($show->pur_name); ?></td>
                    </tr>
                    <tr>
                        <th>Purchase Email</th>
                        <td><?php echo e($show->pur_email); ?></td>
                    </tr>
                    <tr>
                        <th>Purchase Phone</th>
                        <td><?php echo e($show->pur_phone); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($show->acc_name): ?>
                    <tr>
                        <th>Account Name</th>
                        <td><?php echo e($show->acc_name); ?></td>
                    </tr>
                    <tr>
                        <th>Account Email</th>
                        <td><?php echo e($show->acc_email); ?></td>
                    </tr>
                    <tr>
                        <th>Account Phone</th>
                        <td><?php echo e($show->acc_phone); ?>

                        </td>
                    </tr>
                <?php endif; ?>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/customers/show.blade.php ENDPATH**/ ?>