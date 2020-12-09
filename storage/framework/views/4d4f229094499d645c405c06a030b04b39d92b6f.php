
<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h2 class="border-bottom text-dark">Dashboard</h2>

</div>

<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('customers')); ?>">Customers</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($customers); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('parameters')); ?>"><span class="text-success">Parameters</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($parameters); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('capabilities')); ?>"><span class="text-info">Capabilities</span></a></div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($capabilities); ?></div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('assets')); ?>"><span class="text-warning">Assets</span></a></div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($assets); ?></div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('sessions')); ?>"><span class="text-danger">Quotes</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($quotes); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('jobs')); ?>"><span class="text-primary">Jobs</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($jobs); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a style="text-decoration:none" href="<?php echo e(url('users')); ?>"><span class="text-success">Staff</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($personnels); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="#"><span class="text-dark">My Tasks</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-dark"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a style="text-decoration:none" href="#"><span class="text-primary">Department</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($departments); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="#"><span class="text-dark">Designation</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($designations); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-dark"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/dashboard.blade.php ENDPATH**/ ?>