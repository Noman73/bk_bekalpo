<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\TermsAndCondition;
class TermsAndServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function form()
    {
        return view('backend.termscondition.termscondition');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'description'=>"required|max:15000|min:1",
        ]);

        if($validator->passes()){
            $data=TermsAndCondition::first();
            if($data!=null){
                $terms=TermsAndCondition::find($data->id);
                $terms->description=$request->description;
                $terms->author_id=auth()->user()->id;
                $terms->save();
            }else{
                $terms=new TermsAndCondition;
                $terms->description=$request->description;
                $terms->author_id=auth()->user()->id;
                $terms->save();
            }
            if ($terms) {
                return response()->json(['message'=>'Terms And Condition Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
