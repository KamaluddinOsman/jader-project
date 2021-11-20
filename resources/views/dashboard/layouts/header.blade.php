<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-none d-sm-inline-block">
                    <a href="{{ App::isLocale('ar') ? url('/en') : url('/ar')}}" class="dropdown d-none d-sm-inline-block">
                        <img src="{{ App::isLocale('ar') ? asset('dashboard/images/flags/us.png') : asset('dashboard/images/flags/sa.png') }}" alt="flag-icon" class="me-1" height="12"> <span
                            class="align-middle" style="color: white">{{ App::isLocale('ar') ? "English" : "Arabic"}}</span>
                    </a>
                </div>
                
                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                {{-- @include('dashboard.layouts.notifications') --}}

                @include('dashboard.layouts.user-profile')
                

                <div class="dropdown d-inline-block">
                    {{-- <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect"> --}}
                    <button type="button" class="btn header-item noti-icon waves-effect">
                        <i class="mdi mdi-settings-outline"></i>
                    </button>
                </div>

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('dashboard/images/logo-sm.png') }}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('dashboard/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="javascript: void(0)" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('dashboard/images/jader-logo.png') }}" alt="Wafeer" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('dashboard/images/jader-logo.png') }}" alt="Wafeer" height="50px">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="{{ __('dashboard.search') }}">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>

                {{-- @include('dashboard.layouts.mega-menu') --}}
            </div>

        </div>
    </div>
</header>