@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('product.product') }} | {{ __('auth.bageTitle') }}             
    @endsection

    <link href="{{ asset('dashboard/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />


    <style>
        .product-image-thumbs {
            -ms-flex-align: stretch;
            align-items: stretch;
            display: -ms-flexbox;
            display: flex;
            margin-top: 2rem;
        }
        .product-image-thumb {
            box-shadow: 0 1px 2px rgb(0 0 0 / 8%);
            border-radius: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            display: -ms-flexbox;
            display: flex;
            margin-right: 1rem;
            max-width: 7rem;
            padding: 0.5rem;
        }
    </style>
@endsection
@section('content')
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">{{ __('product.productTable') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('product.productTable') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{$product->name ? $product->name : ""}}</h3>
                    <div class="col-12">
                        <img class="product-image-larg rounded img-thumbnail" src="{{ File::exists( asset($product->getOriginal('image1')) ) ? asset($product->getOriginal('image1')) : asset('img/no_image.png') }}" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active">
                            <img class="rounded img-thumbnail product-image-small" src="{{ File::exists( asset($product->getOriginal('image1')) ) ? asset($product->getOriginal('image1')) : asset('img/no_image.png') }}" alt="Product Image">
                        </div>
                        <div class="product-image-thumb" >
                            <img class="rounded img-thumbnail product-image-small" src="{{ File::exists( asset($product->getOriginal('image2')) ) ? asset($product->getOriginal('image2')) : asset('img/no_image.png') }}" alt="Product Image">
                        </div>
                        <div class="product-image-thumb" >
                            <img class="rounded img-thumbnail product-image-small" src="{{ File::exists( asset($product->getOriginal('image3')) ) ? asset($product->getOriginal('image3')) : asset('img/no_image.png') }}" alt="Product Image">
                        </div>
                        <div class="product-image-thumb" >
                            <img class="rounded img-thumbnail product-image-small" src="{{ File::exists( asset($product->getOriginal('image4')) ) ? asset($product->getOriginal('image4')) : asset('img/no_image.png') }}" alt="Product Image">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$product->name ? $product->name : ""}}</h3>
                    <p>{{$product->notes}}</p>

                    <hr>
                    <h4>Available Colors</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach($product->colors as $a)
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                {{$a->name ? $a->name : ""}}
                                <br>
                                <i style="color: {{$a->code}}" class="fas fa-circle fa-2x"></i>
                            </label>
                        @endforeach
                    </div>


                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            {{$product->price}}  ر. س
                        </h2>
                    </div>

                    <div>
                        <h5  class="text-gray mt-3"> البائع : {{$product->store ? $product->store->name : "" }}</h5>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-bs-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-bs-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                        <a class="nav-item nav-link" id="product-rating-tab" data-bs-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('scripts')
    <script>
        $('.product-image-small').on("click", function(){
            var productImage=$(this).attr('src');
            $('.product-image-larg').attr('src',productImage);
        });
    </script>
@endsection
