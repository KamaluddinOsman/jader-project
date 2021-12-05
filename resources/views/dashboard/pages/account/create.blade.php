@extends('admin.layouts.layout')
@section('title')
    {{__('lang.moneyTransactions')}}
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
                        <li class="breadcrumb-item active">{{__('lang.moneyTransactions')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <br>
    <br>
    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div style="text-align: center" class="alert alert-warning" role="alert">
         يرجى قبل حفظ بيانات التحويل التأكد من بيانات التحويل لانك لا يمكنك التعديل هنا مره اخرى بسبب ارسال اشعار للعميل بالمبلغ (إدارة جدير)
    </div>
    <div class="box">
        <div class="box-body">
            <div class="col">
                <form action="{{route('transactions.money')}}" method="post" enctype = 'multipart/form-data',>
                    @csrf

                    <section class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('lang.moneyTransactions')}}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">{{__('lang.type')}}</label>
                                            <select id="type" name="type" class="form-control select2"
                                                    id="exampleFormControlSelect1">
                                                <option>إختر</option>
                                                <option value="client">Client</option>
                                                <option value="car">Car</option>
                                                <option value="stores">Store</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription">المحول اليه</label>
                                            <select name="client_id" id="client" class="form-control select2">
                                                <option>أختر</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                                   class="label">{{__('lang.money')}} </label>
                                            {!! Form::text('money',null,['class' => 'form-control','id' => 'client_money' ]) !!}
                                        </div>

                                        <div class="form-group">
                                            <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                                   class="label">{{__('lang.transfer_Number')}} </label>
                                            {!! Form::text('transfer_Number',null,['class' => 'form-control','id' => 'body']) !!}
                                        </div>

                                        <div>
                                            <table style="text-align: center" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الاموال التى تم تحويلها</th>
                                                    <th scope="col">الاموال المتبقية لدينا</th>
                                                    <th scope="col">نسبتنا من الارباح</th>
                                                    <th scope="col">الإجمالى</th>
                                                </tr>
                                                </thead>
                                                <tbody id="totalMoney">

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                                           class="label">{{__('lang.note')}} </label>
                                                    {!! Form::textarea('note',null,[
                                                      'class' => 'form-control',
                                                      'id' => 'body'
                                                    ]) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">صوره من ايصال التحويل</label>

                                                    <label for="imageInp" class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </label>

                                                    <input for="imageInp"  style="display: none" name="image" type='file' id="imageInp" />
                                                    <img style="width: 220px;height:220px;margin-top: 12px;border: 1px solid #000000; display: none" id="image" src="#" alt="your image" />


                                                    @if(!empty($records->image))
                                                        <img id="image_old" style="width: 220px; height:220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->getOriginal('image')) }}">
                                                    @else
                                                        <img id="imageNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                                             src="{{ asset('public/storage/images/no_image.png') }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div style="margin: 0 0 30px 30px" class="form-group">
                                        <button class="btn btn-primary submit-btn">{{__('lang.save')}}</button>
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


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {

            $("#type").change(function () {
                $.ajax({
                    url: "{{ url('/money/getclient') }}" + "/" + $(this).val(),
                    method: 'GET',

                    success: function (data) {
                        $('#client').html(data.output);
                        select.append('<option data-type="value.type" value=' + value.id + '>' + value.name + '</option>');

                    }
                });
            });
        });


        $(document).ready(function () {

            $("#client").change(function () {
                var typeClient = $(this).find(':selected').attr('data-type');
                $.ajax({
                    url: "{{ url('/money/getAccounts') }}" + "/" + $(this).val(),
                    method: 'GET',
                    data: {'type': typeClient},

                    success: function (data) {
                        $('#totalMoney').html(data.output);
                        var todo = '<tr><td>' + 1 + '</td><td>' + value.client_money + '</td><td>' + 30 + '</td>';
                        jQuery('#totalMoney').append(todo);
                    }
                });
            });
        });

    </script>

@endsection

{{--'<option value=' + value.id + '>' + value.name + '</option>' +--}}
