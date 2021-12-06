
@extends('admin.layouts.layout')
@inject('model','App\DeliveryCost')

@section('title')
    إضافة تكلفة
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Delivers Costs Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item ">{{__('lang.delivers_costs')}}</li>
                        <li class="breadcrumb-item active">{{__('lang.delivers_costsAdd')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box">
        <div class="box-body">
            {!! Form::model($model,[
          'action' => 'Admin\DeliversCostsController@store'
        ]) !!}

            @include('/admin/delivers_costs/form')

            <br>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">حفظ</button>
            </div>


            {!! Form::close() !!}
        </div>
    </div>


@endsection
