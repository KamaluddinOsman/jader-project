@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('institution.institutions') }} {{__('institution.institutionPending')}} | {{ __('auth.bageTitle') }}
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
                    <h4 class="page-title mb-0 font-size-18">{{ __('institution.institutions')}} - {{ __('institution.institutionPending') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('institution.institutions')}} - {{ __('institution.institutionPending') }}</li>
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
                        <a href="javascript: void(0)" style="margin-bottom: 8px" class="btn btn-primary">
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
                                    <th>{{__('institution.statusColumn')}}</th>
                                    <th>{{__('institution.actionColumn')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
        
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>
                                                <img style="width: 50px; height: 50px" src="{{asset($record->getOriginal('logo'))}}">
                                            </td>
                                            <td>{{$record->name}}</td>
                                            <td>
                                                <a href="{{url('store/'.$record->id)}}" class="btn btn-success">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($record->activated == 0)
                                                    <a href="{{url('store/active/'.$record->id)}}" class="btn btn-info">
                                                        {{__('institution.institutionPending')}}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <form style="display: inline-block" method="POST"
                                                    action="{{route('store.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
    
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord" title="Delete">
                                                            <i class="mdi mdi-delete-alert"></i>
                                                        </a>
                                                    </div>
                                                </form>
        
                                                <button type="button" style="display: inline-block"
                                                        class="btn btn-primary"
                                                        data-storeId="{{$record->id}}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cancelStore"
                                                        title="Cancel">
                                                    <i class="{{ App::isLocale('ar') ? 'dripicons-document' : 'dripicons-document-delete'}}"></i>
                                                </button>
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

    <!-- Cancel Store Modal -->
    <div class="modal fade" id="cancelStore" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelStoreLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">الغاء طلب الإنضمام</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store.cancel')}}" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> سبب
                                الالغاء </label>
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="store_id" id="store_id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit"> حفظ</button>
                    </div>
                </form>
            </div>
        </div>
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

        $('#cancelStore').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var store_id = button.data('storeid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #store_id').val(store_id);
        });

    </script>

@endsection