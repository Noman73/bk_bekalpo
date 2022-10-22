@extends('layouts.admin.admin-master')

@section('link')
<link rel="stylesheet" href="{{asset('')}}/storage/dependencies/bootstrap/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/fontawesome/css/all.min.css">
   
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/flaticon/flaticon.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/owl.carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/owl.carousel/css/owl.theme.default.min.css">
    <!-- Animated Headlines CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/jquery-animated-headlines/css/jquery.animatedheadline.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/magnific-popup/css/magnific-popup.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/animate.css/css/animate.min.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('')}}/storage/dependencies/meanmenu/css/meanmenu.min.css">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{asset('')}}/storage/assets/css/app.css">
    <link rel="stylesheet" href="{{asset('')}}/storage/admin/vendor/sweetalert2/dist/sweetalert2.min.css">
@endsection
@section('content')
<!--=====================================-->
        <!--=          Product Start         =-->
        <!--=====================================-->
        <section class="single-product-wrap-layout1 section-padding-equal-70 bg-accent">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="single-product-box-layout1">
                            <div class="product-info light-shadow-bg">
                                <div class="product-content light-box-content">
                                    <h4><strong>{{$post->title}}</strong></h4>
                                    <div class="item-img-gallery">
                                        <div class="tab-content">
                                            @foreach($post->images as $image)
                                            <div class="tab-pane fade show {{$loop->index == 0 ? 'active' : ''}}" id="gallery{{$loop->index}}" role="tabpanel">
                                                <a href="#">
                                                    <img class="zoom_01" src="{{asset('storage/post_image')}}/{{$image->image}}" alt="product" data-zoom-image="{{asset('storage/media/product/')}}/{{$image->image}}">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach($post->images as $image2)
                                            <li class="nav-item">

                                                <a class="nav-link {{$loop->index == 0 ? 'active' : ''}}" data-toggle="tab" href="#gallery{{$loop->index}}" role="tab" aria-selected="true">
                                                    <img src="{{asset('storage/post_image')}}/{{$image2->image}}" alt="thumbnail">
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="single-entry-meta">
                                        <ul>
                                            <li><i class="fa fa-clock"></i>{{date('M-d-Y h:i',strtotime($post->created_at))}} </li>
                                            <li><i class="fa fa-map-marker-alt"></i>{{$post->division->name}}, {{$post->district->name}}</li>
                                        </ul>
                                        @if($post->condition!=null)
                                        <div class="item-condition">{{($post->condition==1 ? 'New' : "Used" )}}</div>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#details" role="tab" aria-selected="true">Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#features" role="tab" aria-selected="false">Features</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                                {{--  --}}
                                                <div class="item-features">
                                                    <ul class="item-meta">
                                                        @if($post->manufacture_year!=null)
                                                        <li><span>Manufacture Year:</span> {{$post->manufacture_year}}</li>
                                                        @endif
                                                        @if($post->registration_year!=null)
                                                        <li><span>Registration Year:</span> {{$post->registration_year}}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                {{--  --}}
                                                <p>{{$post->description}}</p>
                                            </div>
                                            <div class="tab-pane fade" id="features" role="tabpanel">
                                                <div class="item-features">
                                                    <ul class="item-meta">
                                                        @if($post->item_type!=null)
                                                        <li><span>Product Type :</span> {{$post->item_type->name}}</li>
                                                        @endif
                                                        @if($post->condition!=null)
                                                        <li><span>Condition :</span> {{$post->condition==1? 'New' : "Used"}}</li>
                                                        @endif
                                                        @if($post->model!=null)
                                                        <li><span>Model :</span> {{$post->model->name}}</li>
                                                        @endif
                                                        @if($post->body_type!=null)
                                                        <li><span>Body Type :</span> {{$post->bodytype->name}}</li>
                                                        @endif
                                                        @if($post->size!=null)
                                                        <li><span>size :</span> {{$post->size}}</li>
                                                        @endif
                                                        @if($post->unittype!=null)
                                                        <li><span>Unit Type :</span> {{$post->unittype->name}}</li>
                                                        @endif
                                                        @if($post->trim!=null)
                                                        <li><span>Trim/Edition :</span> {{$post->trim}}</li>
                                                        @endif
                                                        @if($post->capacity!=null)
                                                        <li><span>Capacity :</span> {{$post->capacity}}</li>
                                                        @endif
                                                        @if($post->transmission!=null)
                                                        <li><span>Transmission :</span>
                                                            @switch($post->transmission)
                                                            @case(1)
                                                                {{__('Manual')}}
                                                                @break
                                                        
                                                            @case(2)
                                                                {{__('Autometic')}}
                                                                @break
                                                            @case(3)
                                                                {{__('Others Transmission')}}
                                                                @break
                                                            @endswitch
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if(isset($feature) && $feature->count()>0)
                                                            <h4>Features :</h4>
                                                            <ul class="features-list">
                                                                @foreach($feature as $f)
                                                                <li>{{$f->feature->name}}</li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(isset($fueltype) && $fueltype->count()>0)
                                                            <h4>Fuel Type :</h4>
                                                            <ul class="features-list">
                                                                @foreach($fueltype as $f)
                                                                <li>{{$f->fueltype->name}}</li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-action-area">
                                        <ul>
                                            @if(Auth::check())
                                            @php
                                                $fav=App\Models\Favourite::where('user_id',auth()->user()->id)->where('post_id',$post->id)->count();
                                            @endphp
                                            <li class="inline-item"><a href="javascript:void(0)" {{( $fav>0 ? '' : "onclick=addFav()")}}><i  class="fa fa-heart fav {{($fav>0 ? 'text-success' : '')}}"></i></a></li>
                                            @else
                                            @endif

                                            <li class="item-social">
                                                <span class="share-title">
                                                    <i class="fa fa-share-alt"></i>
                                                    Share:
                                                </span>
                                                <span id="c-share">
                                                </span>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 sidebar-break-md sidebar-widget-area">
                        <div class="widget-lg widget-price">
                            <div class="item-price">
                                <span class="currncy-symbol">৳</span>
                                {{$post->price}}
                            </div>
                        </div>
                        <div class="widget-lg widget-author-info widget-light-bg">
                            <h3 class="widget-border-title bg-dark text-center">Seller Information</h3>
                            <div class="author-content">
                                <div class="author-name justify-content-center">
                                    <div class="item-img">
                                        <img style="height:100px;width:100px;size:cover !important; border-radius:50% !important;display:block !important;" src="{{$post->user->image==null? asset('storage/media/figure/avatar.jpg') : asset('storage/users/'.$post->user->image) }}" alt="author">
                                    </div>
                                </div>
                                <h4 class="author-title text-center bg-dark">{{$post->user->name}}</h4>
                                <div class="author-meta">
                                    <ul>
                                        <li><i class="fa fa-map-marker-alt"></i>{{$post->division->name}},{{$post->district->name}}</li>
                                    </ul>
                                </div>
                                <div class="phone-number classima-phone-reveal not-revealed" data-phone="{{$post->phones->phone}}">
                                    <div class="number"><i class="fa fa-phone"></i><span>{{substr($post->phones->phone,6)}}XXX</span></div>
                                    <div class="item-text">Click to reveal phone number</div>
                                </div>
                                <div class="author-mail">
                                    @guest
                                    <a href="javascript:void()" class="mail-btn" onclick="alert('please login first')">
                                        <i class="fa fa-envelope"></i>Email to Seller
                                    </a>
                                    @else
                                    <a href="javascript:void()" class="mail-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="fa fa-envelope"></i>Email to Seller
                                    </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                        <div class="widget-lg widget-safty-tip widget-light-bg">
                            <h3 class="widget-border-title">Safety Tips for Buyers</h3>
                            <div class="safty-tip-content">
                                <ul>
                                    <li>Meet seller at a public place</li>
                                    <li>Check The item before you buy</li>
                                    <li>Pay only after collecting The item</li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    <div class="item-review light-shadow-bg">
                        <h3 class="widget-border-title " style="color:black !important;">Take a Action</h3>
                        <form action="{{route('admin.post.update',$post->id)}}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label class=" d-block" for="">Action</label>
                                <select name="action" id="action" class="form-control">
                                    <option value="">--select--</option>
                                    <option value="2">Aprove</option>
                                    <option value="3">Reject</option>
                                    <option value="4">Need Edit</option>
                                    <option value="5">Reported</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('script')
    <script>
        var url="{{URL::to('/')}}";
    </script>
    <script src="{{asset('')}}/storage/dependencies/jquery/js/jquery.min.js"></script>
    <!-- Popper Js -->
    <script src="{{asset('')}}/storage/dependencies/popper.js/js/popper.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="{{asset('')}}/storage/dependencies/bootstrap/js/bootstrap.min.js"></script>
    <!-- Waypoints Js -->
    <script src="{{asset('')}}/storage/dependencies/waypoints/js/jquery.waypoints.min.js"></script>
    <!-- Counterup Js -->
    <script src="{{asset('')}}/storage/dependencies/jquery.counterup/js/jquery.counterup.min.js"></script>
    <!-- Owl Carousel Js -->
    <script src="{{asset('')}}/storage/dependencies/owl.carousel/js/owl.carousel.min.js"></script>
    <!-- ImagesLoaded Js -->
    <script src="{{asset('')}}/storage/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
    <!-- Isotope Js -->
    <script src="{{asset('')}}/storage/dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
    <!-- Animated Headline Js -->
    <script src="{{asset('')}}/storage/dependencies/jquery-animated-headlines/js/jquery.animatedheadline.min.js"></script>
    <!-- Magnific Popup Js -->
    <script src="{{asset('')}}/storage/dependencies/magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <!-- ElevateZoom Js -->
    <script src="{{asset('')}}/storage/dependencies/elevatezoom/js/jquery.elevateZoom-2.2.3.min.js"></script>
    <!-- Bootstrap Validate Js -->
    <script src="{{asset('')}}/storage/dependencies/bootstrap-validator/js/validator.min.js"></script>
    <!-- Meanmenu Js -->
    <script src="{{asset('')}}/storage/dependencies/meanmenu/js/jquery.meanmenu.min.js"></script>
    <script src="{{asset('')}}/storage/admin/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>
    <!-- Site Scripts -->
    <script src="{{asset('')}}/storage/assets/js/app.js"></script>
@endsection