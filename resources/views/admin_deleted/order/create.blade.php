
@extends('admin.layouts.layout')
@inject('model','App\Client')
@section('title')
    {{__('lang.edit')}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>  {{__('lang.master')}}</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> {{__('lang.addClient')}}</li>
        </ol>
    </section>
    <br>
    <br>
    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box">
        <div class="box-body">

        {!! Form::model($model,[
          'action' => 'Admin\ClientController@store',
          'enctype' => 'multipart/form-data',

        ]) !!}

            <div class="col">
                @include('/admin/client/form')
                <div class="clearfix"></div>

                <br>
                <div class="col-lg-8">
                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.password')}} </label>
                    <br>
                    <br>
                    {!! Form::password(null,[
                      'class' => 'form-control',
                    ]) !!}
                </div>
        </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <br>

                <button class="btn btn-primary" type="submit">{{__('lang.save')}}</button>
            </div>


            {!! Form::close() !!}
        </div>
    </div>



@endsection




