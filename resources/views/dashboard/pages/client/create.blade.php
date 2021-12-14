@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('client.addClient')}} | {{ __('auth.bageTitle') }}
    @endsection
@endsection
@inject('model','App\Client')

@include('dashboard.layouts.flash-message')
@include('flash::message')

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('client.clientTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('client.clientTable') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model( $model, ['action' => 'Dashboard\ClientController@store','enctype' => 'multipart/form-data' ]) !!}
                            <div class="col">
                                @include('/dashboard/pages/client/form')
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('client.password') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="inputName" class="col-md-2 col-form-label">{{__('client.password')}}</label>
                                                <div class="col-md-8">
                                                    {!! Form::password('password',['class' => 'form-control' ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <br>
                
                                <button class="btn btn-primary" type="submit">{{__('client.addClient')}}</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).next('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#logoInp").change(function() {
            $('#logoNoImage').css('display','none');
            $('#logo_old').css('display','none');
            $('#logo').css('display','block');
            readURL(this);
        });
    </script>
@endsection
