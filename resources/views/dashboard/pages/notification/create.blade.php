@extends('dashboard.layouts.main')
@section('head')
    @section('title')
            {{__('lang.category')}}
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Data Tables</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCategory">
                            {{__('lang.addCategory')}}
                        </button>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div> --}}
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <form action="{{route('notification.send')}}" method="post"> --}}
                        <form action="javascript: void(0)" method="post">
                            @csrf
            
                            <section class="container">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ __('notification.sendNotification') }}</h4>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label">{{__('notification.type')}}</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="client">Client</option>
                                                            <option value="car">Car</option>
                                                            <option value="store">Store</option>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">{{__('notification.title')}}</label>
                                                    <div class="col-md-10">
                                                        {!! Form::text('title',null,['class' => 'form-control', 'id' => 'title']) !!}
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">{{__('notification.body')}}</label>
                                                    <div class="col-md-10">
                                                        {!! Form::text('body',null,['class' => 'form-control', 'id' => 'body']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
            
                                            <div  style="margin: 0 0 30px 30px" class="form-group">
                                                <button class="btn btn-primary submit-btn" >{{ __('notification.send') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    {{-- <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">{{__('lang.notificationSend')}}</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                
                                            </div>
            
                                            <div class="clearfix"></div>
            
                                            <div  style="margin: 0 0 30px 30px" class="form-group">
                                                <button class="btn btn-primary submit-btn" >{{__('lang.save')}}</button>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
            
                            </section>
                            <div class="clearfix"></div> --}}
                        </form>
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

    <!-- Buttons examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    {{-- <script src="{{ asset('dashboard/js/app.js') }}"></script> --}}

@endsection