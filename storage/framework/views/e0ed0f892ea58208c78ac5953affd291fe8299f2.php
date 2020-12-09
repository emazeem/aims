
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="row">
        <h2 class="border-bottom text-dark">Calculator</h2>
    </div>
    <div class="col-12 mt-5">
        <form class="form-horizontal" action="<?php echo e(route('data_entry.create')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" value="<?php echo e($show->id); ?>" name="jobtypeid">
            <input type="hidden" value="<?php echo e($location); ?>" name="jobtype">
            <input type="hidden" value="<?php echo e($show->items->capabilities->procedure); ?>" name="procedure">
            <div class="form-group row">
                <label for="assets" class="col-sm-3 control-label">Assets</label>
                <select class="form-control col-md-9" id="assets" name="assets">
                    <option selected disabled>Assets</option>
                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($asset->id); ?>"><?php echo e($asset->name); ?> (<?php echo e($asset->code); ?>) (<?php echo e($asset->range); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('assets')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('assets')); ?></strong></span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="units" class="col-sm-3 control-label">Units</label>
                <select class="form-control col-md-9" id="units" name="units">
                    <option selected disabled>Select Unit</option>
                </select>
                <?php if($errors->has('units')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('units')); ?></strong></span>
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="start_temp" class="col-md-3 col-12 control-label">Start Temperature</label>
                <input type="text" class="form-control col-md-9 col-12" id="start_temp" name="start_temp"
                       placeholder="Start Temperature" autocomplete="off" value="<?php echo e(old('start_temp')); ?>">
                <?php if($errors->has('start_temp')): ?>
                    <span class="text-danger">
                                <strong><?php echo e($errors->first('start_temp')); ?></strong>
                            </span>
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="end_temp" class="col-md-3 col-12 control-label">End Temperature</label>
                <input type="text" class="form-control col-md-9 col-12" id="end_temp" name="end_temp"
                       placeholder="End Temperature" autocomplete="off" value="<?php echo e(old('end_temp')); ?>">
                <?php if($errors->has('end_temp')): ?>
                    <span class="text-danger">
                                <strong><?php echo e($errors->first('end_temp')); ?></strong>
                            </span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="uuc_resolution" class="col-md-3 col-12 control-label">UUC Resolution</label>
                <input type="text" class="form-control col-md-9 col-12" id="uuc_resolution" name="uuc_resolution"
                       placeholder="UUC Resolution" autocomplete="off" value="<?php echo e(old('uuc_resolution')); ?>">
                <?php if($errors->has('uncertainty')): ?>
                    <span class="text-danger">
                                <strong><?php echo e($errors->first('uuc_resolution')); ?></strong>
                            </span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="accuracy" class="col-md-3 col-12 control-label">Accuracy of UUC</label>
                <input type="text" class="form-control col-md-9 col-12" id="accuracy" name="accuracy"
                       placeholder="Accuracy of UUC" autocomplete="off" value="">
                <?php if($errors->has('accuracy')): ?>
                    <span class="text-danger">
                        <strong><?php echo e($errors->first('accuracy')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="range" class="col-md-3 col-12 control-label">Range of UUC</label>
                <input type="text" class="form-control col-md-9 col-12" id="range" name="range"
                       placeholder="Range of UUC" autocomplete="off" value="">
                <?php if($errors->has('range')): ?>
                    <span class="text-danger">
                        <strong><?php echo e($errors->first('range')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="location" class="col-md-3 col-12 control-label">Location of UUC</label>
                <input type="text" class="form-control col-md-9 col-12" id="location" name="location"
                       placeholder="Location of UUC" autocomplete="off" value="">
                <?php if($errors->has('location')): ?>
                    <span class="text-danger">
                        <strong><?php echo e($errors->first('location')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>


            <div class="form-group row">
                <label for="before_offset" class="col-md-3 col-12 control-label">Offset of UUC (Before
                    Adjustment)</label>
                <input type="text" class="form-control col-md-9 col-12" id="before_offset" name="before_offset"
                       placeholder="Offset" autocomplete="off" value="0">
                <?php if($errors->has('before_offset')): ?>
                    <span class="text-danger">
                        <strong><?php echo e($errors->first('before_offset')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <label for="after_offset" class="col-md-3 col-12 control-label">Offset of UUC (After Adjustment)</label>
                <input type="text" class="form-control col-md-9 col-12" id="after_offset" name="after_offset"
                       placeholder="Offset" autocomplete="off" value="0">
                <?php if($errors->has('after_offset')): ?>
                    <span class="text-danger">
                        <strong><?php echo e($errors->first('after_offset')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form-group row">
                <label for="fixed" class="col-sm-3 control-label">Single / Fixed Value</label>
                <select class="form-control col-md-9" id="fixed" name="fixed">
                    <option selected disabled>Single / Fixed Value</option>
                    <option value="UUC">UUC</option>
                    <option value="Ref">Ref Std</option>
                </select>
                <?php if($errors->has('fixed')): ?>
                    <span class="text-danger"><strong><?php echo e($errors->first('fixed')); ?></strong></span>
                <?php endif; ?>
            </div>
            <div class="row cal-inputs" style="display: none">
                <div class="col-md-3 col-12">
                    <h6 id="left"></h6>
                </div>
                <div class="col-md-9 col-12">
                    <h6 id="right"></h6>
                </div>
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Fixed Value</td>
                        <td>X<sub>1</sub></td>
                        <td>X<sub>2</sub></td>
                        <td>X<sub>3</sub></td>
                        <td>X<sub>4</sub></td>
                        <td>X<sub>5</sub></td>
                        <td><i class="fa fa-plus-circle"></i></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="text" name="fixed_value[]" class="form-control"/>
                            <?php if($errors->has('fixed_value')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('fixed_value')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="x1[]" class="form-control"/>
                            <?php if($errors->has('x1')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('x1')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="x2[]" class="form-control"/>
                            <?php if($errors->has('x2')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('x2')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="x3[]" class="form-control "/>
                            <?php if($errors->has('x3')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('x3')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="x4[]" class="form-control "/>
                            <?php if($errors->has('x4')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('x4')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="text" name="x5[]" class="form-control "/>
                            <?php if($errors->has('x5')): ?>
                                <span class="text-danger">
                                    <strong><?php echo e($errors->first('x5')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="deleteRow"></a>
                            <i id="addrow" class="fa fa-plus-circle text-primary mt-2 text-lg"></i>
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
            </div>
            <div class="box-footer">
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {

            $('select[name="assets"]').on('change', function () {
                var parameter = $(this).val();
                if (parameter) {
                    $.ajax({
                        url: '/units/units_of_assets/' + parameter,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="units"]').empty();

                            $('select[name="units"]').append('<option disabled selected>Select Respective Units</option>');
                            $.each(data, function (key, value) {
                                $('select[name="units"]').append('<option value="' + value.id + '">' + value.unit + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="units"]').empty();
                }
            });
            $('select[name="fixed"]').on('change', function () {
                var fixed = $(this).val();
                if (fixed == 'UUC') {
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "UUC");
                    $('#left').text('Values observed on UUC');
                    $('#right').text('Values observed on Reference');
                }
                if (fixed == 'Ref') {
                    $('.cal-inputs').show();
                    $("#fixed_value").attr("placeholder", "Reference");
                    $('#left').text('Values observed on Reference');
                    $('#right').text('Values observed on UUC');
                }
            });
        });


        $(document).ready(function () {
            var counter = 0;

            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control" name="fixed_value[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x1[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x2[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x3[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x4[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="x5[]"/></td>';
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

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/calculator/create.blade.php ENDPATH**/ ?>