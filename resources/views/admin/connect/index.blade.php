
@extends('admin.layouts.layout')
@section('title')
    {{__('lang.messages')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/adminPanel"><i class="fa fa-dashboard"></i>  {{__('lang.master')}} </a></li>
            <li class="active"><i class="fa fa-dashboard"></i> {{__('lang.messages')}} </li>
        </ol>
    </section>
    <br>
    <br>

    <div class="box-body">


        <div class="table-responsive">

            <div class="box">

                <div class="box-body">
                    @include('flash::message')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('lang.name')}} </th>
                            <th>{{__('lang.email')}} </th>
                            <th>{{__('lang.type')}} </th>
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.delete')}}</th>

                        </tr>
                        </thead>
                        <tbody>




                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->email}}</td>

                                    <td>
                                        @if($record->type == 'complaint')
                                            <h3 style="padding: 10px" class="label label-warning">{{__('lang.complaint')}}</h3>
                                        @elseif($record->type == 'suggestion')
                                            <h3 style="padding: 10px" class="label label-success">{{__('lang.suggestion')}}</h3>
                                        @elseif($record->type == 'enquiry')
                                            <h3 style="padding: 10px" class="label label-danger">{{__('lang.enquiry')}}</h3>
                                        @endif
                                    </td>


                                    <td><a href="{{url(route('connect.show',$record->id))}}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                                    <td> <a href="javascript:" rel="{{ $record->id }}" rel1="deletemsg" class="btn btn-danger btn-mini deleteRecord" title="Delete"><i class="fa fa-remove"></i></a></td>
                                </tr>
                            @endforeach




                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{__('lang.name')}} </th>
                            <th>{{__('lang.email')}} </th>
                            <th>{{__('lang.type')}} </th>
                            <th>{{__('lang.show')}}</th>
                            <th>{{__('lang.delete')}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


@endsection

