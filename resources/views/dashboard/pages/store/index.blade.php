@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('institution.institutions')}} | {{ __('auth.bageTitle') }}
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
                    <h4 class="page-title mb-0 font-size-18">{{ __('institution.institutionTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('institution.institutionTable') }}</li>
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
                        <a href="{{ route('store.create') }}" style="margin-bottom: 8px" class="btn btn-primary">
                            {{__('institution.addInstitution')}}
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
                                    <th>{{__('institution.imageColumn')}}</th>
                                    <th>{{__('institution.nameColumn')}}</th>
                                    <th>{{__('institution.showColumn')}}</th>
                                    <th>{{__('institution.editColumn')}}</th>
                                    <th>{{__('institution.statusColumn')}}</th>
                                    <th>{{__('institution.deleteColumn')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($records))

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>
                                                <img style="width: 50px; height: 50px" src="{{ $record->logo ? asset($record->getOriginal('logo')) : asset('img/no_image.png') }}">
                                            </td>
                                            <td>{{$record->name}}</td>
                                            <td>
                                                <a href="{{url('store/'.$record->id)}}" class="btn btn-success">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('store/'.$record->id.'/edit')}}" class="btn btn-primary">
                                                    <i class="dripicons-document-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($record->activated == 1)
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" checked 
                                                    data-url="{{url('store/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('institution.activeInstitution')}}" data-off-label="{{__('institution.blockInstitution')}}"></label>
                                                @else
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" checked
                                                    data-url="{{url('store/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('institution.activeInstitution')}}" data-off-label="{{__('institution.blockInstitution')}}"></label>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{route('store.destroy', $record->id)}}">
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

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>

    <script>
        // Changing Category Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/store";
        });

    </script>

@endsection