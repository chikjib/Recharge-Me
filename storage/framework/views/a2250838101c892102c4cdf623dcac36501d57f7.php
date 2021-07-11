
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('admin')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5>Users</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>S/N</th>
                <th>User Type</th>
                <th>Name</th>
                <th>Email</th>
                <th>State</th>
                <th>Phone</th>
                <th>Wallet Balance</th>
                <th>Payment Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php if($users): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="gradeX">
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php if($user->user_type == 1): ?> End User <?php else: ?> Vendor <?php endif; ?></td>
                <td><?php echo e($user->name); ?></a></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->state); ?></td>
                <td><?php echo e($user->phone); ?></td>
               
                <td>&#8358;<?php echo e(number_format($user->amount,2)); ?> | <a href="/admin/users/topup/<?php echo e($user->user_id); ?>">Top Up</a></td>
                <td><?php if($user->payment_status == 0 AND $user->user_type == 1): ?> End User (Free) 
                    <?php elseif($user->payment_status == 1 AND $user->user_type == 2): ?> Paid 
                    <?php elseif($user->payment_status == 0 AND $user->user_type == 2): ?> UnPaid
                    <?php endif; ?>
                </td>
                <td>
                  <a href="/admin/users/update/<?php echo e($user->id); ?>">Edit</a> | <span class="delete" style="color: red;" data-id="<?php echo e($user->id); ?>">Delete </span>
                </td>
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

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {

$('.data-table').on("click", ".delete", function() {
                                var el = this;

                                // Delete id
                                var delete_id = $(this).data('id');
                                var confirmalert = confirm("Are you sure you want to delete?");
                                if (confirmalert == true) {
                                    
                                $.ajax({

                                    url: "/admin/users/delete",

                                    type: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },

                                    data: {
                                        delete_id: delete_id,
                                    },

                                    success: function(data) {
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function() {
                                                $(this).remove();
                                        });
                                        //alert(data.result.message);

                                            },



                                        });
                                    }

                                });
  });
                      </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/users.blade.php ENDPATH**/ ?>