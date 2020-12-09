
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="border-bottom text-dark">Lab Tasks</h2>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>UUC</th>
                    <th>Eq ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>UUC</th>
                    <th>Eq ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <hr>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Site Tasks</h2>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example2" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>UUC</th>
                    <th>Eq ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>UUC</th>
                    <th>Eq ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
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
                    "url": "<?php echo e(route('mytasks.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "uuc" },
                    { "data": "eqid" },
                    { "data": "start" },
                    { "data": "end" },
                    { "data": "status" },
                    { "data": "options" ,"orderable":false},
                ]

            });
            $('#example2').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax":{
                    "url": "<?php echo e(route('s_mytasks.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "uuc" },
                    { "data": "eqid" },
                    { "data": "start" },
                    { "data": "end" },
                    { "data": "status" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {

            InitTable();
            $(document).on('click', '.nofacility', function(e)
            {
                swal({
                    title: "Are you sure that you have no facility of this quote?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '<?php echo e(csrf_token()); ?>';
                            e.preventDefault();
                            var request_method = $("#form"+id).attr("method");
                            var form_data = $("#form"+id).serialize();

                            $.ajax({
                                url: "<?php echo e(url('quotes/nofacility')); ?>/"+id,
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal("Success", "Sent with no facility.", "success");
                                    InitTable();
                                },
                                error: function(){
                                    swal("Failed", "Try again later." , "error");
                                },
                            });

                        }
                    });

            });



        } );
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/mytask/index.blade.php ENDPATH**/ ?>