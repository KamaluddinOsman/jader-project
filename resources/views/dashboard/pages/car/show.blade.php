@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('car.car')}} | {{ __('auth.bageTitle') }}
    @endsection

    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('car.car') }} - {{ $car->number ?  $car->number : '' }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i>{{ __('dashboard.dashboard') }} </a></li>
                            <li class="breadcrumb-item"><a href="/car"><i class="fa fa-dashboard"></i>{{ __('car.car') }}</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i>{{ $car->number }}</li>
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
                            @if(!empty($car->image_car_front))
                                <img alt="{{$car->number}}"
                                        class="profile-user-img img-fluid img-circle"
                                        style="width: 245px;border-radius: 15px"
                                        src="{{asset($car->getOriginal('image_car_front'))}}">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{$car->number}}</h3>

                        <p class="text-muted text-center">{{$car->site}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>{{__('car.numberColumn')}} : </b>
                                <a class="float-right">{{$car->number}}</a>
                            </li>

                        </ul>
                        <a href="{{'active/'.$car->id}}" class="btn {{$car->activated == 1 ? 'btn-success' : 'btn-danger' }} btn-block"><b>{{ $car->activated == 1 ? __('car.activeCar') : __('car.blockCar') }}</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user-circle"></i> Manger</strong>

                        <p class="text-muted">
                            {{$car->client->full_name ?? ''}}
                        </p>

                        <hr>

                        <strong><i class="fa fa-money mr-1"></i> Type Car</strong>

                        <p class="text-muted">{{$car->Type_car ?? ''}}</p>

                        <hr>

                        <strong><i class="fa fa-money mr-1"></i> Car Model</strong>

                        <p class="text-muted">{{$car->car_model ?? ''}}</p>

                        <hr>

                        <strong><i class="fa fa-money mr-1"></i> Personal Id</strong>

                        <p class="text-muted">{{$car->personal_id}}</p>

                        <hr>

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
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Car papers</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">driver</a>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Money</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <p>كل اوراق السياره</p>

                                <!-- Default box -->
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-sm-3">
                                            <a href="{{asset($car->getOriginal('driver_license'))}}" data-toggle="lightbox" data-title="رخصة السائق" data-gallery="gallery">
                                                <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('driver_license'))}}" class="img-fluid mb-2" alt="رخصة السائق"/>
                                            </a>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{asset($car->getOriginal('car_license'))}}" data-toggle="lightbox" data-title="رخصة السيارة" data-gallery="gallery">
                                                <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('car_license'))}}" class="img-fluid mb-2" alt="رخصة السيارة"/>
                                            </a>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{asset($car->getOriginal('image_car_front'))}}" data-toggle="lightbox" data-title="صوره السياره من الامام" data-gallery="gallery">
                                                <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('image_car_front'))}}" class="img-fluid mb-2" alt="صوره السياره من الامام"/>
                                            </a>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{asset($car->getOriginal('image_car_back'))}}" data-toggle="lightbox" data-title="صوره السياره من الامام" data-gallery="gallery">
                                                <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('image_car_back'))}}" class="img-fluid mb-2" alt="صوره السياره من الامام"/>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                @if(count($orders))
                                <div class="timeline-inverse">
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>order_id</th>
                                                    <th>name_buyer</th>
                                                    <th>shipped</th>
                                                    <th>status</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($orders as $order)
                                                        <tr>
                                                            <td>{{$loop->index + 1}}</td>
                                                            <td>{{$order->id}}</td>
                                                            <td>{{$order->name_buyer}}</td>
                                                            <td>{{$order->shipped}}</td>
                                                            @if($order->status == "Delivered")
                                                                <td class="text-success">{{$order->status}}</td>
                                                            @else
                                                                <td class="text-danger">{{$order->status}}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach

                                                @else

                                                    <div class="alert alert-warning alert-block">
                                                        <strong>{{__('car.noData')}}</strong>
                                                    </div>
                                                @endif
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    @if(count($money))
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">كل المبيعات</th>
                                                <th scope="col">ارباح الموقع</th>
                                                <th scope="col">ارباح المندوب</th>
                                                <th scope="col">التحويل النقدى للمندوب</th>
                                                <th scope="col">المتبقى</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">{{$total}}</th>
                                                <td>{{$profit_site}}</td>
                                                <td>{{$profit_store}}</td>
                                                <td>{{$cash_withdrawal}}</td>
                                                <td>{{$net_commissions}}</td>
                                            </tr>
                                            </tbody>

                                            <h1> عرض حركات تحويل نسبة المندوب</h1>
                                            <h1> خصم تحويل نسبة المندوب</h1>
                                        </table>
                                    @endif
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
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
    
@endsection