
<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="border-bottom text-dark">Manage Jobs</h2>
</div>
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
<div class="row">
  <div class="col-lg-12">
      <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Turnaround</th>
        <th>Total Items</th>
          <th>Jobs</th>
        <th>Type</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody class="text-capitalize">
      </tbody>
      <tfoot>
      <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Turnaround</th>
          <th>Total Items</th>
          <th>Jobs</th>
          <th>Type</th>
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
                "url": "<?php echo e(route('jobs.manage.fetch')); ?>",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "<?php echo e(csrf_token()); ?>"}
            },
            "columns": [
                { "data": "id" },
                { "data": "customer" },
                { "data": "turnaround" },
                { "data": "total" },
                { "data": "jobs" },
                { "data": "type" },
                { "data": "options" ,"orderable":false},
            ]
        });
    }
    $(document).ready(function() {
        InitTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/manage/index.blade.php ENDPATH**/ ?>