<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;

class NecoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function index()
    {
        return view('pages.backend.neco');
    }

    public function buy(Request $request)
    {
      $smartno = $request->gneco;
      $email = Auth::user()->email;
    //dd($samt); 
      //$bill_type = "dstv";

      //Initalization
      $api_user = SiteSetting::where('name','api_user_id')->first();
      $api_pass = SiteSetting::where('name','api_pass')->first();
      $neco_amount  = SiteSetting::where('name','neco')->first();
      if(Auth::user()->user_type == 1){
        //End User Type
        $amount = $neco_amount->end_user_price;

      }else{
        //Vendor Type
        $amount = $neco_amount->vendor_price;
      }


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
      $response = file_get_contents("https://mobileairtimeng.com/httpapi/neco?userid=".$api_user_id."&pass=".$api_pass."&jsn=json&user_ref=".$user_ref);
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
              'ref' => $user_ref,
              'service' => 'Neco',
              'description' => "Neco Result Token ".$amount,
              'destination' => Auth::user()->email,
              'amount' => $amount,
              'balance' => $w_balance->amount,
              'status' => "Serial: ".$results->serial." | Pin: ".$results->pin
          ]);

        Mail::raw('Neco Result Token: Serial: '.$results->serial.' | Pin: '.$results->pin, function ($message) {
            $message->from(config('app.email'), config('app.name'));
            $message->to(Auth::user()->email, Auth::user()->name);
            $message->subject('Neco Result Token Purchase');
            $message->priority(3);
        });
          
          
        }

      }

        
        return view('pages.backend.neco',['results' => $results]);
    }
}
