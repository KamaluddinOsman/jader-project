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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}
                            </a></li>
                        <li class="breadcrumb-item active"><i
                                class="fa fa-dashboard"></i> {{__('lang.storePending')}}</li>
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
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.action')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td><img style="width: 50px; height: 50px"
                                            src="{{asset($record->getOriginal('logo'))}}"></td>
                                    <td>{{$record->name}}</td>
                                    <td><a href="{{url('store/'.$record->id)}}" class="btn btn-success"><i
                                                class="fa fa-eye"></i></a></td>
                                    <td>
                                        @if($record->activated == 0)
                                            <a href="{{url('store/active/'.$record->id)}}" class="btn btn-info">
                                                {{__('lang.pending')}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form style="display: inline-block" method="POST"
                                            action="{{route('store.destroy', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </form>

                                        <button type="button" style="display: inline-block" data-storeId="{{$record->id}}"
                                                class="btn btn-primary"
                                                data-toggle="modal" data-target="#cancelStore">
                                            <i class="fa fa-window-close"></i>
                                        </button>
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
                        <th>{{__('lang.image')}}</th>
                        <th>{{__('lang.name')}}</th>
                        <th>{{__('lang.show')}}</th>
                        <th>{{__('lang.status')}}</th>
                        <th>{{__('lang.action')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>


        <div class="table-responsive">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                        </thead>
                        <tbody>


                        </tbody>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="cancelStore" tabindex="-1" role="dialog" aria-labelledby="cancelStoreTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">الغاء طلب الإنضمام</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('store.cancel')}}" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> سبب
                                الالغاء </label>
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="store_id" id="store_id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
