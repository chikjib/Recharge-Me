
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Gotv</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Gotv Recharge</h5>
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
          <form action="<?php echo e(route('gotv')); ?>" method="post" class="form-horizontal" id="gotv">
            <?php echo csrf_field(); ?>
            <div class="control-group">
              <label class="control-label">IUC no: </label>
              <div class="controls">
                <input type="text" value="" id="gsmart" name="gsmart" onchange=" return restme('gotv')"  />
              </div>
              <div class="control-group">
                  <p style="text-align: justify; padding:10px;">Please confirm customer information before recharging.</p>
                  <div id="cust-gotv" style=" background-color:#FFFFCC; padding: 10px; text-align:justify;" ></div>

                  <div class="controls">
              
              <input type="button" value="Customer Check" onclick="return gocustomer('gotv',document.getElementById('gsmart').value)" class="btn btn-primary" />
                </div>
              </div>
            <div class="control-group">
              <label class="control-label">Recharge Type:</label>
              <div class="controls">
                <input name="goname" id="goname" type="hidden" value=""> 
                <input name="goinvoice" id="goinvoice" type="hidden" value="">
                <input name="gocustno" id="gocustno" type="hidden" value="">
                <select name="samt" id="samt"   >
					<?php if(Auth::user()->user_type == 1): ?>
					
					<option value=870>GOtv Smallie - Monthly N870</option>
                    <option value=2170>GOtv Smallie - Quarterly N2170</option>
                    <option value=6270>GOtv Smallie - Yearly N6270</option>
                    <option value=3670>GOtv Max N3670</option>
                    <option value=1710>GOtv Jinja Bouquet N1710</option>
                    <option value=2530>GOtv Jolli Bouquet N2530</option>
					<?php else: ?>
					
					<option value=850>GOtv Smallie - Monthly N850</option>
                    <option value=2150>GOtv Smallie - Quarterly N2150</option>
                    <option value=6250>GOtv Smallie - Yearly N6250</option>
                    <option value=3650>GOtv Max N3650</option>
                    <option value=1690>GOtv Jinja Bouquet N1690</option>
                    <option value=2510>GOtv Jolli Bouquet N2510</option>
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

		<div class="form-actions">
            <input type="submit" onclick="return gopaygotv()" value="Recharge" class="btn btn-success" />
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


function gopaygotv(){
var phone=document.getElementById('gphone').value;
var smartno=document.getElementById('gsmart').value;
var amt=document.getElementById('samt').value;

if(!IsNumeric(smartno)){
		//navigator.notification.alert('Invalid smart card no!');
		alert('Invalid smart card no');
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

if(amt<0){
		//navigator.notification.alert('Minimun amount is N600 and maximun is N3,600');
		alert('Select amount!');
		return false;
	}

if(confirmed==0){
	alert('Please check customer details!');
	return false;
}

var conf=confirm("Recharge Dstv ("+smartno+") with N"+amt+"?");
if(conf==0){
	return false;
}
document.dstv.submit();
 
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
		return false;
	}
	if(a=='startimes'){
		did='cust-startimes';
	}
	else if(a=='gotv' || a=='dstv' ){
		did='cust-gotv';
	}
	
	confirmed=0;
	document.getElementById(did).innerHTML="checking...";
	if (ajxbool==true){		
		ajx.onreadystatechange=function(){
			if(ajx.readyState==4){	
				//slert("CXX");
				var resp=JSON.parse(ajx.responseText);
				//console.log(resp);
				if(resp['message']=="failed"){
					document.getElementById(did).innerHTML="Cannot load details!";
					confirmed=0;
				}
				else{														
					if(a=='gotv' || a=='dstv'){
						var res = resp;
						var info=res;
						//console.log(res);
						if(a=='gotv' || a=='dstv' ){
							document.getElementById('goname').value=res['customerName'];
							document.getElementById('goinvoice').value=res['invoice'];
							document.getElementById('gocustno').value=res['customerNumber'];
						}
						document.getElementById(did).innerHTML= "<b>Name: </b> " +res['customerName'] + "<br/> <b>Status: </b> " + res['status'] + "<br/> <b>Due Date: </b>" + res['dueDate'];
					}
					else{
						document.getElementById(did).innerHTML=resp;
					}
							
					confirmed=1;				
				}
			}
		}
		var code="?bill=" + a + "&smartno="+b ;
		var pga="/dashboard/billcustomer_check" + code;
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
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/gotv.blade.php ENDPATH**/ ?>