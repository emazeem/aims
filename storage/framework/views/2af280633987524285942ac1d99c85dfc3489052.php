
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function() {
                swal("Done!",'<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Error & Uncertainty</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="<?php echo e(route('manageref.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label for="parameter" class="col-2 control-label">Select Parameter</label>
                    <div class="col-10">
                        <select class="form-control" id="parameter" name="parameter" >
                            <option value="" selected disabled>Select Parameter</option>
                            <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($parameter->id); ?>"><?php echo e($parameter->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('parameter')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('parameter')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="assets" class="col-2 control-label">Select Assets</label>
                    <div class="col-10">
                        <select class="form-control" id="assets" name="assets" >
                            <option value="" selected disabled>Select Assets</option>
                        </select>
                        <?php if($errors->has('assets')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('assets')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="units" class="col-2 control-label">Select Units</label>
                    <div class="col-10">
                        <select class="form-control" id="units" name="units" >
                            <option value="" selected disabled>Select Units</option>
                        </select>
                        <?php if($errors->has('units')): ?>
                            <span class="text-danger">
                                <strong><?php echo e($errors->first('units')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Unit Under Calibration</td>
                        <td>Reference Standard</td>
                        <td>Uncertainty</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>

                            <input type="text" name="uuc[]"  class="form-control"/>

                        </td>
                        <td>
                            <input type="text" name="reference[]"  class="form-control"/>
                            <?php if($errors->has('reference')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('reference')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="uncertainty[]"  class="form-control "/>
                            <?php if($errors->has('uncertainty')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('uncertainty')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td >
                            <a class="deleteRow"></a>
                            <i  id="addrow" class="fa fa-plus-circle text-primary mt-2 text-lg"></i>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><?php if($errors->has('uuc')): ?>
                                <span class="text-danger">
                                <strong><?php echo e($errors->first('uuc')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </td>

                    </tr>
                    </tfoot>
                </table>



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
            $('select[name="parameter"]').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    "url": "<?php echo e(url('/parameters/view_assets')); ?>",
                    type: "POST",
                    data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        //$(".loader").fadeIn();
                    },
                    statusCode: {
                        403: function() {

                        }
                    },
                    success: function(data)
                    {
                        $('select[name="assets"]').empty();
                        $('select[name="assets"]').append('<option disabled selected>Select Asset</option>');
                        $.each(data, function(key, value) {
                            $('select[name="assets"]').append('<option value="'+ value.id +'">'+ value.name +' - '+ value.code +'</option>');
                        });
                    },
                    error: function(){
                        $('select[name="assets"]').empty();
                    },
                });
            });
            $('select[name="assets"]').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    "url": "<?php echo e(url('/parameters/view_units')); ?>",
                    type: "POST",
                    data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        //$(".loader").fadeIn();
                    },
                    statusCode: {
                        403: function() {

                        }
                    },
                    success: function(data)
                    {
                        $('select[name="units"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="units"]').append('<option value="'+ value.id +'">'+ value.unit +'</option>');
                        });
                    },
                    error: function(){
                        $('select[name="units"]').empty();
                    },
                });
            });

        });










        $(document).ready(function () {
            var counter = 0;

            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control" name="uuc[]" value="'+$('input[name="uuc[]"]').val()+'"/></td>';
                cols += '<td><input type="text" class="form-control" name="reference[]" value="'+$('input[name="reference[]"]').val()+'"/></td>';
                cols += '<td><input type="text" class="form-control" name="uncertainty[]" value="'+$('input[name="uncertainty[]"]').val()+'"/></td>';
                cols += '<td><i class="ibtnDel fa fa-times-circle mt-2 text-lg text-danger"></i></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });



            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1
            });


        });



        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();

        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function () {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/reference_errors/create.blade.php ENDPATH**/ ?>