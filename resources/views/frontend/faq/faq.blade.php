@extends('layouts.guest.master')
@section('content')
<h2 class="m-4 text-center">Faq</h2>
<div id="accordion">
    @foreach($faqs as $faq)
    <div class="card">
        <div class="container">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$faq->question}}
                </button>
                </h5>
            </div>
            <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                <p class="">{{$faq->answer}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
  </div>
  @endsection