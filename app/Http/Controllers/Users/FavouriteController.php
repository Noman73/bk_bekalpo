<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;
class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addFav($locale='en',$post_id)
    {
        $existance=Favourite::where('user_id',auth()->user()->id)->where('post_id',$post_id)->count();
        if($existance<=0){
            $fav=new Favourite;
            $fav->user_id=auth()->user()->id;
            $fav->post_id=$post_id;
            $fav->save();
            return response()->json(['message'=>'This Ad Listed to Favourite List']);
        }else{
            return response()->json(['error'=>'This Ad Already Added to Favourite List']);
        }
        

    }
    public function unFav($post_id)
    {
        $existance=Favourite::where('user_id',auth()->user()->id)->where('post_id',$post_id)->count();
        if($existance>0){
            $fav=Favourite::where('user_id',auth()->user()->id)->where('post_id',$post_id);
            $fav->delete();
            return response()->json(['message'=>'Unlist Ad SuccessFully']);
        }else{
            return response()->json(['message'=>'This Ad Already Added to Favourite List']);
        }
    }
}
