


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
        <div class="modal-body">

          
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            <div class="myaccount-login-form light-shadow-bg">
            <div class="light-box-content">
                <div class="">
                    <div class="form-box login-form">
                        <h3 class="item-title">Login</h3>
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control {{($errors->has('email') ? 'is-invalid' : '')}}" name="email" id="login-username">
                                @if ($errors->has('email'))
                                  <div data-id="{{$errors->has('email')}}" class="invalid-feedback" id="login_email_msg">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control {{($errors->has('password') ? 'is-invalid' : '')}}" name="password" id="login-password">
                                @if ($errors->has('password'))
                                  <div data-id="{{$errors->has('password')}}" class="invalid-feedback" id='login_password_msg'>{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check form-check-box">
                                    <input class="form-check-input" type="checkbox" id="check-password">
                                    <label for="check-password">Remember Me</label>
                                </div>
                                
                            </div>

                            <button type="submit" class=" btn btn-primary m-2 login-btn">Login</button>
                            <a href="{{URL::to(app()->getLocale().'/signup')}}" class="submit-btn btn btn-success m-2 login-btn" >Create an Account</a>
                            <div class="form-group">
                                {{-- <a href="#" class="forgot-password">Forgot your password?</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>

