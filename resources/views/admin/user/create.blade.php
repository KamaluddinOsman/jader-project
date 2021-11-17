@extends('admin.layouts.layout')
@inject('model','App\User')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item ">{{__('lang.user')}}</li>
                        <li class="breadcrumb-item active">{{__('lang.userAdd')}}</li>
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
              'action' => 'Admin\UserController@store'
        ]) !!}

            @include('/admin/user/form')

            <div class="form-group col-md-12">
                <button class="btn btn-primary" type="submit">{{__('lang.save')}}</button>
            </div>
            </section>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
