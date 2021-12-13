@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
            {{__('car.carTable')}} - {{__('car.pending')}} | {{ __('auth.bageTitle') }}
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
                    <h4 class="page-title mb-0 font-size-18">{{__('car.carTable')}} - {{__('car.pending')}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{__('car.carTable')}} - {{__('car.pending')}}</li>
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
                        <table id="datatable"
                            class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('car.imageColumn') }}</th>
                                    <th>{{ __('car.numberColumn') }}</th>
                                    <th>{{ __('car.showColumn') }}</th>
                                    <th>{{ __('car.editColumn') }}</th>
                                    <th>{{ __('car.statusColumn') }}</th>
                                    <th>{{ __('car.deleteColumn') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
                            
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><img style="width: 50px; height: 50px" src="{{asset($record->image_car_front)}}"></td>
                                            <td>{{$record->number}}</td>
                                            <td>
                                                <a href="{{url('car/'.$record->id)}}" class="btn btn-success">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('car/'.$record->id.'/edit')}}" class="btn btn-warning">
                                                    <i class="dripicons-document-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($record->activated == 1)
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" checked 
                                                    data-url="{{url('car/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('car.activeCar')}}" data-off-label="{{__('car.blockCar')}}"></label>
                                                @else
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" 
                                                    data-url="{{url('car/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('car.activeCar')}}" data-off-label="{{__('car.blockCar')}}"></label>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{route('car.destroy', $record->id)}}" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord">
                                                            <i class="mdi mdi-delete-alert"></i>
                                                        </a>
                                                    </div>
                                                </form>

                                                <button type="button" style="display: inline-block" data-carId="{{$record->id}}"
                                                    class="btn btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#cancelCar">
                                                    <i class="{{ App::isLocale('ar') ? 'dripicons-document' : 'dripicons-document-delete' }}"></i>
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

     <!-- Cancel Captain Modal -->
    <div class="modal fade" id="cancelCar" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelCarTitle"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">الغاء طلب الإنضمام</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('car.cancel')}}" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> سبب
                                الالغاء </label>
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="car_id" id="car_id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
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

        // Changing Captain Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/car";
        });

        $('#cancelCar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var car_id = button.data('carid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #car_id').val(car_id);
        });
    </script>

@endsection