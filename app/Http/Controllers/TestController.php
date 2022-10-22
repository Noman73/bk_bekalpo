<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Otp;
use Auth;
use Mail;
use Str;
class TestController extends Controller
{
    public function Test(){
      return view('test.compress');
    }
    public function TestFile(Request $request)
    {
      // return $request->all();
      if($request->hasFile('file')){
        // return "ok";
        $ext=$request->file->getClientOriginalExtension();
        $name=Str::uuid().'_'.time().'.'.$ext;
        $request->file->storeAs('public/test_image',$name);
      }
    }
}
