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
                                class="fa fa-dashboard"></i> {{__('lang.pending')}}</li>
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
                                        <a style="display: inline-block" href="{{url('product/'.$record->id)}}" class="btn btn-success" title="??????"><i class="fa fa-eye"></i></a>

                                        <form style="display: inline-block" method="POST" action="{{route('product.destroy', $record->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                    <i class="fa fa-trash" title="??????"></i>
                                                </a>
                                            </div>
                                        </form>

                                        <a style="display: inline-block" href="{{url('product/active/'.$record->id)}}" class="btn btn-secondary" title="??????????"><i class="fa fa-check"></i></a>

                                        <button type="button" style="display: inline-block" data-productId="{{$record->id}}"
                                                class="btn btn-primary"
                                                data-toggle="modal" data-target="#cancelProduct" title="??????????">
                                            <i class="fa fa-window-close"></i>
                                        </button>
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
        </div>

    <!-- Modal -->
    <div class="modal fade" id="cancelProduct" tabindex="-1" role="dialog" aria-labelledby="cancelProductTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">?????????? ?????? ????????????</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('product.cancel')}}" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> ??????
                                ?????????????? </label>
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="product_id" id="product_id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">??????</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
