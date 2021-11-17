@extends('admin.layouts.layout')

@section('title')
    {{__('lang.city')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تحويل مالى</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">التحويل المالى للعملاء</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    @include('admin.layouts.flash-message')
    @include('flash::message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        شاشة خاصة بتحويل الاموال لعملاء التطبيق الارقام والحسابات الموجودة فى هذه الشاشه بناء على
                        التعاملات المالية والمبيعات والمرتجع للعملاء
                    </div>

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> {{__('lang.jadeeer')}}
                                    <small class="float-right"> تاريخ التحويل {{ $trans->created_at }}<br></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                اسم المحول اليه
                                <address>
                                    <strong>
                                        @if($store !== '')
                                            {{$store->name }}</strong><br>
                                            {{$store->phone1 }}<br>
                                    @elseif($client !== '')
                                    {{$client->full_name }}</strong><br>
                                    {{$client->phone }}<br>
                                        @endif
                                </address>
                            </div><!-- /.col -->

                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                المسؤول عن التحويل
                                <address>
                                    <strong>{{$trans->user->name }}</strong> ({{__('lang.jadeeer')}})<br>
                                </address>
                            </div><!-- /.col -->
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b> رقم عملية التحويل </b><br>
                                <b> #{{$trans->transfer_Number }} </b><br>
                            </div><!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">المبلغ الذى تم تحويله</th>
                                        <th scope="col">الاموال المتبقية لدينا</th>
                                        <th scope="col">صوره ايصال التحويل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td> {{$trans->total_money}}</td>
                                        <td> {{$rest}}</td>
                                        <td>
                                            <a href="#" id="pop">
                                                <img title="اضغط لتكبير إيصال السداد" id="imageresource"
                                                     src="{{url($trans->image)}}" style="width: 50px; height: 50px;">
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <img src="{{url(asset('image/Everything.png'))}}" alt="jadeeer">

                                <p style="text-align: center">{{__('lang.thanks')}}</p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">نسبة التطبيق</th>
                                            <td>
                                                {{$site_money}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ارباح</th>
                                            <td>
                                                {{$commission}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a onclick="window.print()" class="btn btn-default print"><i
                                        class="fa fa-print"></i> {{__('lang.print')}} </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">صورة ايصال تحويل المبلغ</h4>
                </div>
                <div class="modal-body">
                    <img src="" id="imagepreview" style="width: 600px; height: 464px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

