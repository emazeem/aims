<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WORKSHEET</title>
    <link rel="stylesheet" href="<?php echo e(url('docs.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <div class="col-2 text-center custom-border">
                <img src="<?php echo e(asset('/img/AIMS.png')); ?>" class="mt-2 ml-2" width="100">
            </div>
        <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 10px">Calibration Worksheet
                    <br>
                    ( <?php echo e($job->items->capabilities->parameters->name); ?> )
                </p>
            </div>
        <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-TM-FRM-09a</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 01-01-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>
        <div class="col-6 mt-4">
            <table class="table table-bordered">

                <tbody>
                <tr>
                    <th class="font-11" width="30%">Request #:</th>
                    <td class="font-11" width="70%"><?php echo e($quote->details); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Job #:</th>
                    <td class="font-11"><?php echo e($mainjob->id); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Certificate #:</th>
                    <td class="font-11"></td>
                </tr>

                <tr>
                    <th class="font-11" colspan="2">Details of Unit Under Calibration:</th>
                </tr>
                <tr>
                    <th class="font-11">UUC:</th>
                    <td class="font-11"><?php echo e($job->items->capabilities->name); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Make:</th>
                    <td class="font-11"><?php echo e($job->make); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Model:</th>
                    <td class="font-11"><?php echo e($job->model); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Serial#:</th>
                    <td class="font-11"><?php echo e($job->serial); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Asset/ID#:</th>
                    <td class="font-11"><?php echo e($job->eq_id); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Accuracy:</th>
                    <td class="font-11"><?php echo e($job->accuracy); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Cal Range:</th>
                    <td class="font-11"><?php echo e($job->range); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Resolution:</th>
                    <td class="font-11"><?php echo e($job->resolution); ?></td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-6 mt-4">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" width="30%">Customer Name :</th>
                    <td class="font-11"  width="70%"><?php echo e($quote->customers->reg_name); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Address :</th>
                    <td class="font-11"><?php echo e($quote->customers->address); ?></td>
                </tr>

                <tr>
                    <th class="font-11" colspan="2">Environmental Details :</th>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Temperature :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11"><?php echo e($entries->start_temp); ?> C</td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11"><?php echo e($entries->end_temp); ?> C</td>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Humidity :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <th class="font-11" colspan="2">Atmospheric Pressure :</th>
                </tr>
                <tr>
                    <td class="font-11">Start :</td>
                    <td class="font-11"></td>
                </tr>
                <tr>
                    <td class="font-11">End :</td>
                    <td class="font-11"></td>
                </tr>

                </tbody>
            </table>

        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" width="20%">Location :</th>
                    <td class="font-11" width="80%"><?php echo e($entries->location); ?></td>
                </tr>
                <tr>
                    <th class="font-11">Calibration Date :</th>
                    <td class="font-11"><?php echo e(date('d-M-y',strtotime($entries->created_at))); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="6">Details of Calibration Standards Used :</th>
                </tr>
                <tr>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                    <th class="font-11">ID # </th>
                </tr>
                <tr>
                    <?php $assets=explode(',',$job->assign_assets);$i=0; ?>
                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <td class="font-11" width="16%"><?php echo e(\App\Models\Asset::find($asset)->code); ?></td>
                         <?php $i++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php for($x=$i;$x < 6; $x++): ?>
                         <td class="font-11" <?php echo e(($x!=5)?'width="16%"':''); ?>>-</td>
                    <?php endfor; ?>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11">Calibration Method(s) Used : <span class="font-weight-normal"><?php echo e($job->items->capabilities->procedures->name); ?> <span class="mx-5"></span><?php echo e($job->items->capabilities->procedures->description); ?></span></th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-bordered ">
                <tbody>
                <colgroup>
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                    <col width="16.66%"><col width="16.66%">
                </colgroup>
                <tr>
                    <th class="font-11" colspan='60'>Measured Observations :</th>
                </tr>
                <tr>
                    <td class="font-11"  colspan='15'>Cal. Range :</td>
                    <td class="font-11"  colspan='15'><?php echo e($job->range); ?></td>
                    <td class="font-11"  colspan='15'>Accuracy of UUC :</td>
                    <td class="font-11"  colspan='15'><?php echo e($job->accuracy); ?></td>
                </tr>
                <tr>
                    <td class="font-11" colspan="30">Resolution / Readability of UUC :</td>
                    <td class="font-11" colspan="30"><?php echo e($job->resolution); ?></td>
                </tr>
                <tr>
                    <td class="font-11" colspan="12">Offset of UUC :</td>
                    <td class="font-11" colspan="12">Before Adjustment</td>
                    <td class="font-11" colspan="12"><?php echo e($entries->before_offset); ?></td>
                    <td class="font-11" colspan="12">After Adjustment</td>
                    <td class="font-11" colspan="12"><?php echo e($entries->after_offset); ?></td>
                </tr>
                <tr>
                    <th class="font-11 text-center py-2" colspan="50" >Readings on the
                        <?php if($entries->fixed_type=='UUC'): ?>
                            Reference Standard
                        <?php else: ?>
                            UUC
                        <?php endif; ?>
                        :</th>
                    <th class="font-11 text-center" colspan="10" rowspan="2" >Reading on <br> ( <?php echo e($entries->fixed_type); ?> )</th>
                </tr>

                <tr>
                    <td class="font-11 text-center" colspan="10">x1 ↓</td>
                    <td class="font-11 text-center" colspan="10">x2 ↑</td>
                    <td class="font-11 text-center" colspan="10">x3 ↓</td>
                    <td class="font-11 text-center" colspan="10">x4 ↑</td>
                    <td class="font-11 text-center" colspan="10">x5 ↓</td>
                </tr>
                <tr class="text-center">
                    <td class="font-11" colspan="50"> (<?php echo e(\App\Models\Unit::find($entries->unit)->unit); ?>) </td>
                    <td class="font-11" colspan="10" >(<?php echo e(\App\Models\Unit::find($entries->unit)->unit); ?>)</td>
                </tr>
                <?php $__currentLoopData = $entries->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->x1); ?></td>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->x2); ?></td>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->x3); ?></td>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->x4); ?></td>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->x5); ?></td>
                        <td class="font-11 text-center" colspan="10"><?php echo e($entry->fixed_value); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="2">Signatures </th>
                    <th class="font-11">Date </th>
                </tr>
                <tr>
                    <td class="font-11">Calibrated By</td>
                    <td class="font-11">-</td>
                    <td class="font-11"><?php echo e(date('d-M-y')); ?></td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="col-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="font-11" colspan="2">Signatures </th>
                    <th class="font-11">Date </th>
                </tr>
                <tr>
                    <td class="font-11">Checked By</td>
                    <td class="font-11">-</td>
                    <td class="font-11"><?php echo e(date('d-M-y')); ?></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\aims\resources\views/mytask/worksheet.blade.php ENDPATH**/ ?>