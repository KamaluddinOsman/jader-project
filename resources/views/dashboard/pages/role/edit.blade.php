
@extends('dashboard.layouts.main')

@inject('model','App\Role')
@inject('perm','App\Permission')

@section('head')
    @section('page-title')
        {{ __('user.user') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2/sweetalert.css') }}"> --}}
@endsection
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

    <div class="box-body">
        {!! Form::model($records, ['action' => ['Dashboard\RoleController@update',$records->id], 'method' => 'put' ]) !!}
            @include('/dashboard/pages/role/form')
            <br>
            <div class="form-group">
                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الصلاحيات </label>
                <br>
                <label style="margin-top: 19px;font-weight: bold"><input {{ $records->id == 1 ? 'disabled' : ''}} type="checkbox" id="select_all" /> اختيار الكل</label>

                <div class="row">
                    @foreach($perm->all() as $permission)

                        <div class="col-sm-3 col-lg-2">
                            <div class="checkbox">
                                <label>
                                    <input {{ $records->id == 1 ? 'disabled' : ''}}  type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                                        @if($records->hasPermission($permission->name))
                                        checked
                                        @endif

                                    > {{$permission->display_name}}
                                </label>
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">{{ __('role.editRole') }}</button>
            </div>
        {!! Form::close() !!}

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

