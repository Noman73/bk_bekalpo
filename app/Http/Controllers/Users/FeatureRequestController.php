<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Featured;
class FeatureRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store($locale='en',Request $request,$id)
    {
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'package'=>"required|max:200|min:1",
            'mobile'=>"required|max:11|min:11",
            'transaction'=>"required|max:200|min:1",
            'payment_method'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $featured=new Featured;
            $featured->post_id=$id;
            $featured->package_id=$request->package;
            $featured->transaction=$request->transaction;
            $featured->method_id=$request->payment_method;
            $featured->user_id=auth()->user()->id;
            $featured->status=0;
            $featured->save();
            if ($featured) {
                return response()->json(['message'=>'Feature Add Request Submitted Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
