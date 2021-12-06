
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.messages')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/adminPanel"><i class="fa fa-dashboard"></i>  {{__('lang.master')}}</a></li>
            <li><a href="connect"><i class="fa fa-dashboard"></i>{{__('lang.messages')}}</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> {{$connect->name}}</li>
        </ol>
    </section>
    <br>
    <br>

    <div class="box-body">


        <div class="table-responsive">
            <div class="box">

                <div class="details">
                    <h2 style="text-align: center;color: #9f191f">  رسالة من {{$connect->name}}</h2>
                    <div><h4>الأسم  </h4> <span> : {{$connect->name}} </span></div>
                    <div><h4>الإيميل  </h4> <span> : {{$connect->email}}</span></div>
                    <div><h4>رقم التليفون </h4> <span> : {{$connect->phone}}</span></div>
                    <div><h4>عنوان الرسالة </h4> <span> : {{$connect->title}}</span></div>
                    <div><h4>نص الرسالة </h4> <span> : {{$connect->message}}</span></div>
                </div>
<br>
<br>
<br>
            </div><!-- /.box -->
        </div>
    </div>


@endsection

