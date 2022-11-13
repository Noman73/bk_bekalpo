@php
use App\Http\Traits\Number;
$lang_name="name_".app()->getLocale();
@endphp

<section class="section-padding-top-heading">
    <div class="container">
        <div class="heading-layout1">
            <h2 class="heading-title">{{__('lang.homepage.category_header')}}</h2>
        </div>
        <div class="row">
            @php
            $category=App\Models\Category::with('postCount')->orderBy('serial','asc')->get();
            // dd($category);
            @endphp
            @foreach($category as $cat)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="category-box-layout1">
                    <a href="{{URL::to(app()->getLocale().'/ads?category='.$cat->id)}}">
                        <div class="item-icon">
                            <i class="fa {{explode('|',$cat->icon)[0]}}"></i>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title">{{$cat->$lang_name}}</h3>
                            <div class="item-count">{{Number::num($cat->postCount->count(),app()->getLocale())}} {{__('lang.ad')}}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>