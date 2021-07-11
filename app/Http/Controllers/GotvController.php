<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;

class GotvController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function index()
    {
        return view('pages.backend.gotv');
    }

    public function getcustomer(Request $request)
    {
        $bill = $request->bill;
        $smartno = $request->smartno;

        //dd($bill);

        //Initalization
        $api_user = SiteSetting::where('name','api_user_id')->first();
        $api_pass = SiteSetting::where('name','api_pass')->first();

        $api_user_id = $api_user->detail;
        $api_pass = $api_pass->detail;



            //Api Request section
        $response = file_get_contents("https://mobileairtimeng.com/httpapi/customercheck?userid=".$api_user_id."&pass=".$api_pass."&bill=".$bill."&smartno=".$smartno."&jsn=json");

        return $response;
    }

    public function recharge(Request $request)
    { 
      //dd($amount);
      $gsmart = $request->gsmart; 
      $goname = urlencode($request->goname);
      $goinvoice = $request->goinvoice;
      $gocustno = $request->gocustno;
      $amount = $request->samt;
      $gphone = $request->gphone;
      if(Auth::user()->user_type == 1){
        //End User Type
        $added_amt = 70;
      }else{
        //Vendor Type
        $added_amt = 50;
      }
      $samt = $amount-$added_amt;
     
      $bill_type = "gotv";

      //Initalization
      $api_user = SiteSetting::where('name','api_user_id')->first();
      $api_pass = SiteSetting::where('name','api_pass')->first();
      //$remove  = SiteSetting::where('name','airtime')->first();

      $api_user_id = $api_user->detail;
      $api_pass = $api_pass->detail;

      //Generator starts here
      // Available alpha caracters
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

      // generate a pin based on 2 * 7 digits + a random character
      $ref = mt_rand(1000000, 9999999)
          . mt_rand(1000000, 9999999)
          . $characters[rand(0, strlen($characters) - 1)];

      // shuffle the result
      $user_ref = str_shuffle($ref);

      //dd($user_ref);
      //Generator ends here
      
      //Check Wallet
      $wallet_balance = Wallet::where('user_id',Auth::user()->id)->first();

      //dd($wallet_balance);
      if($wallet_balance->amount < $amount){
          $response = '{"code": "203", "message": "Insufficient Balance"}';
          $results = json_decode($response);
        //dd("yes");
      }else{


      //Api Request section
      $response = file_get_contents("https://mobileairtimeng.com/httpapi/multichoice?userid=".$api_user_id."&pass=".$api_pass."&phone=".$gphone."&amt=".$samt."&smartno=".$gsmart."&customer=".$goname."&invoice=".$goinvoice."&billtype=".$bill_type."&customernumber=".$gocustno."&jsn=json");
      $results = json_decode($response);
        //dd($results);

        if($results->code == 100){
          //Update Wallet Table
          $deduction = $wallet_balance->amount - $amount;
          Wallet::where('user_id',Auth::user()->id)->update(['amount' => $deduction]);

          
      $w_balance = Wallet::where('user_id',Auth::user()->id)->first();
          //Create Transaction
          Transaction::create([
              'user_id' => Auth::user()->id,
              'ref' => $results->exchangeReference,
              'service' => 'Cable Subscription',
              'description' => ucwords($bill_type)." ".$amount,
              'destination' => $gsmart,
              'amount' => $amount,
              'balance' => $w_balance->amount,
              'status' => $results->message
          ]);
          
          
        }

      }

        
        return view('pages.backend.gotv',['results' => $results]);
        
  }

}
