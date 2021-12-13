@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('user.changePassword') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">{{ __('user.changePassword') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{ __('user.changePassword') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('dashboard.layouts.flash-message')
    @include('flash::message')

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open(['action' => 'Dashboard\UserController@updatePassword','method' => 'post']) !!}

                        <div class="mb-3 row">
                            <label for="inputProjectLeader" class="col-md-3 col-form-label">{{ __('user.currentPassword') }}</label>
                            <div class="col-md-6">
                                {!! Form::password('old_password',['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputProjectLeader" class="col-md-3 col-form-label">{{ __('user.newPassword') }}</label>
                            <div class="col-md-6">
                                {!! Form::password('password',['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputProjectLeader" class="col-md-3 col-form-label">{{ __('user.confirmPassword') }}</label>
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                            </div>
                        </div>
                            

                        <div class="mb-3 row">
                            <button class="btn btn-primary col-sm-3" type="submit">{{ __('user.editPassword') }}</button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection




