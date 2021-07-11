
<?php $__env->startSection('content'); ?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="<?php echo e(route('dashboard')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Direct Data Bundle</a> </div>
<?php echo $__env->make('layouts.backend.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Direct Data Bundle</h5>
        </div>
        <p></p>
        <p style="text-align: center"><b>To Check Data balance:</b> <br/>
            <b>Airtel:</b> *123*10# or *140#, <b>Etisalat:</b> *228#, <b>MTN:</b> *131*4# <b>GLO:</b> *127*0#<br>						   
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
          <form action="<?php echo e(route('direct_data')); ?>" method="post" class="form-horizontal" id="form1">
            <?php echo csrf_field(); ?>
            <div class="control-group">
              <label class="control-label">Network: </label>
              <div class="controls">
                <select name="network" id="network" onChange="getnewbundles(this.value)" class="span8">
                    <option value="none" selected>Select</option>
                    <option value="airtel">Airtel</option>							  
                    <option value="9mobile">9Mobile</option>
                    <option value="mtn">MTN</option>
                    <option value="glo">GLO</option>
                  </select>
              </div>
            </div>
            <div class="control-group">
            <div id='dataloader' class="span8" style=" color: #000099; display: none">Loading data bundles...</div>
            </div>

            <div class="control-group">
              <label class="control-label">Data Bundles/Price:</label>
              <div class="controls">
                <select name="bundles" id="bundles" onchange="getprice(this)">
                    <option value="0" selected >Select</option>
                    </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Phone Number :</label>
              <div class="controls">
                <input type="text" class="span8" placeholder="Phone Number" name="phone" id="phone" />
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
    //var amt=document.getElementById('amt').value;
    var element=document.getElementById('network');
    var element1=document.getElementById('bundles');
    
    if(element1.value=='0'){
        alert("No data bundle selected.");
        return false;
    }
    
    if(phone.length<11 || phone.length>11){
        alert("Please enter phone number.");
        return false;
    }
    if(phone.length<11 || phone.length>11){
        alert("Incorrect Phone number.");
        return false;
    }
    if(isNaN(phone)){
        alert("Please enter phone number.");
        return false;
    }
    
    var b=element1.value;
    var dnet = element.options[ element.selectedIndex ].text + " " +element1.options[ element1.selectedIndex ].text ;
    var conf=confirm("Data Top up for "+ phone + " with "+ dnet +"?");
    if(conf==0){
        return false;
    }
    
    document.getElementById('tbut').value="Please wait...";
    document.form1.submit();
    }
    
    function getnewbundles(a){
        var xhttp;
        if(a=='none'){
            alert('select network');
            return false;
        }
        
        document.getElementById('dataloader').style.display='block';
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              
              var resp=JSON.parse(this.responseText);
              var resp1 = resp['products'];
              //console.log(resp1);
              //var info=resp.split("|");
              var info=resp1;
              
              var ncount=info.length;
              //console.log(ncount);

              if(ncount<1){
                 document.getElementById('bundles').options.length = 0;
                    var x = document.getElementById("bundles");
                    var option = document.createElement("option");
                    option.value = 0;
                    option.innerHTML = "Select";
                    x.add(option);	
                    document.getElementById('dataloader').style.display='none';
                    alert("Cannot load bundles!");
                }
                else{
                     document.getElementById('bundles').options.length = 0;
                    var x = document.getElementById("bundles");
                    var option = document.createElement("option");
                    option.value = 0;
                    option.innerHTML = "Select";
                    x.add(option);
                    
                    var icont;
                    var icont1;
                    var dvalue;
                    var dtext;
                    var disprice;
                    var mdis=getmydis(a);				
                    for (var i=0; i<ncount; i++){
                        icont=info[i];
                        //icont1=icont.split("*");
                        icont1=icont;
                        //console.log(icont1);
                        dvalue=icont1['data'];
                        //console.log(dvalue);
                        disprice = icont1['amount'];

                        realprice = icont1['amount'];
                        realprice1 = realprice.toFixed(2);
                        //console.log(disprice);
                        disprice=disprice-(disprice*mdis);
                        //console.log(disprice);
                        disprice1 = disprice.toFixed(2);
                        //console.log(disprice1);
                        if(a=='airtel'){
                            dtext=dvalue +" at " + disprice1+" Naira";
                        }
                        else{
                            dtext=dvalue +" at " + disprice+" Naira";
                        }					
                        var option = document.createElement("option");
                        if(a=='airtel'){
                          option.value = realprice1;
                        }
                        else{
                          option.value = realprice;
                        }
                        option.innerHTML = dtext;
                        x.appendChild(option);
                    }			
                }
                  document.getElementById('dataloader').style.display='none';
            }	
        };
        var code="?datanet=" + a;
        xhttp.open("GET", "/dashboard/get-direct-data-bundles"+code, true);
        xhttp.send();   
    
    }

    function getprice(selectObject) {
      var value = selectObject.value;  
      //console.log(value);
    }


    var user_type="<?php echo Auth::user()->user_type; ?>";
    
    function getmydis(net){
        var bdis=0;
        if(net=='mtn'){
          if(user_type == 1){
            bdis="0.02";
          }else{
            bdis="0.03";
          }
             
        }
        else if(net=='glo'){
          if(user_type == 1){
            bdis="0.035";
          }else{
            bdis="0.040";
          }
        }
        else if(net=='airtel'){
          if(user_type == 1){
            bdis="0.02";
          }else{
            bdis="0.03";
          }
        }
        else if(net=='9mobile'){
          if(user_type == 1){
            bdis="0.020";
          }else{
            bdis="0.030";
          }
        }
        
        return bdis;
    }
    
    
    </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mywebsites\rechargeme\resources\views/pages/backend/direct_data.blade.php ENDPATH**/ ?>