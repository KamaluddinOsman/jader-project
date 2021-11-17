

@extends('admin.layouts.layout')
@section('title')
{{__('lang.delivers_costs')}}
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
                    <li class="breadcrumb-item"><a href="/"><i
                                class="fa fa-dashboard"></i> {{__('lang.master')}}
                        </a></li>
                    <li class="breadcrumb-item active"><i
                            class="fa fa-dashboard"></i> {{__('lang.delivers_costs')}}</li>
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
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <a href="{{url(route('deliveryCost.create'))}}" style="margin-bottom: 8px" class="btn btn-primary">اضافة تكلفه </a>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>#</th>
                            <th>من كم </th>
                            <th>الى كم </th>
                            <th>من سعر </th>
                            <th>الى سعر </th>
                            <th>نوع السياره </th>
                            <th>تعديل</th>
                            <th>حذف</th>

                        </tr>
                        </thead>
                        <tbody>


                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->from_k}}</td>
                                    <td>{{$record->to_k}}</td>
                                    <td>{{$record->from_price}}</td>
                                    <td>{{$record->to_price}}</td>
                                    <td>
                                        //  --  --  --  --  --  --
                                        @if($record->type_car == 1)
                                            صغيره سيدان
                                        @elseif($record->type_car == 2)
                                            بكب صغيره
                                        @elseif($record->type_car == 3)
                                            دينا
                                        @elseif($record->type_car == 4)
                                            بكب كبيره
                                        @elseif($record->type_car == 5)
                                            سطحه
                                        @elseif($record->type_car == 6)
                                            شاحنة
                                        @elseif($record->type_car == 7)
                                            قلاب
                                        @endif
                                    </td>
                                    <td><a href="{{url(route('deliveryCost.edit',$record->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form method="POST" action="{{route('deliveryCost.delete', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </form>
                                </tr>
                            @endforeach

                        @else

                            <div class="alert alert-warning alert-block">
                                <strong>لا يوجد بيانات</strong>
                            </div>

                        @endif


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>من كم </th>
                            <th>الى كم </th>
                            <th>من سعر </th>
                            <th>الى سعر </th>
                            <th>نوع السياره </th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


@endsection



