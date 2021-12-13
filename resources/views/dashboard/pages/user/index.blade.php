@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('user.user') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('user.userTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{ __('user.userTable') }}</li>
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
                        <a href="{{url('user/create')}}" class="btn btn-primary" style="height: 40px;">
                            <p>{{__('user.addUser')}}</p>
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
                                    <th>{{ __('user.nameColumn') }}</th>
                                    <th>{{ __('user.emailColumn') }}</th>
                                    <th>{{ __('user.roleColumn') }}</th>
                                    <th>{{ __('user.editColumn') }}</th>
                                    <th>{{ __('user.deleteColumn') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if ($user->roles)
                                                    <ul class="list-unstyled">
                                                        @foreach($user->roles as $role)
                                                            <li>
                                                                <span class="label label-success">{{$role->display_name}}</span>
                                                            </li>
                                                        @endforeach
                                                        @else
                                                            <li>
                                                                <span class="label label-success">{{__('user.noRole')}}</span>
                                                            </li>
                                                    </ul>
                                                @endif
                                            </td>
        
                                            <td>
                                                <a href="{{url(route('user.edit',$user->id))}}" class="btn btn-warning">
                                                    <i class="dripicons-document-edit"></i>
                                                </a>
                                            </td>
        
                                            <td>
                                                <form method="POST" action="{{route('user.destroy', $user->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord">
                                                            <i class="mdi mdi-delete-alert"></i>
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
    
@endsection