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
                    <h4 class="page-title mb-0 font-size-18">{{ __('car.carTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('car.carTable') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')
    
        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCategory">
                            {{__('car.addCar')}}
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
                        <table id="datatable-buttons"
                            class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('lang.image')}}</th>
                                    <th>{{__('lang.Number')}}</th>
                                    <th>{{__('lang.show')}}</th>
                                    <th>{{__('lang.edit')}}</th>
                                    <th>{{__('lang.status')}}</th>
                                    <th>{{__('lang.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
                            
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><img style="width: 50px; height: 50px" src="{{asset($record->image_car)}}"></td>
                                            <td>{{$record->number}}</td>
                                            <td>
                                                {{-- <a href="{{url('car/'.$record->id)}}" class="btn btn-success"> --}}
                                                <a href="javascript: void(0)" class="btn btn-success">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                {{-- <a href="{{url('car/'.$record->id.'/edit')}}" class="btn btn-warning"> --}}
                                                <a href="javascript: void(0)" class="btn btn-warning">
                                                    <i class="dripicons-document-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="checkbox">
                                                    <input data-url="{{url('car/active/'.$record->id)}}"  switch="bool"
                                                        data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck"
                                                        type="checkbox" data-on="{{__('lang.active')}}"
                                                        data-off="{{__('lang.block')}}"
                                                        {{$record->activated == 1 ? 'checked' : '' }} data-toggle="toggle"
                                                        data-onstyle="success" data-offstyle="danger">
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('lang.active')}}" data-off-label="{{__('lang.block')}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <form method="POST" action="{{route('car.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }} --}}
                                                <form method="POST" action="javascript: void(0)">
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
                                                    data-toggle="modal"
                                                    {{-- data-target="#cancelCar"> --}}
                                                    data-target="javascript: void(0)">
                                                    <i class="dripicons-document-delete"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                            
                                @else
                            
                                    <div class="alert alert-warning alert-block">
                                        <strong>{{__('lang.ThereAreNoData')}}</strong>
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

     <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategory" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">
                        {{__('lang.EditCategory')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update','category')}}" method="post" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="category_id" id="category_id" value="">
                        @include('/dashboard/pages/category/form')

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Add Category Modal-->
    <div class="modal fade" id="addCategory" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">
                        {{__('category.addCategory')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('/dashboard/pages/category/create')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

    <script>
        // Changing Category Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            // console.log(url);
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
                // success: function (data) {
                //     console.log(data);
                // }

            });
        });
        

        // Edit Category
        $('#editCategory').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('myname') // Extract info from data-* attributes
            var category_id = button.data('categoryid') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #category_id').val(category_id);
        });

        // $('#Addvariety').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget) // Button that triggered the modal
        //     var category_id = button.data('idcategory') // Extract info from data-* attributes
        //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //     var modal = $(this)
        //     modal.find('.modal-body #id_category').val(category_id);
        // });

    </script>
@endsection
