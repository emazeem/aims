
<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h3 class="border-bottom text-dark">Manage Reference Errors & Uncertainty</h3>

        <span>
        <a href="<?php echo e(route('units')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-eye"></i> Manage Units</a>
        <a href="<?php echo e(route('manageref.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Add Errors & Uncertainty</a>
    </span>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Asset</th>
                    <th>Unit</th>
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Asset</th>
                    <th>Unit</th>
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                    <th>Action</th>                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>

        function InitTable() {
            $(".loading").fadeIn();

            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax": {
                    "url": "<?php echo e(route('manageref.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "<?php echo e(csrf_token()); ?>"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "asset"},
                    {"data": "unit"},
                    {"data": "uuc"},
                    {"data": "ref"},
                    {"data": "error"},
                    {"data": "uncertainty"},
                    {"data": "options", "orderable": false},
                ]

            });

        }

        $(document).ready(function () {
            InitTable();
        });

    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/reference_errors/index.blade.php ENDPATH**/ ?>