
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Settings</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Update Settings</h5>
        </div>
        <div class="widget-content nopadding">
            <?php if(session('message')): ?>
            <?php echo session('message'); ?>

        <?php endif; ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Price (End Users)</th>
                <th>Price (Vendor Users)</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
                <form action="<?php echo e(route('updateSettings')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                <?php if($settings): ?>
                <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="gradeX">
                <td><?php echo e($loop->iteration); ?></td>
                <td><input type="text" name="name[]" value="<?php echo e($setting->name); ?>" style="pointer-events:none;"></td>
                <td><input type="number" name="end_user_price[]" value="<?php echo e($setting->end_user_price); ?>"></td>
                <td><input type="number" name="vendor_price[]" value="<?php echo e($setting->vendor_price); ?>"></td>
                <td><textarea name="detail[]"><?php echo e($setting->detail); ?></textarea></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <div class="form-actions">
              <input type="submit" class="btn btn-success" value="Save Changes">
              </div>
                </form>
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
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/settings.blade.php ENDPATH**/ ?>