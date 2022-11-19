@extends('layouts.guest.master')
@push('title')
bekalpo.com | Easy Buy, Easy Sell 
@endpush
@section('link')
<style>
    .is-invalid{
        border:1px solid red !important;
    }
</style>
<link rel="stylesheet" href="{{asset('storage/dependencies/image-uploader/dist/image-uploader.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/dependencies/image-upload-new/jquery.uploader.css')}}">
@endsection
@section('content')
<section class="inner-page-banner" data-bg-image="{{asset('storage/')}}/media/banner/banner.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs-area">
                    <h1>@lang('lang.pages.post.banner_text')</h1>
                    <ul>
                        <li>
                            <a href="index-2.html">@lang('lang.pages.allads.header.home')</a>
                        </li>
                        <li>@lang('lang.pages.post.banner_text')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=        Post Add Start    			=-->
<!--=====================================-->
<section class="section-padding-equal-70">
    <div class="container">
        <div class="post-ad-box-layout1 light-shadow-bg">
            <div class="post-ad-form light-box-content">
                <div class="post-alert alert alert-success">You have more {{\App\Models\Post::where('status',2)->count()}} free ads.</div>
                <form onsubmit="return false" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="post-section post-type">
                        <div class="post-ad-title">
                            <i class="fa fa-tags"></i>
                            <h3 class="item-title">@lang('lang.pages.post.select_type')</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.select_type.ad_type')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" name="ad_type" id="ad_type">
                                        <option value="">--@lang('lang.pages.allads.select_an_option')--</option>
                                        <option value="1">@lang('lang.pages.allads.sell')</option>
                                        <option value="2">@lang('lang.pages.allads.buy')</option>
                                    </select>
                                    <div class="invalid-feedback" id="ad_type_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-section post-category">
                        <div class="row" id="init_division">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.select_type.cities')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id="cities">
                                        <option value=""> - @lang('lang.pages.allads.select_an_option') -</option>
                                        @php
                                        $lang_name=('name_'.app()->getLocale());
                                        @endphp
                                        @foreach($division as $div)
                                        <option value="{{$div->id}}">{{$div->$lang_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="cities_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="init_location">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.select_type.areas')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id="areas">
                                        <option value="">- @lang('lang.pages.allads.select_an_option') -</option>
                                    </select>
                                    <div class="invalid-feedback" id="areas_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-ad-title">
                            <i class="fa fa-tags"></i>
                            <h3 class="item-title">@lang('lang.pages.post.fields.select_category.title')</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.select_category.category')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" name="category" id="category">
                                        <option value="">--@lang('lang.pages.allads.select_an_option')--</option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->$lang_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="category_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="init_sub_category">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.select_category.sub_category')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" name="sub_category" id="sub_category">
                                    </select>
                                    <div class="invalid-feedback" id="sub_category_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="post-section post-information d-none">
                        <div class="post-ad-title">
                            <i class="fa fa-folder-open"></i>
                            <h3 class="item-title">@lang('lang.pages.post.fields.product_information.title')</h3>
                        </div>
                        <div class="row" id="init_title">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.product_information.ad_title')
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title">
                                    <div class="invalid-feedback" id="title_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div id="data-init">
                    </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    @lang('lang.pages.post.fields.product_information.description')
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <textarea name="description" class="form-control textarea" id="description" cols="30" rows="8"></textarea>
                                    <div class="invalid-feedback" id="description_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="init_price">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    {{__('lang.pages.post.fields.product_information.price')}}
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="price" id="price">
                                    <div class="invalid-feedback" id="price_msg">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="post-section post-img" id="init_image">
                        <div class="post-ad-title">
                            <i class="far fa-image"></i>
                            <h3 class="item-title">Images</h3>
                        </div>
                        <div class="form-group">
                            {{-- <div class="input-images"></div> --}}
                            <input type="text" id="demo3" value="">
                        </div>
                    </div>
                    <div class="post-section post-contact">
                        <div class="post-ad-title">
                            <i class="fa fa-user"></i>
                            <h3 class="item-title">Contact Details <div class="float-right ml-4"  id="countdown"></div></h3>
                        </div>
                        {{--  --}}
                        <div class="row" id="init_phones">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Phones
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group" id="phones">
                                    {{-- @foreach($phones as $phone)
                                    <div class="form-check form-radio-btn">
                                        <input class="form-check-input" type="radio" name="phones[]" value="{{$phone->id}}">
                                        <label class="form-check-label" for="condition">
                                            {{$phone->phone}}
                                        </label>
                                    </div>
                                    @endforeach
                                    <div class="invalid-feedback" id="phones_msg">
                                    </div> --}}
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-success mb-3" id="new-phone-btn">Add Phone Number <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            
                        </div>
                        {{--  --}}
                        <div class="row d-none" id="init_add_phone">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Phone
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" aria-label="Recipient's username" aria-describedby="basic-addon2" name="phone" id="phone">
                                    <div class="input-group-append">
                                      <button class="btn btn-success text-dark" type="button" id="otp_btn">Verify</button>
                                    </div>
                                    <div class="invalid-feedback" id="phone_msg">
                                    </div>
                                  </div>
                            </div>

                        </div>
                        <div class="row mt-3 d-none" id="otp_input">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    OTP Code
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    {{--  --}}
                                    <input type="text" class="form-control" placeholder="Enter Otp Number"  aria-describedby="basic-addon2" name="otp" id="otp">
                                    <div class="input-group-append">
                                      <button class="btn btn-success text-dark" type="button" id="add-phone">Add</button>
                                    </div>
                                    <div class="invalid-feedback" id="otp_msg">
                                    </div>
                                    {{--  --}}
                                    {{-- <input type="text" class="form-control" placeholder="Enter Otp Code"  name="otp" id="otp">
                                    <div class="invalid-feedback" id="otp_msg">
                                    </div> --}}
                                  </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
        
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <button onclick="formRequest()" type='submit' class="submit-btn" >Submit Listing</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')


@include('frontend.post.internal-assets.js.custom.form-generate')
{{-- <script src="{{asset('storage/frontend/custom/js/form-generate.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('storage/dependencies/image-uploader/dist/image-uploader.min.js')}}"></script>
<script src="{{asset('storage/dependencies/image-upload-new/jquery.uploader.min.js')}}"></script>
<script src="{{asset('storage/dependencies/countdown/countdown.js')}}"></script>
<script src="{{asset('storage/dependencies/compressor/compressor.js')}}"></script>
<script>
// IMAGE UPLOAD NEW
var imagesFiles=[];
let ajaxConfig = {
        ajaxRequester: function (config, uploadFile, pCall, sCall, eCall) {
            console.log(uploadFile)
            if(imagesFiles.length<=4 && ){
                console.log(imagesFiles.length)
                imagesFiles.push(uploadFile.file);
            }else{
                $('.jquery-uploader-select-card').addClass('d-none')
            }
            let progress = 0
            let interval = setInterval(() => {
                progress += 10;
                pCall(progress)
                if (progress >= 100) {
                    clearInterval(interval)
                    const windowURL = window.URL || window.webkitURL;
                    sCall({
                        data: windowURL.createObjectURL(uploadFile.file)
                    })
                    // eCall("上传异常")
                }
            }, 300)
        }
    }
let imageData=$("#demo3").uploader({
        multiple: true,
        ajaxConfig: ajaxConfig
    });
</script>


@include('frontend.post.internal-assets.js.script')
<script>
$('.input-images').imageUploader({
    maxFiles:5,
});


</script>
@endsection