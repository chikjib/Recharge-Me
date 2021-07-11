
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Profile</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
  <div class="container-fluid">
    <?php if(isset($results) == true): ?>
    <?php if($results->code == 100): ?>
    <div class="alert alert-success" style="padding: 10px;"><?php echo e($results->message); ?></div>
    <?php else: ?>
    <div class="alert alert-danger" style="padding: 10px;"> <?php echo e($results->message); ?></div>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if($errors->any): ?>
  
      
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="alert alert-danger" style="padding: 10px;"><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
  
  <?php endif; ?>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Account Settings</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="<?php echo e(route('update_profile')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <div class="control-group">
                <label class="control-label">Name :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Name" name="name" id="name" value="<?php echo e(Auth::user()->name); ?>" required />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email Address :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Email Address" name="email" id="email" value="<?php echo e(Auth::user()->email); ?>" disabled required style="pointer-events: none;" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Phone :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Phone Number" name="phone" id="phone" value="<?php echo e(Auth::user()->phone); ?>" disabled required style="pointer-events: none;"/>
                </div>
              </div>
            
		<div class="form-actions">
            <input type="submit" class="btn btn-success" value="Save"/>
        </div>

          </form>
        </div>
      </div>
  </div>
  <div class="span6">
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
      <h5>Password Settings</h5>
    </div>  

    <div class="widget-content nopadding">
      <form action="<?php echo e(route('update_password')); ?>" method="post" class="form-horizontal" id="form1">
        <?php echo csrf_field(); ?>
        <div class="control-group">
            <label class="control-label">Old Password :</label>
            <div class="controls">
              <input type="password" class="span11" placeholder="Old Password" name="old_password" id="old_password" required />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">New Password :</label>
            <div class="controls">
              <input type="password" class="span11" placeholder="New Password" name="password" id="password" required />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Confirm Password :</label>
            <div class="controls">
              <input type="password" class="span11" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" required />
            </div>
          </div>
        
<div class="form-actions">
        <input type="submit" class="btn btn-success" value="Save"/>
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
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/profile.blade.php ENDPATH**/ ?>