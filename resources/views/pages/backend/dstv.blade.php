@extends('layouts.backend.master')
@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Dstv</a> </div>
@include('layouts.backend.overview')
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Dstv Recharge</h5>
        </div>

        @if(session('message'))
            {!! session('message') !!}
        @endif

        @if(isset($results))
          @if($results->code == 100)
          <div class="alert alert-success">{{ $results->message}}</div>
          @else
          <div class="alert alert-danger">{{ $results->message}}</div>
          @endif
        @endif

        <div class="widget-content nopadding">
          <form action="{{ route('dstv') }}" method="post" class="form-horizontal" id="dstv">
            @csrf
            <div class="control-group">
              <label class="control-label">Smart Card no: </label>
              <div class="controls">
                <input type="text" value="" id="gsmart" name="gsmart" onchange="return restme('dstv')"  />
              </div>
              <div class="control-group">
                  <p style="text-align: justify; padding:10px;">Please confirm customer information before recharging.</p>
                  <div id="cust-gotv" style=" background-color:#FFFFCC; padding: 10px; text-align:justify;" ></div>

                  <div class="controls">
              
              <input type="button" value="Customer Check" onclick="return gocustomer('dstv',document.getElementById('gsmart').value)" class="btn btn-primary" />
                </div>
              </div>
            <div class="control-group">
              <label class="control-label">Recharge Type:</label>
              <div class="controls">
                <input name="goname" id="goname" type="hidden" value=""> 
                <input name="goinvoice" id="goinvoice" type="hidden" value="">
                <input name="gocustno" id="gocustno" type="hidden" value="">
                <select name="samt" id="samt"   >
                  @if(Auth::user()->user_type == 1)
                    {{-- End User --}}
                    <option value=7970>DStv Compact N7970</option>
                <option value=6270>DStv Compact Asian Add-on N6270</option>
                <option value=3330>DStv Compact French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Compact French Plus N8170</option>
                <option value=2370>DStv Compact French Touch N2370</option>
                <option value=2570>DStv Compact HDPVR/XtraView N2570</option>
                <option value=12470>DStv Compact Plus N12470</option>
                <option value=6270>DStv Compact Plus Asian Add-on N6270</option>
                <option value=3330>DStv Compact Plus French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Compact Plus French Plus N8170</option>
                <option value=2370>DStv Compact Plus French Touch N2370</option>
                <option value=2570>DStv Compact Plus HDPVR/XtraView N2570</option>
                <option value=18470>DStv Premium N18470</option>
                <option value=6270>DStv Premium Asian Add-on N6270</option>
                <option value=3330>DStv Premium French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Premium French Plus N8170</option>
                <option value=2370>DStv Premium French Touch N2370</option>
                <option value=2570>DStv Premium HDPVR/XtraView N2570</option>
                <option value=20570>DStv Premium Asia N20570</option>
                <option value=3330>DStv Premium Asia French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Premium Asia French Plus N8170</option>
                <option value=2370>DStv Premium Asia French Touch N2370</option>
                <option value=2570>DStv Premium Asia HDPVR/XtraView N2570</option>
                <option value=6270>Asian Bouqet N6270</option>
                <option value=3330>Asian Bouqet French 11 Bouquet E36 N3330</option>
                <option value=8170>Asian Bouqet French Plus N8170</option>
                <option value=2370>Asian Bouqet French Touch N2370</option>
                <option value=2570>Asian Bouqet HDPVR/XtraView N2570</option>
                <option value=2625>DStv Yanga Bouquet E36 N2625</option>
                <option value=6270>DStv Yanga Bouquet E36 Asian Add-on N6270</option>
                <option value=3330>DStv Yanga Bouquet E36 French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Yanga Bouquet E36 French Plus N8170</option>
                <option value=2370>DStv Yanga Bouquet E36 French Touch N2370</option>
                <option value=2570>DStv Yanga Bouquet E36 HDPVR/XtraView N2570</option>
                <option value=4685>DStv Confam Bouquet E36 N4685</option>
                <option value=6270>DStv Confam Bouquet E36 Asian Add-on N6270</option>
                <option value=3330>DStv Confam Bouquet E36 French 11 Bouquet E36 N3330</option>
                <option value=8170>DStv Confam Bouquet E36 French Plus N8170</option>
                <option value=2370>DStv Confam Bouquet E36 French Touch N2370</option>
                <option value=2570>DStv Confam Bouquet E36 HDPVR/XtraView N2570</option>
                <option value=1920>Padi N1920</option>
                <option value=6270>Padi Asian Add-on N6270</option>
                <option value=3280>Padi French 11 Bouquet E36 N3380</option>
                <option value=8170>Padi French Plus N8170</option>
                <option value=2370>Padi French Touch N2370</option>
                <option value=2570>Padi HDPVR/XtraView N2570</option>
                <option value=25620>DStv Premium French N25620</option>
                <option value=2570>DStv Premium French HDPVR/XtraView N2570</option>
                @else
                {{-- Vendor --}}
                <option value=7950>DStv Compact N7950</option>
                <option value=6250>DStv Compact Asian Add-on N6250</option>
                <option value=3310>DStv Compact French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Compact French Plus N8150</option>
                <option value=2350>DStv Compact French Touch N2350</option>
                <option value=2550>DStv Compact HDPVR/XtraView N2550</option>
                <option value=12450>DStv Compact Plus N12450</option>
                <option value=6250>DStv Compact Plus Asian Add-on N6250</option>
                <option value=3310>DStv Compact Plus French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Compact Plus French Plus N8150</option>
                <option value=2350>DStv Compact Plus French Touch N2350</option>
                <option value=2550>DStv Compact Plus HDPVR/XtraView N2550</option>
                <option value=18450>DStv Premium N18450</option>
                <option value=6250>DStv Premium Asian Add-on N6250</option>
                <option value=3310>DStv Premium French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Premium French Plus N8150</option>
                <option value=2350>DStv Premium French Touch N2350</option>
                <option value=2550>DStv Premium HDPVR/XtraView N2550</option>
                <option value=20550>DStv Premium Asia N20550</option>
                <option value=3310>DStv Premium Asia French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Premium Asia French Plus N8150</option>
                <option value=2350>DStv Premium Asia French Touch N2350</option>
                <option value=2550>DStv Premium Asia HDPVR/XtraView N2550</option>
                <option value=6250>Asian Bouqet N6250</option>
                <option value=3310>Asian Bouqet French 11 Bouquet E36 N3310</option>
                <option value=8150>Asian Bouqet French Plus N8150</option>
                <option value=2350>Asian Bouqet French Touch N2350</option>
                <option value=2550>Asian Bouqet HDPVR/XtraView N2550</option>
                <option value=2605>DStv Yanga Bouquet E36 N2605</option>
                <option value=6250>DStv Yanga Bouquet E36 Asian Add-on N6250</option>
                <option value=3310>DStv Yanga Bouquet E36 French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Yanga Bouquet E36 French Plus N8150</option>
                <option value=2350>DStv Yanga Bouquet E36 French Touch N2350</option>
                <option value=2550>DStv Yanga Bouquet E36 HDPVR/XtraView N2550</option>
                <option value=4665>DStv Confam Bouquet E36 N4665</option>
                <option value=6250>DStv Confam Bouquet E36 Asian Add-on N6250</option>
                <option value=3310>DStv Confam Bouquet E36 French 11 Bouquet E36 N3310</option>
                <option value=8150>DStv Confam Bouquet E36 French Plus N8150</option>
                <option value=2350>DStv Confam Bouquet E36 French Touch N2350</option>
                <option value=2550>DStv Confam Bouquet E36 HDPVR/XtraView N2550</option>
                <option value=1900>Padi N1900</option>
                <option value=6250>Padi Asian Add-on N6250</option>
                <option value=3260>Padi French 11 Bouquet E36 N3360</option>
                <option value=8150>Padi French Plus N8150</option>
                <option value=2350>Padi French Touch N2350</option>
                <option value=2550>Padi HDPVR/XtraView N2550</option>
                <option value=25600>DStv Premium French N25600</option>
                <option value=2550>DStv Premium French HDPVR/XtraView N2550</option>
                @endif
                			
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
				//console.log(resp['message']);
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
    
@endsection