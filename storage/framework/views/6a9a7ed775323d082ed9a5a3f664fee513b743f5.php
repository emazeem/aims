
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="row">

        <div class="col-12 mb-2">
            <a href="<?php echo e(url('/customers/edit/'.$show->customer_id)); ?>" class="btn btn-secondary btn-block">
                <?php echo e((!$show->customers->pur_name)?"Add":"Update"); ?>

                <?php echo e($show->customers->reg_name); ?>'s
                Purchase Contact Details
            </a>
        </div>
        <h2 class="col-12">QT/<?php echo e(date('y')); ?>/<?php echo e($show->id); ?> Detail</h2>
        <?php if($show->status>0): ?>
        <?php if(!$show->mode): ?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#approval_card" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e((!$show->mode)?"Add":"Update"); ?> Approval Details / Add Discount</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="approval_card">
                        <div class="card-body">
                            <form action="<?php echo e(url('/quotes/approval_details')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                                    <div class="col-12">
                                        <div class="font-italic form-group p-0 m-0">
                                            <label class="" id="approval_date">Approval Date</label>
                                            <?php
                                            $date=date('Y-m-d');
                                            ?>
                                            <input type="date" class="form-control " id="approval_date" name="approval_date" autocomplete="off" value="<?php echo e(($show->approval_date)?$show->approval_date:$date); ?>">
                                        </div>

                                        <label id="mode">Approval Mode</label>

                                        <div class="form-check form-check-inline" style="width: 100%">
                                            <select class="form-control col-12 " id="mode" name="mode">
                                                <option disabled selected>Select Mode of Approval</option>
                                                <option value="By Email" <?php echo e(($show->mode=="By Email")?"selected":""); ?>>By Email</option>
                                                <option value="By Phone" <?php echo e(($show->mode=="By Phone")?"selected":""); ?>>By Phone</option>
                                                <option value="By PO" <?php echo e(($show->mode=="By PO")?"selected":""); ?>>By PO</option>
                                                <option value="By Walk-in" <?php echo e(($show->mode=="By Walk-in")?"selected":""); ?>>By Walk-in</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label id="details">Approval Details</label>

                                            <input type="text" class="form-control " id="details" name="details" placeholder="Details (PO# for by PO, Email-ID for Email, Name/Phone for by phone or walk-in)" autocomplete="off" value="<?php echo e(($show->details)?$show->details:""); ?>">

                                            <label id="details">PO# for by PO, Email-ID for Email, Name/Phone for by phone or walk-in</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Approve Quote</button>
                            </form>
                            <form action="<?php echo e(route('quotes.discount')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($show->id); ?>">
                                <div class="row py-3">
                                    <div class="col-md-3 col-8">
                                        <div class="font-italic form-group p-0 m-0">
                                            <input type="text" class="form-control " id="discount" name="discount" autocomplete="off" value="" placeholder="Enter % of Discount">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-4">
                                        <button class="btn btn-primary" type="submit">Discount</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php if($show->status!=4): ?>
                
                <?php if($show->customers->pur_name): ?>
                <div class="col-12 text-right">
                    <a title='Revise' class='btn btn-outline-danger revise' href='#' data-id='<?php echo e($show->id); ?>'><i class='fa fa-sync'></i> Revise</a>
                    <a title='Approve' class='btn btn-outline-success approved' href='#' data-id='<?php echo e($show->id); ?>'><i class='fa fa-check'></i> Approve</a>
                </div>
                    <?php endif; ?>
                <form id="form<?php echo e($show->id); ?>" action="" method='post' role='form'>
                    <?php echo csrf_field(); ?>
                    <input name='id' type='hidden' value='<?php echo e($show->id); ?>'>
                </form>

            <?php endif; ?>

        <?php endif; ?>
            <?php elseif($show->status==0): ?>

                <div class="col-12 text-right">
                    <?php if(count($items)>0): ?>
                    <a title='Complete' class='btn btn-outline-primary complete' href='#' data-id='<?php echo e($show->id); ?>'><i class='fa fa-thumbs-up'></i> Mark as Complete</a>
                        <?php endif; ?>
                </div>
        <?php endif; ?>



    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped bg-white table-sm table-bordered mt-2">
                <tr>
                    <td><b>Quote #</b></td>
                    <td><?php echo e($show->id); ?></td>
                </tr>
                <tr>
                    <td><b>Customer</b></td>
                    <td><?php echo e($show->customers->reg_name); ?></td>
                </tr>
                <?php if($show->mode): ?>
                <tr>
                    <td><b>Mode of Approval</b></td>
                    <td><?php echo e($show->mode); ?></td>
                </tr>

                    <tr>
                    <td><b>Details</b></td>
                    <td><?php echo e($show->details); ?></td>
                </tr>
                    <tr>
                    <td><b>Date of Approval</b></td>
                    <td><?php echo e(date('d M, Y',strtotime($show->approval_date))); ?></td>
                </tr>




                <?php endif; ?>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        <?php if($show->status===0): ?>
                            <b class="text-danger">[ Pending ]</b>
                        <?php elseif($show->status===1): ?>
                            <b class="text-danger">[ Awaiting Customer Approval ]</b>
                            <?php elseif($show->status===2): ?>
                            <b class="text-danger">[ Closed ]</b>

                        <?php elseif($show->status===3): ?>
                            <b class="text-muted">[ Approved ]</b>
                        <?php elseif($show->status===4): ?>
                            <b class="text-success">[ Team is working ]</b>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Created on</b></td>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->created_at))); ?></td>
                </tr>
                <tr>
                    <td><b>Updated on</b></td>
                    <td><?php echo e(date('h:i A - d M,Y ',strtotime($show->updated_at))); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 my-2">

            <?php if($show->status==0): ?>
            <a href="<?php echo e(url('/items/create/'.$show->id)); ?>" class='btn btn-sm btn-outline-primary float-right'><i class='fa fa-plus'></i> Items</a>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">

        <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Parameter</th>
                    <th>Capability</th>
                    <th>Location</th>
                    <th>Range</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Parameter</th>
                    <th>Capability</th>
                    <th>Location</th>
                    <th>Range</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
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
            var id='<?php echo e($id); ?>';

            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax":{
                    "url": "<?php echo e(route('items.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": id
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "parameter" },
                    { "data": "capability" },
                    { "data": "location" },
                    { "data": "range" },
                    { "data": "uprice" },
                    { "data": "quantity" },
                    { "data": "sprice" },
                    { "data": "status" },
                    { "data": "options" ,"orderable":false},
                ]

            });

        }
        $(document).ready(function() {
            //InitTable();
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this item?",
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
                                url: "<?php echo e(url('items/delete')); ?>/"+id,
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
                                    swal("Success", "Deleted successfully.", "success");
                                    InitTable();
                                },
                                error: function(){
                                    swal("Failed", "Unable to delete." , "error");
                                },
                            });

                        }
                    });

            });



        } );
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "<?php echo e(url('/items/editNA')); ?>",
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
                        $('#edit_na').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.not_available);
                        $('#edit_quantity').val(data.quantity);
                        //Populating Form Data to Edit Ends
                    },
                    error: function(){},
                });
            });


            $("#edit_na_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('items.updateNA')); ?>",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {

                        if(!data.errors)
                        {

                            swal("Success", "Updated successfully", "success");
                            $('#add_na').modal('hide');
                            location.reload();
                            InitTable();
                        }
                    },
                    error: function()
                    {
                        swal("Failed", "Fields Required. Try again.", "error");
                    }
                });
            }));
        });
        $(document).ready(function() {
            InitTable();
            $(document).on('click', '.approved', function(e)
            {
                swal({
                    title: "Are you sure to approve this quote?",
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
                                url: "<?php echo e(url('quotes/approved')); ?>/"+id,
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
                                    swal("Failed", "Please try again later" , "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.complete', function(e)
            {
                swal({
                    title: "Are you sure to mark this quote as complete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            e.preventDefault();
                            $.ajax({
                                url: "<?php echo e(route('quotes.complete')); ?>",
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    "_token": "<?php echo e(csrf_token()); ?>",
                                    "id": id
                                },
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
                                    swal("Failed", "Please try again later" , "error");
                                },
                            });

                        }
                    });

            });

            $(document).on('click', '.revise', function(e)
            {
                swal({
                    title: "Are you sure to revise this quote?",
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
                                url: "<?php echo e(url('quotes/revised')); ?>/"+id,
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
                                    swal("Failed", "Please try again later" , "error");
                                },
                            });

                        }
                    });
            });
        } );

    </script>

    <div class="modal fade" id="edit_na" tabindex="-1" role="dialog" aria-labelledby="add_na" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_na">Edit Misc.</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_na_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="" name="id" id="edit_id">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Put capability name (not listed)" autocomplete="off" value="<?php echo e(old('name')); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="edit_quantity" name="quantity" placeholder="quantity" autocomplete="off" value="<?php echo e(old('quantity')); ?>">
                            </div>

                            <div class="col-sm-2">
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
    <div class="modal fade bd-example-modal-lg" id="printdetails" tabindex="-1" role="dialog" aria-labelledby="edit_session" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit_session">Add Quote Detail</h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-md-5">

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/quotes/show.blade.php ENDPATH**/ ?>