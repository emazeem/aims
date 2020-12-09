
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Capability Details</h2>
        <a href="" data-toggle="modal" data-target="#add_suggestion"><i class="fa fa-question"></i> Add Suggestion</a>
    </div>

    <div class="col-12">
        <table class="table table-responsive-sm table-hover font-13" width="100%">

            <tr>
                <th width="50%">Name</th>
                <td width="50%"><?php echo e($show->name); ?></td>
            </tr>
            <tr>
                <th>Parameter</th>
                <td><?php echo e($show->parameters->name); ?></td>
            </tr>
            <tr>
                <th>Range</th>
                <td><?php echo e($show->range); ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?php echo e($show->price); ?></td>
            </tr>
            <tr>
                <th>Unit</th>
                <td><?php echo e($show->unit); ?></td>
            </tr>
            <tr>
                <th>Accuracy</th>
                <td><?php echo e($show->accuracy); ?></td>
            </tr>
            <tr>
                <th>Location</th>
                <td class="text-capitalize"><?php echo e($show->location); ?></td>
            </tr>
            <tr>
                <th>Accredited</th>
                <td class="text-capitalize font-weight-bold"><?php echo e($show->accredited); ?></td>
            </tr>

            <tr>
                <th>Remarks</th>
                <td><?php echo e($show->remarks); ?></td>
            </tr>
            <tr>
                <th>Created on</th>
                <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->created_at))); ?></td>
            </tr>
            <tr>
                <th>Updated on</th>
                <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->updated_at))); ?></td>
            </tr>
        </table>

    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="border-bottom text-dark">Suggestions</h2>
    </div>

        <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Capability</th>
                    <th>Parameter</th>
                    <th>Assets</th>
                    <th>Action</th>
                </tr>
                <?php $__currentLoopData = $suggestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(\App\Models\Capabilities::find($suggestion->capabilities)->name); ?></td>
                        <td><?php echo e(\App\Models\Parameter::find($suggestion->parameter)->name); ?></td>
                        <?php $assets=explode(',',$suggestion->optional_assets) ?>
                        <td>
                            <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <small class="badge badge-pill badge-danger"><?php echo e(\App\Models\Asset::find($asset)->name); ?> <b>( <?php echo e(\App\Models\Asset::find($asset)->code); ?> )</b></small>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <form id="delete-suggestion" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($suggestion->id); ?>">
                                <a class="btn btn-outline-danger btn-sm delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '<?php echo e(url('scheduling/tasks/respective-assets')); ?>/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="optassets[]"]').empty();
                            $.each(data, function(index, value) {
                                $('select[name="optassets[]"]').append('<option value="'+ value.id +'">'+ value.code +'-'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="optassets[]"]').empty();
                }
            });
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this suggestion?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var request_method = $("#delete-suggestion").attr("method");
                            var form_data = $("#delete-suggestion").serialize();

                            $.ajax({
                                url: "<?php echo e(route('suggestions.delete')); ?>/",
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

                                    swal('success',data.success,'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function(){
                                    swal("Failed", "Unable to delete." , "error");
                                },
                            });

                        }
                    });

            });
        });


    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <div class="modal fade" id="add_suggestion" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_session">Suggestions</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_suggestion_form" method="post" action="<?php echo e(url('suggestions/create')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Capability</label>
                            <div class="form-group col-12">
                                <input class="form-control " type="hidden" id="capability" name="capability" placeholder="capability" value="<?php echo e($show->id); ?>" autocomplete="off"/>                                   <input class="form-control " placeholder="capability" value="<?php echo e($show->name); ?>" autocomplete="off" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <label for="capability" class="col-12 text-xs control-label">Select Parameter</label>
                            <div class="form-check col-12" style="width: 100%">
                                <select class="form-control" id="parameter" name="parameter">
                                    <option selected disabled="">Select Parameter</option>
                                    <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($parameter->id); ?>"><?php echo e($parameter->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="optassets" class="col-12 text-xs control-label">Select Opt Assets</label>
                            <div class="form-check col-12">
                                <select class="form-control" id="optassets" name="optassets[]" multiple style="width: 100%;font-size: 10px" >

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 text-right">
                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#assets').select2({
            placeholder: 'Select an option'
        });
        $('#optassets').select2({
            placeholder: 'Select optional assets'
        });
        $("select").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/capabilities/show.blade.php ENDPATH**/ ?>