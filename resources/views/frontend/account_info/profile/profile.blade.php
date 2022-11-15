<div class="light-shadow-bg post-ad-box-layout1 myaccount-store-settings myaccount-detail">
    <div class="light-box-content">
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="{{route('users.signup')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="post-section basic-information">
                <div class="post-ad-title">
                    <i class="fas fa-user"></i>
                    <h3 class="item-title">{{__('lang.pages.dashboard.profile.basic_info.title')}}</h3>
                </div>
                <div class="text-center">
                    <img id="imagex" src="{{auth()->user()->image==null? asset('storage/media/figure/avatar.jpg') : asset('storage/users/'.auth()->user()->image) }}" class="d-flex image-upload" style="height:100px;width:100px;">
                    <input class="d-none" type="file" id="file" name="" onchange="readURL(this)">
                    <label for="file"  class="file">{{__('lang.pages.dashboard.profile.basic_info.choose')}}</label>
                    <div id="photo_msg" class="invalid-feedback">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Full Name
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Full Name" class="form-control" value="{{$data->name}}" name="name" id="name">
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
                                    <input  class="form-check-input" type="radio" {{($data->gender==1 ? 'checked' : '' )}}  name="gender[]" value="1">
                                    <label class="form-check-label" for="condition">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input  class="form-check-input" type="radio" {{($data->gender==2 ? 'checked' : '' )}} name="gender[]" value="2">
                                    <label class="form-check-label" for="condition">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" {{($data->gender==3 ? 'checked' : '' )}} name="gender[]" value="3" >
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
                            Phone
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Your Phone..." class="form-control" name="phone" id="phone" value="{{$data->phone}}">
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
                            <select class="form-control select-box" name="cities" id="cities">
                                <option value="">--{{__('lang.pages.allads.select_an_option')}}--</option>
                                @foreach($division as $div)
                                <option {{($div->id==$data->division_id ? "selected" : '')}} value="{{$div->id}}">{{$div->name}}</option>
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
                            <select class="form-control select-box" name="areas" id="areas">
                                <option value="">{{__('lang.pages.allads.select_an_option')}}</option>
                                @foreach($district as $dist)
                                <option {{($dist->id==$data->district_id ? "selected" : '')}} value="{{$dist->id}}">{{$dist->name}}</option>
                                @endforeach
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
                            <textarea name="adress" class="form-control textarea" id="adress" cols="30" rows="2">{{$data->adress}}</textarea>
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