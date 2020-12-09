
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Expenses</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('expenses.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="category" class="col-3 control-label">Select Category</label>
                    <div class="col-9">
                        <select class="form-control" id="category" name="category" >
                            <option value="" selected disabled>Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('category')): ?>
                            <span class="text-danger">
                                        <strong><?php echo e($errors->first('category')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subcategory" class="col-12 control-label">Select Subcategory</label>
                    <div class="col-9">
                        <select class="form-control" id="subcategory" name="subcategory" >
                            <option value="" selected disabled>Select Subcategory</option>
                        </select>
                        <?php if($errors->has('subcategory')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('subcategory')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mt-md-4">
                    <label for="amount" class="col-12 control-label">Amount</label>
                    <div class="col-9">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount" autocomplete="off" value="<?php echo e(old('amount')); ?>">
                        <?php if($errors->has('amount')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('amount')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mt-md-4">
                    <label for="description" class="col-12 control-label">Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="description" autocomplete="off"><?php echo e(old('description')); ?></textarea>
                        <?php if($errors->has('description')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('description')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user" class="col-3 control-label">Handed Over to</label>
                    <div class="col-9">
                        <select class="form-control" id="user" name="user" >
                            <option value="" selected disabled>Select Receiver</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->fname); ?> <?php echo e($user->lname); ?>"><?php echo e($user->fname); ?> <?php echo e($user->lname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('user')): ?>
                            <span class="text-danger">
                                        <strong><?php echo e($errors->first('user')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category"]').on('change', function() {
                var ID = $(this).val();
                if(ID) {
                    $.ajax({
                        url: '/expenses/get_subcategories/'+ID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="subcategory"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="states"]').empty();
                }
            });
        });
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/expenses/create.blade.php ENDPATH**/ ?>