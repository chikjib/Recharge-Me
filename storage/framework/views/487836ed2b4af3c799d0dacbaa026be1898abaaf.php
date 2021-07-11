<!--Action boxes-->
<div class="container-fluid">
    <div class="quick-actions_homepage">
      <div class="alert alert-primary" style="font-weight: 600; font-size:20px;">Welcome, <?php echo e(Auth::user()->name); ?> </div>
        
      <ul class="quick-actions">
        <?php
        $wallet = \DB::table('wallets')->where('user_id',Auth::user()->id)->first();
        ?>
        <li class="bg_lb"> <a href="<?php echo e(route('profile')); ?>"> <i class="icon-user"></i> My Profile </a> </li>
        <li class="bg_lg"> <a href="<?php echo e(route('fundwallet')); ?>"> <i class="icon-money"></i> Fund Wallet</a> </li>

        <li class="bg_lg span3"> <a href="#"> <p style="font-weight: bolder; font-size:20px; padding:4px;">&#8358;<?php echo e(number_format($wallet->amount,2)); ?></p> Account Balance</a> </li>
        
        <li class="bg_lb"> <a href="<?php echo e(route('transactions')); ?>"> <i class="icon-pencil"></i>Transactions</a> </li>
        <li class="bg_lr">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>

          <a href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              <i class="icon icon-key"></i><?php echo e(__('Log out')); ?>

          </a>
      </form>
    </li>

      </ul>
    </div>
    <b>User Type:</b> <?php if(Auth::user()->user_type == 1): ?> End User <?php else: ?> Vendor <?php endif; ?> <br/>
    <b>User Priviledge:</b> <?php if(Auth::user()->role == 1): ?> User <?php else: ?> Admin <?php endif; ?>
  </div>
<!--End-Action boxes-->   <?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/layouts/backend/overview.blade.php ENDPATH**/ ?>