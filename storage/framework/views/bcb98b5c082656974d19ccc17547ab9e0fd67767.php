
<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Item Entries</h2>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-bordered">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Description</th>
                    <th>Parameter</th>
                    <th>Equipment ID</th>
                    <th>Serial</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Accessories</th>
                    <th>Visual Inspection</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->id); ?></td>
                            <td><?php echo e(\App\Models\Capabilities::find($job->items->capability)->name); ?></td>
                            <td><?php echo e(\App\Models\Parameter::find($job->items->parameter)->name); ?></td>
                            <td>
                                <?php if($job->eq_id): ?>
                                <?php echo e($job->eq_id); ?>

                                    <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->serial): ?>
                                    <?php echo e($job->serial); ?>

                                <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->make): ?>
                                    <?php echo e($job->make); ?>

                                <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->model): ?>
                                <?php echo e($job->model); ?>

                                    <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>




                            <td>
                                <?php if($job->accessories): ?>
                                <?php echo e($job->accessories); ?>

                                    <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->visual_inspection): ?>
                                <?php echo e($job->visual_inspection); ?>

                                    <?php else: ?>
                                    <small class="font-italic text-danger">NULL</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->status==0): ?>
                                    <span class="badge badge-danger">Awaiting</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Checked in</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($job->status==2): ?>
                                    Assigned
                                <?php elseif($job->status==1): ?>
                                    <a href="#" data-id="<?php echo e($job->id); ?>" class="btn edit btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <?php elseif($job->status==0): ?>
                                    <a href="#" data-id="<?php echo e($job->id); ?>" class="btn add btn-danger btn-sm"><i class="fa fa-plus"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Item Description</th>
                    <th>Parameter</th>
                    <th>Equipment ID</th>
                    <th>Serial</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Accessories</th>
                    <th>Visual Inspection</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                $('#add_id').val(id);
                $('#add_details').modal('toggle');
            });
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "<?php echo e(url('awaitings/checkin/edit/')); ?>/"+id,
                    type: "POST",
                    data: {'id': id,_token: '<?php echo e(csrf_token()); ?>'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission deneid for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#edit_details').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_eq_id').val(data.eq_id);
                        $('#edit_make').val(data.make);
                        $('#edit_serial').val(data.serial);
                        $('#edit_model').val(data.model);
                        $('#edit_accessories').val(data.accessories);
                        $('#edit_visualinspection').val(data.visual_inspection);
                        //Populating Form Data to Edit Ends
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");},
                });
            });

            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('checkin.store')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#add_details').modal('toggle');
                            swal('success',data.success,'success').then((value) => {
                                location.reload();
                            });

                        }
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    },
                });
            }));
            $("#edit_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('checkin.store')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#edit_details').modal('toggle');
                            swal('success',data.success,'success').then((value) => {
                                location.reload();
                            });

                        }
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                        },
                });
            }));
        });
    </script>
    <div class="modal fade" id="add_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_details_form">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" value="" id="add_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #" autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="make" name="make" placeholder="make" autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="accessories">Accessories</label>
                                <input type="text" class="form-control" id="model" name="accessories" placeholder="Accessories" autocomplete="off" value="NILL">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="OK">
                            </div>


                            <div class="col-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_details_form">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" value="" id="edit_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="edit_eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="edit_eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="edit_serial" name="serial" placeholder="Serial #" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_model">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="edit_make" name="make" placeholder="make" autocomplete="off" value="">
                            </div>


                            <div class="form-group col-12  float-left">
                                <label for="edit_accessories">Accessories</label>
                                <input type="text" class="form-control" id="edit_accessories" name="accessories" placeholder="Accessories" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="edit_visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="">
                            </div>


                            <div class="col-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/awaiting/quotes.blade.php ENDPATH**/ ?>