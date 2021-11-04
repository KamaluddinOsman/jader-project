
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.category')}}
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
                        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> {{__('lang.category')}}</li>
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i>{{$records[0]->parent->name}}</li>
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
                                    data-target="#Addcategory">
                                {{__('lang.addCategory')}}
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('lang.image')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.active')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($records))

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><img style="width: 50px; height: 50px" src="{{asset($record->getOriginal('image'))}}"></td>
                                            @if($record->child($record->id) == false)
                                               <td><a href="{{url('category/'.$record->id)}}">{{$record->name}}</a></td>
                                            @else
                                                <td>{{$record->name}}</td>
                                            @endif
                                            <td><button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-myname="{{$record->name}}" data-categoryid="{{$record->id}}" data-parentid="{{$record->parent_id}}" data-toggle="modal" data-target="#Editcategory"><i class="fa fa-edit"></i></button></td>

                                            <td>
                                                @if($record->activated == 1)

                                                    <div class="checkbox">
                                                        <input data-url="{{url('category/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                                    </div>

                                                @else
                                                    <div class="checkbox">
                                                        <input data-url="{{url('category/active/'.$record->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                                    </div>

                                                @endif
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
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.active')}}</th>
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
    <div class="modal fade" id="Addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.addCategory')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('/admin/category/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="Editcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.EditCategory')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update','category')}}" method="post" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="category_id" id="category_id" value="">
                        @include('/admin/category/form')
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
