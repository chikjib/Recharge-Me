<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(config('app.name')); ?> - <?php if(Auth::user()->role == 2): ?> Admin <?php else: ?> Dashboard <?php endif; ?></title>
<meta charset="UTF-8" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-responsive.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/matrix-style.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/matrix-media.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/colorpicker.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/datepicker.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/uniform.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>" />

<link href="<?php echo e(asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.gritter.css')); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script src="<?php echo e(asset('js/cufon-yui.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/cufon-replace.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/FF-cash.js')); ?>" type="text/javascript"></script>	  
<script src="<?php echo e(asset('js/jquery.easing.1.3.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/matrix.popover.js')); ?>"></script> 
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script> 
<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

</head>
<body>

<?php echo $__env->make('layouts.backend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.backend.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.backend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/layouts/backend/master.blade.php ENDPATH**/ ?>