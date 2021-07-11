<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OverviewController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('vendor');
    }

    public function getprofile()
    {
        return view('pages.backend.profile');
    }

    public function updateprofile(Request $request)
    {
        
        User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
           
        ]);

        $message = '{"code":"100", "message": "Profile details updated successfully"}';
        $results = json_decode($message);


        return view('pages.backend.profile',['results' => $results]);

    }


    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $oldpassword = $request->old_password;
        $newpassword = $request->password;

        $user_password = User::where('id',Auth::user()->id)->first();

        if(Hash::check($oldpassword, $user_password->password) == true){
            User::where('id',Auth::user()->id)->update(['password' => bcrypt($newpassword)]);
            $message = '{"code":"100", "message": "Password changed successfully"}';
            $results = json_decode($message);
        }else{
            $message = '{"code":"101", "message": "Wrong old password!, please try again"}';
            $results = json_decode($message);
        }

        return view('pages.backend.profile',['results' => $results]);

        //return redirect()->back()->with(['results' => $results]);

    }

    public function getfundwallet()
    {
        $api_key = "MK_TEST_9B4DTXXTT8";
        $secret_key = "38R5PRBSJNPYX4RJ2UYKLJUWHXABXWBZ";
        $baseString = "MK_TEST_9B4DTXXTT8:38R5PRBSJNPYX4RJ2UYKLJUWHXABXWBZ";

        $base64 = base64_encode($baseString);
        //dd($base64);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $ref = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $account_ref = str_shuffle($ref);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sandbox.monnify.com/api/v1/auth/login/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Basic ".$base64
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        //dd($response);

        $response = json_decode($response);
        //dd($response->responseBody->accessToken);
        $accessToken = $response->responseBody->accessToken;
       if($response->responseMessage == 'success'){

        $ch1 = curl_init();

        curl_setopt($ch1, CURLOPT_URL, "https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts");
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch1, CURLOPT_HEADER, FALSE);

        curl_setopt($ch1, CURLOPT_POST, TRUE);

        curl_setopt($ch1, CURLOPT_POSTFIELDS, "{
        \"accountName\": \"Recharge Me Online\",
        \"accountReference\": \"rmo234\",
        \"currencyCode\": \"NGN\",
        \"contractCode\": \"2194213424\",
        \"customerName\": \"Recharge Me Online\",
        \"customerEmail\": \"chikjib2015@gmail.com\",
        \"getAllAvailableBanks\": \"true\"
        }");

        curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer ".$accessToken
        ));

        $response1 = curl_exec($ch1);
        curl_close($ch1);

        dd($response1);
        // $curl1 = curl_init();
          
        // curl_setopt_array($curl1, array(
        //   CURLOPT_URL => "https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => array(
        //     "accountReference: ".$account_ref,
        //     "accountName: Recharge Me Online",
        //     "currencyCode: NGN",
        //     "contractCode: 2194213424",
        //     "customerEmail: chikjib2015@gmail.com",
        //     "customerName: Chikwadom Chike Jibunoh",
        //     "getAllAvailableBanks: true",
        //   ),
        //   CURLOPT_HTTPHEADER => array(
        //     "Content-Type: application/json",
        //     "Authorization: Bearer ".$accessToken,
        //   ),
          
        // ));
        
        // $response1 = curl_exec($curl1);
        // dd($response1);
        // $err1 = curl_error($curl1);
        // curl_close($curl1);
       }

        return view('pages.backend.fund-wallet');
    }

    public function fundwallet(Request $request)
    {

    }

    public function get_transactions()
    {
        $transactions = Transaction::where('user_id',Auth::user()->id)->orderby('created_at','desc')->get();
        return view('pages.backend.transactions',['transactions' => $transactions]);
    }
}
