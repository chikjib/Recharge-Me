
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Mtn Data Share</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Mtn Data Share</h5>
        </div>
        <p></p>
        <p style="text-align: center">Instant delivery for SME data.<br>						   
        <B>SME Balance Check: </B>  *461*4#<br></p>
        <hr/>

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
          <form action="<?php echo e(route('datashare')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <div class="control-group">
              <label class="control-label">Network: </label>
              <div class="controls">
                <select name="network" id="network" class="span8">                              
									  <option value="1">MTN</option>
									</select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Phone Number :</label>
              <div class="controls">
                <input type="text" class="span8" placeholder="Phone Number" name="phone" id="phone" />
              </div>
            </div>
<div class="control-group">
  <?php
    $data_1GB = DB::table('site_settings')->where('name','mtn_data_share_1GB')->first();
    $data_2GB = DB::table('site_settings')->where('name','mtn_data_share_2GB')->first();
    $data_3GB = DB::table('site_settings')->where('name','mtn_data_share_3GB')->first();
    $data_5GB = DB::table('site_settings')->where('name','mtn_data_share_5GB')->first();
  ?>
              <label class="control-label">Data:</label>
              <div class="controls">
                <select name="dsize" id="dsize" onChange="getdataamt()" class="span8">
                    <option value="" selected>select</option>
                    <?php if(Auth::user()->user_type == 1): ?>
                    
                    <option value="s-1000">SME 1GB at N<?php echo e($data_1GB->end_user_price); ?></option>
                    <option value="s-2000">SME 2GB at N<?php echo e($data_2GB->end_user_price); ?></option>
                    <option value="s-3000">SME 3GB at N<?php echo e($data_3GB->end_user_price); ?></option>
                    <option value="s-5000">SME 5GB at N<?php echo e($data_5GB->end_user_price); ?></option>
                    <?php else: ?> 
                    
                    <option value="s-1000">SME 1GB at N<?php echo e($data_1GB->vendor_price); ?></option>
                    <option value="s-2000">SME 2GB at N<?php echo e($data_2GB->vendor_price); ?></option>
                    <option value="s-3000">SME 3GB at N<?php echo e($data_3GB->vendor_price); ?></option>
                    <option value="s-5000">SME 5GB at N<?php echo e($data_5GB->vendor_price); ?></option>

                    <?php endif; ?>								 
               </select>  
              </div>
            </div>

		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" class="btn btn-success" onclick="return topup()" value="Place Order"/>	
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

function topup(){

var element=document.getElementById('dsize');
var phone=document.getElementById('phone').value;
var dsize1=document.getElementById('dsize');
phone = phone.replace(/\s+/g, '');

if(phone.length<11 || phone.length>11){
	alert("Please enter phone number.");
	return false;
}
if(isNaN(phone)){
	alert("Please enter phone number.");
	return false;
}
if(dsize1.value==''){
  alert("Select a data size.");
  return false;
}

var dsize = element.options[ element.selectedIndex ].text;
var conf=confirm("Are you sure you want to send " + dsize + " to " + phone +"?");
if(conf==0){
	return false;
}
document.getElementById('tbut').value="Please wait...";
document.form1.submit();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/datashare.blade.php ENDPATH**/ ?>