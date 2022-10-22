<?php 
use App\Models\Post;
use App\Models\Category;
$post=Post::where('status',2)->count();
$cat=Category::count();
return [
   "header"=>[
        "title"=>"এক ক্লিকে সহজে বিক্রয় করুন",
        "all_ads"=>"সবগুলো বিজ্ঞাপন",
        "post_your_ad"=>"বিজ্ঞাপন দিন",
   ],
   'homepage'=>[
       "banner_header"=>"এক ক্লিকে সহজে বিক্রয় করুন",
        "banner_text"=>"খুজুন ".$post." টি বিজ্ঞাপন এবং ".$cat." টি ক্যাটেগরির মধ্যে",
        "search_btn"=>"খুজুন",
        "category_header"=>"শ্রেনীগুলো",
   ],
   "footer"=>[
       "how_to_sell_first"=>[
           'title'=>"টিপস",
           'selling_tips'=>"বিক্রয় করার টিপস",
           'buy_and_sell_quicly'=>"দ্রুত বিক্রয়",
           'membership'=>"মেম্বারশীপ",
           'banner_advertising'=>"ব্যানার বিজ্ঞাপন",
           'promote_your_ad'=>"প্রোমোট বিজ্ঞাপন",
           
       ],
       "information"=>[
           "title"=>"তথ্য",
           'contact_info'=>"যোগাযোগ",
           'blog'=>"ব্লগ",
           'site_map'=>"সাইটম্যাপ",
           'terms_of_service'=>"নীতিমালা",
           'privacy_policy'=>"গোপনীয়তা",
       ],
       "help_and_support"=>[
           "title"=>"হেল্প এবং সাপোর্ট",
           "live_chat"=>"লাইভ চ্যাট",
           "faq"=>"জিজ্ঞাসা",
           "how_to_stay_safe"=>"কিভাবে নিরাপদ থাকবেন",
           "terms_and_condition"=>"শর্তাবলী ও নিতিমালা",
           "about_us"=>"আমাদের সম্পর্কে",
       ],
       'short_description'=>"Bekalpo.com একটি বড় মার্কেট এখানে প্রডাক্টের বিজ্ঞাপন দেয়া হয়! ",
       ],
    'ad'=>"বিজ্ঞাপন",

    
];