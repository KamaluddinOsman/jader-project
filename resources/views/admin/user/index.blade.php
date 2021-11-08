@extends('admin.layouts.layout')
@section('title')
    {{__('lang.client')}}
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
                                    class="fa fa-dashboard"></i> {{__('lang.user')}}</li>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>{{__('lang.name')}} </th>
                                <th>{{__('lang.email')}}  </th>
                                <th> الرتبه</th>
                                <th> {{__('lang.edit')}}  </th>
                                <th>{{__('lang.delete')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="label label-success">{{$role->display_name}}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        <a href="{{url(route('user.edit',$user->id))}}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <form method="POST" action="{{route('user.destroy', $user->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>الإيميل</th>
                            <th> الرتبة</th>
                            <th> تعديل</th>
                            <th>حذف</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        </div>


    @endsection

