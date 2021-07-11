<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;


class DirectDataController extends Controller
{
    //
    //private $response;

    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function index()
    {
        return view('pages.backend.direct_data');
    }

    public function getdata(Request $request)
    {
        $datanet = $request->datanet;

        //Initalization
        $api_user = SiteSetting::where('name','api_user_id')->first();
        $api_pass = SiteSetting::where('name','api_pass')->first();

        $api_user_id = $api_user->detail;
        $api_pass = $api_pass->detail;

            //Api Request section
        $response = file_get_contents("https://mobileairtimeng.com/httpapi/get-items?userid=".$api_user_id."&pass=".$api_pass."&service=".$datanet);

        return $response;

    }

    public function subme(Request $request){

      //
     //Initalization
     $api_user = SiteSetting::where('name','api_user_id')->first();
     $api_pass = SiteSetting::where('name','api_pass')->first();


     $api_user_id = $api_user->detail;
     $api_pass = $api_pass->detail;

     $network1 = $request->network;
     $phone = $request->phone;
     $amount = $request->bundles;

     switch ($network1) {
       case 'mtn':
         $network = '15';
         break;
       case 'glo':
         $network = '6';
         break;
       case 'airtel':
         $network = '1';
         break;
       case '9mobile':
         $network = '2';
         break;
     
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
//dd($amount);     
     //Check Wallet
     $wallet_balance = Wallet::where('user_id',Auth::user()->id)->first();

     //dd($wallet_balance);
     if($wallet_balance->amount < $amount){
         $response = '{"code": "203", "message": "Insufficient Balance"}';
         $results = json_decode($response);
       //dd("yes");
     }else{
     //Api Request section
     $response = file_get_contents("https://mobileairtimeng.com/httpapi/datatopup.php?userid=".$api_user_id."&pass=".$api_pass."&network=".$network."&phone=".$phone."&amt=".$amount."&jsn=json&user_ref=".$user_ref);
     $results = json_decode($response);

     
       if($results->code == 100){
         //Update Wallet Table
         $deduction = $wallet_balance->amount - $amount;
         Wallet::where('user_id',Auth::user()->id)->update(['amount' => $deduction]);

         //Api Request section for status
         $status = file_get_contents("https://mobileairtimeng.com/httpapi/datastatus?batch=".$user_ref);
         $status = json_decode($status);
    
     $w_balance = Wallet::where('user_id',Auth::user()->id)->first();
         //Create Transaction
         Transaction::create([
             'user_id' => Auth::user()->id,
             'ref' => $user_ref,
             'service' => 'Mtn Direct Data',
             'description' => $network1." ".$amount,
             'destination' => $phone,
             'amount' => $amount,
             'balance' => $w_balance->amount,
             'status' => $status->message
         ]);
         
         
       }

     }

       
       return view('pages.backend.direct_data',['results' => $results]);
       

 }

}
