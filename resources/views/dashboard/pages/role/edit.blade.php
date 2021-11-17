@extends('admin.layouts.layout')
@inject('perm','App\Permission')

@section('title')
    {{__('lang.RoleEdit')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item ">{{__('lang.Role')}}</li>
                        <li class="breadcrumb-item active">{{__('lang.RoleEdit')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box-body">
        {!! Form::model($records,[
          'action' => ['Admin\RoleController@update',$records->id],
          'method' => 'put',
        ]) !!}

        @include('/admin/role/form')
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
            <button class="btn btn-primary" type="submit">تعديل</button>
        </div>


        {!! Form::close() !!}

    </div>


@endsection




