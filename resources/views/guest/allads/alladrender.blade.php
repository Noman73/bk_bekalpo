@php
use App\Http\Traits\Number;
$lang_name="name_".app()->getLocale();
@endphp


@if($posts->count()>0)
    @if(app()->getLocale()=='en')
    <input type="hidden" id="item-title" value="{{'Showing '.$posts->count().' of '.$posts->total().' Result' }}">
    @else
    <input type="hidden" id="item-title" value="{{'দেখছেন '.Number::num($posts->count(),app()->getLocale()).' টি বিজ্ঞাপন '.Number::num($posts->total(),app()->getLocale()).' টির মধ্যে' }}">
    @endif
@endif
@foreach($posts as $post)
<div class="col-xl-4 col-md-6 col-6" onclick="location='{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}'">
    <div class="product-grid-view">
        <div class="grid-view-layout1">
            <div class="product-box-layout1 ">
                <div class="item-img">
                    <a href="{{URL::to('/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}" class=""><img style="width: 120px !important;height: 100px !important;object-fit: cover !important;object-position: 50% 50% !important;"  src="{{asset('storage/post_image').'/'.(isset($post->images[0]->image) ? $post->images[0]->image : '' )}}" alt="Product"></a>
                </div>
                <div class="item-content">
                    <h3 class="item-title"><a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}">{{$post->title}}</a></h3>
                    <ul class="entry-meta">
                        <li><i class="far fa-clock"></i>{{$post->created_at->diffForHumans()}}</li>
                        <li><i class="fas fa-map-marker-alt"></i>{{$post->division->$lang_name}},{{$post->district->$lang_name}}</li>
                    </ul>
                    <div class="item-price">
                        <span class="currency-symbol">৳</span>
                        {{Number::num($post->price,app()->getLocale())}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-list-view">
        <div class="list-view-layout1">
            <div class="product-box-layout3 ">
                <div class="item-img">
                    <a href="{{URL::to('/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}" class=""><img style="width: 200px !important;height: 150px !important;object-fit: cover !important;object-position: 50% 50% !important;" src="{{asset('storage/post_image').'/'.(isset($post->images[0]->image) ? $post->images[0]->image : '' )}}" alt="Product"></a>
                </div>
                <div class="product-info">
                    <div class="item-content">
                        <h3 class="item-title"><a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}">{{$post->title}}</a></h3>
                        <ul class="item-condition">
                            @if($post->condition!=null)
                            <li><span>@lang('lang.pages.allads.condition'):</span> {{($post->condition==1 ? __('lang.pages.allads.new') : __('lang.pages.allads.used'))}}</li>
                            @endif
                            @if($post->brand!=null)
                            <li><span>@lang('lang.pages.allads.brand'):</span> {{$post->brand->$lang_name}}</li>
                            @endif
                        </ul>
                        <p>{{substr($post->description, 0, 200)}} </p>
                        <ul class="entry-meta">
                            <li><i class="far fa-clock"></i>{{$post->created_at->diffForHumans()}}</li>
                            <li><i class="fas fa-map-marker-alt"></i>{{$post->division->$lang_name}},{{$post->district->$lang_name}}</li>
                        </ul>
                    </div>
                    <div class="item-right">
                        <div class="item-price">
                            <span class="currency-symbol">৳</span>
                            {{Number::num($post->price,app()->getLocale())}}
                        </div>
                        <div class="item-btn">
                            <a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}">@lang('lang.pages.allads.details')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endforeach
@if($posts->count()>0)
<div class="col-12 ">
    {!! $posts->links('pagination::bootstrap-4') !!}
</div>
@endif



