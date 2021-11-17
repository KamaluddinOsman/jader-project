<!doctype html>
<html lang="{{ App::isLocale('ar') ? "ar" : "en" }}" dir="{{ App::isLocale('ar') ? "rtl" : "ltr" }}">
    <head>
        <meta charset="utf-8" />
        @section('page-title')
            {{ __('auth.login') }} | {{ __('auth.bageTitle') }}             
        @endsection
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        {{-- <!-- <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}"> --> --}}

        <!-- Bootstrap Css -->
        <link href="{{ App::isLocale('ar') ? asset('dashboard/css/bootstrap-rtl.min.css') : asset('dashboard/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ App::isLocale('ar') ? asset('dashboard/css/icons-rtl.min.css') : asset('dashboard/css/icons-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ App::isLocale('ar') ? asset('dashboard/css/app-rtl.min.css') : asset('dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        
        <link href="{{ App::isLocale('ar') ? asset('dashboard/css/custom-rtl.css') :  asset('dashboard/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <body>
        {{-- <div class="home-btn d-none d-sm-block">
            <a href="{{ route('site.index') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> --}}
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-login text-center">
                                <div class="bg-login-overlay"></div>
                                <div class="position-relative">
                                    <h5 class="text-white font-size-20">{{ __('auth.welcomeMessage1') }}</h5>
                                    <p class="text-white-50 mb-0">{{ __('auth.welcomeMessage2') }}</p>
                                    <a href="javascript: void(0)" class="logo logo-admin mt-4">
                                        <img src="{{ asset('dashboard/images/jader-logo.png') }}" alt="" height="30">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="username">{{ __('auth.userName') }}</label>
                                            <input id="email" type="email"  placeholder="{{ __('auth.email')}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="userpassword">{{ __('auth.password') }}</label>
                                            <input id="password" type="password"  placeholder="********" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">{{ __('auth.rememberMe') }}</label>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('auth.login') }}</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        {{-- <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <script src="{{ asset('dashboard/js/app.js') }}"></script> --}}
        @include('dashboard.layouts.head')
    </body>
</html>