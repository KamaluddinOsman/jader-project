<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/images/icons/favicon.ico') }}">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/vendor/animate/animate.css')}}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('admin/login/css/util.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/login/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
