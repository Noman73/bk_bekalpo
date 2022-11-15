<!DOCTYPE html>
<html class="no-js" lang="">
<!-- Mirrored from www.radiustheme.com/demo/html/classima/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Jan 2022 07:14:52 GMT -->
<head>
    <!-- Meta Data -->
    @php
    use App\Models\Company;
    $company=Company::first();
    // print_r($company);
    @endphp
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@stack('title') {{--{{$company->name}} {{$company->title}} --}}</title>
    <meta property="og:description" name="description" content="@stack('meta-description')">
    <meta property="og:image" content="@stack('meta-image')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/logo/'.$company->icon)}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/bootstrap/css/bootstrap.min.css')}}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/fontawesome/css/all.min.css')}}">
   
    <link rel="stylesheet" href="{{asset('storage/dependencies/flaticon/flaticon.css')}}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/owl.carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('storage/dependencies/owl.carousel/css/owl.theme.default.min.css')}}">
    <!-- Animated Headlines CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/jquery-animated-headlines/css/jquery.animatedheadline.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/magnific-popup/css/magnific-popup.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/animate.css/css/animate.min.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('storage/dependencies/meanmenu/css/meanmenu.min.css')}}">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{asset('storage/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('storage/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}">
    @yield('link')
    <style>
        #preloader {
            background: #ffffff url("{{asset('storage/media/preloader.gif')}}") no-repeat scroll center center;
            height: 100%;
            left: 0;
            overflow: visible;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999999;
        }
        .is-invalid{
            border: 1px solid red !important;
        }
    </style>
    <!-- Google Web Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> --}}
</head>

<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <!-- ScrollUp Start Here -->
    <a href="#wrapper" data-type="section-switch" class="scrollup">
        <i class="fa fa-angle-double-up"></i>
    </a>
    <!-- ScrollUp End Here -->
    <!-- Preloader Start Here -->
    {{-- <div id="preloader"></div> --}}
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper">

        <!--=====================================-->
        <!--=            Header Start           =-->
        <!--=====================================-->
        <header class="header">
            <div id="rt-sticky-placeholder"></div>
            <div id="header-menu" class="header-menu menu-layout2 p-2">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-2">
                            <div class="logo-area">
                                <a href="{{URL::to('/'.app()->getLocale())}}" class="temp-logo">
                                    <img style="height:70px;" src="{{asset('storage/logo/'.$company->logo)}}" alt="logo" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end float-right">
                            <nav id="dropdown" class="template-main-menu ">
                                <ul>
                                    <li>
                                        <a id="lang"  href="javascript:void(0)">বাংলা</a>
                                    </li>
                                    <li>

                                        {{-- <a  href="{{route('admin.login')}}">{{__('lang.header.all_ads')}}</a> --}}
                                        <a  href="{{URL::to(app()->getLocale().'/ads')}}">{{__('lang.header.all_ads')}}</a>
                                    </li>
                                   
                                    @guest
                                    <li class="d-md-none">
                                        <a  href="javascript:void(0)" class="login"><i class="fa fa-user"></i></a>
                                    </li>
                                    @endguest
                                </ul>
                            </nav>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end">
                            <div class="header-action-layout1">
                                <ul>
                                    <li class="header-login-icon">
                                        @guest
                                        <a href="javascript:void(0)" id="login" class="color-primary login" data-toggle="tooltip" data-placement="top" title="Login/Register">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        @else
                                        <a href="{{URL::to(app()->getLocale().'/account')}}" id="my_account" class="color-primary">
                                            {{-- <i class="fa fa-user"></i> --}}
                                            <i class="fa fa-user"></i>
                                        </a>
                                        @endguest
                                    </li>
                                    <li class="header-btn">
                                        @guest
                                        <a href="javascript:void(0)" class="item-btn login"><i class="fa fa-plus"></i>{{__('lang.header.post_your_ad')}}</a>
                                        @else
                                        <a href="{{URL::to(app()->getLocale().'/post/create')}}" class="item-btn"><i class="fa fa-plus"></i>{{__('lang.header.post_your_ad')}}</a>
                                        @endguest
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>