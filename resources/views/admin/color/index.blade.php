
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.color')}}
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
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{__('lang.color')}}</li>
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
                                    data-target="#AddColor">
                                {{__('lang.addColor')}}
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('lang.category')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th>{{__('lang.color')}}</th>
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.delete')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($records))

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>{{$record->category->name ?? ''}}</td>
                                            <td>{{$record->name ?? ''}}</td>
                                            <td><div style="width: 50px;height: 50px;border-radius: 50%;background-color: {{$record->code}} "></div></td>
                                            <td><button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-mycode="{{$record->code}}"  data-myname="{{$record->name}}"  data-categoryid="{{$record->category_id}}" data-colorid="{{$record->id}}" data-toggle="modal" data-target="#Editcolor"><i class="fa fa-edit"></i></button></td>
                                            <td>
                                                <form method="POST" action="{{route('color.destroy', $record->id)}}">
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
                                    <th>{{__('lang.category')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th>{{__('lang.color')}}</th>
                                    <th>{{__('lang.edit')}}</th>
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
    <div class="modal fade" id="AddColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.addColor')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('/admin/color/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="Editcolor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.EditColor')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('color.update','color')}}" method="post">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="color_id" id="color_id" value="">
                        @include('/admin/color/form')
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
