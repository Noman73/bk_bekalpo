<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\BodyTypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\ItemTypeController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\FieldPermissionController;
use App\Http\Controllers\Guest\GuestViewController;
use App\Http\Controllers\Users\PostShowController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Users\OtpController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PostManageController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TermsAndServiceController;
use App\Http\Controllers\Users\UserAccountController;
use App\Http\Controllers\Users\SignUpController;
use App\Http\Controllers\Guest\EmailController;
use App\Http\Controllers\Users\PhoneController;
use App\Http\Controllers\Users\FavouriteController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\FeatureRequestController;
use App\Http\Controllers\Users\ReportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\SellTipsController;
use App\Http\Controllers\Admin\StaySafeController;
use App\Http\Controllers\Admin\BannerAdsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureApprovalController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\AdminReportController;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify'=>true]);
// Auth::routes(['verify'=>true]);
Route::get('/test',[TestController::class,'Test']);
Route::post('/testfile',[TestController::class,'TestFile']);
Route::get('/admin/home', [HomeController::class, 'index'])->name('home');

Route::get('/home',function($locale="en"){
    return view('guest.welcome',compact('locale'));
});
Route::get('/admin/get-brand', [HomeController::class, 'index'])->name('home');
Route::post('/sendEmail/{user_id}',[EmailController::class,'send']);
Route::name('users.')->prefix("{locale?}")->middleware('setLocale')->group(function () {
    Route::get('/', function ($locale="en"){
        return view('guest.welcome',compact('locale'));
    });
    Route::get('/get-location-modal', [LocationController::class, 'getModal']);
    Route::resource('/post',PostController::class)->middleware(['auth','verified']);
    Route::post('/my_post_action/{id}',[PostController::class,'postAction'])->name('my_post_action')->middleware('auth');
    Route::resource('/category',CategoryController::class);
    // Route::resource('/sub-category',PostController::class);
    Route::get('/get-subcategory/{id}',[PostController::class,'getSubCategory']);
    Route::get('/field-permission/{id}',[PostController::class,'getFieldPermission']);
    Route::get('/get-location/{id}',[PostController::class,'getLocation']);
    Route::get('/get-city-location/{id}',[PostController::class,'getCityLocation']);
    Route::get('/get-area-location/{id}',[PostController::class,'getAreaLocation']);
    Route::get('/get-brand/{id}',[PostController::class,'getBrand']);
    Route::get('/get-model/{id}',[PostController::class,'getModel']);
    Route::get('/get-bodytype/{id}',[PostController::class,'getBodyType']);
    Route::get('/get-itemtype/{id}',[PostController::class,'getItemType']);
    Route::get('/get-data/{category_id}/{subcategory_id}',[PostController::class,'getData']);
    Route::get('/ads',[GuestViewController::class,'allAds'])->name('all-ads');
    Route::get('/post-data',[PostShowController::class,'getAllAds']);
    Route::post('/post-data',[PostShowController::class,'filter']);
    Route::get('/my_ads',[PostShowController::class,'getMyAds'])->middleware('auth');
    Route::get('/my_fav_ads',[PostShowController::class,'getMyFavAds'])->middleware('auth');
    Route::get('/myad_action',[UserAccountController::class,'getActionModal'])->name('myad_action')->middleware('auth');
    Route::get('/myad_promote/{id}',[UserAccountController::class,'getPromoteModal'])->name('myad_promote')->middleware('auth');
    Route::get('/report_modal/{id}',[UserAccountController::class,'getReportModal'])->name('report-modal')->middleware('auth');
    Route::post('/report_ad',[ReportController::class,'store'])->middleware('auth');
    Route::post('/feature_request/{id}',[FeatureRequestController::class,'store'])->name('feature_request')->middleware('auth');
    Route::get('/ad/{slug}/{id}',[GuestViewController::class,'singleAd']);
    Route::post('/set-otp',[OtpController::class,'setOtp']);
    Route::get('/account',[UserAccountController::class,'myAccount'])->middleware(['verified']);
    Route::get('/signup',[SignUpController::class,'signUpForm'])->middleware('guest');
    Route::post('/signup',[SignUpController::class,'store'])->name('signup')->middleware('guest');
    Route::post('/account/update',[SignUpController::class,'update'])->name('signup.update')->middleware('auth');
    Route::post('/check_username',[SignUpController::class,'checkUsername'])->name('checkusername')->middleware('guest');
    Route::get('/privacy',[GuestViewController::class,'privacy']);
    Route::get('/about',[GuestViewController::class,'about']);
    Route::get('/tips',[GuestViewController::class,'sellTips']);
    Route::get('/staysafe',[GuestViewController::class,'staySafe']);
    Route::get('/banner-ads',[GuestViewController::class,'bannerAds']);
    Route::get('/contact',[GuestViewController::class,'contact']);
    Route::get('/sitemap',[GuestViewController::class,'siteMap']);
    Route::get('/faq',[GuestViewController::class,'faq']);
    Route::get('/terms_and_condition',[GuestViewController::class,'termsAndCondition']);
    Route::get('/add_fav/{post_id}',[FavouriteController::class,'addFav']);
    Route::get('/my_ads_unfav/{post_id}',[FavouriteController::class,'unFav']);
    Route::post('/add_phone',[PhoneController::class,'store']);
    Route::get('/get_phone',[PhoneController::class,'getPhoneNumber']);
    Route::get('/get-profile-form',[SignUpController::class,'updateForm']);
    Route::post('/featured-post',[PostShowController::class,'featurePost']);
});
Route::name('admin.')->prefix('admin')->group(function () {
    Route::resource('/category',CategoryController::class);
    Route::post('/category/get-data',[CategoryController::class,'getData'])->name('category.getdata');
    Route::resource('/sub-category',SubCategoryController::class);
    Route::resource('/brand',BrandController::class);
    Route::resource('/model',ModelController::class);
    Route::resource('/feature',FeatureController::class);
    Route::resource('/fuel',FuelController::class);
    Route::resource('/body-type',BodyTypeController::class);
    Route::resource('/unit',UnitController::class);
    Route::resource('/item_type',ItemTypeController::class);
    Route::resource('/cities',DivisionController::class);
    Route::resource('/areas',DistrictController::class);
    Route::resource('/field_permission',FieldPermissionController::class);
    Route::resource('/company',CompanyController::class);
    Route::resource('/post',PostManageController::class);
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register.form');
    Route::post('/register',[RegisterController::class,'register'])->name('register');
    Route::resource('/feature_request',FeatureApprovalController::class);
    Route::resource('/privacy',PrivacyPolicyController::class);
    Route::resource('/aboutus',AboutUsController::class);
    Route::resource('/sell_tips',SellTipsController::class);
    Route::resource('/stay-safe',StaySafeController::class);
    Route::resource('/banner-ads',BannerAdsController::class);
    Route::resource('/contact-info',ContactController::class);
    Route::resource('/faq',FaqController::class);
    Route::resource('/package',PackageController::class);
    Route::resource('/payment',PaymentController::class);
    Route::resource('/report',AdminReportController::class);
    Route::get('/terms_and_condition',[TermsAndServiceController::class,'form'])->name('termscondition.index');
    Route::post('/terms_and_condition',[TermsAndServiceController::class,'store'])->name('termscondition.store');
});


// varification
Route::get('/email/verify', function () {
    auth()->user()->sendEmailVerificationNotification();
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');