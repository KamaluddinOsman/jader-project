@inject('model','App\Store')
@inject('category','App\Category')
@inject('district','App\District')
@inject('variety','App\Variety')
@inject('brand','App\Brand')

<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
$ins = \App\Store::first();
$category = $category->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$brand = $brand->pluck('name', 'id')->toArray();
$color = \App\UnitColor::where('type', 'color')->pluck('name', 'id', 'code')->toArray();
$size = \App\UnitColor::where('type', 'unit')->pluck('name', 'id', 'code')->toArray();

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
                    <h1>product Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item active">{{__('lang.addProduct')}}</li>
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

        {!! Form::model($model,[
          'action' => 'Admin\StoreController@ProductStore',
          'enctype' => 'multipart/form-data',

        ]) !!}

            <div class="col">

            {!! Form::hidden('store_id',$id) !!}



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
                                        {!! Form::select('category_id',$category,null,[
                                          'class' => 'form-control select2',
                                          'id'    => 'category',
                                        ]) !!}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">التصنيف</label>
                                        <select name="variety_id" id="variety" class="form-control select2">
                                            <option>choose</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">البراند</label>
                                        <select name="brand_id" id="brand" class="form-control select2">
                                            <option>choose</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputDescription">الالوان</label>
                                        <select data-placeholder="Select a Color" multiple="multiple" name="color_id[]" id="color" class="form-control select2">
                                            <option>choose</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">المقاسات</label>
                                        <select data-placeholder="Select a size" multiple="multiple" name="size_id[]" id="unit" class="form-control select2">
                                            <option>choose</option>
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
                                        <label for="inputProjectLeader">{{__('lang.about')}}</label>
                                        {!! Form::textarea('about',null,[
                                         'class' => 'form-control',
                                         'style' => 'height: 187px'
                                        ]) !!}
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
                url: "{{ url('/product/getvariety') }}"+"/"+$(this).val(),
                method: 'GET',

                success: function(data) {
                    $('#variety').html(data.output);
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');

                }
            });
        });


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

@endsection


