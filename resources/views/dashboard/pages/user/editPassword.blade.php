@extends('admin.layouts.layout')
@section('title')
    edit Password
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
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}
                            </a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> تعديل كلمة المرور</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <br>
    <br>

    @include('admin.layouts.flash-message')
    @include('flash::message')


    <div class="box-body">

        <div class="table-responsive">
            <div class="box">
                <div class="box-body">


                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            {!! Form::open([
                              'action' => 'Admin\UserController@updatePassword',
                              'method' => 'post',
                            ]) !!}


                            <div class="form-group">

                                <label
                                    style="color: #000;font-size: 15px;padding-bottom: 15px;width: 143px;display: inline-block;"
                                    class="label"> الباسورد القديم </label>
                                {!! Form::password('old_password',[
                                  'class' => 'form-control'
                                ]) !!}
                                <br>


                                <label
                                    style="color: #000;font-size: 15px;padding-bottom: 15px;width: 143px;display: inline-block;"
                                    class="label"> الباسورد الجديد </label>
                                {!! Form::password('password',[
                                  'class' => 'form-control'
                                ]) !!}

                                <br>
                                <label
                                    style="color: #000;font-size: 15px;padding-bottom: 15px;width: 143px;display: inline-block; "
                                    class="label"> تأكيد الباسورد </label>
                                {!! Form::password('password_confirmation',[
                                  'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">تعديل</button>
                            </div>


                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection




