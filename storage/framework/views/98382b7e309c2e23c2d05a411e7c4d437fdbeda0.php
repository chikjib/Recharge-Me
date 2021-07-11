
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Startimes</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Startimes Recharge</h5>
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
          <form action="<?php echo e(route('startimes')); ?>" method="post" class="form-horizontal" id="startimes">
            <?php echo csrf_field(); ?>
            <div class="control-group">
              <label class="control-label">Smart Card no: </label>
              <div class="controls">
                <input type="text" value="" id="ssmart" name="ssmart" onchange=" return restme('startimes')" />
            </div>
              <div class="control-group">
                  <p style="text-align: justify; padding:10px;">Please confirm customer information before recharging.</p>
                  <div id="cust-startimes" style=" background-color:#FFFFCC; padding: 10px; text-align:justify;" ></div>

                  <div class="controls">
              
              <input type="button" value="Customer Check" onclick="return gocustomer('startimes',document.getElementById('ssmart').value)" class="btn btn-primary" />
                </div>
              </div>
            <div class="control-group">
              <label class="control-label">Recharge Type:</label>
              <div class="controls">
                <select name="samt" id="samt"   >
					<?php if(Auth::user()->user_type == 1): ?>
					
                    <option value=nova|970.00>Nova - 970 Naira - 1 Month</option>
                    <option value=basic|1770.00>Basic - 1,770 Naira - 1 Month</option>
                    <option value=smart|2270.00>Smart - 2,270 Naira - 1 Month</option>
                    <option value=classic|2570.00>Classic - 2,570 Naira - 1 Month</option>
                    <option value=super|4270.00>Super - 4,270 Naira - 1 Month</option>
                    <option value=nova-weekly|370.00>Nova - 370 Naira - 1 Week</option>
                    <option value=basic-weekly|670.00>Basic - 670 Naira - 1 Week</option>
                    <option value=smart-weekly|770.00>Smart - 770 Naira - 1 Week</option>
                    <option value=classic-weekly|1270.00>Classic - 1270 Naira - 1 Week </option>
                    <option value=super-weekly|1570.00>Super - 1,570 Naira - 1 Week</option>
                    <option value=nova-daily|160.00>Nova - 160 Naira - 1 Day</option>
                    <option value=basic-daily|230.00>Basic - 230 Naira - 1 Day</option>
                    <option value=smart-daily|270.00>Smart - 270 Naira - 1 Day</option>
                    <option value=classic-daily|390.00>Classic - 390 Naira - 1 Day </option>
                    <option value=super-daily|470.00>Super - 470 Naira - 1 Day</option>	
					<?php else: ?>
					
					<option value=nova|950.00>Nova - 950 Naira - 1 Month</option>
                    <option value=basic|1750.00>Basic - 1,750 Naira - 1 Month</option>
                    <option value=smart|2250.00>Smart - 2,250 Naira - 1 Month</option>
                    <option value=classic|2550.00>Classic - 2,550 Naira - 1 Month</option>
                    <option value=super|4250.00>Super - 4,250 Naira - 1 Month</option>
                    <option value=nova-weekly|350.00>Nova - 350 Naira - 1 Week</option>
                    <option value=basic-weekly|650.00>Basic - 650 Naira - 1 Week</option>
                    <option value=smart-weekly|750.00>Smart - 750 Naira - 1 Week</option>
                    <option value=classic-weekly|1250.00>Classic - 1250 Naira - 1 Week </option>
                    <option value=super-weekly|1550.00>Super - 1,550 Naira - 1 Week</option>
                    <option value=nova-daily|140.00>Nova - 140 Naira - 1 Day</option>
                    <option value=basic-daily|210.00>Basic - 210 Naira - 1 Day</option>
                    <option value=smart-daily|250.00>Smart - 250 Naira - 1 Day</option>
                    <option value=classic-daily|370.00>Classic - 370 Naira - 1 Day </option>
                    <option value=super-daily|450.00>Super - 450 Naira - 1 Day</option>
					<?php endif; ?>				
                </select>  
            </div>
            </div>

            <div class="control-group">
              <label class="control-label">Phone Number :</label>
              <div class="controls">
                <input type="text" value="" id="gphone" name="gphone"  />   
             </div>
            </div>
            <input type="hidden" value="" id="confstar" name="confstar"  />

		<div class="form-actions">
            <input type="submit" onclick="return gopaystar()" value="Recharge" class="btn btn-success" />
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

