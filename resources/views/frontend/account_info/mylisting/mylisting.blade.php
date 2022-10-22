
    <div class="myaccount-listing">
        @foreach($posts as $post)
        <div class="list-view-layout1">
            <div class="product-box-layout3 {{$post->status==7 ? "bg-dark" : "" }}">
                <div class="item-img">
                    <a href="{{URL::to('/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}" class="item-trending"><img src="{{asset('storage/post_image').'/'.(isset($post->images[0]->image) ? $post->images[0]->image : '' )}}" alt="Product"></a>
                </div>
                <div class="item-content">
                    <h3 class="item-title"><a href="single-product1.html">{{$post->title}}</a><span>New</span></h3>
                    <ul class="entry-meta">
                        <li><i class="far fa-clock"></i>{{$post->created_at}}</li>
                        <li><i class="fas fa-map-marker-alt"></i>{{$post->division->name}}, {{$post->district->name}}</li>
                    </ul>
                    <ul class="item-condition">
                        @if($post->condition!=null)
                        <li><span>Condition:</span> {{($post->condition==1 ? "New" : "Used")}}</li>
                        @endif
                        @if($post->brand!=null)
                        <li><span>Brand:</span> {{$post->brand->name}}</li>
                        @endif
                    </ul>
                    <div class="">
                        <button  class="btn btn-sm btn-primary promoteRow" data-url="{{route('users.myad_promote',$post->id)}}">Promote</button>
                        <button  class="btn btn-sm btn-primary m-1 edit" data-url="{{route('users.post.edit',$post->id)}}">Edit</button>
                        <button  class="deleteRow btn btn-sm btn-primary" data-url="{{route('users.my_post_action',$post->id)}}">Delete</button>
                    </div>
                </div>
                <div class="item-right">
                    <div class="item-price">
                        <span class="currency-symbol">৳</span>
                        {{$post->price}}
                    </div>
                    <div class="item-btn">
                        <a href="#">Details</a>
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

    