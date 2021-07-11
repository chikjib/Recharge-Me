<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;

class StartimesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function index()
    {
        return view('pages.backend.startimes');
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

        $user_id = $request->userid;
        $pass = $request->pass;

            //Api Request section
        $response = file_get_contents("https://mobileairtimeng.com/httpapi/customercheck?userid=".$user_id."&pass=".$pass."&bill=".$bill."&smartno=".$smartno."&jsn=json");

        return $response;
    }

    public function recharge(Request $request)
    { 
      //dd($amount);
      

      $smartno = $request->ssmart;
      $phone = $request->gphone;
      $amount = $request->samt;
      $amount = explode('|',$amount);
      
      $amount = $amount[1];

      if(Auth::user()->user_type == 1){
        //End User Type
        $added_amt = 70;
      }else{
        //Vendor Type
        $added_amt = 50;
      }
      
      $samt = $amount-$added_amt;
    //dd($samt); 
      //$bill_type = "dstv";

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
      $response = file_get_contents("https://mobileairtimeng.com/httpapi/startimes?userid=".$api_user_id."&pass=".$api_pass."&phone=".$phone."&amt=".$samt."&smartno=".$smartno."&jsn=json&user_ref=".$user_ref);
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
              'description' => "Startimes ".$amount,
              'destination' => $smartno,
              'amount' => $amount,
              'balance' => $w_balance->amount,
              'status' => $results->message
          ]);
          
          
        }

      }

        
        return view('pages.backend.startimes',['results' => $results]);
        
  }
}
