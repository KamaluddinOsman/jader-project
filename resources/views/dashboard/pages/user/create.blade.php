@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('user.addUser') }} | {{ __('auth.bageTitle') }}             
    @endsection
@endsection
@inject('model','App\User')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('user.addUser') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{ __('user.addUser') }}</li>
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
                {!! Form::model( $model, ['action' => 'Dashboard\UserController@store']) !!}
                    @include('/dashboard/pages/user/form')
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="submit">{{__('user.addUser')}}</button>
                    </div>            
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
