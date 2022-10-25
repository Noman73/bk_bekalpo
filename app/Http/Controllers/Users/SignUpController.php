<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;
use Auth;
use Hash;
use URL;
use Str;
class SignUpController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }
    public function signUpForm()
    {

        $division=Division::all();
        return view('frontend.signup.signup',compact('division'));
    }

    public function store(Request $request)
    {
        // return $request->all();

        $validator=Validator::make($request->all(),[
            // 'username'=>"|max:200|min:1|unique:users,username",
            'name'=>"required|max:200|min:1",
            'email'=>"required|max:200|min:1|unique:users,email",
            'phone'=>"required|max:200|min:1",
            'cities'=>"required|max:200|min:1",
            'areas'=>"required|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'gender'=>"required|min:1",
            'password'=>"required|max:200|min:1|confirmed",
            'image'=>"nullable|image|max:1024",
        ]);

        if($validator->passes()){
            $user=new User;
            // $user->username=$request->username;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->division_id=$request->cities;
            $user->district_id=$request->areas;
            $user->adress=$request->adress;
            $user->gender=$request->gender;
            $user->password=Hash::make($request->password);
            $user->status=1;
            $user->save();
            if ($user) {
                Auth::loginUsingId($user->id);
                return redirect(URL::to('/account'));
                // return redirect()->with(['message'=>'You Are Registered Success']);
            }
        }
        // return response()->json(['error'=>$validator->getMessageBag()]);
        return redirect()->back()->withErrors($validator)->withInput($request->input());
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function checkUsername(Request $request){
        $username=User::where('username',$request->username)->count();
        if ($username>0) {
            return 0;
        }else{
            return 1;
        }
    }

    public function updateForm()
    {
        $division=Division::all();
        $data=User::find(auth()->user()->id);
        $district=District::where('division_id',$data->division_id)->get();
        return view('frontend.account_info.profile.profile',compact('data','division','district'))->render();
    }
    public function update(Request $request)
    {
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'name'=>"required|max:200|min:1|unique:users,email,".auth()->user()->id,
            'phone'=>"required|max:200|min:1",
            'cities'=>"required|max:200|min:1",
            'areas'=>"required|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'gender'=>"required|min:1",
            'image'=>"nullable|image|max:2048",
        ]);

        if($validator->passes()){
            $user=User::find(auth()->user()->id);
            $user->name=$request->name;
            $user->phone=$request->phone;
            $user->division_id=$request->cities;
            $user->district_id=$request->areas;
            $user->adress=$request->adress;
            $user->gender=$request->gender;
            if($request->hasFile('image')){
                if($user->image!=null){
                    unlink(storage_path('app/public/users/'.$user->image));
                }
                $ext=$request->image->getClientOriginalExtension();
                $name=Str::uuid().'_'.$request->phone.'_'.time().'.'.$ext;
                $request->image->storeAs('public/users',$name);
                $user->image=$name;
            }
            $user->save();
            if ($user) {
                return response()->json(['message'=>'Your Account Updated']);
            }
            
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
