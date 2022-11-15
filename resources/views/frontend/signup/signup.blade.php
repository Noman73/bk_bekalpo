@php
   $lang_name="name_".app()->getLocale();
@endphp
@extends('layouts.guest.master')
@section('link')
<style>
    .is-invalid{
        border:1px solid red !important;
    }
    .is-valid{
        border:1px solid green !important;
    }
</style>
@endsection
@section('content')
<div class="light-shadow-bg post-ad-box-layout1 myaccount-store-settings myaccount-detail">
    <div class="light-box-content">
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger text-center">* {{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="{{URL::to(app()->getLocale().'/signup')}}" method="POST">
            @csrf
            <div class="post-section basic-information">
                <div class="post-ad-title">
                    <i class="fas fa-user"></i>
                    <h3 class="item-title">@lang('lang.pages.signup.title')</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.full_name')
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="{{__('lang.pages.signup.name_place')}}" class="form-control" name="name" id="name" value="{{old('name')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                            <label class="control-label">
                                @lang('lang.pages.signup.gender')
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio"  name="gender" value="1" {{(old('gender')==1 ? 'checked' : "")}}> 
                                    <label class="form-check-label" for="condition">
                                        @lang('lang.pages.signup.male')
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="gender" value="2" {{(old('gender')==2 ? 'checked' : "")}}>
                                    <label class="form-check-label" for="condition">
                                        @lang('lang.pages.signup.female')
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="gender" value="3" {{(old('gender')==3 ? 'checked' : "")}}>
                                    <label class="form-check-label" for="condition">
                                        @lang('lang.pages.signup.others')
                                    </label>
                                </div>
                                <div class="invalid-feedback" id="gender_msg">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.email')
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="email" placeholder="{{__('lang.pages.signup.email_place')}}" class="form-control" name="email" id="email" value="{{old('email')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.phone')
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="{{__('lang.pages.signup.phone_place')}}" class="form-control" name="phone" id="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-section location-detail">
                <div class="post-ad-title">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3 class="item-title">@lang('lang.pages.signup.location')</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.city')
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control select-box" name="cities" id="cities" value="{{old('cities')}}">
                                <option value="">{{__('lang.pages.allads.select_an_option')}}</option>
                                @foreach($division as $div)
                                <option value="{{$div->id}}">{{$div->$lang_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.area')
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control select-box" name="areas" id="areas" value="{{old('areas')}}">
                                <option value="">@lang('lang.pages.allads.select_an_option')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.adress')
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <textarea name="adress" class="form-control textarea" id="adress" cols="30" rows="2" >{{old('adress')}}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            @lang('lang.pages.signup.password')
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input class="form-control" type="password" id="password" placeholder="{{__('lang.pages.signup.password_place')}}" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                         @lang('lang.pages.signup.confirm_password')
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group mb-5">
                            <input class="form-control" type="password" id="password_confirmation" placeholder="{{__('lang.pages.signup.confirm_password_place')}}" name="password_confirmation">
                            <div class="invalid-feedback" id="pass_confirmation-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="submit" class="submit-btn" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@include('frontend.signup.internal-assets.js.script')

<script>
    $(document).on('keyup change','#password_confirmation',function(){
        confirm_pass=$(this).val();
        pass=$('#password').val()
        if (confirm_pass=="") {
            $('#password_confirmation').addClass('is-invalid');
            $('#password_confirmation').removeClass('is-valid');
            $('#pass_confirmation-feedback').removeClass('valid-feedback')
            $('#pass_confirmation-feedback').addClass('invalid-feedback')
            $('#pass_confirmation-feedback').text('Please Enter a Valid Password');
            return false;
        }
            if(confirm_pass==pass){
                $('#password_confirmation').addClass('is-valid');
                $('#password_confirmation').removeClass('is-invalid');
                $('#pass_confirmation-feedback').removeClass('invalid-feedback')
                $('#pass_confirmation-feedback').addClass('valid-feedback')
                $('#pass_confirmation-feedback').text('Password Matched')
            }else{
                $('#password_confirmation').addClass('is-invalid');
                $('#password_confirmation').removeClass('is-valid');
                $('#pass_confirmation-feedback').removeClass('valid-feedback')
                $('#pass_confirmation-feedback').addClass('invalid-feedback')
                $('#pass_confirmation-feedback').text('Password Not Matched')
            }
    })
</script>
@endsection