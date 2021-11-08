@extends('admin.layouts.layout')
@section('title')
    {{__('lang.offer')}}
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
                                class="fa fa-dashboard"></i> {{__('lang.offer')}}</li>
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
                            <th>{{__('lang.product')}}</th>
                            <th>{{__('lang.store')}}</th>
                            <th>{{__('lang.discount_value')}} (%)</th>
                            <th>{{__('lang.discount')}} (رس)</th>
                            <th>{{__('lang.start')}}</th>
                            <th>{{__('lang.end')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.active')}}</th>
                            <th>{{__('lang.delete')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($records))

                            @foreach($records as $key => $record)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td><img data-toggle="modal" data-target="#exampleModal" style="width: 50px; height: 50px; cursor: pointer" src="{{asset($record->image_license)}}"></td>
                                    <td>{{$record->name ?? ''}}</td>
                                    <td>{{$record->product->name  ?? ''}}</td>
                                    <td>{{$record->product->store->name  ?? ''}}</td>
                                    <td>{{$record->discount_value  ?? ''}} %</td>
                                    <td>{{$record->discount  ?? ''}}</td>
                                    <td>{{date('d-m-Y', strtotime($record->start)) ?? ''}}</td>
                                    <td>{{date('d-m-Y', strtotime($record->end)) ?? ''}}</td>

                                    <td>
                                        @if($record->end <= \Carbon\Carbon::now())
                                            <span class="badge badge-danger">منتهى</span>
                                        @elseif($record->start <= \Carbon\Carbon::now() && $record->end >= \Carbon\Carbon::now())
                                            <span class="badge badge-success">يعمل الان</span>
                                        @elseif($record->start > \Carbon\Carbon::now())
                                            <span class="badge badge-warning">لم يبدأ</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="checkbox">
                                            <input data-url="{{url('offer/active/'.$record->id)}}"
                                                data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck"
                                                type="checkbox" data-on="{{__('lang.active')}}"
                                                data-off="{{__('lang.waiting')}}"
                                                {{$record->status == 1 ? 'checked' : '' }} data-toggle="toggle"
                                                data-onstyle="success" data-offstyle="warning">
                                        </div>
                                    </td>
                                    <td style="display: inline-block">
                                        <form style="display: inline-block" method="POST" action="{{route('offer.destroy', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-body">
                                                <img data-toggle="modal" data-target="#exampleModal" style="cursor: pointer" src="{{asset($record->image_license)}}">
                                                <p style="text-align: center">{{$record->desc  ?? ''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <th>{{__('lang.product')}}</th>
                        <th>{{__('lang.store')}}</th>
                        <th>{{__('lang.discount_value')}} (%)</th>
                        <th>{{__('lang.discount')}} (رس)</th>
                        <th>{{__('lang.start')}}</th>
                        <th>{{__('lang.end')}}</th>
                        <th>{{__('lang.status')}}</th>
                        <th>{{__('lang.active')}}</th>
                        <th>{{__('lang.delete')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    </div>
@endsection
