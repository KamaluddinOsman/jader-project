@extends('dashboard.layouts.main')
@section('page-title')
    {{ __('dashboard.main') }} | {{ __('auth.bageTitle') }}             
@endsection
@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('dashboard.main') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.main') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Orders -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">{{ __('dashboard.activeOrders') }}</p>
                                    <h4>{{$active_orders}}</h4>
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

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">{{ __('dashboard.pinddingOrders') }}</p>
                                    <h4>{{$padding_orders}}</h4>
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

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">{{ __('dashboard.canceledOrders') }}</p>
                                    <h4>{{$canceled_orders}}</h4>
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
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">{{__('dashboard.allOrders')}}</p>
                                    <h4>{{$all_orders}}</h4>
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

        <!-- Institutions -->
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p class="mb-2">{{ __('dashboard.openInstitutions') }}</p>
                                <h4 class="mb-0">{{$open_institutions}}</h4>
                            </div>
                            <div class="col-4">
                                <div class="text-end">
                                    <div>
                                        2.06 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                                    </div>
                                    <div class="progress progress-sm mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p class="mb-2">{{ __('dashboard.closedInstitutions') }}</p>
                                <h4 class="mb-0">{{$closed_institutions}}</h4>
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

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p class="mb-2">{{ __('dashboard.pinddingInstitutions') }}</p>
                                <h4 class="mb-0">{{$pendding_institutions}}</h4>
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

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p class="mb-2">{{ __('dashboard.allInstitutions') }}</p>
                                <h4 class="mb-0">{{$all_institutions}}</h4>
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
        </div>

        <!-- Clients -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('dashboard.clientsMovement') }}</h4>
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
                        <h4 class="card-title mb-4">{{ __('dashboard.clientsMovement') }}</h4>
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
        </div>

    </div>
@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ asset('dashboard/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('dashboard/js/pages/dashboard-2.init.js') }}"></script>

@endsection