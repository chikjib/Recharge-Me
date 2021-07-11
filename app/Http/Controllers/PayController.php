<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Http\Request;

class PayController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('vendor');
    // }
    
    public function index()
    {
        return view('pages.backend.pay');
    }

    public function paid(Request $request)
    {

        $user_id = $request->user_id;
        //dd($user_id);
        User::where('id',$user_id)->update(['payment_status' => 1]);

        $response = '{"code": 200,"message": "Payment made successfully!"}';
        $result = json_decode($response);

        return response()->json(['result' => $result]);  
    }
}
