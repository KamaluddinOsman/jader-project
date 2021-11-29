
@extends('admin.layouts.layout')
@inject('model','App\Store')
@section('title')
    {{__('lang.edit')}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Store Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item active">{{__('lang.addR')}}</li>
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

            {!! Form::model($model,['action' => 'Admin\StoreController@store','enctype' => 'multipart/form-data']) !!}

                <div class="col">
                    @include('/dashboard/store/form')
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>

                <div  style="margin: 0 0 30px 30px" class="form-group">
                    <br>
                    <button class="btn btn-primary submit-btn" disabled type="submit">{{__('lang.save')}}</button>
                </div>

            {!! Form::close() !!}
        </div>
    </div>



@endsection




