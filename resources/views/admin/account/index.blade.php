@extends('admin.layouts.layout')
@section('title')
    {{__('lang.transactions')}}
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
                                class="fa fa-dashboard"></i> {{__('lang.transactions')}}</li>
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
                            <th>{{__('lang.type')}}</th>
                            <th>{{__('lang.money')}}</th>
                            <th>{{__('lang.show')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    @if($record->car_id !== null)
                                        <td>{{$record->car->client->full_name}} ({{$record->car->number}})</td>
                                        <td>سائق</td>
                                    @elseif($record->store_id !== null)
                                        <td>{{$record->store->client->full_name}} ({{$record->store->name}})</td>
                                        <td>منشأه</td>
                                    @elseif($record->user_id !== null)
                                        <td>{{$record->client->full_name}}</td>
                                        <td>عميل</td>
                                    @endif
                                    <td>{{$record->total_money}}</td>
                                    <td><a href="{{url('money/'.$record->id)}}" class="btn btn-success"><i
                                                class="fa fa-eye"></i></a></td>

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
                        <th>{{__('lang.type')}}</th>
                        <th>{{__('lang.money')}}</th>
                        <th>{{__('lang.show')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
