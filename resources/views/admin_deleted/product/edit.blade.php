
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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> {{__('lang.activatedStores')}}</li>
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i>{{__('lang.edit')}}   {{$records->name}}</li>
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
          'action' => ['Admin\StoreController@update',$records->id],
          'method' => 'put',
          'enctype' => 'multipart/form-data',

        ]) !!}

            <div class="col">
                    @include('/admin/store/form')

            </div>

<div class="clearfix"></div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">{{__('lang.edit')}}</button>
            </div>


            {!! Form::close() !!}
        </div>
    </div>



@endsection




