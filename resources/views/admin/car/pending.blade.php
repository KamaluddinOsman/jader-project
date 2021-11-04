
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
                                class="fa fa-dashboard"></i> {{__('lang.carPending')}}</li>
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
                        <th>{{__('lang.Number')}}</th>
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
                                <td><img style="width: 50px; height: 50px" src="{{asset($record->image_car)}}"></td>
                                <td>{{$record->number}}</td>
                                <td><a href="{{url('car/'.$record->id)}}" class="btn btn-success"><i
                                            class="fa fa-eye"></i></a></td>
                                <td><a href="{{url('car/'.$record->id.'/edit')}}" class="btn btn-warning"><i
                                            class="fa fa-edit"></i></a></td>
                                <td>
                                    <div class="checkbox">
                                        <input data-url="{{url('car/active/'.$record->id)}}"
                                               data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck"
                                               type="checkbox" data-on="{{__('lang.active')}}"
                                               data-off="{{__('lang.block')}}"
                                               {{$record->active == 1 ? 'checked' : '' }} data-toggle="toggle"
                                               data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </td>
                                <td>
                                    <form style="display: inline-block" method="POST" action="{{route('car.destroy', $record->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <a class="btn btn-danger btn-mini deleteRecord">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </form>

                                    <button type="button" style="display: inline-block" data-carId="{{$record->id}}"
                                            class="btn btn-primary"
                                            data-toggle="modal" data-target="#cancelCar">
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
                        <th>{{__('lang.Number')}}</th>
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


        <!-- Modal -->
        <div class="modal fade" id="cancelCar" tabindex="-1" role="dialog" aria-labelledby="cancelCarTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">الغاء طلب الإنضمام</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('car.cancel')}}" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                @csrf
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> سبب
                                    الالغاء </label>
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="car_id" id="car_id" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
