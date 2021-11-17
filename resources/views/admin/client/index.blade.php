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
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}
                            </a></li>
                        <li class="breadcrumb-item active"><i
                                class="fa fa-dashboard"></i> {{__('lang.client')}}</li>
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
                            <th>{{__('lang.name')}}</th>
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.edit')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.delete')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->first_name .' '. $record->last_name}}</td>
                                    <td><a href="{{url('client/'.$record->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                                    <td><a href="{{url('client/'.$record->id.'/edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        @if($record->activated == 1)

                                            <div class="checkbox">
                                                <input data-url="{{url('client/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                            </div>

                                        @else
                                            <div class="checkbox">
                                                <input data-url="{{url('client/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                            </div>

                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{route('client.destroy', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @else

                            <div class="alert alert-warning alert-block">
                                <strong>{{__('lang.ThereAreNoData')}}</strong>
                            </div>

                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{__('lang.name')}}</th>
                        <th>{{__('lang.show')}}</th>
                        <th>{{__('lang.edit')}}</th>
                        <th>{{__('lang.status')}}</th>
                        <th>{{__('lang.delete')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

@endsection

