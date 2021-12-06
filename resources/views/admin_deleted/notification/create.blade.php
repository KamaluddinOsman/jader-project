
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.notificationSend')}}
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
                        <li class="breadcrumb-item active">{{__('lang.notificationSend')}}</li>
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
            <form action="{{route('notification.send')}}" method="post">
                @csrf

                <section class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('lang.notificationSend')}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{__('lang.type')}}</label>
                                        <select name="type" class="form-control select2" id="exampleFormControlSelect1">
                                            <option value="client">Client</option>
                                            <option value="car">Car</option>
                                            <option value="store">Store</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.title')}} </label>
                                        {!! Form::text('title',null,[
                                          'class' => 'form-control',
                                          'id' => 'title'
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.body')}} </label>
                                        {!! Form::text('body',null,[
                                          'class' => 'form-control',
                                          'id' => 'body'
                                        ]) !!}
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

