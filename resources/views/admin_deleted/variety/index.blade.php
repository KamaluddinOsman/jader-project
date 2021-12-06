
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.variety')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>  {{__('lang.master')}}</a></li>
            <li><a href="/variety"><i class="fa fa-dashboard"></i> {{__('lang.variety')}} </a> </li>
            <li class="active"><i class="fa fa-dashboard"></i> {{$category->name}}</li>

        </ol>
    </section>
    <br>
    <br>

    @include('admin.layouts.flash-message')
    @include('flash::message')

    <div class="box-body">

        <div class="table-responsive">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('lang.name')}}</th>
                            <th>{{__('lang.edit')}}</th>
                            <th>{{__('lang.active')}}</th>

                        </tr>
                        </thead>
                        <tbody>


                        @if(count($varietys))

                            @foreach($varietys as $variety)
                                <tr>
                                    <td>{{$variety->id}}</td>
                                    <td>{{$variety->name}}</td>
                                    <td><button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-myname="{{$variety->name}}" data-varietyid="{{$variety->id}}" data-toggle="modal" data-target="#Editvariety"><i class="fa fa-edit"></i></button></td>
                                    <td>
                                        @if($variety->activated == 1)

                                            <div class="checkbox">
                                                <input data-url="{{url('category.variety/active/'.$variety->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                            </div>

                                        @else
                                            <div class="checkbox">
                                                <input data-url="{{url('category.variety/active/'.$variety->id)}}" data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck" type="checkbox" data-on="{{__('lang.active')}}" data-off="{{__('lang.block')}}"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                            </div>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Modal -->
                            <div class="modal fade" id="Editvariety" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle"> {{__('lang.EditVariety')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                                <form action="{{url(LaravelLocalization::setLocale().'/category/'.$category->id.'/variety/'.$variety->id)}}" method="post">
                                                    {{method_field('PUT')}}
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="variety_id" id="variety_id" value="">
                                                    @include('/admin/variety/form')
                                                    <button class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button>
                                                </form>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                            <th>{{__('lang.edit')}}</th>
                            <th>{{__('lang.active')}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>










@endsection
