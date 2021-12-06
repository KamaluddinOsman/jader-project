<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>{{__('lang.everything')}}
        |
        @yield('title')
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

{!! Html::style('main/css/style.css') !!}

<!-- Select2 -->
{!! Html::style('admin/plugins/select2/css/select2.min.css') !!}
{!! Html::style('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}

<!-- Font Awesome -->
{!! Html::style('admin/plugins/fontawesome-free/css/all.min.css') !!}
<!-- Theme style -->
{!! Html::style('main/css/style_search.css') !!}
<!-- Ionicons -->
{!! Html::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') !!}
<!-- Tempusdominus Bootstrap 4 -->
{!! Html::style('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}
<!-- iCheck -->
{!! Html::style('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}
<!-- JQVMap -->
{!! Html::style('admin/plugins/jqvmap/jqvmap.min.css') !!}
<!-- Theme style -->
{!! Html::style('admin/dist/css/adminlte.min.css') !!}
<!-- overlayScrollbars -->
{!! Html::style('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}
<!-- Daterange picker -->
{!! Html::style('admin/plugins/daterangepicker/daterangepicker.css') !!}
<!-- summernote -->
{!! Html::style('admin/plugins/summernote/summernote-bs4.min.css') !!}


{!! Html::style('admin/plugins/sweetalert2/sweetalert.css') !!}

<!-- dropzonejs -->
{!! Html::style('admin/plugins/dropzone/min/dropzone.min.css') !!}

<!-- Ekko Lightbox -->
{!! Html::style('admin/plugins/ekko-lightbox/ekko-lightbox.css') !!}


<!-- rtl -->
    @if(app()->getLocale()=='ar')
        {!! Html::style('admin/dist/css/AdminLTE.min2.css') !!}
        {!! Html::style('admin/dist/css/bootstrap-rtl.min.css') !!}
        {!! Html::style('admin/dist/css/rtl.css') !!}
    @else
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    @endif



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('header')

</head>

<style>
    .unread {
        background-color: #75cbf5;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">

<script type="text/javascript">
    var csrfToken = $('[name="csrf_token"]').attr('content');

    setInterval(refreshToken, 3600000); // 1 hour

    function refreshToken() {
        $.get('refresh-csrf').done(function (data) {
            csrfToken = data; // the new token
        });
    }

    setInterval(refreshToken, 3600000); // 1 hour

</script>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand  navbar-primary navbar-dark">

        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <div style="width: 191px;
                height: 20px;
                padding: 19px;
                margin: 1px 0px 1px 153px;
                text-align: center;
                line-height: 6px;
                border-radius: 5px;"
             class="bg-warning">
            <p style="color: #fff;font-weight: bold;">
              1.8  نسخة تجريبية
            </p>
        </div>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="#" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>

            </li>


            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link notification-drop" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge  notif-count" data-count = "{{count(auth()->user()->unreadnotifications)}}">{{count(auth()->user()->unreadnotifications)}}</span>
                </a>

                <span style="display: none" id="sound_note" data-count = "0"></span>


                <div  style="height: 300px; overflow: auto" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-item dropdown-header">
                        Notifications
                        <span class="notif-count" data-count = "{{count(auth()->user()->unreadnotifications)}}">{{count(auth()->user()->notifications)}} </span>
                    </div>

                    <div class="dropdown-divider"></div>
                    <div class="scroll"></div>

                    @foreach(auth()->user()->notifications as $note)

                        <div class="dropdown-divider"></div>
                        <div class="scrollable-container">
                            <a href="#" class="dropdown-item {{$note->read_at == null? 'unread' : ''}}">
                                <i class="
                                       @if($note['type'] == 'App\Notifications\NewStoreNotification') fas fa-school
                                       @elseif($note['type'] == 'App\Notifications\NewCarNotification') fas fa-car
                                       @elseif($note['type'] == 'App\Notifications\NewOfferNotification') fas fa-money-bill
                                       @endif  mr-2">
                                </i> {!! $note->data['data'] !!}
                                <span style="font-size: 11px;line-height: 32px;" class="float-right text-muted">{!!\Carbon\Carbon::parse($note->data['created_at'])->diffForHumans()!!}</span>
                                {{$note->markAsRead()}}
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>







            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="nav-icon fas fa-language"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <div class="media-body">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                            <!-- Message End -->
                        </div>
                    </a>
                </div>
            </li>


            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a style="color: #fff" href="#" data-toggle="dropdown">
                            <span class="hidden-xs">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->

                            <li class="user-header">
                                <p>
                                    {{auth()->user()->name}}
                                </p>
                                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}"
                                     alt="{{(auth()->user()->name)}}" class="brand-image img-circle elevation-3"
                                     style="opacity: .8">
                            </li>


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div style="float: right!important" class="pull-right">
                                    <a href="{{route('password.change')}}" class="btn btn-default btn-flat">تغير كلمة المرور</a>
                                </div>

                                <div class="pull-left">
                                    <a href="{{route('logout')  }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>


        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" alt="{{__('lang.jadeeer')}}"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{__('lang.jadeeer')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div style="color: #fff" class="info">
                    <i class="fas fa-business-time"></i>
                    <li style="font-weight: 400; font-size: 14px; float: right; margin-left: 10px; margin-top: 1px;"
                        class="header d-block"> {{date('d-m-Y h:i:s  D') }}</li>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @include('admin.layouts.nav')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div>


    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{date('Y')}} <a target="_blank" href="">Jadeeer</a>.</strong>

        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.1.pre
        </div>
    </footer>

</div>

<!-- jQuery -->
{!! Html::script('admin/bower_components/jquery/dist/jquery.min.js') !!}

{!! Html::script('admin/plugins/jquery/jquery.min.js') !!}
<!-- jQuery UI 1.11.4 -->
{!! Html::script('admin/plugins/jquery-ui/jquery-ui.min.js') !!}

<!-- script Me-->
{!! Html::script('main/js/script_me.js') !!}

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>


{!! Html::script('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- ChartJS -->
{!! Html::script('admin/plugins/chart.js/Chart.min.js') !!}
<!-- Sparkline -->
{!! Html::script('admin/plugins/sparklines/sparkline.js') !!}
<!-- JQVMap -->
{!! Html::script('admin/plugins/jqvmap/jquery.vmap.min.js') !!}
{!! Html::script('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}
<!-- jQuery Knob Chart -->
{!! Html::script('admin/plugins/jquery-knob/jquery.knob.min.js') !!}
<!-- daterangepicker -->
{!! Html::script('admin/plugins/moment/moment.min.js') !!}
{!! Html::script('admin/plugins/daterangepicker/daterangepicker.js') !!}
<!-- Tempusdominus Bootstrap 4 -->
{!! Html::script('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}
<!-- Summernote -->
{!! Html::script('admin/plugins/summernote/summernote-bs4.min.js') !!}
<!-- overlayScrollbars -->
{!! Html::script('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('admin/dist/js/adminlte.js') !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script('admin/dist/js/demo.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{!! Html::script('admin/dist/js/pages/dashboard.js') !!}

<!-- SweetAlert -->
{!! Html::script('admin/plugins/sweetalert2/sweetalert.min.js') !!}


<!-- DataTables  & Plugins -->
{!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
{!! Html::script('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}
{!! Html::script('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}
{!! Html::script('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
{!! Html::script('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
{!! Html::script('admin/plugins/jszip/jszip.min.js') !!}
{!! Html::script('admin/plugins/pdfmake/pdfmake.min.js') !!}
{!! Html::script('admin/plugins/pdfmake/vfs_fonts.js') !!}
{!! Html::script('admin/plugins/datatables-buttons/js/buttons.html5.min.js') !!}
{!! Html::script('admin/plugins/datatables-buttons/js/buttons.print.min.js') !!}
{!! Html::script('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') !!}
{!! Html::script('admin/plugins/select2/js/select2.full.min.js') !!}

<!-- dropzonejs -->
{{--{!! Html::script('admin/plugins/dropzone/min/dropzone.min.js') !!}--}}

<!-- InputMask -->
{!! Html::script('admin/plugins/moment/moment.min.js') !!}
{!! Html::script('admin/plugins/inputmask/jquery.inputmask.min.js') !!}


<!-- Ekko Lightbox -->
{!! Html::script('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') !!}

<!-- switch-->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>
    $('.colorpicker').colorpicker();
</script>
<script>

    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            }
        });
    });


    $('#Editcategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var category_id = button.data('categoryid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #category_id').val(category_id);
    })

    $('#Addvariety').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var category_id = button.data('idcategory') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #id_category').val(category_id);
    })

    $('#Editvariety').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var variety_id = button.data('varietyid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #variety_id').val(variety_id);
    })

    $('#cancelCar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var car_id = button.data('carid') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body #car_id').val(car_id);
    });

    $('#cancelProduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var product_id = button.data('productid') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body #product_id').val(product_id);
    });

    $('#cancelStore').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var store_id = button.data('storeid') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body #store_id').val(store_id);
    });

    $('#EditCity').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var city_id = button.data('cityid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #city_id').val(city_id);
    })

    $('#AddDistrict').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var id_city = button.data('idcity') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #id_city').val(id_city);
    })

    $('#EditDis').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('disname') // Extract info from data-* attributes
        var district_id = button.data('disid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #district_id').val(district_id);
    });

    $('#Editcolor').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var colorid = button.data('colorid') // Extract info from data-* attributes
        var mycode = button.data('mycode') // Extract info from data-* attributes
        var categoryid = button.data('categoryid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #mycode').val(mycode);
        modal.find('.modal-body #categoryid').val(categoryid);
        modal.find('.modal-body #color_id').val(colorid);
    });

    $('#Editunit').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var unitid = button.data('unitid') // Extract info from data-* attributes
        var categoryid = button.data('categoryid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        console.log(categoryid)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #categoryid').val(categoryid);
        modal.find('.modal-body #unit_id').val(unitid);
    });

    $('#Editbrand').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var brandid = button.data('brandid') // Extract info from data-* attributes
        var categoryid = button.data('categoryid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #categoryid').val(categoryid);
        modal.find('.modal-body #brand_id').val(brandid);
    });

    $('#EditBanner').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var title = button.data('mytitle') // Extract info from data-* attributes
        var banner_id = button.data('bannerid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #banner_id').val(banner_id);
    })

    $('.activeCheck').change(function () {
        var url = this.getAttribute('data-url');
        var token = this.getAttribute('data-token');
        console.log(url);
        $.ajax({
            type: 'get',
            data: {_token: token},
            url: url,
            success: function (data) {

                console.log(data);

            }

        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // $('#logo').attr('src', e.target.result);

                $(input).next('img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#logoInp").change(function() {
        $('#logoNoImage').css('display','none');
        $('#logo_old').css('display','none');
        $('#logo').css('display','block');
        readURL(this);
    });
//--------------------------------------------------------------

    $("#coverInp").change(function() {
        $('#coverNoImage').css('display','none');
        $('#cover_old').css('display','none');
        $('#cover').css('display','block');
        readURL(this);
    });
//--------------------------------------------------------------

    $("#contractInp").change(function() {
        $('#contractNoImage').css('display','none');
        $('#contract_old').css('display','none');
        $('#contract').css('display','block');
        readURL(this);
    });
    //--------------------------------------------------------------

    $("#driver_licenseInp").change(function() {
        $('#driver_licenseNoImage').css('display','none');
        $('#driver_license_old').css('display','none');
        $('#driver_license').css('display','block');
        readURL(this);
    });

    //--------------------------------------------------------------

    $("#car_licenseInp").change(function() {
        $('#car_licenseNoImage').css('display','none');
        $('#car_license_old').css('display','none');
        $('#car_license').css('display','block');
        readURL(this);
    });

 //--------------------------------------------------------------

    $("#personal_idInp").change(function() {
        $('#personal_idNoImage').css('display','none');
        $('#personal_id_old').css('display','none');
        $('#personal_id').css('display','block');
        readURL(this);
    });

    //--------------------------------------------------------------

    $("#image_car_frontInp").change(function() {
        $('#image_car_frontNoImage').css('display','none');
        $('#image_car_front_old').css('display','none');
        $('#image_car_front').css('display','block');
        readURL(this);
    });

    //--------------------------------------------------------------

    $("#personal_idInp").change(function() {
        $('#personal_idNoImage').css('display','none');
        $('#personal_id_old').css('display','none');
        $('#personal_id').css('display','block');
        readURL(this);
    });

   //--------------------------------------------------------------

    $("#image_car_backInp").change(function() {
        $('#image_car_backNoImage').css('display','none');
        $('#image_car_back_old').css('display','none');
        $('#image_car_back').css('display','block');
        readURL(this);
    });

    //--------------------------------------------------------------

    $("#imageInp").change(function() {
        $('#imageNoImage').css('display','none');
        $('#image_old').css('display','none');
        $('#image').css('display','block');
        readURL(this);
    });

    //Money Euro
    $('[data-mask]').inputmask();

    $('.check').on('click', function() {
        console.log("###")
        if($('.submit-btn').attr('disabled')) {
            $('.submit-btn').removeAttr('disabled');
        }else {
            $('.submit-btn').attr('disabled', true);

        }
    })

    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    $("#pop").on("click", function() {
        $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });

    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label               : 'Digital Goods',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label               : 'Electronics',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var areaChart       = new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })


        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [
                {
                    data: [700,500,400,600,300,100],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

    })

    // The Calender
    $('#calendar').datetimepicker({
        format: 'L',
        inline: true
    })


    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

    var salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'Digital Goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Electronics',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            }
        ]
    }

    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        }
    )

</script>

<script
{{--    src="https://code.jquery.com/jquery-3.6.0.js"--}}
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('0a5cf5c1d0e94b47316b', {
        cluster: 'mt1',
        encrypted: false

    });
</script>

<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));


    // var $myInput = $(notificationsCountElem).on('change', function (){
    //     audioNote = new Audio('public\\audio\\note.ogg');
    //     audioNote.play()
    // });

    $('.notification-drop').on('click', function (){
        notificationsCount = 0;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);

        setTimeout( function (){
            $('.unread').each(function (){
                $(this).removeClass('unread');
            });
        } , 5000);

        $.get('MarkAllSeen', function (){})

    });


    const sound = document.querySelector('#sound_note');
    sound.addEventListener('change', (e) =>
        {
            console.log(e);
        }
    )


    // document.getElementById('sound_note').bined('val', function(){
    //     console.log('d')
    // });
        // audioNote = new Audio('public\\audio\\note.ogg');
        // audioNote.play()


</script>

<script src="{{asset('js/pushNotification.js')}}"></script>

@yield('scripts')

@stack('script')

@yield('footer')
</body>
</html>
