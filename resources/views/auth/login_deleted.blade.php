
@extends('layouts.app')

@section('header')

    <!--===============================================================================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')


        <div class="limiter">
            <div class="container-login100" style="background-image: url({{asset('admin/login/images/img-01.jpg')}});">
                <div class="wrap-login100 p-t-190 p-b-30">
                    @include('admin.layouts.flash-message')
                    @include('flash::message')
                    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="login100-form-avatar">
                            <img style="margin-bottom: -160px" src="{{asset('admin/login/images/avatar-01.png')}}">
                        </div>

                        <span class="login100-form-title p-t-20 p-b-45">
						EVERYTHING
					</span>

                        <div class="wrap-input100 validate-input m-b-10" data-validate = "email is required">
                            <input id="email" type="email"  placeholder="Email" class="text input100 email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                        </div>

                        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                            <input id="password" type="password"  placeholder="Password" class="text input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                        </div>

                        <div class="wthree-text">


                            <label class="anim" for="remember">
                                <input class="checkbox" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                {{ __('Remember Me') }}
                            </label>
                            <div class="clear"> </div>

                        </div>

                        <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn" type="submit" >
                                {{ __('Login') }}
                            </button>
                        </div>


{{--                        <div class="text-center w-full p-t-25 p-b-230">--}}
{{--                            <a href="#" class="txt1">--}}
{{--                                Forgot Username / Password?--}}
{{--                            </a>--}}
{{--                        </div>--}}

                    </form>
                </div>
            </div>
        </div>


@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
