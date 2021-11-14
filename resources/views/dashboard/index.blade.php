@extends('dashboard.layouts.main')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('dashboard.dashboard') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div>
                                            <p class="text-muted fw-medium mt-1 mb-2">Orders</p>
                                            <h4>1,368</h4>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <div id="radial-chart-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-0"><span class="badge badge-soft-success me-2"> 0.8% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div>
                                            <p class="text-muted fw-medium mt-1 mb-2">Revenue</p>
                                            <h4>$ 32,695</h4>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            <div id="radial-chart-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-0"><span class="badge badge-soft-success me-2"> 0.6% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sales Report</h4>
                        <div class="row">
                            <div class="col-sm-7">
                                <div>
                                    <p class="mb-2">01 Jan - 31 Jan, 2020</p>
                                    <h4>$ 27, 253</h4>
                                    <p class="mt-4 mb-0"><span class="badge badge-soft-success me-2"> 0.6% <i class="mdi mdi-arrow-up"></i> </span> From previous period
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div id="sales-report-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Year</a>
                                </li>
                            </ul>
                        </div>
                        <h4 class="card-title mb-4">Email Sent</h4>
                        <div id="mixed-chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Earning</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <p>1 Jan - 31 Jan, 2020</p>
                                    <p class="mb-2">Total Earning</p>
                                    <h4>$ 12,362</h4>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mt-3">
                                            <p class="mb-2 text-truncate">This Month</p>
                                            <h5 class="d-inline-block align-middle mb-0">$ 9,245</h5> <span
                                                class="badge badge-soft-success">+ 1.5 %</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mt-3">
                                            <p class="mb-2 text-truncate">Last Month</p>
                                            <h5>$ 8,234</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="btn btn-primary btn-sm">View more</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div id="bar-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Yearly sales</h4>

                        <div id="radar-chart" class="apex-charts"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ asset('dashboard/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('dashboard/js/pages/dashboard-2.init.js') }}"></script>

@endsection