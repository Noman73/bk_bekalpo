@extends('layouts.guest.master')
@push('title')
bekalpo.com | {{$post->title}}
@endpush
@push('meta-description')
{{$post->description}}
@endpush
@push('meta-image')
{{asset('storage/post_image')}}/{{$post->images[0]->image}}
@endpush
@section('content')
@section('link')
<style>
    .nav-tabs img{
        width: 120px;
        height: 100px;
        object-fit: cover;
        object-position: 50% 50%;
    }
</style>
@endsection
@php
use App\Http\Traits\Number;
$lang_name="name_".app()->getLocale();

@endphp
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
                                        <div class="tab-content" >
                                            @foreach($post->images as $image)
                                            <div  class="tab-pane text-center fade show {{$loop->index == 0 ? 'active' : ''}}" id="gallery{{$loop->index}}" role="tabpanel">
                                                <a href="#">
                                                    <img style="max-height:500px;width:auto;" class="zoom_01" src="{{asset('storage/post_image')}}/{{$image->image}}" alt="product" data-zoom-image="{{asset('storage/media/product/')}}/{{$image->image}}">
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
                                            <li><i class="fa fa-map-marker-alt"></i>{{$post->division->$lang_name}}, {{$post->district->$lang_name}}</li>
                                        </ul>
                                        @if($post->condition!=null)
                                        @php
                                        switch ($post->condition) {
                                            case 1:
                                                $cond=__('lang.pages.allads.new');
                                                break;
                                            case 2:
                                                $cond=__('lang.pages.allads.used');
                                                break;
                                            case 3:
                                                $cond=__('lang.pages.allads.recondition');
                                                break;
                                            default:
                                                $cond="";
                                                break;
                                        }
                                        @endphp
                                        <div class="item-condition">{{$cond}}</div>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#details" role="tab" aria-selected="true">@lang('lang.pages.allads.details')</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#features" role="tab" aria-selected="false">@lang('lang.pages.singlead.features')</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                                {{--  --}}
                                                <div class="item-features">
                                                    <ul class="item-meta">
                                                        @if($post->manufacture_year!=null)
                                                        <li><span>@lang('lang.pages.allads.manufacture_year'):</span> {{Number::num($post->manufacture_year)}}</li>
                                                        @endif
                                                        @if($post->registration_year!=null)
                                                        <li><span>@lang('lang.pages.allads.registration_year'):</span> {{$post->registration_year}}</li>
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
                                                        <li><span>@lang('lang.pages.singlead.product_type') :</span> {{$post->item_type->$lang_name}}</li>
                                                        @endif
                                                        @if($post->condition!=null)
                                                        <li><span>@lang('lang.pages.allads.condition') :</span> {{$post->condition==1? __('lang.pages.allads.new') : __('lang.pages.allads.used')}}</li>
                                                        @endif
                                                        @if($post->model!=null)
                                                        <li><span>@lang('lang.pages.allads.model') :</span> {{$post->model->$lang_name}}</li>
                                                        @endif
                                                        @if($post->body_type!=null)
                                                        <li><span>@lang('lang.pages.allads.body_type'):</span> {{$post->bodytype->$lang_name}}</li>
                                                        @endif
                                                        @if($post->size!=null)
                                                        <li><span>@lang('lang.pages.singlead.size') :</span> {{$post->size}}</li>
                                                        @endif
                                                        @if($post->unittype!=null)
                                                        <li><span>@lang('lang.pages.singlead.unit_type') :</span> {{$post->unittype->$lang_name}}</li>
                                                        @endif
                                                        @if($post->trim!=null)
                                                        <li><span>@lang('lang.pages.singlead.trim') :</span> {{$post->trim}}</li>
                                                        @endif
                                                        @if($post->capacity!=null)
                                                        <li><span>@lang('lang.pages.allads.capacity') :</span> {{$post->capacity}}</li>
                                                        @endif
                                                        @if($post->transmission!=null)
                                                        <li><span>@lang('lang.pages.allads.transmission') :</span>
                                                            @switch($post->transmission)
                                                            @case(1)
                                                                {{__('lang.pages.singlead.manual')}}
                                                                @break
                                                        
                                                            @case(2)
                                                                {{__('lang.pages.singlead.autometic')}}
                                                                @break
                                                            @case(3)
                                                                {{__('lang.pages.singlead.others_transmission')}}
                                                                @break
                                                            @endswitch
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if(isset($feature) && $feature->count()>0)
                                                            <h4>@lang('lang.pages.singlead.features') :</h4>
                                                            <ul class="features-list">
                                                                @foreach($feature as $f)
                                                                <li>{{$f->feature->$lang_name}}</li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(isset($fueltype) && $fueltype->count()>0)
                                                            <h4>Fuel Type :</h4>
                                                            <ul class="features-list">
                                                                @foreach($fueltype as $f)
                                                                <li>{{$f->fueltype->$lang_name}}</li>
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
                                            <li class="inline-item"><a href="javascript:void(0)" onclick="getReportModal({{$post->id}})">report ad</a></li>
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
                                {{Number::num($post->price,app()->getLocale())}}
                            </div>
                        </div>
                        <div class="widget-lg widget-author-info widget-light-bg">
                            <h3 class="widget-border-title">@lang('lang.pages.singlead.seller_info')</h3>
                            <div class="author-content">
                                <div class="author-name justify-content-center">
                                    <div class="item-img">
                                        <img style="height:100px;width:100px;size:cover !important; border-radius:50% !important;display:block !important;" src="{{$post->user->image==null? asset('storage/media/figure/avatar.jpg') : asset('storage/users/'.$post->user->image) }}" alt="author">
                                    </div>
                                </div>
                                <h4 class="author-title text-center"><a href="javascript:void(0)">{{$post->user->name}}</a></h4>
                                <div class="author-meta">
                                    <ul>
                                        <li><i class="fa fa-map-marker-alt"></i>{{$post->division->$lang_name}},{{$post->district->$lang_name}}</li>
                                    </ul>
                                </div>
                                <div class="phone-number classima-phone-reveal not-revealed" data-phone="{{Number::num($post->phones->phone,app()->getLocale())}}">
                                    <div class="number"><i class="fa fa-phone"></i><span>{{Number::num(substr($post->phones->phone,6),app()->getLocale())}}XXX</span></div>
                                    <div class="item-text">@lang('lang.pages.singlead.click_to')</div>
                                </div>
                                <div class="author-mail">
                                    @guest
                                    <a href="javascript:void()" class="mail-btn" onclick="alert('please login first')">
                                        <i class="fa fa-envelope"></i>@lang('lang.pages.singlead.mail_to')
                                    </a>
                                    @else
                                    <a href="javascript:void()" class="mail-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="fa fa-envelope"></i>@lang('lang.pages.singlead.mail_to')
                                    </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                        <div class="widget-lg widget-safty-tip widget-light-bg">
                            <h3 class="widget-border-title">@lang('lang.pages.singlead.safety_tips.title')</h3>
                            <div class="safty-tip-content">
                                <ul>
                                    <li>@lang('lang.pages.singlead.safety_tips.no1')</li>
                                    <li>@lang('lang.pages.singlead.safety_tips.no2')</li>
                                    <li>@lang('lang.pages.singlead.safety_tips.no3')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-related-product light-shadow-bg col-md-9">
                    <div class="flex-heading-layout2">
                        <h3 class="widget-border-title">Related Ads</h3>
                        <div id="owl-nav1" class="smart-nav-layout1">
                            <span class="rt-prev">
                                <i class="fa fa-angle-left"></i>
                            </span>
                            <span class="rt-next">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </div>
                    </div>
                    <div class="light-box-content">
                        <div class="rc-carousel" data-loop="true" data-items="4" data-margin="30" data-custom-nav="#owl-nav1" data-autoplay="false" data-autoplay-timeout="3000" data-smart-speed="1000" data-dots="false" data-nav="false" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="false" data-r-small="2" data-r-small-nav="false" data-r-small-dots="false" data-r-medium="2" data-r-medium-nav="false" data-r-medium-dots="false" data-r-large="3" data-r-large-nav="false" data-r-large-dots="false" data-r-extra-large="3" data-r-extra-large-nav="false" data-r-extra-large-dots="false">
                            {{--  --}}
                            @foreach($rel_product as $rel)
                            @php
                        
                            @endphp
                            <div class="product-box-layout1 box-shadwo-light mg-1">
                                <div class="item-img">
                                    <a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$rel->title.'/'.$rel->id)}}"><img style="width: 100% !important;max-height: 150px !important;object-fit: cover !important;object-position: 50% 50% !important;" src="{{asset('storage/post_image/'.$rel->images[0]->image)}}" alt="Product"></a>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$rel->title.'/'.$rel->id)}}">{{$rel->title}}</a></h3>
                                    <ul class="entry-meta">
                                        <li><i class="fa fa-clock"></i>{{$rel->created_at}}</li>
                                        <li><i class="fa fa-map-marker-alt"></i>{{$rel->division->$lang_name}}, {{$rel->district->$lang_name}}</li>
                                    </ul>
                                    <div class="item-price">
                                        <span class="currency-symbol">$</span>
                                    {{Number::num($rel->price,app()->getLocale())}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- modal start --}}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="item-review light-shadow-bg">
                        <h3 class="widget-border-title">Send Message To Seller</h3>
                        <div class="light-box-content">
                            <form action="#">
                                <div class="form-group">
                                    <label for="">Subject : </label>
                                    <input type="text" class="form-control bg-color" name="subject" id="subject" placeholder="Enter Subject">
                                </div>
                                <div class="form-group">
                                    <label for="">Message : </label>
                                    <textarea class="form-control bg-color" name="" id="message"  rows="5" placeholder="write message"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button onclick="emailSend()" type="button" class="btn btn-primary">Send</button>
                </div>
              </div>
            </div>
          </div>
    {{-- modal end --}}
    {{-- report modal --}}
    <div id="render-report-modal">

    </div>
