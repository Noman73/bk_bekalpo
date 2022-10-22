@extends('layouts.guest.master')
@push('title')
bekalpo.com | Easy Buy, Easy Sell 
@endpush
@section('link')
<style>
    /* img {
    display: inline-block !important;
    vertical-align: middle !important;
} */
.product-view img{
    width: 120px !important;
    height: 100px !important;
    object-fit: cover !important;
    object-position: 50% 50% !important;
}
</style>
@endsection
@section('content')
<section class="inner-page-banner" data-bg-image="{{'storage'}}/media/banner/banner.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs-area">
                    <h1>All Ads</h1>
                    <ul>
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>All Ads</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=          Search Box Start         =-->
<!--=====================================-->
<section class="bg-accent">
    <div class="container">
        <div class="search-box-wrap-layout3">
            <div class="search-box-layout1">
                <form action="javascript:void(0)">
                    <div class="row no-gutters">
                        <div class="col-lg-3 form-group">
                            <div class="input-search-btn search-location">
                                <i class="fa fa-map-marker-alt"></i>
                                <span id="locationModal">Location</span>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 form-group">
                            <div class="input-search-btn search-category">
                                <i class="fa fa-map-marker-alt"></i>
                                    <select class='form-control' name="" id="area">
                                    <option value="">--Select An Area--</option>
                                    </select> --}}
                                
                                {{-- <div class="product-sorting">
                                <div class="ordering-controller">
                                    <label class="overlay-content ordering-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Select Category</label>
                                    <div class="dropdown-menu clearfix" id="localtion">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="aToZ()">A to Z (title)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="zToA()">Z to A (title)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="oldest()">Data Added (oldest)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="lowToHigh()">Price (low to high)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="highToLow()">Price (high to low)</a>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- </div>
                        </div> --}}
                        <div class="col-lg-7 form-group">
                            <div class="input-search-btn search-keyword">
                                <i class="fa fa-text-width"></i>
                                <input type="text" class="form-control" placeholder="Enter Keyword here ..." name="keyword" id="keyword">
                            </div>
                        </div>
                        <div class="col-lg-2 form-group">
                            <button type="submit" id="keyword-btn" class="submit-btn"><i class="fa fa-search"></i>Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=           Product Start           =-->
<!--=====================================-->

