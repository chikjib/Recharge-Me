
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Airtime Top Up</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Airtime Top Up</h5>
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
          <form action="<?php echo e(route('airtime')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <div class="control-group">
              <label class="control-label">Network: </label>
              <div class="controls">
                <select name="network" id="network" class="span8">                              
									  <option value="">Select</option>
									  <option value="15">MTN VTU</option>
									  <option value="30">MTN Share N Sell</option>
									   <option value="20">MTN AWUFU</option>
									  <option value="25">MTN Wallet (Retailer)</option>									  
									  <option value="6">Glo</option>
									  <option value="1">Airtel</option>							  
									  <option value="2">9Mobile</option>
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
              <label class="control-label">Amount :</label>
              <div class="controls">
                <input type="text" class="span5" placeholder="Amount" name="amt" id="amt" onKeyPress="return isNumber(event)"  />
              </div>
            </div>

		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" class="btn btn-success" onclick="return topup()" value="Top up"/>	
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
var phone=document.getElementById('phone').value;
var amt=document.getElementById('amt').value;
var element=document.getElementById('network');
var network=document.getElementById('network');

if(network.value==''){
	alert("Select network.");
	return false;
}

if(amt ==''){
	alert("Add an amount.");
	return false;
}

phone = phone.replace(/\s+/g, '');

if(phone.length<11 || phone.length>11){
	alert("Please enter phone number.");
	return false;
}

if(isNaN(phone)){
	alert("Please enter phone number.");
	return false;
}

document.getElementById('phone').value=phone;


if(network.value=='20' && amt<2000){
	//alert("Minimum recharge on MTN Premium is 2,000 at 4.2% discount.");
	//exit;
}
if(network.value=='25' && amt<10){
	//alert("Minimum recharge on MTN VTU wallet is 2,000 at 5% discount.");
	//exit;
}

if(network.value=='30' && (amt<50 || amt>5000 )){
	alert("Minimum recharge is 50 and maximum is 5000.");
	return false;
}

var dnet = element.options[ element.selectedIndex ].text;

var conf=confirm("Top up "+ phone + " with "+ dnet+ " N"+amt +"?");
//console.log(conf);
if(conf==false){
	return false;
}
document.getElementById('tbut').value="Please wait...";
document.form1.submit();
}


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/airtime.blade.php ENDPATH**/ ?>