<head>
    <meta charset="utf-8" />
    <title>@yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @yield('head')

    <!-- Bootstrap Css -->
    <link href="{{ App::isLocale('ar') ? asset('dashboard/css/bootstrap-rtl.min.css') : asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ App::isLocale('ar') ? asset('dashboard/css/icons-rtl.min.css') : asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ App::isLocale('ar') ? asset('dashboard/css/app-rtl.min.css') : asset('dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ App::isLocale('ar') ? asset('dashboard/css/custom-rtl.css') :  asset('dashboard/css/custom.css') }}" rel="stylesheet" type="text/css" />

    
    <style>
        th, td {
            text-align: center;
        }
    </style>
    
</head>