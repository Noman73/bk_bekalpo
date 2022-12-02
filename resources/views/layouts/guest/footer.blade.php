 <footer>
     @php
     $company=App\Models\Company::first();
     @endphp
            <div class="footer-top-wrap mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-box-layout1">
                                <div class="footer-logo">
                                    <img style="height:70px;" src="{{asset('storage/logo/'.$company->logo)}}" alt="logo">
                                </div>
                                <p>{{__('lang.footer.short_description')}}</p>
                                <ul class="footer-social">
                                    <li><a href="https://www.facebook.com/bekalpo" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.twitter.com/bekalpo" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/bekalpo" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://www.instagram.com/bekalpo" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-box-layout1">
                                <div class="footer-title">
                                    <h3>{{__('lang.footer.how_to_sell_fast.title')}}</h3>
                                </div>
                                <div class="footer-menu-box">
                                    <ul>
                                        <li><a href="{{URL::to('/tips')}}">{{__('lang.footer.how_to_sell_fast.selling_tips')}}</a></li>
                                        <li><a href="{{URL::to('/banner-ads')}}">{{__('lang.footer.how_to_sell_fast.banner_advertising')}}</a></li>
                                        {{-- <li><a href="#">{{__('lang.footer.how_to_sell_fast.promote_your_ad')}}</a></li> --}}
                                        <li><a href="{{URL::to('/faq')}}">{{__('lang.footer.help_and_support.faq')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-box-layout1">
                                <div class="footer-title">
                                    <h3>{{__('lang.footer.information.title')}}</h3>
                                </div>
                                <div class="footer-menu-box">
                                    <ul>
                                        <li><a href="{{URL::to('/contact')}}">{{__('lang.footer.information.contact_info')}}</a></li>
                                        <li><a href="{{URL::to('/sitemap')}}">{{__('lang.footer.information.site_map')}}</a></li>
                                        <li><a href="{{URL::to('/privacy')}}">{{__('lang.footer.information.privacy_policy')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-box-layout1">
                                <div class="footer-title">
                                    <h3>{{__('lang.footer.help_and_support.title')}}</h3>
                                </div>
                                <div class="footer-menu-box">
                                    <ul>
                                        
                                        <li><a href="{{URL::to('/staysafe')}}">{{__('lang.footer.help_and_support.how_to_stay_safe')}}</a></li>
                                        <li><a href="{{URL::to('/terms_and_condition')}}">{{__('lang.footer.help_and_support.terms_and_condition')}}</a></li>
                                        <li><a href="{{URL::to('/about')}}">{{__('lang.footer.help_and_support.about_us')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="copyright-text">
                                © Copyright Bekalpo.com  <?php echo date("Y"); ?>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="payment-option">
                                <a href="#">
                                    <img src="media/figure/payment.png" alt="payment">
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('frontend.login.login')

    <script>
        var lang="{{app()->getLocale()}}";
        var url="{{URL::to('/')}}/"+lang;
        var this_url=window.location.href;
        var baseURL="{{URL::to('/')}}/"+(lang=='en' ? 'bn' :'en');
        
    </script>
    <!-- Jquery Js -->
    <script src="{{asset('storage/dependencies/jquery/js/jquery.min.js')}}"></script>
    <!-- Popper Js -->
    <script src="{{asset('storage/dependencies/popper.js/js/popper.min.js')}}"></script>
    <!-- Bootstrap Js -->
    <script src="{{asset('storage/dependencies/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints Js -->
    <script src="{{asset('storage/dependencies/waypoints/js/jquery.waypoints.min.js')}}"></script>
    <!-- Counterup Js -->
    <script src="{{asset('storage/dependencies/jquery.counterup/js/jquery.counterup.min.js')}}"></script>
    <!-- Owl Carousel Js -->
    <script src="{{asset('storage/dependencies/owl.carousel/js/owl.carousel.min.js')}}"></script>
    <!-- ImagesLoaded Js -->
    <script src="{{asset('storage/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Isotope Js -->
    <script src="{{asset('storage/dependencies/isotope-layout/js/isotope.pkgd.min.js')}}"></script>
    <!-- Animated Headline Js -->
    <script src="{{asset('storage/dependencies/jquery-animated-headlines/js/jquery.animatedheadline.min.js')}}"></script>
    <!-- Magnific Popup Js -->
    <script src="{{asset('storage/dependencies/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- ElevateZoom Js -->
    <script src="{{asset('storage/dependencies/elevatezoom/js/jquery.elevateZoom-2.2.3.min.js')}}"></script>
    <!-- Bootstrap Validate Js -->
    <script src="{{asset('storage/dependencies/bootstrap-validator/js/validator.min.js')}}"></script>
    <!-- Meanmenu Js -->
    <script src="{{asset('storage/dependencies/meanmenu/js/jquery.meanmenu.min.js')}}"></script>
    <script src="{{asset('storage/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
    <!-- Site Scripts -->
    <script src="{{asset('storage/assets/js/app.js')}}"></script>
    <script>
        if(this_url=="{{URL::to('/')}}/"){
            this_url=this_url+lang;
            console.log(this_url)
        }
        if(lang=='en'){
            $('#lang').text('বাংলা');
            lang_url=this_url.replace(url,baseURL);
        }else{
            $('#lang').text('English');
            lang_url=this_url.replace(url,baseURL);
        }
        $('#lang').click(function(e){
            window.location=lang_url;
        })
        console.log(lang_url,this_url)
    </script>
    @yield('script')
    @stack('scripts')
    <script>
        
        $(document).on('click','.login',function(){
            $('#loginModal').modal('show');
        })
        this_page_url="{{URL::to('/'.app()->getLocale().'/signup')}}";
        if($(('#login_email_msg').data('id')==1 || $('#login_password_msg').data('id')==1) && window.location.href==this_page_url ){
            $('#loginModal').modal('show')
        }
        
    </script>
</body>


<!-- Mirrored from www.radiustheme.com/demo/html/classima/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Jan 2022 07:15:01 GMT -->
</html>