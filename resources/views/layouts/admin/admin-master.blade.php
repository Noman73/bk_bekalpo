<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:title" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	@php 
	$company=App\Models\Company::first();
	@endphp
	<title>{{$company->name}} Admin</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
	<link href="{{asset('storage/admin/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{asset('storage/admin/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<!-- Style css -->
    <link href="{{asset('storage/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('storage/admin/vendor/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('storage/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('storage/admin/css/nice-select-search.css')}}" rel="stylesheet">

	@yield('link')
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
				
				<img style="width:120px;" src="{{asset('storage/logo'.'/'.$company->logo)}}" alt="logo">
				
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
	
		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Admin
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">

							
							
							
							
							<li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="{{asset('storage/media/figure')}}/avatar.jpg" width="20" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<div class="dropdown header-profile2 ">
					<a class="nav-link " href="javascript:void(0);"  role="button" data-bs-toggle="dropdown">
						<div class="header-info2 d-flex align-items-center">
							<img src="{{asset('storage/media/figure')}}/avatar.jpg" alt=""/>
							<div class="d-flex align-items-center sidebar-info">
								<div>
									<span class="font-w400 d-block">{{auth()->user()->name}}</span>
									<small class="text-end font-w400">Superadmin</small>
								</div>	
								<i class="fas fa-chevron-down"></i>
							</div>
							
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
							<svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
							<span class="ms-2">Logout </span>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</div>
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Category</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{route('admin.category.create')}}">Category</a></li>
							<li><a href="{{route('admin.sub-category.create')}}">Sub Category</a></li>
						</ul>

                    </li>
					<li>
						<a href="{{route('admin.brand.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Brand</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.model.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Model</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.feature.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Feature</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.item_type.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Item Type</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.fuel.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Fuel Type</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.body-type.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Body Type</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.unit.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Unit Type</span>
						</a>
					</li>
					{{-- city --}}
					<li>
						<a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Location</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('admin.cities.create')}}">Cities</a></li>
							<li><a href="{{route('admin.areas.create')}}">Areas</a></li>
						</ul>
					</li>
					<li>
						<a href="{{route('admin.field_permission.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Permission</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.feature_request.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Feature Request</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.package.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Package</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.payment.create')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Payment Gateway</span>
						</a>
					</li>
					<li>
						<a href="{{URL::to('admin/company')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Company Info</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.post.index')}}" class="" aria-expanded="false">
							<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Manage Ads</span>
						</a>
					</li>
					<li>
						<a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Company Rules</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('admin.termscondition.index')}}">Terms And Condition</a></li>
							<li><a href="{{route('admin.privacy.create')}}">Privacy Policy</a></li>
							<li><a href="{{route('admin.aboutus.create')}}">About Us</a></li>
							<li><a href="{{route('admin.sell_tips.create')}}">Sell Tips</a></li>
							<li><a href="{{route('admin.stay-safe.create')}}">Stay Safe</a></li>
							<li><a href="{{route('admin.banner-ads.create')}}">Banner Ads</a></li>
							<li><a href="{{route('admin.contact-info.create')}}">Contact Info</a></li>
							<li><a href="{{route('admin.faq.create')}}">Faq</a></li>
						</ul>
					</li>

                </ul>
			</div>
        </div>
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
				@yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
		
		
		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Developed by <a href="https://www.ongsho.com/" target="_blank" title="Ongsho Limited">Ongsho</a> 2021</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->
	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
	<script src="{{asset('storage/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('storage/admin/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('storage/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('storage/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
	<!-- Apex Chart -->
	<script src="{{asset('storage/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<!-- Chart piety plugin files -->
    <script src="{{asset('storage/admin/vendor/peity/jquery.peity.min.js')}}"></script>
	<!-- Dashboard 1 -->
	<script src="{{asset('storage/admin/vendor/owl-carousel/owl.carousel.js')}}"></script>
    <script src="{{asset('storage/admin/js/custom.min.js')}}"></script>
	<script src="{{asset('storage/admin/js/dlabnav-init.js')}}"></script>
	<script src="{{asset('storage/admin/vendor/axios/axios.min.js')}}"></script>
	<script src="{{asset('storage/admin/vendor/toastr/js/toastr.min.js')}}"></script>
	<script src="{{asset('storage/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
	<script src="{{asset('storage/admin/js/nice_select_search.js')}}"></script>

	<script>
		jQuery(document).ready(function(){
			setTimeout(function(){
				dlabSettingsOptions.version = 'dark';
				new dlabSettings(dlabSettingsOptions);
			},0)
		});
		function JobickCarousel()
			{
				/*  testimonial one function by = owl.carousel.js */
				jQuery('.front-view-slider').owlCarousel({
					loop:false,
					margin:30,
					nav:true,
					autoplaySpeed: 3000,
					navSpeed: 3000,
					autoWidth:true,
					paginationSpeed: 3000,
					slideSpeed: 3000,
					smartSpeed: 3000,
					autoplay: false,
					animateOut: 'fadeOut',
					dots:true,
					navText: ['', ''],
					responsive:{
						0:{
							items:1
						},
						
						480:{
							items:1
						},			
						
						767:{
							items:3
						},
						1750:{
							items:3
						}
					}
				})
			}
			jQuery(window).on('load',function(){
				setTimeout(function(){
					JobickCarousel();
				}, 1000); 
			});
	</script>
@yield('script')
</body>
</html>