<section class="product-inner-wrap-layout1 bg-accent">
    <div class="container">
        <div class='' id='not-found'>

        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 sidebar-break-md sidebar-widget-area" id="accordion">
                <div class="widget-bottom-margin-md widget-accordian widget-filter">
                    <h3 class="widget-bg-title">Filter <button class="btn btn-sm btn-light float-right" onclick="reset()">Reset</button></h3>
                    <form action="#">
                        <div class="accordion-box">
                            <div class="card filter-type filter-item-list">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                        Type
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioexample" onclick="adType(this.value)" id="radio1" value="1">
                                                    <label class="form-check-label" for="radio1">Sell</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioexample" onclick="adType(this.value)" id="radio2" value="2">
                                                    <label class="form-check-label" for="radio2">Buy</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--condition  --}}
                            <div class="card filter-type filter-item-list">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#conditionClp" aria-expanded="true">
                                        Condition
                                    </a>
                                </div>
                                <div id="conditionClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="condition[]" onclick="conditions(this.value)" id="radio1" value="1">
                                                    <label class="form-check-label" for="radio1">New</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="condition[]" onclick="conditions(this.value)" id="radio2" value="2">
                                                    <label class="form-check-label" for="radio2">Used</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="condition[]" onclick="conditions(this.value)" id="radio2" value="3">
                                                    <label class="form-check-label" for="radio2">Recondition</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- */ --}}
                            <div class="card filter-type filter-item-list" id="category_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#categoryClp" aria-expanded="true">
                                        Category
                                    </a>
                                </div>
                                <div id="categoryClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onChange="categories(this)" class="form-control" name="" id="category">
                                                        <option value="">-Select an Option-</option>
                                                        @foreach($category as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}({{$cat->post_count_count}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card filter-type filter-item-list d-none" id="subcategory_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#subcategoryClp" aria-expanded="true">
                                        Sub Category
                                    </a>
                                </div>
                                <div id="subcategoryClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onChange="subcategories(this.value)" class="form-control" name="" id="subcategory">
                                                        <option value="">-Select an Option-</option>
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card filter-category multi-accordion filter-item-list">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
                                        Category
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="multi-accordion-content" id="accordion2">
                                            @foreach($category as $cat)
                                            <div class="card"  onclick="categories({{$cat->id}})">
                                                <div class="card-header">
                                                    <a  class="parent-list collapsed" role="button" data-toggle="collapse" href="#cat{{$cat->id}}" aria-expanded="false">
                                                        <i class="fa {{explode('|',$cat->icon)[0]}} mr-1"></i>
                                                        {{$cat->name}}
                                                    </a>
                                                </div>
                                                <div  id="cat{{$cat->id}}" class="collapse" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <ul class="sub-list">
                                                            @foreach($cat->subcategory as $subcategory)
                                                                <li><a href="javascript:void(0)" onclick="subcategory({{$subcategory->id}})">{{$subcategory->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{--  --}}
                            <div class="card filter-type filter-item-list d-none" id="brand_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#brandClp" aria-expanded="true">
                                        Brand
                                    </a>
                                </div>
                                <div id="brandClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onChange="brands(this.value)" class="form-control" name="" id="brand">
                                                        <option value="">-Select an Option-</option>
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-type filter-item-list d-none" id="model_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#modelClp" aria-expanded="true">
                                        Model
                                    </a>
                                </div>
                                <div id="modelClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onChange="models(this.value)" class="form-control" name="" id="model">
                                                        <option value="">-Select an Option-</option>
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-type filter-item-list d-none" id="item_type_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#item_typeClp" aria-expanded="true">
                                        Item Type
                                    </a>
                                </div>
                                <div id="item_typeClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onChange="itemtype(this.value)" class="form-control" name="" id="item_type">
                                                        <option value="">-Select an Option-</option>
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-type filter-item-list d-none" id="authenticity_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#authenticityClp" aria-expanded="true">
                                        Authenticity
                                    </a>
                                </div>
                                <div id="authenticityClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="authenticity[]" onclick="authenticities(this.value)" id="radio1" value="1">
                                                    <label class="form-check-label" for="radio1">Original</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="authenticity[]" onclick="authenticities(this.value)" id="radio2" value="2">
                                                    <label class="form-check-label" for="radio2">Refurbished</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-price-range filter-item-list d-none" id="manufacture_year_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#manufacture_yearFour" aria-expanded="true">
                                        Manufacture Year
                                    </a>
                                </div>
                                <div id="manufacture_yearFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="price-range-content">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min" class="form-control" id="min" placeholder="min" onkeyup="minManufacture(this.value)">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min"  class="form-control" id="max" placeholder="max" onkeyup="maxManufacture(this.value)">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <button id="apply-filter" class="filter-btn">Apply Filters</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-type filter-item-list d-none" id="transmission_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#transmissionClp" aria-expanded="true">
                                        Transmission
                                    </a>
                                </div>
                                <div id="transmissionClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioexample" onclick="transmissions(this.value)" id="radio1" value="1">
                                                    <label class="form-check-label" for="radio1">Manual</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioexample" onclick="transmissions(this.value)" id="radio2" value="2">
                                                    <label class="form-check-label" for="radio2">Autometic</label>
                                                </li>
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="radioexample" onclick="transmissions(this.value)" id="radio2" value="3">
                                                    <label class="form-check-label" for="radio2">Others Transmission</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card filter-type filter-item-list d-none" id="body_type_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#body_typeClp" aria-expanded="true">
                                        Body Type
                                    </a>
                                </div>
                                <div id="body_typeClp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="filter-type-content">
                                            <ul>
                                                <div class="form-group">
                                                    <select onchange="bodytype(this.value)"  class="form-control" name="" id="body_type">
                                                        <option value="">-Select an Option-</option>
                                                    </select>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="card filter-price-range filter-item-list d-none" id="kilometer_run_filter">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#kilometrerunFour" aria-expanded="true">
                                        Kilometers Run
                                    </a>
                                </div>
                                <div id="kilometrerunFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="price-range-content">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min" class="form-control" id="min" placeholder="min" onkeyup="kilometreRun(this.value)">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min"  class="form-control" id="max" placeholder="max" onkeyup="kilometreRun(this.value)">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <button id="apply-filter" class="filter-btn">Apply Filters</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{--  --}}
                            <div class="card filter-price-range filter-item-list">
                                <div class="card-header">
                                    <a class="parent-list" role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true">
                                        Price Range
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="price-range-content">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min" class="form-control" id="min" placeholder="min" onkeyup="minPrice(this.value)">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <input type="number" name="filter-price-min"  class="form-control" id="max" placeholder="max" onkeyup="maxPrice(this.value)">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <button id="apply-filter" class="filter-btn">Apply Filters</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="product-filter-heading">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="item-title" id="item-title-header">Loading ....</h2>
                        </div>
                        <div class="col-md-6 d-flex justify-content-md-end justify-content-center">
                            <div class="product-sorting">
                                <div class="ordering-controller">
                                    <button class="ordering-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="aToZ()">A to Z (title)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="zToA()">Z to A (title)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="oldest()">Data Added (oldest)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="lowToHigh()">Price (low to high)</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="highToLow()">Price (high to low)</a>
                                    </div>
                                </div>
                                <div class="layout-switcher">
                                    <ul>
                                        <li class="active">
                                            <a href="#" data-type="product-box-list" class="product-view-trigger">
                                                <i class="fa fa-th-list"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="product-view-trigger" href="#" data-type="product-box-grid">
                                                <i class="fa fa-th-large"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="product-view" class="product-box-list">
                    <div class="row" id="posts-feature">
                       
                    </div>
                    <div class="row" id="posts-all">
                       
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="renderModal">

    </div>
</section>
@endsection
@section('script')
   @include('guest.allads.internal-assets.js.script');
@endsection