
<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">All Procedures</h2>

        <a href="<?php echo e(route('procedures.create')); ?>" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus"></i> Procedures</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Uncertainties</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Uncertainties</th>
                    <th>Action</th>
                </tr>
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
                "ajax":{
                    "url": "<?php echo e(route('procedures.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "uncertainties" },
                    { "data": "options" ,"orderable":false},
                ]

            });
        }
        $(document).ready(function() {
            InitTable();
        });

    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/procedures/index.blade.php ENDPATH**/ ?>