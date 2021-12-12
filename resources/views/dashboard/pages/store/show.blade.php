@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('institution.institutions') }} {{__('institution.institutionShow')}} | {{ __('auth.bageTitle') }}
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
                    <h4 class="page-title mb-0 font-size-18">{{__('institution.institutionShow') ." ".__('institution.institution') ." : ". ($store->name ? $store->name : "") }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{__('institution.institutionShow') ." ".__('institution.institution') ." : ". ($store->name ? $store->name : "") }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')
        
        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-widgets py-3">

                            <div class="text-center">
                                <div class="">
                                    <img src="{{ File::exists($store->logo) ? asset($store->logo) : asset('img/no_image.png') }}" alt=""
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                    </div>
                                </div>

                                <div class="mt-3 ">
                                    <a href="#" class="text-dark fw-medium font-size-16">{{ $store->name ? $store->name : ""}}</a>
                                    <p class="text-body mt-1 mb-1">{{ $store->company_register ? $store->company_register : "Not registered yet"}}</p>

                                    <a class="badge bg-primary" href="https://www.facebook.com/{{$store->facebook}}" target="_blank">
                                        <i class="mdi mdi-facebook-box"></i>
                                        Facebook
                                    </a>
                                    <a class="badge bg-success" href="https://api.whatsapp.com/send?phone={{$store->whatsapp}}" target="_blank">
                                        <i class="mdi mdi-whatsapp"></i>
                                        Whatsapp
                                    </a>
                                </div>

                                {{-- <div class="row mt-4 border border-start-0 border-end-0 p-3">
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
                                </div> --}}

                                {{-- <div class="mt-4">

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

                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{-- <h5 class="card-title mb-3">Personal Information</h5> --}}
                        <h5 class="card-title mb-3">{{ __('institution.institutionAbout') }}</h5>
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fas fa-user-circle"> </i> {{ __('institution.responsible') }}
                            </p>
                            <h6 class="">
                                {{$store->name_responsible}}<br>
                                {{$store->responsible_position}}<br>
                                {{$store->responsible_mobile}}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fas fa-user-circle"> </i> {{ __('institution.authorized') }}
                            </p>
                            <h6 class="">
                                {{$store->name_authorized}}<br>
                                {{$store->authorized_mobile}}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fa fa-money mr-1"></i>{{ __('institution.legalName') }}
                            </p>
                            <h6 class="">
                                {{$store->legal_name}}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fa fa-money mr-1"></i>{{ __('institution.institutionEmail') }}
                            </p>
                            <h6 class="">
                                {{$store->email}}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fa fa-money mr-1"></i> {{ __('institution.minOrder') }}
                            </p>
                            <h6 class="">
                                {{$store->minimum_order}}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fa fa-money mr-1"></i> {{ __('institution.deliveryPrice') }}
                            </p>
                            <h6 class="">
                                {{$store->delivery_price}}
                            </h6>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ __('institution.location') }}
                            </p>
                            <h6 class="">
                                {{$store->address}}
                            </h6>
                        </div>
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fas fa-pencil-alt mr-1"></i> {{ __('institution.institutionContractPic') }}
                            </p>
                            <h6 class="">
                                <a href="{{asset($store->getOriginal('picture_contract'))}}"> {{ __('institution.clickHere')}} </a>
                            </h6>
                        </div>
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="fas fa-pencil-alt mr-1"></i> {{ __('institution.institutionCover')}}
                            </p>
                            <h6 class="">
                                <a href="{{asset($store->getOriginal('front_img'))}}"> {{ __('institution.clickHere')}} </a>
                            </h6>
                        </div>
                        <div class="mt-3">
                            <p class="font-size-12 text-muted mb-1">
                                <i class="far fa-file-alt mr-1"></i> {{ __('institution.institutionNote') }}
                            </p>
                            <h6 class="">
                                {{$store->about}}
                            </h6>
                        </div>

                        @if(!empty($store->day_work))
                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">
                                    <i class="fas fa-calendar mr-1"></i> {{ __('institution.workingDays') }}
                                </p>
                                <h6 class="">
                                    <?php $days = new \Carbon\Carbon(now()) ?>
                                    <ul class="list-unstyled list-inline language-skill mb-0">
                                        @if ($store->day_work != 'null')
                                            @foreach(json_decode($store->day_work) as $key => $val)
                                                <li class="list-inline-item badge bg-primary">
                                                    <span class="badge {{$days->dayName == $val ? 'badge-warning': 'badge-success'}}">{{$val}}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="list-inline-item badge bg-primary">
                                                Not set yet
                                            </li>
                                        @endif
                                    </ul>
                                    <p>
                                        <span style="display: inline-block; margin-right: 20px; font-size: 13px"><i style="color: #007fff" class="fas fa-hourglass"></i>{{date('h:i', strtotime($store->start_time))}}</span>
                                        <span style="display: inline-block; font-size: 13px"><i style="color: #007fff" class="fas fa-hourglass-end"></i> {{date('h:i', strtotime($store->end_time))}}</span>
                                    </p>
                                </h6>
                            </div>
                        @endif
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
                                        <p class="mb-2">{{__('institution.institutionProductsCard')}}</p>
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
                                        <p class="mb-2">{{__('institution.institutionOrdersCard')}}</p>
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
                                        <p class="mb-2">{{__('institution.institutionProfitCard')}}</p>
                                        <h4 class="mb-0">{{ $profit_store ? $profit_store : 0 }}</h4>
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
                                <a class="nav-link active" data-bs-toggle="tab" href="#products" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">{{ __('institution.products') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab">
                                    <span class="d-none d-sm-block">{{ __('institution.orders') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#money" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">{{ __('institution.transactions') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#location" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">{{ __('institution.location') }}</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="products" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title mb-4">
                                        {{-- <div style="display: inline-block" class="text-left">
                                            <p>عرض كل منتجات العميل</p>
                                         </div> --}}
                                        <div style="display: inline-block; float: right"  class="text-right">
                                            <a href="{{url('product/create/' .$store->id)}}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus"></i> {{ __('product.addProduct') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body pb-0">
                                        <div class="row d-flex align-items-stretch">
                                            @if ($products->count() != 0)
                                                @foreach($products as $product)
                                                    <div class="col-lg-4 col-sm-6 col-md-4 d-flex align-items-stretch">
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
                                            @endif
                                        </div>
                                        <div style="display: block; margin: 0 auto">
                                            {{ $products->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="orders" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-body pb-0">
                                        <table id="datatable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('institution.orderId') }}</th>
                                                    <th>{{ __('institution.product') }}</th>
                                                    <th>{{ __('institution.quantity') }}</th>
                                                    <th>{{ __('institution.discount') }}</th>
                                                    <th>{{ __('institution.price') }}</th>
                                                    <th>{{ __('institution.status') }}</th>
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
                                                                <td class="text-success">{{ __('institution.complete') }}</td>
                                                            @else
                                                                <td class="text-danger">{{ __('institution.pending') }}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="money" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-body pb-0">
                                        <form class="form-horizontal">
                                            <table id="datatable2" class="table table-bordered table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">{{ __('institution.allSales') }}</th>
                                                        <th scope="col">{{ __('institution.siteProfit') }}</th>
                                                        <th scope="col">{{ __('institution.institutionProfit') }}</th>
                                                        <th scope="col">{{ __('institution.institutionTransactions') }}</th>
                                                        <th scope="col">{{ __('institution.remaining') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($money))
                                                        <tr>
                                                            <th scope="row">{{$total}}</th>
                                                            <td>{{$profit_site}}</td>
                                                            <td>{{$profit_store}}</td>
                                                            <td>{{$cash_withdrawal}}</td>
                                                            <td>{{$net_commissions}}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="location" role="tabpanel">
                                <form class="form-horizontal">
                                    <input hidden value="{{$store->lang}}">
                                    <input hidden value="{{$store->late}}">
                                    <!--Google map-->
                                    <div id="map" style="height: 500px">
                                    </div>
                                    <!--Google Maps-->
                                </form>
                            </div>
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

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>

    
    <script>
        // $(function () {
        //     let processing_val      = $('html').attr('lang') == 'ar' ? "جارٍ التحميل ..." : "Processing ..."
        //     let lengthMenu_val      = $('html').attr('lang') == 'ar' ? "أظهر _MENU_ مدخلات" : "Show _MENU_ entry"
        //     let zeroRecords_val     = $('html').attr('lang') == 'ar' ? "لم يعثر على أية سجلات" : "No records found"
        //     let info_val            = $('html').attr('lang') == 'ar' ? "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل" : "Show _START_ to _END_ out of _TOTAL_ entry"
        //     let infoEmpty_val       = $('html').attr('lang') == 'ar' ? "يعرض 0 إلى 0 من أصل 0 سجل" : "Show 0 to 0 out of 0 records"
        //     let infoFiltered_val    = $('html').attr('lang') == 'ar' ? "(منتقاة من مجموع _MAX_ مُدخل)" : "(Selected from the sum of _MAX_ entered)"
        //     let first_val           = $('html').attr('lang') == 'ar' ? "الأول" : "The first"
        //     let search_val          = $('html').attr('lang') == 'ar' ? "ابحث : " : "Search : "
        //     let previous_val        = $('html').attr('lang') == 'ar' ? "السابق" : "Previous"
        //     let next_val            = $('html').attr('lang') == 'ar' ? "التالي" : "Next"
        //     let last_val            = $('html').attr('lang') == 'ar' ? "الأخير" : "The last"
            
        //     $('#datatable2').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": true,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         // "buttons": ["copy", "csv", "excel", "pdf", "print"],
        //         "buttons": false,
        //         "responsive": true,
        //         "language": {
        //             "sProcessing": processing_val,
        //             "sLengthMenu": lengthMenu_val,
        //             "sZeroRecords": zeroRecords_val,
        //             "sInfo": info_val,
        //             "sInfoEmpty": infoEmpty_val,
        //             "sInfoFiltered": infoFiltered_val,
        //             "sInfoPostFix": "",
        //             "sSearch": search_val,
        //             "sUrl": "",
        //             "oPaginate": {
        //                 "sFirst": first_val,
        //                 "sPrevious": previous_val,
        //                 "sNext": next_val,
        //                 "sLast": last_val,
        //             }
        //         }
        //     });
        // });
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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvt4xYX0QycPedzqGKJ7_1sg6KH_iztDA&callback=initMap&libraries=&v=weekly" defer></script>
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