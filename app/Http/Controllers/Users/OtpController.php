<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Otp;
use Validator;
class OtpController extends Controller
{
    public function setOtp(Request $request){
        $validator=Validator::make($request->all(),[
            'mobile'=>'required|min:1|max:25|numeric',
        ]);
        $code= Otp::generate('mobile:'.$request->mobile);
        $api_key="C20081826072b4bc932d35.83708572";
        $sender_id="8809601000185";
        $contacts=$request->mobile;
        $type="application/json";
        $msg="Your bekalpo.com Mobile Verify Code is: ".$code;
        $fields='api_key='.$api_key.'&type='.$type.'&contacts='.$contacts.'&senderid='.$sender_id.'&msg='.$msg;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://esms.mimsms.com/smsapi");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        // Further processing ...
        return $server_output;
        // if ($server_output == "OK") { 

        //  } else { 
             
        //  }
    }
}
