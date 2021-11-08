
@extends('admin.layouts.layout')

@section('title')
    {{__('lang.userEdit')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item ">{{__('lang.user')}}</li>
                        <li class="breadcrumb-item active">{{__('lang.userEdit')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box-body">

        {!! Form::model($records,[
          'action' => ['Admin\UserController@update',$records->id],
          'method' => 'put',
        ]) !!}

        @include('admin.user.form')

        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">Edit</button>
        </div>

        {!! Form::close() !!}

    </div>


@endsection




