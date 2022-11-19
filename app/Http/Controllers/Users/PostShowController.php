<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Favourite;
use App\Models\Featured;
use DB;
use Log;
use Carbon\Carbon;
class PostShowController extends Controller
{

    public function getAllAds()
    {
        $post=Post::with('permission','division','district','brand','model','images')->where('status',2)->get();
        return response()->json($post);
    }
    public function ads(Request $request){
        $params = $request->except('_token');
        // return response()->json($params);
        $query=Post::with('permission','division','district','brand','model','images')->filter($params)->get();

        return response()->json($query);
    }
    public function filter(Request $request){

        $params = $request->except('_token');
        $posts=Post::with('permission','division','district','brand','model','images')->filter($params)->where('status',2)->orderBy('created_at','desc')->paginate(6);
        return view('guest.allads.alladrender',compact('posts'))->render();
    }

    public function getMyAds($locale='en')
    {
        $posts=Post::with('division','district','images','brand')->where('user_id',auth()->user()->id)->whereIn('status',[1,2,7])->orderBy('updated_at','desc')->paginate(2);
        return view('frontend.account_info.mylisting.mylisting',compact('posts'))->render();
    }
    public function getMyFavAds($locale="en")
    {
        // $posts=Favourite::with('posts')->where('user_id',auth()->user()->id)->paginate(5);
        $lang_name="name_".app()->getLocale();
        $posts=DB::table("favourites")
                   ->join('posts','posts.id','=','favourites.post_id')
                   ->join('divisions','divisions.id','=','posts.division_id')
                   ->join('districts','districts.id','=','posts.district_id')
                   ->leftjoin('brands','brands.id','=','posts.brand_id')
                   ->leftjoin('images','posts.id','=','images.post_id')
                   ->select('posts.id','brands.'.$lang_name.' as brand_name','images.image','divisions.'.$lang_name.' as division_name','districts.'.$lang_name.' as district_name','posts.title','posts.created_at','posts.condition','posts.price','posts.status')
                   ->where('favourites.user_id',auth()->user()->id)
                //    ->where('posts.status',2)
                   ->groupBy('posts.id')
                //    ->get();
                   ->paginate(5);
                //    dd($posts);
        return view('frontend.account_info.myfavlist.mylisting',compact('posts'))->render();
    }
    public function featurePost(Request $request)
    {
        $category=$request->category;
        $subcategory=$request->subcat;
        $posts=Featured::with('post')->where('status',1)->whereHas('post',function($q) use ($category,$subcategory){
            if($category!=null){
                $q->where('category_id',$category);
            }
            if($subcategory!=null){
                $q->where('subcategory_id',$subcategory);
            }
            $q->where('status',2);
            // Log::info(print_r($q->get()));
        })->where('end_ad_at','>=',Carbon::now())->inRandomOrder()->limit(2)->get();
        return view('guest.allads.feature-post',compact('posts'))->render();
    }
}
