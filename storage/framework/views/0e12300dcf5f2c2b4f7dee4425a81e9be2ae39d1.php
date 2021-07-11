
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Transactions</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Transactions</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Date/Time</th>
                <th>Reference</th>
                <th>Service</th>
                <th>Description</th>
                <th>Destination</th>
                <th>Amount</th>
                <th>Wallet Balance</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
                <?php if($transactions): ?>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="gradeX">
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e(date('D M Y, g:ia',strtotime($transaction->created_at))); ?></td>
                <td><?php echo e($transaction->ref); ?></td>
                <td><?php echo e($transaction->service); ?></td>
                <td><?php echo e($transaction->description); ?></td>
                <td><?php echo e($transaction->destination); ?></td>
                <td>&#8358;<?php echo e(number_format($transaction->amount)); ?></td>
                <td>&#8358;<?php echo e(number_format($transaction->balance)); ?></td>
                <td><?php echo e($transaction->status); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/transactions.blade.php ENDPATH**/ ?>