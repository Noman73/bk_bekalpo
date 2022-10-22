<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Models\User;
class EmailController extends Controller
{
    public function send(Request $request,$user_id){
        // return response()->json($request->all());
       $fromEmail=User::where('id',$user_id)->first();
    //    return $fromEmail->email;
        Mail::send('email.sendmail',[
            'data'=>$request->message,
          ],function($message) use ($request,$fromEmail){
            $message->to($fromEmail->email);
            $message->subject($request->subject);
          });
          return response()->json(['message'=>"send email success"]);
    }
}
