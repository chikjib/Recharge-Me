<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;

class CorporateDataController extends Controller
{
    //
    //

    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function index()
    {
        return view('pages.backend.corporate');
    }

    public function subme(Request $request){

         //
        //Initalization
        $api_user = SiteSetting::where('name','api_user_id')->first();
        $api_pass = SiteSetting::where('name','api_pass')->first();


        $api_user_id = $api_user->detail;
        $api_pass = $api_pass->detail;

        $network = $request->network;
        $phone = $request->phone;
        $dsize = $request->dsize;

        switch ($dsize) {
          case 'c-1000':
            $mtn_datashare1gb = SiteSetting::where('name','mtn_corporate_data_1GB')->first();
            if(Auth::user()->user_type == 1){
              //End User Type
              $amount = $mtn_datashare1gb->end_user_price;
            }else{
              //Vendor Type
              $amount = $mtn_datashare1gb->vendor_price;
            }
            $description = "MTN Corporate 1GB";
            break;

          case 'c-2000':
            $mtn_datashare2gb = SiteSetting::where('name','mtn_corporate_data_2GB')->first();
            if(Auth::user()->user_type == 1){
              //End User Type
              $amount = $mtn_datashare2gb->end_user_price;
            }else{
              //Vendor Type
              $amount = $mtn_datashare2gb->vendor_price;
            }
            $description = "MTN Corporate 2GB";
            break;

          case 'c-3000':
            $mtn_datashare3gb = SiteSetting::where('name','mtn_corporate_data_3GB')->first();
            if(Auth::user()->user_type == 1){
              //End User Type
              $amount = $mtn_datashare3gb->end_user_price;
            }else{
              //Vendor Type
              $amount = $mtn_datashare3gb->vendor_price;
            }
            $description = "MTN Corporate 3GB";
            break;

          case 'c-5000':
            $mtn_datashare5gb = SiteSetting::where('name','mtn_corporate_data_5GB')->first();
            if(Auth::user()->user_type == 1){
              //End User Type
              $amount = $mtn_datashare5gb->end_user_price;
            }else{
              //Vendor Type
              $amount = $mtn_datashare5gb->vendor_price;
            }
            $description = "MTN Corporate 5GB";
            break;
        
          case 'c-10000':
            $mtn_datashare10gb = SiteSetting::where('name','mtn_corporate_data_10GB')->first();
            if(Auth::user()->user_type == 1){
              //End User Type
              $amount = $mtn_datashare10gb->end_user_price;
            }else{
              //Vendor Type
              $amount = $mtn_datashare10gb->vendor_price;
            }
            $description = "MTN Corporate 10GB";
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
        
        //Check Wallet
        $wallet_balance = Wallet::where('user_id',Auth::user()->id)->first();

        //dd($wallet_balance);
        if($wallet_balance->amount < $amount){
            $response = '{"code": "203", "message": "Insufficient Balance"}';
            $results = json_decode($response);
          //dd("yes");
        }else{
          //API CALL
        $response = file_get_contents("https://mobileairtimeng.com/httpapi/cdatashare?userid=".$api_user_id."&pass=".$api_pass."&network=".$network."&phone=".$phone."&datasize=".$dsize."&jsn=json&user_ref=".$user_ref);
        $results = json_decode($response);

       
          if($results->code == 100){
            //Update Wallet Table
            $deduction = $wallet_balance->amount - $amount;
            Wallet::where('user_id',Auth::user()->id)->update(['amount' => $deduction]);

            //API CALL STATUS
            $status = file_get_contents("https://mobileairtimeng.com/httpapi/datastatus?batch=".$user_ref);
            $status = json_decode($status);
        

          $w_balance = Wallet::where('user_id',Auth::user()->id)->first();
            //Create Transaction
            Transaction::create([
                'user_id' => Auth::user()->id,
                'ref' => $user_ref,
                'service' => 'Mtn Corporate Data',
                'description' => $description,
                'destination' => $phone,
                'amount' => $amount,
                'balance' => $w_balance->amount,
                'status' => $status->message
            ]);
            
            
          }

        }

          
          return view('pages.backend.corporate',['results' => $results]);
          

    }
}
