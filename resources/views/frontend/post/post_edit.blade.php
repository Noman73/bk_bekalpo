@php
$lang_name="name_".app()->getLocale();
@endphp

@extends('layouts.guest.master')
@push('title')
bekalpo.com | Easy Buy, Easy Sell 
@endpush
@section('link')
<style>
    .is-invalid{
        border:1px solid red !important;
    }

/* .imagex {
  float: left;
  margin: 10px;
  cursor: pointer;
  width: 120px;
  height: 120px;
  position: relative;
}
.closex{
  position: absolute;
  top: 0;
  right: 0;
  z-index: 9999;
} */
</style>
<link rel="stylesheet" href="{{asset('storage/dependencies/image-uploader/dist/image-uploader.min.css')}}">
@endsection
@section('content')
<section class="inner-page-banner" data-bg-image="{{asset('storage/')}}/media/banner/banner.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs-area">
                    <h1>Post an Ad</h1>
                    <ul>
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>Post an Ad</li>
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
                            <h3 class="item-title">@lang('lang.pages.post.fields.select_type.ad_type')</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Ad Type
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select disabled class="form-control select-box" name="ad_type" id="ad_type" >
                                        <option {{$post->ad_type==1 ? 'selected' : ""}} value="1">Sell</option>
                                        <option {{$post->ad_type==2 ? 'selected' : ""}} value="2">Buy</option>
                                    </select>
                                    <div class="invalid-feedback" id="ad_type_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-section post-category">
                        <div class="post-ad-title">
                            <i class="fa fa-tags"></i>
                            <h3 class="item-title">Select Category</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Category
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select disabled class="form-control select-box" name="category" id="category">
                                        <option value="">--SELECT--</option>
                                        <option selected value="{{$post->category_id}}">{{$post->category->$lang_name}}</option>
                                    </select>
                                    <div class="invalid-feedback" id="category_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row " id="init_sub_category">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Sub Category
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select disabled class="form-control select-box" name="sub_category" id="sub_category">
                                        <option selected value="{{$post->subcategory_id}}">{{$post->subcategory->$lang_name}}</option>
                                    </select>
                                    <div class="invalid-feedback" id="sub_category_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="init_division">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Cities
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select disabled class="form-control select-box" id="cities">
                                        <option value="{{$post->division_id}}">{{$post->division->$lang_name}}</option>
                                    </select>
                                    <div class="invalid-feedback" id="cities_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="init_location">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Areas
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select disabled class="form-control select-box" id="areas">
                                        <option value="{{$post->district_id}}">{{$post->district->$lang_name}}</option>
                                    </select>
                                    <div class="invalid-feedback" id="areas_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-section post-information">
                        <div class="post-ad-title">
                            <i class="fa fa-folder-open"></i>
                            <h3 class="item-title">Product Information</h3>
                        </div>
                        <div class="row" id="init_title">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Title
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
                                    <div class="invalid-feedback" id="title_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- init data--}}
                    <div id="data-init">
                        {{-- @if($post->condition!=null)
                        <div class="row" id="init_condition">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Condition
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="form-check form-radio-btn">
                                        <input {{($post->condition==1 ? 'checked': '')}} class="form-check-input" type="radio"  name="condition[]" value="1">
                                        <label class="form-check-label" for="condition">
                                            New
                                        </label>
                                    </div>
                                    <div class="form-check form-radio-btn">
                                        <input {{($post->condition==2 ? 'checked': '')}} class="form-check-input" type="radio" name="condition[]" value="2">
                                        <label class="form-check-label" for="condition">
                                            Used
                                        </label>
                                    </div>
                                    <div class="invalid-feedback" id="condition_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($post->authenticity!=null)
                        <div class="row" id="init_authenticity">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Authenticity
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="form-check form-radio-btn">
                                        <input {{($post->authenticity==1 ? 'checked' : '')}} class="form-check-input" type="radio" name="authenticity[]" value="1">
                                        <label class="form-check-label" for="exampleRadios3">
                                            Original
                                        </label>
                                    </div>
                                    <div class="form-check form-radio-btn">
                                        <input {{($post->authenticity==1 ? 'checked' : '')}} class="form-check-input" type="radio"  name="authenticity[]" value="2">
                                        <label class="form-check-label" for="exampleRadios4">
                                            Copy
                                        </label>
                                    </div>
                                    <div class="invalid-feedback" id="authenticity_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($post->brand_id!=null)
                        <div class="row" id="init_brand">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Brand
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id="brand" name="brand">
                                    <option value="">-Select An Option-</option>
                                    @foreach($brands as $brand)
                                    <option {{ $post->brand_id==$brand->id ? 'selected' :'' }} value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="brand_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($post->model_id!=null)
                        <div class="row" id="init_model">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Model
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id="model">
                                        <option value="">-Select An Option-</option>
                                        @foreach($models as $model)
                                        <option {{$post->model_id==$model->id ? "selected" : ""}} value="{{$model->id}}">{{$model->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="model_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($postfeature->count()>0)
                        <div class="row" id="init_feature">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Features
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    @foreach($features as $feature)
                                    <div class="form-check form-check-box">
                                        <input class="form-check-input" type="checkbox" name="feature[]" value="{{$feature->id}}">
                                        <label class="form-check-label" for="{{$feature->name}}">{{$feature->name}}</label>
                                     </div>
                                    @endforeach
                                    <div class="invalid-feedback" id="feature_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($postfueltype->count()>0)
                        <div class="row" id="init_feature">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Fuel Type
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    @foreach($fueltype as $fuel)
                                    <div class="form-check form-check-box">
                                        <input class="form-check-input" type="checkbox" name="fueltype[]" value="{{$fuel->id}}">
                                        <label class="form-check-label" for="{{$fuel->name}}">{{$fuel->name}}</label>
                                     </div>
                                    @endforeach
                                    <div class="invalid-feedback" id="fuel_type_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif --}}
                    </div>
                    {{-- end init data  --}} 
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Description
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
                                    Price
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
                        <div class="images">

                        </div>
                        <div class="form-group">
                            <div class="input-images"></div>
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
                                    @foreach($phones as $phone)
                                    <div class="form-check form-radio-btn">
                                        <input class="form-check-input" type="radio" name="phones[]" value="{{$phone->id}}">
                                        <label class="form-check-label" for="condition">
                                            {{$phone->phone}}
                                        </label>
                                    </div>
                                    @endforeach
                                    <div class="invalid-feedback" id="phones_msg">
                                    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('storage/dependencies/image-uploader/dist/image-uploader.min.js')}}"></script>
<script src="{{asset('storage/dependencies/countdown/countdown.js')}}"></script>

{{-- @include('frontend.post.internal-assets.js.script') --}}
<script src="{{asset('storage/dependencies/compressor/compressor.js')}}"></script>
@include('frontend.post.internal-assets.js.edit-script')
@include('frontend.post.internal-assets.js.custom.form-generate-edit')
<script>
$('.input-images').imageUploader({
    maxFiles:5,
});
</script>
@endsection