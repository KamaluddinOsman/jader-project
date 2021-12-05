@extends('dashboard.layouts.main')
@section('head')
    @section('title')
            {{__('institution.Institution')}}
    @endsection

    <link href="{{ asset('dashboard/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

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
?>
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('product.addProduct') }} الي {{ __('institution.institution') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('product.addProduct') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($records,['action' => ['Dashboard\StoreController@ProductUpdate',$records->id],'method' => 'put','enctype' => 'multipart/form-data' , 'class'=>'repeater']) !!}    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">بيانات المنتج</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('lang.name')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('name',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-2 col-form-label">النوع</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('type', array('1' => 'منتج', '0' => 'خدمة'), null,['class' => 'form-select select2']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-2 col-form-label">الفئات</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('spacialCategory_id',$category,null,['class' => 'form-select select2','id'    => 'category']) !!}
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-2 col-form-label">براند</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('brand_id',$brand,null,['class' => 'form-select select2','id'    => 'brand']) !!}
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-2 col-form-label">الالوان</label>
                                                <div class="col-md-8">
                                                    <select name="color_id[]" id="color" class="form-select select2"  multiple>
                                                        @foreach ($records->colors as $color)
                                                            <option selected value="{{$color->id}}">{{$color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="inputProjectLeader" class="col-md-2 col-form-label">المقاسات</label>
                                                <div class="col-md-8">
                                                    <select name="size_id[]" id="unit" class="form-select select2"  multiple>
                                                        @foreach ($records->sizes as $size)
                                                            <option selected value="{{$size->id}}">{{$size->name}}</option>
                                                        @endforeach
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
                                            <h3 class="card-title">استكمال البيانات</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('lang.price')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('price',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('lang.code')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('code',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('lang.quantity')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('quantity',null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="mt-3 row">
                                                <label for="textarea" class="col-md-2 col-form-label">{{__('lang.notes')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::textarea('notes',null,['id'=> 'textarea', 'class' => 'form-control', 'maxlength = "225" rows = "3" placeholder="" ']) !!}
                                                </div>
                                            </div>

                                            <div class="mt-3 row">
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
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">منتجات يمكن اضافتها من المنتج</h3>
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
                            </div>

                            <div class="row">
                                <div class="card-footer">
                                    <button class="btn btn-primary submit-btn">{{__('product.editProduct')}}</button>
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

    $("#category").change(function () {
        $.ajax({
            url: "{{ url('/product/getbrand') }}" + "/" + $(this).val(),
            method: 'GET',

            success: function (data) {
                $('#brand').html(data.output);
                select.append('<option value=' + value.id + '>' + value.name + '</option>');
            }
        });
    });

    $("#category").change(function () {
        $.ajax({
            url: "{{ url('/product/getcolor') }}" + "/" + $(this).val(),
            method: 'GET',

            success: function (data) {
                $('#color').html(data.output);
                select.append('<option value=' + value.id + '>' + value.name + '</option>');
            }
        });
    });

    $("#category").change(function () {
        $.ajax({
            url: "{{ url('/product/getunit') }}" + "/" + $(this).val(),
            method: 'GET',

            success: function (data) {
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
                            '<select class="form-control select2 " name="size_id[]" id="size">' +
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
@endsection