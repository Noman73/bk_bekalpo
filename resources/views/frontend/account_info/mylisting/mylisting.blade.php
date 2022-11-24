
@php
$lang_name='name_'.app()->getLocale();
@endphp
    <div class="myaccount-listing">
        @foreach($posts as $post)
        <div class="list-view-layout1">
            <div class="product-box-layout3 {{$post->status==7 ? "bg-dark" : "" }}">
                <div class="item-img">
                    <a href="{{URL::to(app()->getLocale().'/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}" class="item-trending"><img src="{{asset('storage/post_image').'/'.(isset($post->images[0]->image) ? $post->images[0]->image : '' )}}" alt="Product"></a>
                </div>
                <div class="item-content">
                    <h3 class="item-title"><a href="single-product1.html">{{$post->title}}</a><span>{{__('lang.pages.mylist.new')}}</span></h3>
                    <ul class="entry-meta">
                        <li><i class="far fa-clock"></i>{{$post->created_at}}</li>
                        <li><i class="fas fa-map-marker-alt"></i>{{$post->division->$lang_name}}, {{$post->district->$lang_name}}</li>
                    </ul>
                    <ul class="item-condition">
                        @if($post->condition!=null)
                        <li><span>{{__('lang.pages.mylist.condition')}}:</span> {{($post->condition==1 ? __('lang.pages.mylist.new') : __('lang.pages.mylist.used'))}}</li>
                        @endif
                        @if($post->brand!=null)
                        <li><span>{{__('lang.pages.mylist.brand')}}:</span> {{$post->brand->$lang_name}}</li>
                        @endif
                    </ul>
                    <div class="">
                        <button  class="btn btn-sm btn-primary promoteRow" data-url="{{URL::to(app()->getLocale().'/myad_promote'.'/'.$post->id)}}">{{__('lang.pages.mylist.promote')}}</button>
                        <button  class="btn btn-sm btn-primary m-1 edit" data-url="{{URL::to(app()->getLocale().'/post'.'/'.$post->id.'/edit')}}">{{__('lang.pages.mylist.edit')}}</button>
                        <button  class="deleteRow btn btn-sm btn-primary" data-url="{{URL::to(app()->getLocale().'/my_post_action'.'/'.$post->id)}}">{{__('lang.pages.mylist.delete')}}</button>
                    </div>
                </div>
                <div class="item-right">
                    <div class="item-price">
                        <span class="currency-symbol">৳</span>
                        {{$post->price}}
                    </div>
                    <div class="item-btn">
                        <a href="#">{{__('lang.pages.mylist.details')}}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    {{--  --}}
    </div>
    <div class="">
        {!! $posts->links('pagination::bootstrap-4') !!} 
    </div>

    