
<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">All Units</h2>

        <span>
        <a href="<?php echo e(route('units.create')); ?>" class="btn btn-primary pull-right btn-sm">
            <span class="fa fa-plus"></span> Add Unit
        </a>
        </span>

    </div>

    <div class="row">
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Parameter</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Parameter</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
            <!-- /.col -->
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
                        "url": "<?php echo e(route('units.fetch')); ?>",
                        "dataType": "json",
                        "type": "POST",
                        "data": {_token: "<?php echo e(csrf_token()); ?>"}
                    },
                    "columns": [
                        {"data": "id"},
                        {"data": "parameter"},
                        {"data": "unit"},
                        {"data": "options", "orderable": false},
                    ]

                });
            }
            $(document).ready(function () {
                InitTable();
            });

        </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/units/index.blade.php ENDPATH**/ ?>