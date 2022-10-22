<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Division;
use App\Models\Post;
use App\Models\FeatureMark;
use App\Models\FuelTypeMark;
use App\Models\TermsAndCondition;
use App\Models\About;
use App\Models\SellTips;
use App\Models\StaySafe;
use App\Models\BannerAd;
use App\Models\Contact;
use App\Models\Faq;
class GuestViewController extends Controller
{
    public function allAds($locale="en"){
        // return "dfgdfd";
        $category=Category::with(['subcategory'])->withCount('postCount')->orderBy('post_count_count','desc')->get();
        $division=Division::with(['location'])->get();
        // dd($category);
        return view('guest.allads.allads',compact('category','division','locale'));
    }

    public function singleAd($slug,$id){
        
       $post=Post::with('permission','division','district','brand','model','images','user','bodytype','unittype')->where('id',$id)->where('status',2)->first();

    //    dd($post);
       $rel_product=Post::with('images','division','district')->where('id', '<>',$id)->where('subcategory_id',$post->subcategory_id)->where('status',2)->get();
    //    dd($rel_product);
       $feature=FeatureMark::with('feature')->where('post_id',$post->id)->get();
       $fueltype=FuelTypeMark::with('fueltype')->where('post_id',$post->id)->get();
    //    dd($fueltype->count());
        return view('frontend.single-ad.single-ad',compact('post','rel_product','feature','fueltype'));
    }

    public function privacy()
    {
        return view('frontend.privacy.privacy');
    }

    public function termsAndCondition()
    {
        return view('frontend.termscondition.termscondition');
    }
    public function about()
    {
        $description=About::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        return view('frontend.about_us.about_us',compact('data'));
    }
    public function sellTips()
    {
        $description=SellTips::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        return view('frontend.sell_tips.sell_tips',compact('data'));
    }
    public function staySafe()
    {
        $description=StaySafe::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        return view('frontend.stay_safe.stay_safe',compact('data'));
    }
    public function bannerAds()
    {
        $description=BannerAd::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        return view('frontend.banner_ads.banner_ads',compact('data'));
    }
    public function contact()
    {
        $description=Contact::first();
        // dd($description);
        if($description==null){
            $data='';
        }else{
            $data=$description->description;
        }
        return view('frontend.contact_info.contact_info',compact('data'));
    }
    public function siteMap()
    {
        $category=Category::with('subcategory')->get();
        return view('frontend.sitemap.sitemap',compact('category'));
    }
    public function faq()
    {
        $faqs=Faq::all();
        return view('frontend.faq.faq',compact('faqs'));
    }
    
}
