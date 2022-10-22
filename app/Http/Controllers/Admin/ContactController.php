<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $description=Contact::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        
        return view('backend.contact_info.contact_info',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'description'=>"required|max:15000|min:1",
        ]);
        if($validator->passes()){
            $data=Contact::first();
            if($data!=null){
                $banner_ad=Contact::find($data->id);
                $banner_ad->description=$request->description;
                $banner_ad->author_id=auth()->user()->id;
                $banner_ad->save();
            }else{
                $banner_ad=new Contact;
                $banner_ad->description=$request->description;
                $banner_ad->author_id=auth()->user()->id;
                $banner_ad->save();
            }
            if ($banner_ad) {
                return response()->json(['message'=>'Contacts Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
