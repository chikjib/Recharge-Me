
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Topup Wallet</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Top Up Wallet</h5>
        </div>

        <?php if(session('message')): ?>
            <?php echo session('message'); ?>

        <?php endif; ?>

        <?php if(isset($results)): ?>
          <?php if($results->code == 100): ?>
          <div class="alert alert-success"><?php echo e($results->message); ?></div>
          <?php else: ?>
          <div class="alert alert-danger"><?php echo e($results->message); ?></div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="widget-content nopadding">
            <p style="padding: 5px;"> Previous Wallet Balance : &#8358;<?php echo e(number_format($wallet->amount,2)); ?>

          <form action="<?php echo e(route('topupWallet')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="user_id" value="<?php echo e($wallet->id); ?>">
            <div class="control-group">
                <label class="control-label">Amount :</label>
                <div class="controls">
                  <input type="number" class="span8" placeholder="Amount" name="amount" />
                </div>
              </div>

		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" class="btn btn-success" value="Save Changes"/>	
        </div>

          </form>
        </div>
      </div>
  </div>
</div>
</div>
</div>
</div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/topup.blade.php ENDPATH**/ ?>