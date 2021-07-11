
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">NECO RESULT TOKEN</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>NECO RESULT TOKEN</h5>
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
          <form action="<?php echo e(route('neco')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <div class="control-group">
                <p style="padding:5px;">Check result here; <a href="https://result.neco.gov.ng/" target="_blank">result.neco.gov.ng</a><br>
                </p>
                <?php if(isset($results)): ?>
                    <?php if($results->code == 100): ?>
                <p><u>Neco Result Token Purchase</u></p>
                <p>Serial No: <?php echo e($results->serial); ?></p>
                <p>Pin: <?php echo e($results->pin); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
                <input name="gneco" type="hidden" id="gneco">
            </div>
            
		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" onclick="return getwaec()" class="btn btn-success" value="Place Order"/>
        </div>

          </form>
        </div>
      </div>
  </div>
</div>
</div>
</div>
</div>


<script type="text/javascript"> Cufon.now(); </script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.slider')._TMS({
				duration:1000,
				easing:'easeOutQuint',
				preset:'diagonalFade',
				slideshow:7000,
				banners:false,
				pauseOnHover:true,
				pagination:true,
				pagNums:false
			});
		});
	</script>
<script language="javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
    
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    
            return false;
    
        }
        return true;
    }
    
    function getwaec(){
    
    var b=confirm("Are you sure you want to proceed?");
    if(b==1){
        document.getElementById('gneco').value="gwa";
        document.getElementById('tbut').value="Please wait...";
        document.form1.submit();
        }
    }
    </script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/neco.blade.php ENDPATH**/ ?>