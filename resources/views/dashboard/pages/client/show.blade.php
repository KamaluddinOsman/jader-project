@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('client.client')}} | {{ __('auth.bageTitle') }}
    @endsection

   <!-- DataTables -->
   <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- Sweet Alert-->
   <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('client.addClient') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('client.addClient') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(!empty($client->image))
                                <img alt="{{$client->name}}" class="profile-user-img img-fluid img-circle" style="width: 245px;border-radius: 15px" src="{{asset($client->image)}}">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{$client->full_name}}</h3>

                        <p class="text-muted text-center">{{$client->site}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>{{__('client.email')}} : </b>
                                <a class="float-right">{{$client->email}}</a>
                            </li>

                            <li class="list-group-item">
                                <b>{{__('client.phoneNumber')}} </b>
                                <a class="float-right">{{$client->phone}}</a>
                            </li>
                        </ul>
                        <a href="{{'active/'.$client->id}}" class="btn {{$client->activated == 1 ? 'btn-success' : 'btn-danger' }} btn-block"><b>{{ $client->activated == 1 ? __('client.activeClient') : __('client.blockClient') }}</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-bs-toggle="tab" href="#activity" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">{{__('client.activity')}}</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#timeline" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">{{__('client.timeline')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="activity" role="tabpanel">
                                @include('dashboard.pages.client.activity')
                            </div>
                            <div class="tab-pane" id="timeline" role="tabpanel">
                                @include('dashboard.pages.client.timeline')
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div id="showOrder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="orderView"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    <script>

        // $("#order").click(function (event) {
        $(document).on("click", "#order", function () {
            var order_id = $(this).data('orderid');
            console.log(order_id)
            $.ajax({
                url: "{{ url('/client/showdetailsorder') }}"+"/"+ order_id,
                method: 'GET',

                success: function(data) {
                    $('#orderView').html(data.output);
                }
            });
        });

    </script>

@endsection
