
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Market Place</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Market Place</h5>
        </div>
        <p></p>
        <p style="text-align: center">Fast Delivery of Products<br>						   
        <hr/>

        <?php if(session('message')): ?>
            <?php echo session('message'); ?>

        <?php endif; ?>

        <?php if(isset($results)): ?>
          <?php if($results->ok == true): ?>
          <div class="alert alert-success"><?php echo e($results->message); ?></div>
          <?php else: ?>
          <div class="alert alert-danger"><?php echo e($results->description); ?></div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="widget-content nopadding">
          <form action="<?php echo e(route('market')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
           <div class="control-group">
        
                    <label class="control-label">Product:</label>
                    <div class="controls">
                        <select name="product" id="product" class="span8">
                            <option value="" selected>select</option>
                            <?php if(isset($products) == true): ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->product_name); ?> | &#8358;<?php echo e($product->price); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            							 
                    </select>  
                    </div>
        </div>

            <div class="control-group">
              <label class="control-label">Phone Number :</label>
              <div class="controls">
                <input type="text" class="span8" placeholder="Phone Number (WhatsApp or Telegram Phone number)" name="phone" id="phone" />
              </div>
            </div>

            <div class="control-group">
                <label class="control-label">Quantity :</label>
                <div class="controls">
                    <select name="quantity" id="quantity" class="span8">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>


		<div class="form-actions">
            <input name="tbut" type="submit" id="tbut" class="btn btn-success" onclick="return buy()" value="Place Order"/>	
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

function buy(){

var element=document.getElementById('product');
var phone=document.getElementById('phone').value;
var product1=document.getElementById('product');
var quantity=document.getElementById('quantity').value;
phone = phone.replace(/\s+/g, '');

if(product1.value == ''){
    alert("Please select a product");
    return false;
}

if(isNaN(phone)){
	alert("Please enter a Whatsapp or a Telegram phone number.");
	return false;
}


if(phone.length<11 || phone.length>11){
	alert("Please enter a Whatsapp or a Telegram phone number.");
	return false;
}

var product = element.options[ element.selectedIndex ].text;
var conf=confirm("Are you sure you want to buy " + product + " x " + quantity +" using " + phone +"?");
if(conf==0){
	return false;
}
document.getElementById('tbut').value="Please wait...";
document.form1.submit();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/market.blade.php ENDPATH**/ ?>