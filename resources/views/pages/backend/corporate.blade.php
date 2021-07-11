@extends('layouts.backend.master')
@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Mtn Corporate Data</a> </div>
@include('layouts.backend.overview')
  <div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Mtn Corporate Data</h5>
        </div>
        <p></p>
        <p style="text-align: center">Instant delivery for Mtn corporate data.<br>						   
        <B>Corporate Balance Check: 
        </B> *131*4# OR *460*260#<br></p>
        <hr/>

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
          <form action="{{ route('corporate') }}" method="post" class="form-horizontal" id="form1">
            @csrf
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
    $data_1GB = DB::table('site_settings')->where('name','mtn_corporate_data_1GB')->first();
    $data_2GB = DB::table('site_settings')->where('name','mtn_corporate_data_2GB')->first();
    $data_3GB = DB::table('site_settings')->where('name','mtn_corporate_data_3GB')->first();
    $data_5GB = DB::table('site_settings')->where('name','mtn_corporate_data_5GB')->first();
    $data_10GB = DB::table('site_settings')->where('name','mtn_corporate_data_10GB')->first();

  ?>
              <label class="control-label">Data:</label>
              <div class="controls">
                <select name="dsize" id="dsize" onChange="getdataamt()" class="span8">
                    <option value="" selected>select</option>
                    
                    @if(Auth::user()->user_type == 1)
                    {{-- End User --}}
                    <option value="c-1000">Gifting 1GB at N{{ $data_1GB->end_user_price }}</option>
                    <option value="c-2000">Gifting 2GB at N{{ $data_2GB->end_user_price }}</option>
                    <option value="c-3000">Gifting 3GB at N{{ $data_3GB->end_user_price }}</option>
                    <option value="c-5000">Gifting 5GB at N{{ $data_5GB->end_user_price }}</option>
                    <option value="c-10000">Gifting 10GB at N{{ $data_10GB->end_user_price }}</option>
                    @else 
                    {{-- Vendor  --}}
                    <option value="c-1000">Gifting 1GB at N{{ $data_1GB->vendor_price }}</option>
                    <option value="c-2000">Gifting 2GB at N{{ $data_2GB->vendor_price }}</option>
                    <option value="c-3000">Gifting 3GB at N{{ $data_3GB->vendor_price }}</option>
                    <option value="c-5000">Gifting 5GB at N{{ $data_5GB->vendor_price }}</option>
                    <option value="c-10000">Gifting 10GB at N{{ $data_10GB->vendor_price }}</option>

                    @endif

                    								 
								 
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
if(dsize1.value == ''){
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
@endsection