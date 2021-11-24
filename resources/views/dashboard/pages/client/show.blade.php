@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('client.client')}} | {{ __('auth.bageTitle') }}
    @endsection

    <link href="{{ asset('dashboard/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endsection
@include('admin.layouts.flash-message')
    @include('flash::message')

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
                            <b>{{__('lang.email')}} : </b> <a
                                class="float-right">{{$client->email}}</a>
                        </li>

                        <li class="list-group-item">
                            <b>{{__('lang.phone')}} </b> <a
                                class="float-right">{{$client->phone}}</a>
                        </li>
                    </ul>

                    <a href="{{'active/'.$client->id}}"
                       class="btn {{$client->activated == 1 ? 'btn-danger' : 'btn-success' }} btn-block"><b>{{$client->activated == 1 ? 'Block' : 'Active' }}</b></a>
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
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{__('lang.cart')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">{{__('lang.order')}}</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">عرض كل طلبات العميل</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>صوره</th>
                                                <th>اسم المنتج</th>
                                                <th>الكميه</th>
                                                <th>السعر</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                                @if($carts)
                                                    @foreach($carts as $cart)
                                                            <tr>
                                                                <td><img style="width: 50px; height: 50px" src="{{asset($cart->product->image)}}"></td>
                                                                <td>{{$cart->product->name}}</td>
                                                                <td>{{$cart->quantity}}</td>
                                                                <td>{{$cart->total_price}}</td>
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
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">عرض كل طلبات العميل</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>رقم الطلب</th>
                                                    <th>اسم المشترى</th>
                                                    <th>الحالة</th>
                                                    <th>السعر</th>
                                                    <th>عرض التفاصيل</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($orders)
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>{{$order->id}}</td>
                                                                <td>{{$order->name_buyer}}</td>
                                                                <td>{{$order->status}}</td>
                                                                <td>{{$order->billing_total}}</td>
                                                                <td><button id="order" type="button" class="btn btn-primary" data-orderid="{{$order->id}}" data-bs-toggle="modal" data-bs-target="#showOrder"><i class="fa fa-eye"></i></button></td>
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
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
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

    <div id="showOrder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="orderView"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

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
