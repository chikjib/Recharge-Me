<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;


class AirtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('vendor');
    }
    
    public function index()
    {
        return view('pages.backend.airtime'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recharge(Request $request)
    {
        //
        //Initalization
        $api_user = SiteSetting::where('name','api_user_id')->first();
        $api_pass = SiteSetting::where('name','api_pass')->first();
        $airtime_discount = SiteSetting::where('name','airtime')->first();

        $api_user_id = $api_user->detail;
        $api_pass = $api_pass->detail;

        $network = $request->network;
        $amount = $request->amt;
        $phone = $request->phone;

        //dd($amount);
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
//API CALL
        $response = file_get_contents("https://mobileairtimeng.com/httpapi/?userid=".$api_user_id."&pass=".$api_pass."&network=".$network."&phone=".$phone."&amt=".$amount."&user_ref=".$user_ref."&jsn=json");
        
        $results = json_decode($response);

          if($results->code == 100){
            //Update Wallet Table
            if(Auth::user()->user_type == 1){
              //End User Type
              $airtime_discount_price  = $airtime_discount->end_user_price;
            }else{
              //Vendor Type
              $airtime_discount_price  = $airtime_discount->end_user_price;
            }
            $amount = $amount - ($amount*$airtime_discount_price);
            $deduction = $wallet_balance->amount - $amount;
            Wallet::where('user_id',Auth::user()->id)->update(['amount' => $deduction]);

            //Remodify input of network
            if($network == 15 OR $network == 30 OR $network == 20 OR $network == 25){
              $description = "MTN";
            }elseif ($network == 6) {
              $description = "GLO";
            }elseif ($network == 1) {
              $description = "AIRTEL";
            }elseif ($network == 2) {
              $description = "9Mobile";
            }
//API CALL STATUS
        $status = file_get_contents("https://mobileairtimeng.com/httpapi/status?userid=".$api_user_id."&pass=".$api_pass."&transid=".$user_ref);
        
        $status = json_decode($status);

        $w_balance = Wallet::where('user_id',Auth::user()->id)->first();
            //Create Transaction
            Transaction::create([
                'user_id' => Auth::user()->id,
                'ref' => $user_ref,
                'service' => 'airtime',
                'description' => $description." ".$amount,
                'destination' => $phone,
                'amount' => $amount,
                'balance' => $w_balance->amount,
                'status' => $status->message
            ]);
            
            
          }

        }

          
          return view('pages.backend.airtime',['results' => $results]);
          
    }

   
}
