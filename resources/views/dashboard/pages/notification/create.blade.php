@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
    {{ __('notification.notification') }} | {{ __('auth.bageTitle') }}             
    @endsection
@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('notification.sendNotification') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{ __('notification.sendNotification') }}</li>
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
                    <form action="{{route('notification.send')}}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4>{{ __('notification.sendNotification') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">{{__('notification.type')}}</label>
                                <div class="col-md-8">
                                    <select class="form-select" name="type" aria-label="Default select example">
                                        <option value="client">{{ __('notification.client') }}</option>
                                        <option value="car">{{ __('notification.captain') }}</option>
                                        <option value="store">{{ __('notification.institution') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-3 col-form-label">{{__('notification.title')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('title',null,['class' => 'form-control', 'id' => 'title']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-3 col-form-label">{{__('notification.body')}}</label>
                                <div class="col-md-8">
                                    {!! Form::textarea('body',null,['class' => 'form-control', 'id' => 'body', 'rows'=> 3 ]) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                {!! Form::submit( __('notification.send'), ['class' => 'btn btn-primary submit-btn col-md-3'] ) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection