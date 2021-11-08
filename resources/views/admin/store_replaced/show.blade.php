@extends('admin.layouts.layout')
<style>
    .data_rest {
        width: 150px;
        font-weight: bold;
        display: inline-block;
        color: #1c2529;
        padding: 9px;
    }

    .span_rest {
        font-size: 20px;
        color: #0b93d5;
    }

    .meal {
        background-color: #0b97c4;
        width: 100%;
        height: 40px;
        margin-bottom: 12px;
        margin-top: 11px;
        border-radius: 5px 5px 0 0;
    }

    .meal h3 {
        margin-right: 10px;
        color: white;
        padding-top: 8px;
    }

    .cover-container{
        background: #1E90FF;
        background: -webkit-radial-gradient(bottom, #73D6F5 12%, #1E90FF);
        background: radial-gradient(at bottom, #73D6F5 12%, #1E90FF)
    }
    .fb-profile-block-thumb{
        display: block;
        height: 315px;
        overflow: hidden;
        position: relative;
        text-decoration: none;
        margin-bottom: 15px;
    }

    .profile-img a{
        bottom: 15px;
        box-shadow: none;
        display: block;
        left: 15px;
        padding:1px;
        position: absolute;
        /*height: 160px;*/
        /*width: 160px;*/
        /*background: rgba(0, 0, 0, 0.3) none repeat scroll 0 0;*/
        z-index:9;
    }
    .profile-img img {
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.07);
        height:158px;
        padding: 5px;
        width:158px;
    }
    .profile-name {
        bottom: 25px;
        left: 281px;
        position: absolute;
    }
    .profile-name h2 {
        color: #fff;
        font-size: 24px;
        font-weight: 500;
        line-height: 30px;
        max-width: 300px;
        position: relative;
        text-transform: uppercase;
    }
</style>
@section('title')
    {{__('lang.store')}}
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
                                <li class="breadcrumb-item"><a href="/store"><i
                                            class="fa fa-dashboard"></i> {{__('lang.store')}}</a></li>
                                <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{$store->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Cover -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="fb-profile-block-thumb cover-container">
                                        @if(!empty($store->getOriginal('cover')))
                                            <img alt="{{$store->name}}"
                                                 class=""
                                                 style="background-repeat: no-repeat; background-size: cover; width: 100%"
                                                 src="{{asset($store->getOriginal('cover'))}}">
                                        @endif
                                </div>
                                <div class="profile-img">
                                    <a href="#">
                                        @if(!empty($store->logo))
                                            <img alt="{{$store->name}}"
                                                 class="profile-user-img img-fluid img-circle"
                                                 style="width: 245px;border-radius: 15px"
                                                 src="{{asset($store->getOriginal('logo'))}}">
                                        @endif
                                    </a>
                                </div>
                                <div class="profile-name">
                                    <h2 style="display: inline-block">{{$store->name}}</h2>
                                    @if($store->ratio == 6)
                                       <img title="حساب موثق من جدير" style="width: 30px; margin-top: -8px" src="{{asset('public/storage/images/valid.png')}}">
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">

                                    <ul class="list-group list-group-unbordered mb-3">

                                        <li style="border-top: none" class="list-group-item">
                                            <b>{{__('lang.company_register')}} : </b> <a
                                                class="float-right">{{$store->company_register}}</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b>{{__('lang.num_tax')}} </b> <a
                                                class="float-right">{{$store->num_tax}}</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b>{{__('lang.phone')}} </b> <a
                                                class="float-right">{{$store->phone1}}</a>
                                        </li>
                                    </ul>

                                    <div style="padding: 8px" class="text-center media">
                                        <a style="margin: 5px" target="_blank" href="{{$store->facebook}}">
                                            <i class="fab fa-facebook fa-2x"></i>
                                        </a>

                                        <a style="margin: 5px" target="_blank"
                                           href="https://api.whatsapp.com/send?phone={{$store->whatsapp}}">
                                            <i style="color: #239241" class="fab fa-whatsapp fa-2x"></i>
                                        </a>

                                    </div>

                                    <a href="{{'active/'.$store->id}}"
                                       class="btn {{$store->active == 1 ? 'btn-danger' : 'btn-success' }} btn-block"><b>{{$store->active == 1 ? 'Block' : 'Active' }}</b></a>
                                    <b class="btn btn-info btn-block">{{$store->active == 'open' ? 'Opened Now' : 'Closed Now' }}</b>
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
                                    <strong><i class="fas fa-user-circle"> </i> Responsible</strong>

                                    <p class="text-muted">
                                        {{$store->name_responsible}}<br>
                                        {{$store->responsible_position}}<br>
                                        {{$store->responsible_mobile}}
                                    </p>

                                    <hr>

                                    <strong><i class="fas fa-user-circle"> </i> Authorized</strong>

                                    <p class="text-muted">
                                        {{$store->name_authorized}}<br>
                                        {{$store->authorized_mobile}}
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-money mr-1"></i> Legal Name</strong>

                                    <p class="text-muted">{{$store->legal_name}}</p>

                                    <hr>

                                    <strong><i class="fa fa-money mr-1"></i> Email</strong>

                                    <p class="text-muted">{{$store->email}}</p>

                                    <hr>

                                    <strong><i class="fa fa-money mr-1"></i> Minimum Order</strong>

                                    <p class="text-muted">{{$store->minimum_order}}</p>

                                    <hr>

                                    <strong><i class="fa fa-money mr-1"></i> Delivery Price</strong>

                                    <p class="text-muted">{{$store->delivery_price}}</p>

                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                    <p class="text-muted">{{$store->address}}</p>

                                    <hr>

                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Contract</strong>

                                    <p> <a href="{{asset($store->getOriginal('picture_contract'))}}"> Contract </a> </p>
                                    <hr>

                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Front Store</strong>

                                    <p> <a href="{{asset($store->getOriginal('front_img'))}}"> Front Store </a> </p>
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                    <p class="text-muted">{{$store->about}}</p>

                                    <hr>

                                    @if(!empty($store->day_work))
                                        <strong><i class="fas fa-calendar mr-1"></i> Day Of Work</strong>
                                        <p class="text-muted">
                                            <?php $days = new \Carbon\Carbon(now()) ?>
                                            {{-- @foreach(json_decode($store->day_work) as $key => $val)
                                                <span class="badge {{$days->dayName == $val ? 'badge-warning': 'badge-success'}}">{{$val}}</span>
                                            @endforeach --}}
                                            <br>
                                            <span style="display: inline-block; margin-right: 20px; font-size: 13px"><i style="color: #007fff" class="fas fa-hourglass"></i>{{date('h:i', strtotime($store->start_time))}}</span>
                                            <span style="display: inline-block; font-size: 13px"><i style="color: #007fff" class="fas fa-hourglass-end"></i> {{date('h:i', strtotime($store->end_time))}}</span>
                                        </p>
                                    <hr>
                                    @endif
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
                                        <li class="nav-item"><a class="nav-link active" href="#activity"
                                                                data-toggle="tab">{{__('lang.product')}}</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Order</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Money</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#location" data-toggle="tab">Location</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div style="display: inline-block" class="text-left">
                                               <p>عرض كل منتجات العميل</p>
                                            </div>
                                            <div style="display: inline-block; float: right"  class="text-right">
                                                <a href="{{url('product/create/' .$store->id)}}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-plus"></i> Add Product
                                                </a>
                                            </div>

                                            <!-- Default box -->
                                            <div class="card card-solid">
                                                <div class="card-body pb-0">
                                                    <div class="row d-flex align-items-stretch">
                                                        @foreach($products as $product)
                                                            <div class="col-lg-3 col-sm-6 col-md-4 d-flex align-items-stretch">
                                                                <div class="card bg-light">
                                                                    <div class="card-header text-muted border-bottom-0">
                                                                        <h2 class="lead"><b>{{$product->name}}</b></h2>
                                                                    </div>
                                                                    <div class="card-body pt-0">
                                                                        <div class="row">
                                                                            <div class="text-center">
                                                                                <img
                                                                                    src="{{asset($product->getOriginal('image1'))}}"
                                                                                    alt="{{$product->name}}"
                                                                                    class="img-fluid">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <div class="text-right">
                                                                            <a href="{{url('product/ProductShow/'.$product->id)}}" class="btn btn-sm btn-primary">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>

                                                                            <a href="{{url('product/'.$product->id.'/edit')}}" class="btn btn-sm btn-success">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>

                                                                            <form style="display: inline-block" method="POST" action="{{route('product.destroy', $product->id)}}">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}

                                                                                <a class="btn btn-sm btn-danger deleteRecord">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div style="display: block; margin: 0 auto">
                                                        {{ $products->links() }}
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                            </div>
                                            <!-- /.card -->


                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <!-- The timeline -->
                                            <div class="">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>order_id</th>
                                                        <th>product</th>
                                                        <th>quantity</th>
                                                        <th>discount</th>
                                                        <th>price</th>
                                                        <th>status</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($orders))

                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>{{$order->id}}</td>
                                                                <td>{{$order->order_id}}</td>
                                                                <td>{{$order->product->name}}</td>
                                                                <td>{{$order->quantity}}</td>
                                                                <td>{{$order->discount}}</td>
                                                                <td>{{$order->price}}</td>
                                                                @if($order->status == "complete")
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
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">
                                            <form class="form-horizontal">

                                                @if(count($money))
                                                    <table class="table">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">كل المبيعات</th>
                                                        <th scope="col">ارباح الموقع</th>
                                                        <th scope="col">ارباح المؤسسة</th>
                                                        <th scope="col">التحويل النقدى للمؤسسة</th>
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

                                                        <h1> عرض حركات تحويل نسبة المؤسسة</h1>
                                                        <h1> خصم تحويل نسبة المؤسسة</h1>
                                                        <h1>عرض المكان على الخريطه</h1>
                                                </table>
                                                @endif

                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="location">
                                            <form class="form-horizontal">
                                                <input hidden value="{{$store->lang}}">
                                                <input hidden value="{{$store->late}}">
                                                <!--Google map-->
                                                <div id="map" style="width: 898px; height: 500px">
                                                </div>
                                                <!--Google Maps-->
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



    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvt4xYX0QycPedzqGKJ7_1sg6KH_iztDA&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = { lat: {{$store->late}}, lng: {{$store->lang}} };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 19,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }

    </script>

@endsection

@section('script')

@endsection
