@extends('layouts.guest.master')
@section('content')
<h2 class="m-4 text-center">Site Map</h2>
<div id="accordion">
    @foreach($category as $cat)
    <div class="card">
        <div class="container">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$cat->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$cat->name}}
                </button>
                </h5>
            </div>
            <div id="collapse{{$cat->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                @foreach($cat->subcategory as $subcategory)
                <a href="{{URL::to('/ads?subcategory='.$subcategory->id)}}">
                    <p class="ml-5">{{$subcategory->name}}</p>
                </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
  </div>
  @endsection