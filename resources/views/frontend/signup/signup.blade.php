
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
        <form action="{{route('users.signup')}}" method="POST">
            @csrf
            <div class="post-section basic-information">
                <div class="post-ad-title">
                    <i class="fas fa-user"></i>
                    <h3 class="item-title">Basic Information</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Full Name
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Full Name" class="form-control" name="name" id="name" value="{{old('name')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                            <label class="control-label">
                                Gender
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio"  name="gender" value="1" {{(old('gender')==1 ? 'checked' : "")}}> 
                                    <label class="form-check-label" for="condition">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="gender" value="2" {{(old('gender')==2 ? 'checked' : "")}}>
                                    <label class="form-check-label" for="condition">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="gender" value="3" {{(old('gender')==3 ? 'checked' : "")}}>
                                    <label class="form-check-label" for="condition">
                                        Others
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
                            Email
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="email" placeholder="Enter Email" class="form-control" name="email" id="email" value="{{old('email')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Phone
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Your Phone..." class="form-control" name="phone" id="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-section location-detail">
                <div class="post-ad-title">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3 class="item-title">Location</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            City
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control select-box" name="cities" id="cities" value="{{old('cities')}}">
                                <option value="">Select City</option>
                                @foreach($division as $div)
                                <option value="{{$div->id}}">{{$div->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Area
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control select-box" name="areas" id="areas" value="{{old('areas')}}">
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Adress
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
                            Password
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input class="form-control" type="password" id="password" placeholder="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">
                         Confirm Password
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group mb-5">
                            <input class="form-control" type="password" id="password_confirmation" placeholder="password" name="password_confirmation">
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