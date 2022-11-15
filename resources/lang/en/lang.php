<?php 
use App\Models\Post;
use App\Models\Category;
$post=Post::where('status',2)->count();
$cat=Category::count();

return [
    
   "header"=>[
        "title"=>"Easy Buy, Easy Sell in one click",
        "all_ads"=>"All Ads",
        "post_your_ad"=>"Post Your Add",

   ],
   'homepage'=>[
       "banner_header"=>"Easy Buy, Easy Sell in one click",
        "banner_text"=>"Search in ".$post." ads from ".$cat." categories",
        "search_btn"=>"Search",
        "category_header"=>"Categories",
   ],
   "footer"=>[
       "how_to_sell_fast"=>[
           'title'=>"Tips",
           'selling_tips'=>"Sale Tips",
           'buy_and_sell_quicly'=>"Quick Sell",
           'membership'=>"Membership",
           'banner_advertising'=>"Bannder Ads",
           'promote_your_ad'=>"Promote Ads",
       ],
       "information"=>[
           "title"=>"Information",
           'contact_info'=>"Contact",
           'blog'=>"Blog",
           'site_map'=>"Sitemap",
           'terms_of_service'=>"Terms",
           'privacy_policy'=>"Privacy Policy",
       ],
       "help_and_support"=>[
           "title"=>"Help & Support",
           "live_chat"=>"Live Chat",
           "faq"=>"Faq",
           "how_to_stay_safe"=>"How to Keep Safe",
           "terms_and_condition"=>"Terms & Condition",
           "about_us"=>"About Us",
           
       ],
       "short_description"=>"Bekalpo.com is a Largest Classified Listing Marketplace for you. You can easy buy and easy sell via Bikalpo.",
    ],
   'ad'=>"Ad",
   'pages'=>[
    'dashboard'=>include('pages/dashboard.php'),
    'signup'=>include('pages/signup.php'),
    'allads'=>include('pages/allads.php'),
    'singlead'=>include('pages/singlead.php'),
    'post'=>include('pages/post.php'),
   ],
];