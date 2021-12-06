
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.order')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>  {{__('lang.master')}}</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> {{__('lang.order')}}</li>

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
                            <th>{{__('lang.Order number')}}</th>
                            <th>{{__('lang.invoice')}}</th>
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.order History')}}</th>

                        </tr>
                        </thead>
                        <tbody>


                        @if(count($records))

                            @foreach($records as $record)
                                <tr>
                                    <td><h5>{{$record->id}}</h5></td>
                                    <td><h5>{{$record->invoice}}</h5></td>
                                    <td><a href="{{url('order/'.$record->id)}}" class="btn btn-success">{{__('lang.Show order')}}</a></td>
                                    <td>
                                        @if($record->status == 'pending')
                                            <h3 style="padding: 10px" class="label label-warning">{{__('lang.pending')}}</h3>
                                        @elseif($record->status == 'accepted')
                                            <h3 style="padding: 10px" class="label label-success">{{__('lang.accepted')}}</h3>
                                        @elseif($record->status == 'rejected')
                                            <h3 style="padding: 10px" class="label label-danger">{{__('lang.rejected')}}</h3>
                                        @elseif($record->status == 'delivered')
                                            <h3 style="padding: 10px" class="label label-info">{{__('lang.delivered')}}</h3>
                                        @elseif($record->status == 'declined')
                                            <h3 style="padding: 10px" class="label label-primary">{{__('lang.declined')}}</h3>
                                        @endif
                                    </td>
                                    <td><h5>{{$record->created_at}}</h5></td>
{{--                                    <td> <a href="javascript:" data-id="" rel="{{ $record->id }}" rel1="delete" class="btn btn-danger btn-mini deleteRecord" title="Delete"><i class="fa fa-remove"></i></a></td>--}}
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
                            <th>{{__('lang.Order number')}}</th>
                            <th>{{__('lang.invoice')}}</th>
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.order History')}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>










@endsection
