
<?php $__env->startSection('content'); ?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<?php if(Auth::user()->role == 2): ?>
<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              <div class="chart"></div>
            </div>
            <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo e($users->count()); ?></strong> <small>Total Users</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong><?php echo e($new_users->count()); ?></strong> <small>New Users </small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong><?php echo e($orders->count()); ?></strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong><?php echo e($pending_orders->count()); ?></strong> <small>Pending Orders</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
<?php endif; ?>
    <hr/>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Latest Posts</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <?php if($posts): ?>
              <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <div class="user-thumb"> <img width="40" height="40" alt="User" src="/uploads/post_images/<?php echo e($post->featured_image); ?>"> </div>
                <div class="article-post"> <span class="user-info"> By: <?php echo e($post->author); ?> / Date: <?php echo e(date('d M Y',strtotime($post->created_at))); ?> / Time: <?php echo e(date('g:i A',strtotime($post->created_at))); ?></span>
                  <p><a href="#"><?php echo illuminate\Support\Str::words($post->body, 50, '...'); ?></a> </p>
                </div>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              
                <a href="<?php echo e(route('blog')); ?>" class="btn btn-warning btn-mini">View All</a>
              </li>
            </ul>
          </div>
        </div>
        
        
      </div>

    </div>
  </div>
</div>

<!--end-main-container-part-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/dashboard.blade.php ENDPATH**/ ?>