function selectbill(b){
if(b=='none'){
	document.getElementById('startimes').style.display='none';
	document.getElementById('gotv').style.display='none';
	document.getElementById('dstv').style.display='none';
}
else if(b=='startimes'){
	document.getElementById('startimes').style.display='block';
	document.getElementById('gotv').style.display='none';
	document.getElementById('dstv').style.display='none';
}
else if(b=='gotv'){
	document.getElementById('startimes').style.display='none';
	document.getElementById('gotv').style.display='block';
	document.getElementById('dstv').style.display='none';
}
else if(b=='dstv'){
	document.getElementById('startimes').style.display='none';
	document.getElementById('gotv').style.display='none';
	document.getElementById('dstv').style.display='block';
} 

}


function gopaystar(){

var amt=document.getElementById('samt');
var smartno=document.getElementById('ssmart').value;
var phone=document.getElementById('gphone').value;

var txt=amt.options[ amt.selectedIndex ].text;

if(!IsNumeric(smartno)){
		//navigator.notification.alert('Invalid smart card no!');
		alert('Invalid smart card no');
		return false;
	}

if(confirmed==0){
	alert('Please check customer details!');
	return false;
}

if(phone.length<11 || phone.length>11){
	//navigator.notification.alert("Incorrect Phone number.");
	alert('Incorrect phone number');
	return false;
}
if(!IsNumeric(phone)){
		//navigator.notification.alert('Unrecognized Phone Number.');
		alert('Unrecognized phone number');
		return false;
	}

var conf=confirm("Recharge Startimes ("+smartno+") with "+txt+"?");
if(conf==0){
	return false;
}
document.startimes.submit();
 
  
}

function IsNumeric(strString)

   //  check for valid numeric strings	

   {

   var strValidChars = "0123456789.-";

   var strChar;

   var blnResult = true;



   if (strString.length == 0) return false;

   for (i = 0; i < strString.length && blnResult == true; i++)

      {

      strChar = strString.charAt(i);

      if (strValidChars.indexOf(strChar) == -1)

         {

         blnResult = false;

         }

      }

   return blnResult;

   }



var ajx;
var ajxbool;

try{
	ajx=new XMLHttpRequest();
	ajxbool=true;
} catch(e){
	ajx=new ActiveXObject("Microsoft.XMLHTTP");
	ajxbool=true;
}

var confirmed=0;

function gocustomer(a,b){
	var did;
	if(b==''){		
		exit;
	}
	if(a=='startimes'){
		did='cust-startimes';
	}
	else if(a=='gotv'){
		did='cust-gotv';
	}
	else if(a=='dstv'){
		did='cust-dstv';
	}
	
	confirmed=0;
	document.getElementById(did).innerHTML="checking...";
	if (ajxbool==true){		
		ajx.onreadystatechange=function(){
			if(ajx.readyState==4){	
				//slert("CXX");
				var resp=JSON.parse(ajx.responseText);
				console.log(resp);
				var res = resp; 
				if(res['code']!="100"){
					document.getElementById(did).innerHTML="Error loading details!";
					confirmed=0;
				}
				else{						
					var rname=res['customerName'];							
					var rbal=res['balance'];
					var combo="<b>Name:</b> " + rname + "<br><b>Balance:</b> " + rbal;
					document.getElementById(did).innerHTML=combo;
					confirmed=1;				
				}
			}
		}
		var code="?bill=" + a + "&smartno="+b +"&userid=840826&pass=web" ;
		//var pga="httpapi/billcustomer_check.php" + code;
		var pga="/dashboard/customercheck" + code;
		ajx.open ("GET",pga,true);
		ajx.send(null);
	}	
	
}

function restme(a){
	if(a=='startimes'){
		did='cust-startimes';
	}
	else if(a=='gotv'){
		did='cust-gotv';
	}
	else if(a=='dstv'){
		did='cust-dstv';
	}
	
	document.getElementById(did).innerHTML="";
	confirmed=0;
}

</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/startimes.blade.php ENDPATH**/ ?>