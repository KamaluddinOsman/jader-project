@extends('admin.layouts.layout')
@section('title')
    {{__('lang.product')}}
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
                                class="fa fa-dashboard"></i> {{__('lang.rejected')}}</li>
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
                            <th>{{__('lang.image')}}</th>
                            <th>{{__('lang.name')}}</th>
                            <th>{{__('lang.store')}}</th>
                            <th>{{__('lang.spacialCategory')}}</th>
                            <th>{{__('lang.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td><img style="width: 50px; height: 50px" src="{{asset($record->image1)}}"></td>
                                    <td>{{$record->name ?? ''}}</td>
                                    <td>{{$record->store->name  ?? ''}}</td>
                                    <td>{{$record->spacialCategory->name  ?? ''}}</td>
                                    <td style="display: inline-block">
                                        <a style="display: inline-block" href="{{url('product/'.$record->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                        <a style="display: inline-block" href="{{url('product/active/'.$record->id)}}" class="btn btn-secondary" title="تفعيل"><i class="fa fa-check"></i></a>

                                        <form style="display: inline-block" method="POST" action="{{route('product.destroy', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

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
                                <strong>{{__('lang.ThereAreNoData')}}</strong>
                            </div>

                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{__('lang.image')}}</th>
                        <th>{{__('lang.name')}}</th>
                        <th>{{__('lang.store')}}</th>
                        <th>{{__('lang.category')}}</th>
                        <th>{{__('lang.action')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

@endsection
