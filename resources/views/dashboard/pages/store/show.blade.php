@extends('dashboard.layouts.main')
@section('head')
    @section('title')
            {{__('institution.Institution')}}
    @endsection

    <link href="{{ asset('dashboard/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('institution.institution') }} : {{$store->name ? $store->name : "" }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('institution.institution') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-3">

                            <div class="text-center">
                                <div class="">
                                    <img src="{{ $store->logo ? asset($store->logo) : asset('img/no_image.png') }}" alt=""
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                    </div>
                                </div>

                                <div class="mt-3 ">
                                    <a href="#" class="text-dark fw-medium font-size-16">{{ $store->name ? $store->name : ""}}</a>
                                    <p class="text-body mt-1 mb-1">UI/UX Designer</p>

                                    <span class="badge bg-success">Follow Me</span>
                                    <span class="badge bg-danger">Message</span>
                                </div>

                                <div class="row mt-4 border border-start-0 border-end-0 p-3">
                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            Followers
                                        </h6>
                                        <h5 class="mb-0">9,025</h5>
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="text-muted">
                                            Following
                                        </h6>
                                        <h5 class="mb-0">11,025</h5>
                                    </div>
                                </div>

                                <div class="mt-4">

                                    <ul class="list-inline social-source-list">
                                        <li class="list-inline-item">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle">
                                                    <i class="mdi mdi-facebook"></i>
                                                </span>
                                            </div>
                                        </li>

                                        <li class="list-inline-item">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </span>
                                            </div>
                                        </li>

                                        <li class="list-inline-item">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-danger">
                                                    <i class="mdi mdi-google-plus"></i>
                                                </span>
                                            </div>
                                        </li>

                                        <li class="list-inline-item">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-pink">
                                                    <i class="mdi mdi-instagram"></i>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Personal Information</h5>

                        <p class="card-title-desc">
                            Hi I'm Patrick Becker, been industry's standard dummy ultrices Cambridge.
                        </p>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Email Address</p>
                            <h6 class="">StaceyTLopez@armyspy.com</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Phone number</p>
                            <h6 class="">001 951-402-8341</h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">Office Address</p>
                            <h6 class="">2240 Denver Avenue
                                Los Angeles, CA 90017</h6>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2">My Top Skills</h5>
                        <p class="text-muted">Suspendisse mattis rutrum orci eu pellentesque. </p>
                        <ul class="list-unstyled list-inline language-skill mb-0">
                            <li class="list-inline-item badge bg-primary"><span>java</span></li>
                            <li class="list-inline-item badge bg-primary"><span>Javascript</span></li>
                            <li class="list-inline-item badge bg-primary"><span>laravel</span></li>
                            <li class="list-inline-item badge bg-primary"><span>HTML5</span></li>
                            <li class="list-inline-item badge bg-primary"><span>android</span></li>
                            <li class="list-inline-item badge bg-primary"><span>zengo</span></li>
                            <li class="list-inline-item badge bg-primary"><span>python</span></li>
                            <li class="list-inline-item badge bg-primary"><span>react</span></li>
                            <li class="list-inline-item badge bg-primary"><span>php</span></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">{{__('institution.institutionProducts')}}</p>
                                        <h4 class="mb-0">{{$products ? $products->count() : 0}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                2.06 % <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">{{__('institution.institutionOrders')}}</p>
                                        <h4 class="mb-0">{{ $orders ? $orders->count() : 0}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                3.12 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 78%" aria-valuenow="78" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <p class="mb-2">{{__('institution.institutionProfit')}}</p>
                                        <h4 class="mb-0">{{$profit_store ? $profit_store->count() : 0}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-end">
                                            <div>
                                                2.12 % <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                            </div>
                                            <div class="progress progress-sm mt-3">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#experience" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Experience</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#revenue" role="tab">
                                    <span class="d-none d-sm-block">Revenue</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Settings</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="experience" role="tabpanel">
                                <div class="timeline-count mt-5">
                                    <!-- Timeline row Start -->
                                    <div class="row">

                                        <!-- Timeline 1 -->
                                        <div class="timeline-box col-lg-4">
                                            <div class="mb-5 mb-lg-0">
                                                <div class="item-lable bg-primary rounded">
                                                    <p class="text-center text-white">2016 - 20</p>
                                                </div>
                                                <div class="timeline-line active">
                                                    <div class="dot bg-primary"></div>
                                                </div>
                                                <div class="vertical-line">
                                                    <div class="wrapper-line bg-light"></div>
                                                </div>
                                                <div class="bg-light p-4 rounded mx-3">
                                                    <h5>Back end Developer</h5>
                                                    <p class="text-muted mt-1 mb-0">Voluptatem accntium
                                                        doemque lantium, totam rem aperiam, eaque ipsa quae
                                                        ab illo quasi sunt explicabo.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline 1 -->

                                        <!-- Timeline 2 -->
                                        <div class="timeline-box col-lg-4">
                                            <div class="mb-5 mb-lg-0">
                                                <div class="item-lable bg-primary rounded">
                                                    <p class="text-center text-white">2013 - 16</p>
                                                </div>
                                                <div class="timeline-line active">
                                                    <div class="dot bg-primary"></div>
                                                </div>
                                                <div class="vertical-line">
                                                    <div class="wrapper-line bg-light"></div>
                                                </div>
                                                <div class="bg-light p-4 rounded mx-3">
                                                    <h5>Front end Developer</h5>
                                                    <p class="text-muted mt-1 mb-0">Vivamus ultrices massa
                                                        tellus, sed convallis urna interdum eu. Pellentesque
                                                        htant morbi varius mollis et quis nisi.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline 2 -->

                                        <!-- Timeline 3 -->
                                        <div class="timeline-box col-lg-4">
                                            <div class="mb-5 mb-lg-0">
                                                <div class="item-lable bg-primary rounded">
                                                    <p class="text-center text-white">2011 - 13</p>
                                                </div>
                                                <div class="timeline-line active">
                                                    <div class="dot bg-primary"></div>
                                                </div>
                                                <div class="vertical-line">
                                                    <div class="wrapper-line bg-light"></div>
                                                </div>
                                                <div class="bg-light p-4 rounded mx-3">
                                                    <h5>UI /UX Designer</h5>
                                                    <p class="text-muted mt-1 mb-0">Suspendisse potenti.
                                                        senec netus malesuada fames ac turpis egesta vitae
                                                        blandit ac tempus nulla.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline 3 -->
                                    </div>
                                    <!-- Timeline row Over -->

                                </div>
                            </div>
                            <div class="tab-pane" id="revenue" role="tabpanel">
                                <div id="revenue-chart" class="apex-charts mt-4"></div>
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel">

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname"
                                                placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname"
                                                placeholder="Enter last name">
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="userbio">Bio</label>
                                            <textarea class="form-control" id="userbio" rows="4"
                                                placeholder="Write something..."></textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label class="form-label" for="useremail">Email Address</label>
                                            <input type="email" class="form-control" id="useremail"
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" id="userpassword"
                                                placeholder="Enter password">
                                        </div>
                                    </div> <!-- end col -->
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Projects</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Projects</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Billing Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" colspan="2">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Qovex admin UI</td>
                                        <td>
                                            21/01/2020
                                        </td>
                                        <td>Werner Berlin</td>
                                        <td>$ 125</td>
                                        <td><span class="badge badge-soft-success font-size-12">Paid</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Qovex admin Logo
                                        </td>
                                        <td>16/01/2020</td>

                                        <td>Robert Jordan</td>
                                        <td>$ 118</td>
                                        <td><span class="badge badge-soft-danger font-size-12">Chargeback</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Redesign - Landing page
                                        </td>
                                        <td>17/01/2020</td>

                                        <td>Daniel Finch</td>
                                        <td>$ 115</td>
                                        <td><span class="badge badge-soft-success font-size-12">Paid</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Blog Template
                                        </td>
                                        <td>18/01/2020</td>

                                        <td>James Hawkins</td>
                                        <td>$ 121</td>
                                        <td><span class="badge badge-soft-warning font-size-12">Refund</span>
                                        </td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>


{{-- <script src="{{ asset('dashboard/js/custom.js') }}"></script> --}}

    <script>

        $(function () {
            $("#datatable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
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

        // Changing Category Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/store";
        });

    </script>

@endsection