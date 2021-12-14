@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('client.client')}} | {{ __('auth.bageTitle') }}
    @endsection

     <!-- DataTables -->
     <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
 
     <!-- Sweet Alert-->
     <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('client.clientTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('client.clientTable') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('client/create')}}" class="btn btn-primary" style="height: 40px">
                            <p>{{ __('client.addClient') }}</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable"
                        class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('client.nameColumn')}}</th>
                                    <th>{{__('client.showColumn')}}</th>
                                    <th>{{__('client.editColumn')}}</th>
                                    <th>{{__('client.statusColumn')}}</th>
                                    <th>{{__('client.deleteColumn')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>{{$record->first_name .' '. $record->last_name}}</td>
                                            <td>
                                                <a href="{{url('client/'.$record->id)}}" class="btn btn-success">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('client/'.$record->id.'/edit')}}" class="btn btn-warning">
                                                    <i class="dripicons-document-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($record->activated == 1)
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" checked 
                                                    data-url="{{url('client/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('client.activeClient')}}" data-off-label="{{__('client.blockClient')}}"></label>
                                                @else
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" 
                                                    data-url="{{url('client/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('client.activeClient')}}" data-off-label="{{__('client.blockClient')}}"></label>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{route('client.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord">
                                                            <i class="mdi mdi-delete-alert"></i>
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else

                                    <div class="alert alert-warning alert-block">
                                        <strong>{{__('user.noData')}}</strong>
                                    </div>

                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    <script>
        // Changing Client Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/client";
        });

    </script>

@endsection