<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Note</title>
    <link rel="stylesheet" href="<?php echo e(url('docs.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<style>
    @media  print {
        #printPageButton {
            display: none;
        }
    }
</style>
<body>
<button onclick="window.print()" id="printPageButton" class="btn btn-danger btn-sm float-right">Print</button>
<div class="container">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="<?php echo e(url('/img/AIMS.png')); ?>" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24 mt-4" style="margin-top: 10px">DELIVERY NOTE


                </p>
            </div>
            <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-BM-FRM-04,</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 06-10-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>

        </div>
        <div class="row py-3">
            <div class="col-3 my-1 font-11">DN#:<span class="custom-bottom-border px-md-5"><?php echo e($job->id); ?></span></div>
            <div class="col-3 my-1 font-11 ">Date:<span class="custom-bottom-border px-md-5"><?php echo e(date('d-m-Y')); ?></span></div>
            <div class="col-6 my-1 font-11 ">Work order / DN # <span class="custom-bottom-border " style="padding-left: 70%"></span></div>
            <div class="col-6 my-1 font-11 ">Customer Name:  <span class="custom-bottom-border px-md-5 "><?php echo e($job->quotes->customers->reg_name); ?></span></div>
            <div class="col-6 my-1 font-11 ">Address:  <span class="custom-bottom-border px-md-5 "><?php echo e($job->quotes->customers->address); ?></span></div>

            <div class="col-12 my-1 font-11 ">Contact Person:  <span class="custom-bottom-border " style="width: 100%;box-sizing: border-box"><?php echo e($job->quotes->principal); ?></span></div>
            <div class="col-6 my-1 font-11 ">Contact #:
                <span class="custom-bottom-border px-md-5">
                    <?php if($job->quotes->principal==$job->quotes->customers->prin_name_1): ?>
                        <?php echo e($job->quotes->customers->prin_phone_1); ?>

                    <?php elseif($job->quotes->principal==$job->quotes->customers->prin_name_1): ?>
                        <?php echo e($job->quotes->customers->prin_phone_2); ?>

                    <?php else: ?>
                        <?php echo e($job->quotes->customers->prin_phone_3); ?>

                    <?php endif; ?>
                </span>
            </div>
            <div class="col-6 my-1 font-11 ">Email:  <span class="custom-bottom-border px-md-5" >
                    <?php if($job->quotes->principal==$job->quotes->customers->prin_name_1): ?>
                        <?php echo e($job->quotes->customers->prin_email_1); ?>

                    <?php elseif($job->quotes->principal==$job->quotes->customers->prin_name_1): ?>
                        <?php echo e($job->quotes->customers->prin_email_2); ?>

                    <?php else: ?>
                        <?php echo e($job->quotes->customers->prin_email_3); ?>

                    <?php endif; ?>
                </span>
            </div>
        </div>
        <div class="col-12 text-center">
            <p class=" font-14 b mt-3">Items received for calibration</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Item Description</th>
                    <th>Equipment ID/Sr #</th>
                    <th>Certificate No.</th>
                    <th>Accessories (if any)</th>
                    <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                <?php $__currentLoopData = $labjobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $labjob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="font-11"><?php echo e($i); ?></td>
                        <?php $i++; ?>
                        <td class="font-11"><?php echo e($labjob->items->capabilities->name); ?></td>
                        <td class="font-11"><?php echo e($labjob->eq_id); ?></td>
                        <td class="font-11"><?php echo e($labjob->certificate); ?></td>
                        <td class="font-11"><?php echo e($labjob->accessories); ?></td>
                        <td class="font-11"><?php echo e($labjob->visual_inspection); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $sitejobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitejob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="font-11"><?php echo e($i); ?></td>
                        <?php $i++; ?>
                        <td class="font-11"><?php echo e($sitejob->items->capabilities->name); ?></td>
                        <td class="font-11"><?php echo e($sitejob->eq_id); ?></td>
                        <td class="font-11"><?php echo e($sitejob->certificate); ?></td>
                        <td class="font-11"><?php echo e($sitejob->accessories); ?></td>
                        <td class="font-11"><?php echo e($sitejob->visual_inspection); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
        <div class="row mt-3">
            <p class="font-10 b">Despatch Check List</p>
            <table class="table table-bordered">

                <tbody>
                <tr>
                    <td>
                        <input type="checkbox"> Equipment with sticker, certificate & Invoice<br>
                        <input type="checkbox"> Equipment with sticker & Certificates<br>
                        <input type="checkbox"> Equipment with sticker<br>
                        <input type="checkbox"> Feedback form dispatched<br>
                        <input type="checkbox"> Equipment only
                    </td>
                    <td>
                        Remarks:
                    </td>
                </tr>
                <tr>
                    <th class="text-center">Handed over by (AIMS Representative)</th>
                    <th class="text-center">Received (in working order) by (Customer Representative)</th>
                </tr>
                <tr>

                    <td class="font-11">
                        <div class="row py-3">
                            <div class="col-3">
                                Signature
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>
                            <div class="col-3">
                                Name
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>
                            <div class="col-3">
                                Date
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>

                        </div>

                    </td>

                    <td class="font-11">
                        <div class="row py-3">
                            <div class="col-3">
                                Signature
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>
                            <div class="col-3">
                                Name
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>
                            <div class="col-3">
                                Date
                            </div>
                            <div class="col-9">
                                <span class="text-right">____________________________</span>
                            </div>

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <p class="col-12 mb-5 custom-border font-11">This document is the property of AIMS Cal Lab. It is not to be retransmitted, printed or copied without prior written permission of the company.</p>
        </div>


    </div>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\aims\resources\views/jobs/deliverynote.blade.php ENDPATH**/ ?>