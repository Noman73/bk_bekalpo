{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="reportModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
            <a onclick="backModal()" href="javascript:void(0)"><i class="fa fa-angle-left mr-3 d-none" id="back-button"></i></a><p class="modal-title" id="exampleModalLongTitle"><strong>Report This Ad</strong> </p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
                  <div class="list-view-layout1">
                    <div class="product-box-layout3 ">
                        <div class="item-img">
                            <a href="{{URL::to('/ad')}}/{{str_replace(' ','-',$post->title.'/'.$post->id)}}" class=""><img src="{{asset('storage/post_image').'/'.(isset($post->images[0]->image) ? $post->images[0]->image : '' )}}" alt="Product"></a>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title">{{$post->title}}</h3>
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
                        </div>
                        <div class="item-right">
                            <div class="item-price">
                                <span class="currency-symbol">৳</span>
                                {{$post->price}}
                            </div>
                        </div>
                    </div>
                  </div>
                {{-- form --}}
                  <table class="table">
                    <tr>
                      <td>Description</td>
                      <td>
                        <textarea type="text" class="form-control border" name="description" placeholder="Write" id="description"></textarea>
                      </td>
                    </tr>
                  </table>
                {{-- end form --}}
          </div>
          <div class="modal-footer mt-4">
            <button class="btn btn-primary featureSubmitBtn" onclick="reportRequest({{$post->id}})">save</button>
          </div>
      </div>
    </div>
  </div>