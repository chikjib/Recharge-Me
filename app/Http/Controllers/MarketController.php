<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\MarketPlace;

class MarketController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('vendor');
    }
    
    public function index()
    {
        $products = MarketPlace::all();
        return view('pages.backend.market',['products' => $products]);
    }

    public function buy(Request $request)
    {
         //
        //Initalization
        $api_user = SiteSetting::where('name','api_user_id')->first();
        $api_pass = SiteSetting::where('name','api_pass')->first();


        $api_user_id = $api_user->detail;
        $api_pass = $api_pass->detail;

        $product_id = $request->product;
        $phone = $request->phone;
        $quantity = $request->quantity;
        
        $get_product = MarketPlace::where('id',$product_id)->first();
        $product_name = $get_product->product_name;

        $amount = $get_product->price * $quantity;

      if($quantity == 1){
        $text = urlencode(Auth::user()->name." just ordered ".$quantity." quantity of ".$product_name.", for N".number_format($amount,2)." and his/her phone number is ".$phone);
      }else{
        $text = urlencode(Auth::user()->name." just ordered ".$quantity." quantities  of ".$product_name.", for N".number_format($amount,2)." and his/her phone number is ".$phone);

      }
        
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
            $response = '{"ok": false, "description": "Insufficient Balance"}';
            $results = json_decode($response);
          //dd("yes");
        }else{
          
        //Api Request section
        $curl = curl_init();
          
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.telegram.org/bot1666028502:AAEWIttTNTEw_kencRT8w-w3I70aVwWwH2w/sendMessage?chat_id=@submenow9jama&text=".$text,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Cache-Control: no-cache",
            ),
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          
          if ($err) {
            echo "cURL Error #: " .$err;
          } else {
            $results = json_decode($response);
            //$response = json_decode($response); 
            $response2 = '{"code": "205", "message": "pending"}';
            $status = json_decode($response2);
          }
          //dd($response);
          

          if($results->ok == true){
            
            $response1 = '{"ok": true, "message": "Order placed successfully!"}';
            $results = json_decode($response1);
            //Update Wallet Table
            $deduction = $wallet_balance->amount - $amount;
            Wallet::where('user_id',Auth::user()->id)->update(['amount' => $deduction]);


        $w_balance = Wallet::where('user_id',Auth::user()->id)->first();
            //Create Transaction
            Transaction::create([
                'user_id' => Auth::user()->id,
                'ref' => $user_ref,
                'service' => $product_name,
                'description' => $product_name,
                'destination' => $phone,
                'amount' => $amount,
                'balance' => $w_balance->amount,
                'status' => $status->message
            ]);
            
            
          }

        }

          
          return view('pages.backend.market',['results' => $results]);
    }
}
