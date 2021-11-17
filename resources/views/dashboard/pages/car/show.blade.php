@extends('admin.layouts.layout')

@section('title')
    {{__('lang.city')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <br>
    <br>

    @include('admin.layouts.flash-message')
    @include('flash::message')


    <div class="box-body">
        <div class="table-responsive">


            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/"><i
                                            class="fa fa-dashboard"></i> {{__('lang.master')}}</a></li>
                                <li class="breadcrumb-item"><a href="/car"><i
                                            class="fa fa-dashboard"></i> {{__('lang.car')}}</a></li>
                                <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{$car->number}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
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
                                            <b>{{__('lang.Number')}} : </b> <a
                                                class="float-right">{{$car->number}}</a>
                                        </li>

                                    </ul>

                                    <a href="{{'active/'.$car->id}}"
                                       class="btn {{$car->activated == 1 ? 'btn-danger' : 'btn-success' }} btn-block"><b>{{$car->activated == 1 ? 'Block' : 'Active' }}</b></a>
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
                                                    <div style="width: 19%; margin-left: 9px">
                                                        <a href="{{asset($car->getOriginal('driver_license'))}}" data-toggle="lightbox" data-title="رخصة السائق" data-gallery="gallery">
                                                            <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('driver_license'))}}" class="img-fluid mb-2" alt="رخصة السائق"/>
                                                        </a>
                                                    </div>

                                                    <div style="width: 19%; margin-left: 9px">
                                                        <a href="{{asset($car->getOriginal('car_license'))}}" data-toggle="lightbox" data-title="رخصة السيارة" data-gallery="gallery">
                                                            <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('car_license'))}}" class="img-fluid mb-2" alt="رخصة السيارة"/>
                                                        </a>
                                                    </div>

                                                    <div style="width: 19%; margin-left: 9px">
                                                        <a href="{{asset($car->getOriginal('image_car_front'))}}" data-toggle="lightbox" data-title="صوره السياره من الامام" data-gallery="gallery">
                                                            <img style="width:220px; height: 220px" src="{{asset($car->getOriginal('image_car_front'))}}" class="img-fluid mb-2" alt="صوره السياره من الامام"/>
                                                        </a>
                                                    </div>

                                                    <div style="width: 19%; margin-left: 9px">
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
                                                                    <strong>{{__('lang.ThereAreNoData')}}</strong>
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
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
    </div>









@endsection
