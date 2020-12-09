
<?php $__env->startSection('content'); ?>
<?php if(Session::has('success')): ?>
    <script>
        $(document).ready(function () {
            swal("Done!", '<?php echo e(Session('success')); ?>', "success");
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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="border-bottom text-dark">All Jobs</h2>
</div>
<div class="row">

  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

      <thead>
      <tr>
        <th>ID</th>
        <th>Quote ID</th>
        <th>Customer</th>
        <th>Type</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Quote ID</th>
          <th>Customer</th>
          <th>Type</th>
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
                "url": "<?php echo e(route('jobs.fetch')); ?>",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "<?php echo e(csrf_token()); ?>"}
            },
            "columns": [
                { "data": "id" },
                { "data": "quote" },
                { "data": "customer" },
                { "data": "type" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]

        });

    }
    $(document).ready(function() {
        InitTable();

    });


</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/jobs/index.blade.php ENDPATH**/ ?>