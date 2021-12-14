
@extends('dashboard.layouts.main')

@inject('model','App\Role')
@inject('perm','App\Permission')

@section('head')
    @section('page-title')
        {{ __('role.addRole') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('role.addRole') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{ __('role.addRole') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')

        <div class="box">
            <div class="box-body">
                {!! Form::model($model, ['action' => 'Dashboard\RoleController@store']) !!}
                    @include('/dashboard/pages/role/form')

                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{ __('role.permissions') }}</label>
                        <br>
                        <label style="margin-top: 19px;font-weight: bold"><input type="checkbox" id="select_all" />{{ __('role.selectAll') }}</label>
                        <div class="row">
                            @foreach($perm->all() as $permission)
                                <div class="col-sm-3 col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"> {{$permission->display_name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{ __('role.addRole') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Select all
        $('#select_all').click(function () {
            $('input[type=checkbox]').prop('checked',$(this).prop('checked'));
        });
    </script>    
@endsection