@endsection
@section('script')
<script src="{{asset('storage/dependencies/elevatezoom/js/jquery.elevateZoom-2.2.3.min.js')}}"></script>
<script src="{{asset('storage/dependencies/watermark/watermark.js')}}">
</script>
    @include('frontend.single-ad.internal-assets.js.script')
    @push('scripts')
    <script src="{{asset('storage/dependencies/c-share/c-share.js')}}"></script>
    <script>
        $('#c-share').cShare({
            description: '{{$post->description}}',
            showButtons: ['fb', 'twitter', 'line', 'plurk', 'weibo', 'tumblr', 'email']
        });
    </script>
    <script>
        function emailSend(){
            subject=$('#subject').val();
            message=$('#message').val();
            $.post(url+"/sendEmail"+"/{{$post->user_id}}",{_token:"{{csrf_token()}}",message:message,subject:subject})
            .then((res)=>{
                console.log(res);
                if(res.message){
                    $('#message').val('');
                    $('#subject').val('');
                    $('#exampleModalCenter').modal('hide');
                    alert('Message Succesfully Send');
                }
            })
        }
        function addFav(){
            $.get(url+'/add_fav/'+"{{$post->id}}")
            .then(res=>{
                if(res.message){
                    $('.fav').addClass('text-success');
                }else{
                    alert(res.error);
                }
            })
        }
        function getReportModal(id){
            $.get(url+'/report_modal/'+id)
            .then(res=>{
                $('#render-report-modal').html(res);
                $('#reportModal').modal('show');
            })
        }
        function reportRequest(id){
            var description=$('#description').val();
            $.post(url+'/report_ad',{_token:"{{csrf_token()}}",description:description,post_id:id})
            .then(res=>{
                if(res.message){
                    $('#reportModal').modal('hide');
                    setTimeout(() => {
                        $('#render-report-modal').empty();
                    },300)
                    Swal.fire(
                    'Good job!',
                    res.message,
                    'success'
                )
                }
            })
        }
    </script>
    @endpush

<script>

</script>
@endsection