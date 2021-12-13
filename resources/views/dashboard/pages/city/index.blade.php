@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('city.city') }} | {{ __('auth.bageTitle') }}             
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
                    <h4 class="page-title mb-0 font-size-18">{{ __('city.cityTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('city.cityTable') }}</li>
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
                        <button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCity">
                                {{__('city.addCity')}}
                        </button>
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
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('city.cityNameColumn')}}</th>
                                        <th>{{__('city.editCityColumn')}}</th>
                                        <th>{{__('city.deleteCityColumn')}}</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>{{$record->name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-myname="{{$record->name}}"
                                                    data-cityid="{{$record->id}}"
                                                    data-bs-target="#editCity">
                                                    <i class="dripicons-document-edit"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{route('city.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
        
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord" id="sa-warning">
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

    <!-- Add City Modal-->
    <div class="modal fade" id="addCity" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCityLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCityLabel">
                        {{__('city.addCity')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('/dashboard/pages/city/create')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

     <!-- Edit City Modal -->
     <div class="modal fade" id="editCity" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCityLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityLabel">
                        {{__('city.editCity')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('city.update','city')}}" method="post">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="city_id" id="city_id" value="">
                        @include('/dashboard/pages/city/form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('city.close') }}</button>
                            <button class="btn btn-primary" type="submit"> {{__('city.editCity')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
        $('#editCity').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('myname') // Extract info from data-* attributes
            var city_id = button.data('cityid') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #city_id').val(city_id);
        })

        $('#AddDistrict').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id_city = button.data('idcity') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #id_city').val(id_city);
        })

        $('#EditDis').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('disname') // Extract info from data-* attributes
            var district_id = button.data('disid') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #district_id').val(district_id);
        });
    </script>
@endsection