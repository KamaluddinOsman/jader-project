@extends('admin.layouts.layout')
@section('title')
    {{__('lang.log')}}
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
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{__('lang.log')}}</li>
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
                        <th>{{__('lang.service')}}</th>
                        <th>{{__('lang.content')}}</th>
                        <th>{{__('lang.time')}}</th>
                        <th>{{__('lang.delete')}}</th>


                    </tr>
                    </thead>
                    <tbody>
                    @if(count($records))
                        @foreach($records as $record)
                            <tr>
                                <td>{{$record->id}}</td>
                                <td>{{$record->service}}</td>
                                <td>
                                    @foreach($record->content as $key => $content)
                                       <li>{{ $key.' : '.$content}}</li>
                                    @endforeach
                                </td>
                                <td>{{$record->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('log.destroy', $record->id)}}">
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
                        <th>{{__('lang.service')}}</th>
                        <th>{{__('lang.content')}}</th>
                        <th>{{__('lang.time')}}</th>
                        <th>{{__('lang.delete')}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
