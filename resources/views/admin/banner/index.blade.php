
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.banner')}}
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
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{__('lang.banner')}}</li>
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

        <div class="table-responsive">
            <div class="box">
                <div class="box-body">


                    <div class="card">
                        <div class="card-header">
                            <button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-toggle="modal"
                                    data-target="#Addbanner">
                                {{__('lang.addbanner')}}
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('lang.image')}}</th>
                                    <th>{{__('lang.title')}}</th>
                                    <th>{{__('lang.Description')}}</th>
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.active')}}</th>
                                    <th>{{__('lang.delete')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($records))

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><img style="width: 100px; height: 100px" src="{{asset($record->getOriginal('image'))}}"></td>
                                            <td>{{$record->title}}</td>
                                            <td>{{$record->description}}</td>
                                            <td><button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-mytitle="{{$record->title}}" data-bannerid="{{$record->id}}" data-toggle="modal" data-target="#EditBanner"><i class="fa fa-edit"></i></button></td>

                                            <td>
                                                @if($record->active == 0)

                                                    <div class="checkbox">
                                                        <input data-url="{{url('banner/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}" {{$record->active == 1 ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                                    </div>

                                                @else
                                                    <div class="checkbox">
                                                        <input data-url="{{url('banner/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" title="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}" {{$record->active == 1 ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                                    </div>

                                                @endif
                                            </td>

                                            <td>
                                                <form method="POST" action="{{route('banner.destroy', $record->id)}}">
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
                                    <th>{{__('lang.image')}}</th>
                                    <th>{{__('lang.title')}}</th>
                                    <th>{{__('lang.Description')}}</th>
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.active')}}</th>
                                    <th>{{__('lang.delete')}}</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="Addbanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.addbanner')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('/admin/banner/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="EditBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.EditBanner')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('banner.update','banner')}}" method="post" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="banner_id" id="banner_id" value="">
                        @include('/admin/banner/form')
                        <button class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
