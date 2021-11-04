@inject('model','App\Setting')

@extends('admin.layouts.layout')
@section('title')
    {{__('lang.setting')}}
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
                        <li class="breadcrumb-item"><a href="#">{{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item active">{{__('lang.setting')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <br>
    <br>
    @include('admin.layouts.flash-message')
    @include('flash::message')

    <div class="box">
        <div class="box-body">
            <div class="col">
                {!! Form::model($records,[
                  'action' => ['Admin\SettingController@update',$records->id],
                  'method' => 'put',
                  'enctype' => 'multipart/form-data',

                ]) !!}
                    @csrf

                    <section class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="alert alert-default-warning">
                                    <h5 style="text-align: center">يرجى الحظر عند التعامل مع هذه الشاشه لانها خاصه باعدادت التطبيق وينصح بعدم استخدامها غير تحت اشراف المطور المسؤل</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('lang.setting')}}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">


                                        @include('/admin/setting/form')

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.logo')}} </label>
                                                <div class="col-md-4">
                                                    {!! Form::file('logo') !!}

                                                    @if($records->logo != null)

                                                        <img src="{{url(asset($records->logo))}}">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">عن التطبيق </label>
                                                {!! Form::textarea('About',null,[
                                                  'class' => 'form-control'
                                                ]) !!}
                                                <br>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                    <div  style="margin: 0 0 30px 30px" class="form-group">
                                        <button class="btn btn-primary submit-btn" >{{__('lang.save')}}</button>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>

                    </section>
                    <div class="clearfix"></div>
                </form>
            </div>

        </div>
    </div>



@endsection

