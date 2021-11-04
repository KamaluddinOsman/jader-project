@inject('model','App\Product')
@inject('category','App\SpacialCategory')
@inject('district','App\District')
@inject('brand','App\Brand')

<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
$store = \App\Store::where('id', $records->store_id)->first();
$category = $category->where('store_id', $records->store_id)->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$brand = $brand->where('category_id', $store->category_id)->pluck('name', 'id')->toArray();
$color = \App\UnitColor::where('type', 'color')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();
$size = \App\UnitColor::where('type', 'unit')->where('category_id', $store->category_id)->pluck('name', 'id', 'code')->toArray();
?>
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.edit')}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>product Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item active">{{__('lang.editProduct')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <br>
    <br>
    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box">
        <div class="box-body">

            {!! Form::model($records,[
              'action' => ['Admin\StoreController@ProductUpdate',$records->id],
              'method' => 'put',
              'enctype' => 'multipart/form-data',

            ]) !!}

            <div class="col">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">بيانات المنتج</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">{{__('lang.name')}}</label>
                                        {!! Form::text('name',null,[
                                          'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">النوع</label>
                                        {!! Form::select('type', array('1' => 'منتج', '0' => 'خدمة'), null,[
                                          'class' => 'form-control select2',
                                        ]) !!}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">الفئات</label>
                                        {!! Form::select('spacialCategory_id',$category,null,[
                                          'class' => 'form-control select2',
                                          'id'    => 'category',
                                        ]) !!}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">براند</label>
                                        {!! Form::select('brand_id',$brand,null,[
                                          'class' => 'form-control select2',
                                          'id'    => 'brand',
                                        ]) !!}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">الالوان</label>
                                        <select name="color_id[]" id="color" class="form-control select2"  multiple>
                                            @foreach ($records->colors as $color)
                                                <option selected value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">المقاسات</label>

                                        <select name="size_id[]" id="unit" class="form-control select2"  multiple>
                                            @foreach ($records->sizes as $size)
                                                <option selected value="{{$size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">استكمال البيانات</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">{{__('lang.price')}} </label>
                                        {!! Form::text('price',null,[
                                          'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">{{__('lang.code')}} </label>
                                        {!! Form::text('code',null,[
                                          'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">{{__('lang.quantity')}} </label>
                                        {!! Form::text('quantity',null,[
                                          'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputProjectLeader">{{__('lang.notes')}}</label>

                                        <textarea id="notes" name = "notes" style="height: 102px" class="form-control">
                                           @if($records->notes !== '')
                                                {{$records->notes}}
                                            @endif
                                        </textarea>

                                    </div>

                                    <div class="form-group row">
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
                </section>
                <!-- /.content -->


                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">منتجات يمكن اضافتها من المنتج</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
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
                                            @foreach($extraProducts as $extraProduct)
                                                <div class="row itemAdd">
                                                    <div class="form-group col-md-9" id="dynamic-container">
                                                        <input id="extraProduct" type="text" value="{{$extraProduct->name}}" class="form-control extraProduct"
                                                               name="extra_productName[]">
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <input id="priceExtraProduct" value="{{$extraProduct->price}}" type="text"
                                                               class="form-control priceExtraProduct"
                                                               name="extra_productPrice[]">
                                                    </div>

                                                    <a style="margin-top: 16px; cursor: pointer"  id="extraProductDelete" data-id="{{$extraProduct->id}}" class="delete  col-md-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                    </div>

                                    <span class="add_item_field_extra"
                                          style="font-size:16px; font-weight:bold;margin-top: -10px ;margin-bottom: 20px; display: block; cursor: pointer">+ إضافة </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">منتجات يمكن حذفها من المنتج</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
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
                                            @foreach($removeProducts as $removeProduct)
                                            <div class="row itemRe">

                                            <div class="form-group col-md-9" id="dynamic-container">
                                                    <input id="removeProduct" value="{{$removeProduct->name}}" type="text" class="form-control removeProduct"
                                                           name="remove_productName[]">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <input id="priceRemoveProduct" value="{{$removeProduct->price}}"  type="text"
                                                           class="form-control priceRemoveProduct"
                                                           name="remove_productPrice[]">
                                                </div>

                                                <a style="margin-top: 16px; cursor: pointer" id="removeProductDelete" data-id="{{$removeProduct->id}}" class="delete  col-md-1">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <span class="add_item_field_removed"
                                          style="font-size:16px; font-weight:bold;margin-top: -10px ;margin-bottom: 20px; display: block; cursor: pointer">+ اضافة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>

            <div  style="margin: 0 0 30px 30px" class="form-group">
                <br>
                <button class="btn btn-primary submit-btn" >{{__('lang.save')}}</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>



@endsection


@section('scripts')

    <script type="text/javascript">

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

            $($(".itemAdd")).on("click", ".delete", function (e) {
                var idData = $(this).attr("data-id");
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

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

            $($(".itemRe")).on("click", ".delete", function (e) {
                var idData = $(this).attr("data-id");
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

            $(wrapper).on("click", ".delete", function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>
@endsection


