@extends('layouts.guest.master')
@push('title')
bekalpo.com | Easy Buy, Easy Sell 
@endpush
@section('content')
@section('link')
<style>
     .file {
    border: 1px solid #ccc;
    display: inline-block;
    width: 100px;
    cursor: pointer;
    background-color:#253DEF;
    color:white;
}
    .file:hover{
    background-color:#fff000;
    }
    .image-upload{
    margin:0 auto;
    }
</style>
@endsection
<section class="section-padding-equal-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 sidebar-break-sm sidebar-widget-area mt-0">
                <div class="widget-bottom-margin widget-account-menu widget-light-bg">
                    <h3 class="widget-border-title">{{__('lang.pages.dashboard.title')}}</h3>
                    <ul class="nav nav-tabs flex-column" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-selected="true">{{__('lang.pages.dashboard.menubar.dashboard')}}</a>
                        </li>
                        <li class="nav-item" id="mylist">
                            <a class="nav-link" data-toggle="tab" href="#my-listing" role="tab" aria-selected="false">{{__('lang.pages.dashboard.menubar.my_listing')}}</a>
                        </li>
                        <li class="nav-item" id="myfavlist">
                            <a class="nav-link" data-toggle="tab" href="#my-listing" role="tab" aria-selected="false">{{__('lang.pages.dashboard.menubar.favourite_list')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false" onclick="profile()">{{__('lang.pages.dashboard.menubar.profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#accout-detail" role="tab" aria-selected="false">{{__('lang.pages.dashboard.menubar.setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="{{ route('logout') }}" role="tab" aria-selected="false" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{__('lang.pages.dashboard.menubar.logout')}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="myaccount-dashboard light-shadow-bg">
                            <div class="light-box-content">
                                <div class="media-box">
                                    <div class="item-img">
                                        <img style="height:100px !important;width:100px !important;background-size:cover !important;" src="{{auth()->user()->image==null? asset('storage/media/figure/avatar.jpg') : asset('storage/users/'.auth()->user()->image) }}" alt="avatar">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title">{{auth()->user()->name}}</h3>
                                        <div class="item-email"><span>Email: </span>{{auth()->user()->email}}</div>
                                    </div>
                                </div>
                                <div class="static-report">
                                    <h3 class="report-title">Membership Report</h3>
                                    <div class="report-list">
                                        <div class="report-item">
                                            <label>Status</label>
                                            <div class="item-value">{{auth()->user()->status ==1 ? "Active" : 'Deactive'}}</div>
                                        </div>
                                    </div>
                                    <div class="report-list">
                                        <div class="report-item">
                                            <label>Joined</label>
                                            <div class="item-value">{{date('M, d Y',strtotime(auth()->user()->created_at))}}</div>
                                        </div>
                                    </div>
                                    <div class="report-list">
                                        <div class="report-item">
                                            <label>Total Ads</label>
                                            <div class="item-value">{{App\Models\Post::where('user_id',auth()->user()->id)->count()}}</div>
                                        </div>
                                    </div>
                                    <div class="report-list">
                                        <div class="report-item">
                                            <label>Reviewing Ads</label>
                                            <div class="item-value">{{App\Models\Post::where('user_id',auth()->user()->id)->where('status',1)->count()}}</div>
                                        </div>
                                    </div>
                                    <div class="report-list">
                                        <div class="report-item">
                                            <label>Published Ads</label>
                                            <div class="item-value">{{App\Models\Post::where('user_id',auth()->user()->id)->where('status',2)->count()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="my-listing" role="tabpanel">

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal">
    </div>
</section>
@endsection
@section('script')
    <script src="{{asset('storage/dependencies/axios/axios.min.js')}}"></script>
    @include('frontend.account_info.internal-assets.js.script')
    <script>
        $(document).on('click','.close',function(){
            $('#myad_action').modal('hide');
            setTimeout(() => {
                $('#modal').empty();
            }, 500);
            
        })
    $(document).on('click','#submitbtn',function(){
        action=$('#myadaction').val();
        posturl=$('#post_url').val()
        $.post(posturl,{_token:"{{csrf_token()}}",action:action})
        .then(response=>{
            console.log(response);
            if(response.message){
                $('#myad_action').modal('hide');
                setTimeout(() => {
                    $('#modal').empty();
                    getMyAds();
                }, 300);
                
            }
        })
    })
    </script>
    @push('scripts')
    @include('frontend.account_info.mylisting.internal-assets.js.script');
    @endpush
@endsection