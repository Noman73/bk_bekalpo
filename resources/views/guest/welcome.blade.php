{{-- {{App::setLocale($locale)}} --}}
@extends('layouts.guest.master')
@push('title')
bekalpo.com | Easy Buy, Easy Sell 
@endpush
@section('content')
        <!--=====================================-->
        <!--=            Banner Start           =-->
        <!--=====================================-->
        <section class="main-banner-wrap-layout2 bg-dark-overlay-2 bg-common" data-bg-image="{{asset('storage/')}}/media/banner/banner.jpg">
            <div class="container">
                <div class="main-banner-box-layout1 animated-headline">
                    <h1 class="ah-headline item-title">
                        <span class="ah-words-wrapper">
                            <b class="is-visible">{{__('lang.header.title')}}</b>
                            <b>{{__('lang.header.title')}}</b>
                        </span>
                    </h1>
                    <div class="item-subtitle">{{__('lang.homepage.banner_text')}}</div>
                    <div class="search-box-layout1">
                        <form action="">
                            <div class="row no-gutters">
                                <div class="col-lg-10 form-group">
                                    <div class="input-search-btn search-keyword">
                                        <i class="fa fa-text-width"></i>
                                        <input type="text" class="form-control" placeholder="{{__('lang.homepage.search_btn')}}..." name="keyword" id="keyword">
                                    </div>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <button type="submit" class="submit-btn"><i class="fa fa-search"></i>{{__('lang.homepage.search_btn')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            @if(Session::has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        <!--=====================================-->
        <!--=            Category Start           =-->
        <!--=====================================-->
        @include('frontend.category.category')
        <!--=====================================-->
        <!--=            Product Start          =-->
        <!--=====================================-->
        
   @endsection
   @section('script')
   @include('guest.internal-assets.js.script')
   @endsection    