
<?php $__env->startSection('content'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            $(document).ready(function () {
                swal("Done!", '<?php echo e(Session('success')); ?>', "success");
            });
        </script>
    <?php endif; ?>
    <div class="col-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 p-2">
            <h2 class="border-bottom text-dark">Invoicing Ledger</h2>

            <a href="" class="btn btn-secondary"><i class="fa fa-print"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-danger font-weight-bold"><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <div class="card shadow mb-4">

                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h5 class="m-0 font-weight-bold text-primary"> Advance Filter <i class="fa fa-search"></i></h5>
                </a>
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body">
                        <div class="col-12 text-right">
                            <form action="<?php echo e(route('clear.filter')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Clear Filter</button>
                            </form>
                        </div>
                        <form method="post" action="<?php echo e(route('search')); ?>" role="form">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <div class="form-check ml-md-5">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="show" value="customer_radio">Customer
                                    </label>
                                    <label class="form-check-label ml-md-5">
                                        <input type="radio" class="form-check-input" name="show" value="tax_radio">Tax
                                    </label>
                                    <label class="form-check-label ml-md-5">
                                        <input type="radio" class="form-check-input" name="show" value="none_radio">None
                                    </label>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="daterange" class="col-sm-2 control-label">Select date range</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="daterange" id="daterange" value="<?php echo e($oldest); ?> - <?php echo e($latest); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="customer_div" style="display: none">
                                <label for="customer" class="col-sm-2 control-label">Customer</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="customer" name="customer">
                                        <option selected disabled>Select Customer</option>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->reg_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div id="taxtype_div" style="display: none">
                                <div class="form-group row">
                                    <label for="taxtype" class="col-sm-2 control-label">Tax Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="taxtype" name="taxtype">
                                            <option selected disabled>Select Text Type</option>
                                            <option value="service">Service Tax</option>
                                            <option value="income">Income Tax</option>
                                        </select>
                                        <?php if($errors->has('taxtype')): ?>
                                            <span class="text-danger">
                                        <strong><?php echo e($errors->first('taxtype')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <label for="taxby" class="col-sm-2 control-label">Tax payed/deducted</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="taxby" name="taxby">
                                            <option selected disabled>Tax payed/deducted</option>
                                            <option value="AIMS">By AIMS</option>
                                            <option value="Source">At Source</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div id="service_div" style="display: none">
                                <div class="form-group row">
                                    <label for="region" class="col-sm-2 control-label">Select region</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline" style="width: 100%">
                                            <select class="form-control" id="region" name="region">
                                                <option selected disabled>Select region</option>
                                                <option value="PRA">PRA</option>
                                                <option value="SRB">SRB</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Job<br>#</th>
                    <th>Services<br> Charges</th>
                    <th>Services<br> Tax Type</th>
                    <th>Services<br> Tax Amount</th>
                    <th>Income Tax <br>Percent</th>
                    <th>Income Tax<br> Amount</th>
                    <th>Service Tax <br>Payed</th>
                    <th>Income Tax <br>Payed</th>
                    <th>Net <br>Receivable</th>
                    <th>Confirmed <br>by</th>
                    <th>Invoice <br>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize text-center">
                </tbody>
                <tfoot class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Job<br>#</th>
                    <th>Services<br> Charges</th>
                    <th>Services<br> Tax Type</th>
                    <th>Services<br> Tax Amount</th>
                    <th>Income Tax <br>Percent</th>
                    <th>Income Tax<br> Amount</th>
                    <th>Service Tax <br>Payed</th>
                    <th>Income Tax <br>Payed</th>
                    <th>Net <br>Receivable</th>
                    <th>Confirmed <br>by</th>
                    <th>Invoice <br>Date</th>
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
/*                "lengthMenu": [[-1], ["All"]],*/
                "ajax":{
                    "url": "<?php echo e(route('invoicing_ledger.fetch')); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "customer" },
                    { "data": "job_id" },
                    { "data": "service_charges" },
                    { "data": "services_tax_type" },
                    { "data": "services_tax_amount" },
                    { "data": "income_tax_percent" },
                    { "data": "income_tax_amount" },
                    { "data": "service_tax_deducted" },
                    { "data": "income_tax_deducted" },
                    { "data": "net_receivable" },
                    { "data": "confirmed_by" },
                    { "data": "invoice" },
                    { "data": "options" ,"orderable":false},

                ]
            });
        }
        $(document).ready(function() {
            InitTable();

            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            $("input[name$='show']").click(function(){
                if ($(this).val()=='customer_radio'){
                    $('#customer_div').show();
                    $('#taxtype_div').hide();
                    $('#service_div').hide();
                }
                if ($(this).val()=='tax_radio'){
                    $('#customer_div').hide();
                    $('#taxtype_div').show();
                }
                if ($(this).val()=='none_radio'){
                    $('#customer_div').hide();
                    $('#taxtype_div').hide();
                }


            });
            $('#taxtype').on('change', function() {
                if (this.value=='service'){
                    $('#service_div').show();
                }
                if (this.value=='income'){
                    $('#service_div').hide();
                }

            });
        });

    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\aims\resources\views/invoicingledger/index.blade.php ENDPATH**/ ?>