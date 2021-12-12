@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
    {{ __('product.editProduct') ." ". __('institution.from') ." ". __('institution.institution') }} | {{ __('auth.bageTitle') }}
    @endsection
    
    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@inject('model','App\Store')
@inject('category','App\SpacialCategory')
@inject('district','App\District')
@inject('brand','App\Brand')

{{-- <style>
    .image-upload > input {
        display: none;
    }
</style> --}}
<?php
$store = \App\Store::where('id', $records->store_id)->first();
$category = $category->where('store_id', $records->store_id)->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$brand = $brand->where('category_id', $store->category_id)->pluck('name', 'id')->toArray();
$color = \App\UnitColor::where('type', 'color')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();
$size = \App\UnitColor::where('type', 'unit')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();

/*
$store = \App\Store::where('id', $records->store_id)->first();
$category = \App\Category::where('parent_id', $store->category_id)->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$brand = $brand->where('category_id', $store->category_id)->pluck('name', 'id')->toArray();
$color = \App\UnitColor::where('type', 'color')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();
$size = \App\UnitColor::where('type', 'unit')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();
*/
?>
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('product.editProduct') ." ". __('institution.from') ." ". __('institution.institution') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('product.editProduct') ." ". __('institution.from') ." ". __('institution.institution') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($records,['action' => ['Dashboard\StoreController@ProductUpdate',$records->id],'method' => 'put','enctype' => 'multipart/form-data' , 'class'=>'repeater']) !!}
                            {!! Form::hidden('store_id', $store->id) !!}   
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('product.productDetails') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-3 col-form-label">{{__('product.productName')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('name',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-3 col-form-label">{{__('product.productType')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('type', array('1' => 'منتج', '0' => 'خدمة'), null,['class' => 'form-select select2']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-3 col-form-label">{{__('product.productCategory')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('spacialCategory_id',$category,null,['class' => 'form-select select2','id'=> 'category']) !!}
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row" style="display:{{ $store->id == 1 ? 'none' : 'flex'}}">
                                                <label for="inputProjectLeader" class="col-md-3 col-form-label">{{__('product.productBrand')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('brand_id',$brand,null,['class' => 'form-select select2','id'=> 'brand']) !!}
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row" style="display:{{ $store->id == 1 ? 'none' : 'flex'}}">
                                                <label for="inputProjectLeader" class="col-md-3 col-form-label">{{ __('product.productColors') }}</label>
                                                <div class="col-md-8">
                                                    <select name="color_id[]" id="color" class="form-select select2" multiple>
                                                        @if ($records->colors != '[]')
                                                            @foreach ($records->colors as $color)
                                                                <option selected value="{{$color->id}}">{{$color->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row" style="display:{{ $store->id == 1 ? 'none' : 'flex'}}">
                                                <label for="inputProjectLeader" class="col-md-3 col-form-label">{{__('product.productSizes')}}</label>
                                                <div class="col-md-8">
                                                    <select name="size_id[]" id="unit" class="form-select select2" multiple>
                                                        @if ($records->sizes != '[]')
                                                            @foreach ($records->sizes as $size)
                                                                <option selected value="{{$size->id}}">{{$size->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('lang.quantity')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('quantity',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div> --}}
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('product.productCompleteDetails') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-3 col-form-label">{{__('product.productPrice')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('price',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-3 col-form-label">{{__('product.productCode')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('code',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-3 col-form-label">{{__('product.productQuantity')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('quantity',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mt-3 row">
                                                <label for="textarea" class="col-md-3 col-form-label">{{__('product.productNotes')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::textarea('notes',null,['id'=> 'textarea', 'class' => 'form-control', 'maxlength = "225" rows = "3" placeholder="" ']) !!}
                                                </div>
                                            </div>

                                            {{-- <div class="mt-3 row">
                                                <div class="col-lg-3">
                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} . 1 </label>
                                                    <label for="image1" class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </label>
                                                    <input name="image1" style="display: none" type="file" id="image1">
                                                </div>
        
                                                <div class="col-lg-3">
                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} . 2 </label>
                                                    <label for="image2" class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </label>
                                                    <input name="image2" style="display: none" type="file" id="image2">
                                                </div>
        
                                                <div class="col-lg-3">
                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} . 3 </label>
                                                    <label for="image3" class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </label>
                                                    <input name="image3" style="display: none" type="file" id="image3">
                                                </div>
        
                                                <div class="col-lg-3">
                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} . 4 </label>
                                                    <label for="image4" class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </label>
                                                    <input name="image4" style="display: none" type="file" id="image4">
                                                </div>
                                            </div> --}}
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title text-center">
                                                {{ __('product.productImage1') }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" id="image1" class="form-control" for="image1_img" name="image1" style="display: none"/>
                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 160px;max-height: 160px;" id="image1_img" src="#" alt="your image" />
                                            
                                            @if(!empty($records->image1))
                                                <img id="image1_old" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{asset($records->getOriginal('image1'))}}">
                                            @else
                                                <img id="image1_noImage" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{ asset('img/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group">
                                                <label class="btn btn-success col fileinput-button" for="image1">
                                                    <i class="fas fa-plus"></i>
                                                    <span>{{ __('product.productAddImage') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title text-center">
                                                {{ __('product.productImage2') }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" id="image2" class="form-control" for="image2_img" name="image2" style="display: none"/>
                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 160px;max-height: 160px;" id="image2_img" src="#" alt="your image" />
                                            
                                            @if(!empty($records->image2))
                                                <img id="image2_old" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{asset($records->getOriginal('image2'))}}">
                                            @else
                                                <img id="image2_noImage" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{ asset('img/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group">
                                                <label class="btn btn-success col fileinput-button" for="image2">
                                                    <i class="fas fa-plus"></i>
                                                    <span>{{ __('product.productAddImage') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-3">
                                    <div class="card-header">
                                        <div class="card-title text-center">
                                            {{ __('product.productImage3') }}
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" id="image3" class="form-control" for="image3_img" name="image3" style="display: none"/>
                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 160px;max-height: 160px;" id="image3_img" src="#" alt="your image" />
                                            
                                            @if(!empty($records->image3))
                                                <img id="image3_old" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{asset($records->getOriginal('image3'))}}">
                                            @else
                                                <img id="image3_noImage" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{ asset('img/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group">
                                                <label class="btn btn-success col fileinput-button" for="image3">
                                                    <i class="fas fa-plus"></i>
                                                    <span>{{ __('product.productAddImage') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-3">
                                    <div class="card-header">
                                        <div class="card-title text-center">
                                            {{ __('product.productImage4') }}
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="file" id="image4" class="form-control" for="image4_img" name="image4" style="display: none"/>
                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 160px;max-height: 160px;" id="image4_img" src="#" alt="your image" />
                                            
                                            @if(!empty($records->image4))
                                                <img id="image4_old" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{asset($records->getOriginal('image4'))}}">
                                            @else
                                                <img id="image4_noImage" class="rounded mx-auto img-thumbnail" style="max-width: 160px;max-height: 160px;" src="{{ asset('img/no_image.png') }}">
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="input-group">
                                                <label class="btn btn-success col fileinput-button" for="image4">
                                                    <i class="fas fa-plus"></i>
                                                    <span>{{ __('product.productAddImage') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">اضافة مقاسات للمنتج واسعارها</h3>
                                        </div>
                                        <div class="card-body">
                                            <div style="margin-top: -14px" class="row">
                                                <div class="col-md-9">
                                                    <label class="label" for="sizeProduct">المقاس </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label" for="priceSizeProduct">السعر </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="itemSize">
                                                <div style="margin-top: -14px" class="row">
                                                    <div class="form-group col-md-9" id="dynamic-container">
                                                        <select class="form-select select2" name="size_id[]" id="unit"></select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input id="priceSizeProduct" type="text" class="form-control priceSizeProduct" name="size_price[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <span class="add_item_field_size btn btn-success" style="cursor: pointer">+ إضافة </span>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">اضافة الوان للمنتج واسعارها</h3>
                                        </div>
                                        <div class="card-body">
                                            <div style="margin-top: -14px" class="row">
                                                <div class="col-md-9">
                                                    <label class="label" for="colorProduct">إسم المنتج </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label" for="priceColorProduct">السعر </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="itemColor">
                                                <div style="margin-top: -14px" class="row">
                                                    <div class="form-group col-md-9" id="dynamic-container">
                                                        <select class="form-control select2" name="color_id[]" id="color"></select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <input id="priceColorProduct" type="text" class="form-control priceColorProduct" name="color_price[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <span class="add_item_field_color btn btn-success" style="cursor: pointer">+ إضافة </span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">منتجات يمكن اضافتها الي المنتج</h3>
                                        </div>
                                        <div class="card-body">
                                            <div style="margin-top: -14px" class="row">
                                                <div class="col-md-9">
                                                    <label class="label" for="extraProduct">إسم المنتج </label>
                                                </div>
        
                                                <div class="col-md-3">
                                                    <label class="label" for="priceExtraProduct">السعر </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="itemExtra">
                                                <div style="margin-top: -14px" class="row">
                                                    @php
                                                        $extraProducts = [];
                                                    @endphp
                                                    @if ($extraProducts != [])
                                                        @foreach($extraProducts as $extraProduct)
                                                            <div class="form-group col-md-9" id="dynamic-container">
                                                                <input id="extraProduct" type="text" class="form-control extraProduct" name="extra_productName[]">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input id="priceExtraProduct" type="text" class="form-control priceExtraProduct" name="extra_productPrice[]">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="form-group col-md-9" id="dynamic-container">
                                                            <input id="extraProduct" type="text" class="form-control extraProduct" name="extra_productName[]">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input id="priceExtraProduct" type="text" class="form-control priceExtraProduct" name="extra_productPrice[]">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>        
                                        </div>
                                        <div class="card-footer">
                                            <span class="add_item_field_extra btn btn-success" style="cursor: pointer">+ إضافة </span>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">منتجات يمكن حذفها من المنتج</h3>
                                        </div>
                                        <div class="card-body">
                                            <div style="margin-top: -14px" class="row">
                                                <div class="col-md-9">
                                                    <label class="label" for="removeProduct">إسم المنتج </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label" for="priceRemoveProduct">السعر </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="itemRemove">
                                                <div style="margin-top: -14px" class="row">
                                                    @php
                                                        $removeProducts = [];
                                                    @endphp
                                                    @if ($removeProducts != [])
                                                        @foreach ($removeProducts as $removeProduct)
                                                            <div class="form-group col-md-9" id="dynamic-container">
                                                                <input id="removeProduct" type="text" class="form-control removeProduct" name="remove_productName[]">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input id="priceRemoveProduct" type="text"  class="form-control priceRemoveProduct" name="remove_productPrice[]">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="form-group col-md-9" id="dynamic-container">
                                                            <input id="removeProduct" type="text" class="form-control removeProduct" name="remove_productName[]">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input id="priceRemoveProduct" type="text"  class="form-control priceRemoveProduct" name="remove_productPrice[]">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <span class="add_item_field_removed btn btn-success" style="cursor: pointer">+ إضافة </span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="card-footer">
                                    <button class="btn btn-primary submit-btn col-sm-3">{{__('product.editProduct')}}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

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

    <!-- form repeater js -->
    <script src="{{ asset('dashboard/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <!-- form repeater init -->
    <script src="{{ asset('dashboard/js/pages/form-repeater.init.js') }}"></script>

{{-- <script src="{{ asset('dashboard/js/custom.js') }}"></script> --}}

<script type="text/javascript">

    // $("#category").change(function () {
    //     $.ajax({
    //         url: "{{ url('/product/getbrand') }}" + "/" + $(this).val(),
    //         method: 'GET',

    //         success: function (data) {
    //             $('#brand').html(data.output);
    //             select.append('<option value=' + value.id + '>' + value.name + '</option>');
    //         }
    //     });
    // });

    // $( document ).ready(function() {
    //     // let id = alert($(this).val());
    //     let color = document.getElementById('color');
    //     let id = color.getAttribute('data-parent-id');
    //     $.ajax({
    //         url: "{{ url('/product/getcolor') }}" + "/" + id,
    //         method: 'GET',

    //         success: function (data) {
    //             $('#color').html(data.output);
    //             // select.append('<option value=' + value.id + '>' + value.name + '</option>');
    //         }
    //     });
    // });

    // $( document ).ready(function() {
    //     let unit = document.getElementById('unit');
    //     let id = unit.getAttribute('data-parent-id');

    //     $.ajax({
    //         url: "{{ url('/product/getunit') }}" + "/" + id,
    //         method: 'GET',

    //         success: function (data) {
    //             $('#unit').html(data.output);
    //             // select.append('<option value=' + value.id + '>' + value.name + '</option>');
    //         }
    //     });
    // });

    $("#category").change(function(){
            $.ajax({
                url: "{{ url('/product/getbrand') }}"+"/"+$(this).val(),
                method: 'GET',

                success: function(data) {
                    $('#brand').html(data.output);
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                }
            });
        });

        $("#category").change(function(){
            $.ajax({
                url: "{{ url('/product/getcolor') }}"+"/"+$(this).val(),
                method: 'GET',

                success: function(data) {
                    $('#color').html(data.output);
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                }
            });
        });

        $("#category").change(function(){
            $.ajax({
                url: "{{ url('/product/getunit') }}"+"/"+$(this).val(),
                method: 'GET',

                success: function(data) {
                    $('#unit').html(data.output);
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                }
            });
        });

</script>


<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".itemExtra");
        var add_button = $(".add_item_field_extra");
        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div style="margin-top: 5px" class="row">' +
                    '<div class="form-group col-md-9">' +
                    '<input id="extraProduct" type="text" class="form-control extraProduct" name="extra_productName[]">' +

                    '</div>' +
                    '<div class="form-group col-md-2">' +
                    '<input id="priceExtraProduct" type="text" class="form-control priceExtraProduct" name="extra_productPrice[]">' +
                    '</div>' +
                    '<a style="margin-top: 16px" class="delete  col-md-1">' +
                    '<i class="far fa-trash-alt"></i>' +
                    '</a>' +
                    '</div>');
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".itemRemove");
        var add_button = $(".add_item_field_removed");
        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div style="margin-top: 5px" class="row">' +
                    '<div class="form-group col-md-9">' +
                    '<input id="removeProduct" type="text" class="form-control removeProduct" name="remove_productName[]">' +

                    '</div>' +
                    '<div class="form-group col-md-2">' +
                    '<input id="priceRemoveProduct" type="text" class="form-control priceRemoveProduct" name="remove_productPrice[]">' +
                    '</div>' +
                    '<a style="margin-top: 16px" class="delete  col-md-1">' +
                    '<i class="far fa-trash-alt"></i>' +
                    '</a>' +
                    '</div>');
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>


<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".itemSize");
        var add_button = $(".add_item_field_size");
        var x = 1;
        $(add_button).click(function (e) {

            var idCat = $('#category').val();

            e.preventDefault();
            if (x < max_fields) {
                x++;

                $.ajax({
                    url: "{{ url('/product/getunitplus') }}" + "/" + idCat,
                    method: 'GET',
                    dataType: "json",

                    success: function (data) {
                        $(wrapper).append('<div style="margin-top: 5px" class="row">' +
                            '<div class="form-group col-md-9">' +
                            '<select class="form-control select2" name="size_id[]" id="size">' +
                            '</select>' +
                            '</div>' +
                            '<div class="form-group col-md-2">' +
                            '<input id="priceSizeProduct" type="text" class="form-control priceSizeProduct" name="size_price[]">' +
                            '</div>' +
                            '<a style="margin-top: 16px" class="delete  col-md-1">' +
                            '<i class="far fa-trash-alt"></i>' +
                            '</a>' +
                            '</div>');

                        $.each(data, function (key, value) {
                            console.log(value.name)
                            $('select[name="size_id[]"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        })
                    }
                });
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".itemColor");
        var add_button = $(".add_item_field_color");
        var x = 1;
        $(add_button).click(function (e) {

            var idCat = $('#category').val();

            e.preventDefault();
            if (x < max_fields) {
                x++;

                $.ajax({
                    url: "{{ url('/product/getcolorplus') }}" + "/" + idCat,
                    method: 'GET',
                    dataType: "json",

                    success: function (data) {
                        $(wrapper).append('<div style="margin-top: 5px" class="row">' +
                            '<div class="form-group col-md-9">' +
                            '<select class="form-control select2 " name="color_id[]" id="color">' +
                            '</select>' +
                            '</div>' +
                            '<div class="form-group col-md-2">' +
                            '<input id="priceColorProduct" type="text" class="form-control priceColorProduct" name="color_price[]">' +
                            '</div>' +
                            '<a style="margin-top: 16px" class="delete  col-md-1">' +
                            '<i class="far fa-trash-alt"></i>' +
                            '</a>' +
                            '</div>');

                        $.each(data, function (key, value) {
                            console.log(value.name)
                            $('select[name="color_id[]"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        })
                    }
                });
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>

<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // $('#logo').attr('src', e.target.result);

                $(input).next('img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#image1").change(function() {
        $('#image1_noImage').css('display','none');
        $('#image1_old').css('display','none');
        $('#image1_img').css('display','block');
        readURL(this);
    });

    $("#image2").change(function() {
        $('#image2_noImage').css('display','none');
        $('#image2_old').css('display','none');
        $('#image2_img').css('display','block');
        readURL(this);
    });

    $("#image3").change(function() {
        $('#image3_noImage').css('display','none');
        $('#image3_old').css('display','none');
        $('#image3_img').css('display','block');
        readURL(this);
    });

    $("#image4").change(function() {
        $('#image4_noImage').css('display','none');
        $('#image4_old').css('display','none');
        $('#image4_img').css('display','block');
        readURL(this);
    });
</script>
@endsection