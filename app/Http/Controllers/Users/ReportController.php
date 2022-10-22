<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Report;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'description'=>"required|max:500|min:1",
        ]);

        if($validator->passes()){
            $report=new Report;
            $report->description=$request->description;
            $report->user_id=auth()->user()->id;
            $report->post_id=$request->post_id;
            $report->save();
            if ($report) {
                return response()->json(['message'=>'Report Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
