@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
    {{ __('product.product') }} - {{ __('product.pending') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('product.product') }} - {{ __('product.pending') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route ('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('product.product') }} - {{ __('product.pending') }}</li>
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
                                    <th>{{__('product.imageColumn')}}</th>
                                    <th>{{__('product.nameColumn')}}</th>
                                    <th>{{__('product.storeColumn')}}</th>
                                    <th>{{__('product.spacialCategoryColumn')}}</th>
                                    <th>{{__('product.actionColumn')}}</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
        
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><img style="width: 50px; height: 50px" src="{{asset($record->image1)}}"></td>
                                            <td>{{$record->name ?? ''}}</td>
                                            <td>{{$record->store->name  ?? ''}}</td>
                                            <td>{{$record->spacialCategory->name  ?? ''}}</td>
                                            <td>
                                                <a style="display: inline-block" href="{{url('product/'.$record->id)}}" class="btn btn-success" title="عرض">
                                                    <i class="mdi mdi-file-eye"></i>
                                                </a>
        
                                                <form style="display: inline-block" method="POST" action="{{route('product.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord">
                                                            <i class="mdi mdi-delete-alert" title="حذف"></i>
                                                        </a>
                                                    </div>
                                                </form>
        
                                                <a style="display: inline-block" href="{{url('product/active/'.$record->id)}}" class="btn btn-secondary" title="تفعيل">
                                                    <i class="dripicons-checkmark"></i>
                                                </a>
        
                                                <button type="button" style="display: inline-block" data-productId="{{$record->id}}"
                                                        class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#cancelProduct" title="كنسلة">
                                                    <i class="{{ App::isLocale('ar') ? 'dripicons-document' : 'dripicons-document-delete'}}"></i>
                                                </button>
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

     <!-- Modal -->
    <div class="modal fade" id="cancelProduct" tabindex="-1" role="dialog" aria-labelledby="cancelProductTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">الغاء عرض المنتج</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('product.cancel')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> سبب
                                الالغاء </label>
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="product_id" id="product_id" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
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

    <script>
        $('#cancelProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var product_id = button.data('productid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id);
        });
    </script>
@endsection