<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\OtpValidate;
use App\Models\Phone;
use Validator;
class PhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'phone'=>["required","max:200","min:1","unique:phones,phone",new OtpValidate($request->otp)],
            'otp'=>['required','max:6','min:6'],
        ]);

        if($validator->passes()){
            $phone=new Phone;
            $phone->phone=$request->phone;
            $phone->user_id=auth()->user()->id;
            $phone->status=1;
            $phone->save();
            if ($phone) {
                return response()->json(['message'=>'Phone Number Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
        
    }
    public function getPhoneNumber()
    {
        $phones=Phone::where('user_id',auth()->user()->id)->get();
        return response()->json($phones);
    }
}
