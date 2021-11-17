<!doctype html>
<html lang="{{ App::isLocale('ar') ? "ar" : "en" }}" dir="{{ App::isLocale('ar') ? "rtl" : "ltr" }}">
    @include('dashboard.layouts.head')

    <body data-layout="detached" data-topbar="colored">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">

                @include('dashboard.layouts.header')                
            
                <!-- ========== Left Sidebar Start ========== -->
                <div class="vertical-menu">

                    <div class="h-100">

                        <div class="user-wid text-center py-4">
                            <div class="user-img">
                                <img src="{{ asset('dashboard/images/users/default-admin-avatar.ico') }}" alt="" class="avatar-md mx-auto rounded-circle">
                            </div>

                            <div class="mt-3">

                                <a href="#" class="text-dark fw-medium font-size-16">{{ Auth::user() ? Auth::user()->name : 'Geust' }}</a>
                                {{-- <p class="text-body mt-1 mb-0 font-size-13">UI/UX Designer</p> --}}

                            </div>
                        </div>

                        <!--- Sidemenu -->
                        @include('dashboard.layouts.sidebar-menu')
                        <!-- Sidebar -->
                    </div>
                </div>
                <!-- Left Sidebar End -->

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">
                    @yield('content')
                    <!-- End Page-content -->
                    @include('dashboard.layouts.footer')
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

        </div>
        <!-- end container-fluid -->

        <!-- Right Sidebar -->
        @include('dashboard.layouts.right-sidebar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        @include('dashboard.layouts.scripts')

    </body>

</html>