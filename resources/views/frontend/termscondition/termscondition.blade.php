@extends('layouts.guest.master')
@section('content')
<div class="container">
    <h2 class="text-center mt-5 mb-5">Terms And Conditions</h2>
{!! \App\Models\TermsAndCondition::first()->description !!}
</div>
@endsection