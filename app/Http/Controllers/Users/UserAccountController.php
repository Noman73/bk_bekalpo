<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Package;
use App\Models\PaymentGateway;
class UserAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myAccount()
    {
        return view('frontend.account_info.account_info');
    }
    public function getActionModal()
    {
        return view('frontend.account_info.action.action')->render();
    }
    public function getPromoteModal($id)
    {

        $post=Post::with('permission','division','district','brand','model','images')->where('id',$id)->first();
        $package=Package::all();
        $payment=PaymentGateway::all();
        return view('frontend.account_info.action.promote',compact('post','package','payment'))->render();
    }
    public function getReportModal($id)
    {
        $post=Post::with('permission','division','district','brand','model','images')->where('id',$id)->where('status',2)->first();
        return view('frontend.modal.report.report',compact('post'))->render();

    }
}
