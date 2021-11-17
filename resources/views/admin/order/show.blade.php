
@extends('admin.layouts.layout')

@section('title')
    {{__('lang.city')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>  {{__('lang.master')}}</a></li>
            <li><a href="/client"><i class="fa fa-dashboard"></i>  {{__('lang.order')}}</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> {{$order->id}}</li>

        </ol>
    </section>
    <br>
    <br>

    @include('admin.layouts.flash-message')
    @include('flash::message')

    <div class="box-body">
        <div class="table-responsive">
            <div class="box">
                <div class="box-body">


                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> {{__('lang.Everything')}}
                                    <small class="pull-right">{{$carbon}}</small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                {{__('lang.form')}}
                                <br>
                                <br>
                                <address>
                                    <strong>{{__('lang.rest')}} : {{$store->name }}</strong><br>
                                    {{$store->districts->city->name }} - {{$store->districts->name }}<br>
                                    {{__('lang.phone')}} : {{$store->phone }}<br>
                                    {{__('lang.email')}} : {{$store->email }}
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                {{__('lang.to')}}
                                <br>
                                <br>
                                <address>
                                    <strong>{{$client->name }}</strong><br>
                                    {{$order->address }}<br>
                                    {{__('lang.phone')}} : {{$client->phone }}<br>
                                    {{__('lang.email')}} : {{$client->email }}
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>{{__('lang.invoice')}} #{{$order->invoice }}</b><br>
                                <br>
                                <b>{{__('lang.Order number')}}:</b> {{$order->id }}<br>
                                <b>{{__('lang.order History')}}:</b> {{$order->created_at }}<br>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('lang.meal')}}</th>
                                        <th>{{__('lang.Quantity')}}</th>
                                        <th>{{__('lang.Special')}}</th>
                                        <th>{{__('lang.price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_details as $key => $meal)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td> {{$meal->name}}</td>
                                            <td> {{$meal->pivot->quantity}}</td>
                                            <td> {{$meal->pivot->special}}</td>
                                            <td> {{$meal->pivot->price * $meal->pivot->quantity}}</td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                 <img style=" width: 35%;margin-right: 158px;margin-top: 10px;" src="{{url(asset('image/Everything.png'))}}">
                                 <p style="text-align: center">{{__('lang.thanks')}}</p>
                            </div><!-- /.col -->
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">{{__('lang.Subtotal')}}:</th>
                                            <td>
                                               @php
                                               $sumPrice = 0;
                                               @endphp
                                                @foreach($order_details as $key => $meal)
                                                    @php $price = $sumPrice += $meal->pivot->price * $meal->pivot->quantity; @endphp
                                                @endforeach
                                                    {{$sumPrice}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <th>{{__('lang.offer')}} :</th>
                                            <td>
                                                @php
                                                    $sumOffer = 0;
                                                @endphp
                                                @foreach($order_details as $key => $meal)
                                                    @php $offer = $sumOffer += $meal->offer_price * $meal->pivot->quantity; @endphp
                                                @endforeach
                                                {{$sumOffer}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{__('lang.delivery')}} :</th>
                                            <td>{{$store->delivery_price}}</td>
                                        </tr>
                                        <tr>
                                            <th>{{__('lang.total')}} :</th>
                                            <td>{{$price - $offer + $store->delivery_price}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <a onclick="window.print()" class="btn btn-default print"><i class="fa fa-print"></i> {{__('lang.print')}} </a>
                            </div>
                        </div>
                    </section><!-- /.content -->


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>










@endsection
