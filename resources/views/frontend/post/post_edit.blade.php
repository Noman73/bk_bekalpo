@php
$lang_name="name_".app()->getLocale();
// dd($post);
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
                                    <select disabled class="form-control select-box" name="ad_type" id="ad_type" >
                                        <option {{$post->ad_type==1 ? 'selected' : ""}} value="1">@lang('lang.pages.allads.sell')</option>
                                        <option {{$post->ad_type==2 ? 'selected' : ""}} value="2">@lang('lang.pages.allads.buy')</option>
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
                                    <select disabled class="form-control select-box" name="category" id="category">
                                        <option value="">--@lang('lang.pages.allads.select_an_option')--</option>
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
                                    @lang('lang.pages.post.fields.select_category.sub_category')
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
                                    @lang('lang.pages.post.fields.select_type.cities')
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
                                    @lang('lang.pages.post.fields.select_type.areas')
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
                            <h3 class="item-title"> {{__('lang.pages.post.fields.product_information.images')}}</h3>
                        </div>
                        <div class="images">

                        </div>
                        <div class="form-group">
                            {{-- <div class="input-images"></div> --}}
                            <input type="text" id="demo3" value="">
                        </div>
                    </div>
                    <div class="post-section post-contact">
                        <div class="post-ad-title">
                            <i class="fa fa-user"></i>
                            <h3 class="item-title"> {{__('lang.pages.post.fields.contact_details.title')}} <div class="float-right ml-4"  id="countdown"></div></h3>
                        </div>
                        {{--  --}}
                        <div class="row" id="init_phones">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    {{__('lang.pages.post.fields.contact_details.phone')}}
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
                                    <button class="btn btn-sm btn-success mb-3" id="new-phone-btn">{{__('lang.pages.post.fields.contact_details.add_phone')}} <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            
                        </div>
                        {{--  --}}
                        <div class="row d-none" id="init_add_phone">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    {{__('lang.pages.post.fields.contact_details.phone')}}
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" aria-label="Recipient's username" aria-describedby="basic-addon2" name="phone" id="phone">
                                    <div class="input-group-append">
                                      <button class="btn btn-success text-dark" type="button" id="otp_btn">{{__('lang.pages.post.fields.contact_details.verify')}}</button>
                                    </div>
                                    <div class="invalid-feedback" id="phone_msg">
                                    </div>
                                  </div>
                            </div>

                        </div>
                        <div class="row mt-3 d-none" id="otp_input">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    {{__('lang.pages.post.fields.contact_details.otp')}}
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    {{--  --}}
                                    <input type="text" class="form-control" placeholder="Enter Otp Number"  aria-describedby="basic-addon2" name="otp" id="otp">
                                    <div class="input-group-append">
                                      <button class="btn btn-success text-dark" type="button" id="add-phone">{{__('lang.pages.post.fields.contact_details.add')}}</button>
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
                                    <button onclick="formRequest()" type='submit' class="submit-btn" >{{__('lang.pages.post.fields.contact_details.submit_btn')}}</button>
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
<script src="{{asset('storage/dependencies/image-upload-new/jquery.uploader.min.js')}}"></script>
<script src="{{asset('storage/dependencies/countdown/countdown.js')}}"></script>

{{-- @include('frontend.post.internal-assets.js.script') --}}
<script src="{{asset('storage/dependencies/compressor/compressor.js')}}"></script>


<script>
    // IMAGE UPLOAD NEW

    var imageObj=[];
    var imageData;
    var imagesFiles=[];
$(document).ready(function(){
    // image source convert to file 
    const toDataURL = url => fetch(url)
      .then(response => response.blob())
      .then(blob => new Promise((resolve, reject) => {
      const reader = new FileReader()
      reader.onloadend = () => resolve(reader.result)
      reader.onerror = reject
      reader.readAsDataURL(blob)
     }))
  function dataURLtoFile(dataurl, filename) {
     var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
     bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
     while(n--){
     u8arr[n] = bstr.charCodeAt(n);
     }
    return new File([u8arr], filename, {type:mime});
  }
    // image convert end
    post.images.forEach(function(d,index){ 
        // image conversion
        toDataURL("{{URL::to('/')}}/storage/post_image/"+d.image)
            .then(dataUrl => {
            //  console.log('Here is Base64 Url', dataUrl)
            var fileData = dataURLtoFile(dataUrl, d.image);
            //  console.log("Here is JavaScript File Object",fileData)
            imagesFiles.push(fileData)
        })
        // image conversion end
        imageObj.push({name:d.image,url:"{{URL::to('/')}}/storage/post_image/"+d.image});
    })
    console.log(imageObj)
    
    let ajaxConfig = {
            ajaxRequester: function (config, uploadFile, pCall, sCall, eCall) {
                console.log(uploadFile)
                if(imagesFiles.length<=4){
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
        imageData=$("#demo3").uploader({
            multiple: true,
            defaultValue:imageObj,
            ajaxConfig: ajaxConfig
        });
        var uploaderArr=document.getElementsByClassName('jquery-uploader-card');
        console.log(uploaderArr.length)
        for (let index = 0; index < uploaderArr.length; index++) {
            const element = uploaderArr[index];
            console.log(uploaderArr[index])
            $(uploaderArr[index]).attr('data-img',index)
        }
        $(document).on('click',".file-delete",function(){
            dt=$(this).parent().parent().parent().parent().data('img');
            console.log(dt);
            imagesFiles.splice(dt,1);
            console.log(imagesFiles)
        })
    })  
    </script>
    
@include('frontend.post.internal-assets.js.edit-script')
@include('frontend.post.internal-assets.js.custom.form-generate-edit')
<script>
// $('.input-images').imageUploader({
//     maxFiles:5,
// });






</script>
@endsection