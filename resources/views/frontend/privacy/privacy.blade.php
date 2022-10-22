@extends('layouts.guest.master')
@section('content')
<div class="container">
    <h2 class="text-center mt-5 mb-5">Privacy Policy</h2>
{!! \App\Models\Privacy::first()->description !!}
</div>
@endsection