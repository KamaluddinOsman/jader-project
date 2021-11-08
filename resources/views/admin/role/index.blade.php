

@extends('admin.layouts.layout')
@section('title')
{{__('lang.roles')}}
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
                            class="fa fa-dashboard"></i> {{__('lang.role')}}</li>
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
            <a href="{{url(route('role.create'))}}" style="margin-bottom: 8px" class="btn btn-primary">إضافة رتبة </a>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم </th>
                        <th>الإسم المعروض </th>
                        <th>تعديل</th>
                        <th>حذف</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($records))

                        @foreach($records as $record)
                            <tr>
                                <td>{{$record->id}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->display_name}}</td>
                                <td><a href="{{url(route('role.edit',$record->id))}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form method="POST" action="{{route('role.destroy', $record->id)}}">
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
                            <th>الاسم </th>
                            <th>الإسم المعروض </th>
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



